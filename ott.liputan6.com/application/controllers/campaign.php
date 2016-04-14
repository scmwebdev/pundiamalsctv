<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign extends MY_Controller {

  function __construct() {
    parent::__construct();

    $this->load->model(array('campaign_model','payment_model'));
    $this->DB_WRITE = $this->load->database('db_lip6_write', true);
  }

  public function _remap($method){
    if ($this->uri->segment(2) == '')
      $this->index();
    elseif ($this->uri->segment(2) == 'submit_buy')
      $this->submit_buy($this->uri->segment(3));
    elseif ($this->uri->segment(2) == 'unic_code')
      echo $this->campaign_model->get_unic_code();
    else
      $this->detail($this->uri->segment(2));
  }

  function index() {

    redirect();

    $data['page_title']     = 'Campaign List';
    $data['link_active']    = 'campaign';

    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;
    $data['campaigns']      = $this->campaign_model->get_list();

    $this->load->view('header', $data);
    $this->load->view('campaign/index', $data);
    $this->load->view('footer');
  }

  function detail($slug) {
    $this->load->model('match_model');

    $campaign = $this->campaign_model->get_detail($slug);

    if (empty($campaign)) redirect();

    $liga_name = liga_name($campaign[0]['competition_id']);

    // cek apakah sudah beli atau belum
    $is_buyed = $this->campaign_model->is_buyed($slug);
    if (!empty($this->sess_profile) and $is_buyed) {
      // redirect ke pertandingan
      redirect('pertandingan/index/'.$liga_name);
    }

    $data['page_title']     = $campaign[0]['campaign_name'];
    $data['link_active']    = 'campaign';
    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;
    $data['campaign']       = $campaign;
    $data['slug']           = $slug;


    if ($this->uri->segment(3) == 'buy') {
      if (empty($data['sess_profile'])) {
        $data['mst_propinsi']   = $this->core_model->get_data(array('table'=>'mst_propinsi', 'order_by'=>'nama_propinsi asc'));
        $data['mst_teams']      = $this->core_model->get_data(array('table'=>'gsm_team', 'order_by'=>'club_name asc'));
      }

      // add session here
      $this->session->set_userdata('kmk_last_purchased_campaign', $slug);

      #$this->load->view('header', $data);
      #$this->load->view('campaign/buy', $data);
      #$this->load->view('footer');

      $data['page'] = empty($this->sess) ? 'login' : 'campaign';
      $this->load->view('v2/template', $data);
    } else {
      $this->load->view('header', $data);
      $this->load->view('campaign/detail', $data);
      $this->load->view('footer');
    }
  }

  function submit_buy($slug) {
    if ($this->input->post()) {
      if (!isset($_POST['package']))  die(json_encode(array('status'=>'error', 'message'=>'Choose One Package')));
      if (empty($this->sess)) die(json_encode(array('status'=>'error', 'message'=>'Anda Harus Login Sebelum Membeli')));

      $campaign = $this->campaign_model->get_detail($slug);
      if (empty($campaign)) die(json_encode(array('status'=>'error', 'message'=>'No Data')));

      if (empty($this->sess_profile)) {
        $this->load->model('member_model');
        if (isset($_POST['email'])) $this->member_model->insert_profile($_POST, FALSE);
      }

      $cart = array();
      foreach($_POST['package'] as $id) $cart[] = $id;
      $this->session->set_userdata('kmk_cart', $cart);

      $discount_code = trim($this->input->post('discount_code', TRUE));
      if ($discount_code == '') {
        $this->session->unset_userdata('kmk_discount');
      } else {
        $result = $this->core_model->get_data(array('data'=>'row', 'table'=>'discountcodes', 'where'=>array('active'=>'1', 'code'=>$discount_code)));
        if (empty($result))
          $this->session->unset_userdata('kmk_discount');
        else
          $this->session->set_userdata('kmk_discount', $result);
      }

      $campaign = $this->campaign_model->get_detail($slug);
      $slug = liga_name($campaign[0]['competition_id']);
      $this->session->set_userdata('slug', $slug);

      $this->session->set_userdata('campaign_id', $campaign[0]['campaign_id']);
      $this->session->set_userdata('unic_code', $this->input->post('unic_code'));
      die(json_encode(array('status'=>'success', 'message'=>'OK')));
    }
  }

}
