<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH.'libraries/google-api-php-client/src/Google_Client.php');
include(APPPATH.'libraries/google-api-php-client/src/contrib/Google_Oauth2Service.php');

class Google extends CI_Controller {

  public function __construct()
  {
    parent::__construct();

  }

  public function index()
  {
    die('permission dennied');
  }

  public function GplusConnect()
  {
    $this->config->load('google', true);
    $config = $this->config->item('google');

    $client = new Google_Client();
    $client->setApprovalPrompt('auto');
    $client->setApplicationName("Authentication");
    $client->setClientId($config['client_id']);
    $client->setClientSecret($config['client_secret']);
    $client->setRedirectUri($config['redirect_uri']);
    $client->setDeveloperKey($config['developer_key']);

    return $client;
  }

  public function connect()
  {
    $ref = (isset($_GET['location'])) ? $_GET['location'] : '';
    $this->session->set_userdata('location', $ref);

    $client   = $this->GplusConnect();
    $oauth2   = new Google_Oauth2Service($client);


    // step 1
    if (isset($_GET['code'])) {
      $client->authenticate();
      $_SESSION['token'] = $client->getAccessToken();
      $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
      header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
    }

    // step 2
    if (isset($_SESSION['token'])) {
      $client->setAccessToken($_SESSION['token']);
    }

    // step 3
    if (isset($_REQUEST['logout'])) {
      unset($_SESSION['token']);
      $client->revokeToken();
    }

    // core
    if ($client->getAccessToken()) {
      $user = $oauth2->Guserinfo->get();

      // The access token may have been updated lazily.
      $_SESSION['token'] = $client->getAccessToken();

    }else{
      $authUrl    = $client->createAuthUrl();
      redirect($authUrl);
    }

  }

  public function success()
  {
    $referer = $this->session->userdata('location');

    $client     = $this->GplusConnect();
    $oauth2     = new Google_Oauth2Service($client);
    $this->load->model('twitter_model');

    if(empty($_GET['code'])){
      die('Failed connection on Google+ 404');
    }


    $client->getAccessToken();
    $client->authenticate($_GET['code']);
    $_SESSION['token'] = $client->getAccessToken();


    //get user info google
    $user_info = $oauth2->userinfo->get();

    $data['name']     = $user_info['name'];
    $data['lookup']   = $user_info['id'];
    $data['password'] = $user_info['id'];
    $data['email']    = $user_info['email'];
    $data['source']   = 'google';
    $data['id_profile'] = 0;

    //search google credentials
    $googleCredential   = $this->twitter_model->findByLookup($data);

    if(count($googleCredential) < 1){
      $googleCredential   = $this->twitter_model->addUser($data);
    }

    $this->load->model('member_model');
    $profiles       = $this->member_model->get_profile($googleCredential['id_profile']);


    if (empty($profiles)) {
      $googleCredential['full_name']  = $data['name'];
      $googleCredential['email']    = $data['email'];
      $googleCredential['is_validate']= '0';
      $redirectUrl          = 'register';
    } else {
      $googleCredential['full_name']  = $profiles['first_name'].' '.$profiles['last_name'];
      $googleCredential['email']    = $profiles['email'];
      $googleCredential['is_validate']= $profiles['is_validate'];
      $redirectUrl            = 'profile';
    }

    //create session
    $this->session->sess_expiration = 28800; //expires in 8 hours
    $this->session->set_userdata('kmk_member', $googleCredential);

    isset($profiles['id_profile'])?$profiles['id_profile'] = $profiles['id_profile'] : $profiles['id_profile'] = 0;
    $activeOngoingMatches = $this->member_model->listActiveOngoingMatchesByProfile($profiles['id_profile']);

    if(count($activeOnGoingMatches) > 0){
      redirect('pertandingan');
    }else{
      redirect($referer);
    }
  }

  public function logout(){
    if (isset($_REQUEST['logout'])) {
      unset($_SESSION['token']);
      $client->revokeToken();
    }

    redirect();
  }

}
