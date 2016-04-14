<?php
class Pages extends CI_Controller {
  var $sess           = NULL;
  var $sess_profile   = NULL;

  public function __construct()
  {
      parent::__construct();
      $this->sess         = $this->session->userdata('kmk_member');
        $this->sess_profile = $this->session->userdata('kmk_member_profile');
  }

  /* Terms and condition page */
  public function terms($lang = null)
  {
    /*
    $data['page_title']   = 'Terms and condition';

    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;

    $this->load->view('header', $data);
    if($lang == NULL){
      $this->load->view('static/terms_bahasa', $data);
    }else{
      $this->load->view('static/terms', $data);
    }
    $this->load->view('footer');
    */

    $this->load->model('campaign_model');

    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;

    $data['campaign'] = $this->campaign_model->get_list();
    $data['page_title'] = 'Terms and condition';
    $data['link_active'] = 'home';
    if($lang == NULL){
      $data['page'] = 'home/syarat';
    }else{
      $data['page'] = 'home/terms';
    }
    $this->load->view('v2/template', $data);

  }

  /* about-us page */
  public function about()
  {
    $data['page_title']     = 'About Us';

    $this->load->view('header', $data);
    $this->load->view('static/about');
    $this->load->view('footer');
  }

  /* help page */
  public function help()
  {
    $data['page_title']     = 'Help';

    $this->load->view('header', $data);
    $this->load->view('static/help');
    $this->load->view('footer');

  }

  /* payments options page */
  public function payment()
  {
    $data['page_title']     = 'Payment Options';

    $this->load->view('header', $data);
    $this->load->view('static/payment');
    $this->load->view('footer');
  }


  public function faq()
  {
    /*
    $data['page_title']     = 'FAQ';
    $data['link_active']  = 'home';

    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;

    $this->load->view('header', $data);
    $this->load->view('static/faq', $data);
    $this->load->view('footer');
    */
    $this->load->model('campaign_model');

    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;

    $data['campaign'] = $this->campaign_model->get_list();
    $data['page_title'] = 'Faq';
    $data['link_active'] = 'home';
    $data['page'] = 'home/faq';
    $this->load->view('v2/template', $data);

  }
}
?>
