<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
  var $sess           = NULL;
  var $sess_profile   = NULL;

  function __construct() {
    parent::__construct();
    $this->sess         = $this->session->userdata('kmk_member');
    $this->sess_profile = $this->session->userdata('kmk_member_profile');

    $this->load->model('campaign_model');
  }

  function index() {

    $LIVESTREAM_CHANNEL = 6;
    $this->load->model('match_model');
    $this->load->helper(array('swiftserve'));

    $campaign = $this->campaign_model->get_list();

    //if (empty($campaign)) redirect('home/nopackage');

    $data['page_title']     = 'Welcome';
    $data['link_active']    = 'home';
    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;
    $data['campaign']       = $campaign;
    $data['slug']           = @$campaign[0]['key'];

    $today = date('Y-m-d');
    $today < '2013-08-17' ? $startDate = '2013-08-17' : $startDate = $today;

    if(@$campaign[0]['enable_home_livestream']){
      $data['url']    = channel_livestream_url($LIVESTREAM_CHANNEL);
      $data['url_rtmp']   = channel_livestream_url_rtmp($LIVESTREAM_CHANNEL);
      $data['url_ios']    = channel_livestream_url_ios($LIVESTREAM_CHANNEL);
    }

    #$this->load->view('header', $data);
    #$this->load->view('campaign/detail', $data);
    #$this->load->view('footer');
    $data['page'] = 'home/index';
    $this->load->view('v2/template', $data);
  }

  function login(){
    //$data['campaign']       = $this->campaign_model->get_default();
    $data['page_title']     = 'Welcome';
    $data['link_active']    = 'home';
    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;
/*
    $this->load->view('header', $data);
    $this->load->view('login', $data);
    $this->load->view('footer');
*/
    if (!empty($this->sess)) {
      redirect();
    }

    $data['page'] = 'login';
    $this->load->view('v2/template', $data);

  }

  function warning(){
    $data['page_title']     = 'Welcome';
    $data['link_active']    = 'home';
    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;
    $data['content']    = '<br />Untuk dapat melihat "Pertandingan Live" Silahkan anda melakukan pembelian terlebih dahulu dengan memilih paket dibawah ini : <br /><br />';

    $campaign = $this->campaign_model->get_list();
    $data['campaign']       = $campaign;
    $data['slug']           = @$campaign[0]['key'];

    $this->load->view('header', $data);
    $this->load->view('warning', $data);
    $this->load->view('footer');
  }

  function nopackage(){
    $data['campaign']       = $this->campaign_model->get_default();
    $data['page_title']     = 'Welcome';
    $data['link_active']    = 'home';

    $data['content']    = '<br />Maaf untuk saat ini tidak ada paket pertandingan yang aktif. Info lebih lanjut silahkan hubungi customer service kami. <br /><br />';

    $this->load->view('header', $data);
    $this->load->view('nopackage', $data);
    $this->load->view('footer');
  }

}
