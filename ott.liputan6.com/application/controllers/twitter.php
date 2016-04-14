<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Twitter extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('twconnect');
  }

  public function index()
  {
    die('permission denied');
  }


  public function connect()
  {
    $ref = (isset($_GET['location'])) ? $_GET['location'] : '';
    $this->session->set_userdata('location', $ref);

    $ok = $this->twconnect->twredirect('twitter/callback');

    if (!$ok) {
      echo 'Could not connect to Twitter. Refresh the page or try again later.';
    }

  }

  /* return point from Twitter */
  /* you have to call $this->twconnect->twprocess_callback() here! */
  public function callback()
  {
    // $ref = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : '';

    $this->load->library('twconnect');

    $ok = $this->twconnect->twprocess_callback();

    if ( $ok ) { redirect('twitter/success'); }
    else redirect ('twitter/failure');
  }

  /* authentication successful */
  /* it should be a different function from callback */
  /* twconnect library should be re-loaded */
  /* but you can just call this function, not necessarily redirect to it */
  public function success()
  {
    // $ref = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : '';
    $referer = $this->session->userdata('location');

    $this->load->library('twconnect');
    $this->load->model('twitter_model');
    $this->load->model('member_model');
    $this->load->model('match_model');


    $this->twconnect->twaccount_verify_credentials();
    $xdata['userinfo'] = $this->twconnect->tw_user_info;

    //print_r($xdata['userinfo']);
    if(empty($xdata['userinfo'])){
      redirect('twitter/clearsession');
    }

    $data['name']     = $xdata['userinfo']->name;
    $data['lookup']   = $xdata['userinfo']->id;
    $data['password'] = $xdata['userinfo']->screen_name;
    $data['source']   = 'twitter';
    $data['id_profile'] = 0;

    //search credentials
    $twitterCredential  = $this->twitter_model->findByLookup($data);
    if(count($twitterCredential) < 1){
      $twitterCredential  = $this->twitter_model->addUser($data);
    }

    //~ is profile exist ?
    $profiles     = $this->member_model->get_profile($twitterCredential['id_profile']);

    if (empty($profiles)) {
      $twitterCredential['full_name']     = $data['name'];
      $twitterCredential['is_validate']   = '0';
      //$redirectUrl              = 'twitter/checkmail';
      $redirectUrl              = 'register';
    } else {
      $twitterCredential['full_name']     = $profiles['first_name'].' '.$profiles['last_name'];
      $twitterCredential['email']       = $profiles['email'];
      $twitterCredential['is_validate']   = $profiles['is_validate'];
      $redirectUrl              = 'profile';
    }

    //create session
    $this->session->sess_expiration = 28800; //expires in 8 hours
    $this->session->set_userdata('kmk_member', $twitterCredential);

    isset($profiles['id_profile'])?$profiles['id_profile'] = $profiles['id_profile'] : $profiles['id_profile'] = 0;
    $activeOngoingMatches = $this->member_model->listActiveOngoingMatchesByProfile($profiles['id_profile']);

    if(count($activeOnGoingMatches) > 0){
      redirect('pertandingan');
    }else{
      redirect($referer);
    }
  }


  public function checkmail()
  {
    $this->load->library('form_validation');

    $data['page_title']     = 'Twitter Email Validate';

    $this->load->view('header', $data);
    $this->load->view('twitter_checkmail', $data);
    $this->load->view('footer');
  }

  public function sendmail()
  {

    $this->load->library('libmail');
    $this->load->library('encryption');
    $this->load->library('form_validation');
    $this->load->model('member_model');

    $to     = $this->input->post('to');
    $sess     = $this->session->userdata('kmk_member');

    $this->form_validation->set_rules('to', 'Email', 'required|valid_email');

    if ($this->form_validation->run() == FALSE){
      $data['page_title']     = 'Something Wrong,';
    }else{
      //~ validate email format

      //~ insert profile
      $data = array(
        "first_name" => $sess['full_name'],
        "email"    => $to
      );

      //~ insert & get id_profile.profile ?
      $id     = $this->member_model->add_profile_twitter($data);
      $id_profile = $this->encryption->encode($id['id_profile']);
      $link   = base_url()."twitter/validate/".$id_profile;

      //~ send email
      $this->libmail->sendMail(array(
        "replyTo"   => "noreply@kmkonline.co.id",
        "to"      => $to,
        "senderName"  => "KMK OTT",
        "subject"   => "Twitter Email Validate",
        "message"   => "<a href='".$link."'>".$link."</a>"
      ));

      $data['page_title']     = 'Email Verification sending';
      $data['send']     = 1;
    }


    $this->load->view('header', $data);
    $this->load->view('twitter_checkmail', $data);
    $this->load->view('footer');

  }

  public function validate($hash)
  {
    $this->load->model('member_model');
    $this->load->model('core_model');

    $profile = $this->core_model->get_data(array('data'=>'row','table'=>'member_profiles','where'=>array('hash'=>$hash)));

    if (empty($profile)) die('Not found');

    $this->member_model->twitter_member_active($profile['id_profile']);

    $data['page_title']     = 'Twitter Activate';
    $data['validate']   = 1;

    $this->session->sess_destroy();

    $this->load->view('header', $data);
    $this->load->view('twitter_checkmail', $data);
    $this->load->view('footer');
  }

  public function validatex($id_profile)
  {
    $this->load->model('member_model');
    $this->load->library('encryption');

    //decrypt
    $idProfile = $this->encryption->decode($id_profile);

    // search table profile id_profile ...
    $profiles = $this->member_model->get_profile($idProfile);


    if (empty($profiles)) {
      die('Restricted Access');
    } else {
      // validate
      $this->member_model->twitter_member_active($idProfile);
    }

    $data['page_title']     = 'Twitter Activate';
    $data['validate']   = 1;

    $this->load->view('header', $data);
    $this->load->view('twitter_checkmail', $data);
    $this->load->view('footer');
  }

  /* authentication un-successful */
  public function failure()
  {
    $this->session->sess_destroy();
    redirect();

    // echo '<p>Twitter connect failed</p>';
    // echo '<p><a href="' . base_url() . 'twitter/clearsession">Try again!</a></p>';
  }

  /* clear session */
  public function clearsession()
  {

    $this->session->sess_destroy();

    redirect();
  }
}
