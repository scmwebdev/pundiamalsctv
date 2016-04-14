<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends CI_Controller {
  var $sess           = NULL;
  var $sess_profile   = NULL;
  var $sess_cart      = NULL;

  function __construct() {
    parent::__construct();
    $this->sess         = $this->session->userdata('kmk_member');
    $this->sess_profile = $this->session->userdata('kmk_member_profile');
    $this->sess_cart    = $this->session->userdata('kmk_cart');

    /*if (empty($this->sess)) redirect();
    if (empty($this->sess_profile)) redirect();
    if ($this->sess_profile['is_validate'] == '0') redirect();*/
  }

  function index() {
    $data['page_title']     = 'Login';
    $data['sess']           = $this->sess;

    $this->load->view('header', $data);
    $this->load->view('payment/index', $data);
    $this->load->view('footer');
  }

  function success() {
    echo "success";
  }

  function failed() {
    echo "failed";
  }

  function error() {
    echo "error";
  }

  function hacked() {
    echo "hacked";
  }

  function add($id_package) {
    //$this->_check_sess();

    if (empty($this->sess_cart)) {
      $this->sess_cart[] = $id_package;
    } else {
      if (!in_array($id_package, $this->sess_cart)) $this->sess_cart[] = $id_package;
    }

    $this->session->set_userdata('kmk_cart', $this->sess_cart);

    redirect('payment/checkout');
  }

  function checkout() {
    //$this->_check_sess();

    $data['page_title']     = 'Checkout';
    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;
    $data['sess_cart']      = $this->sess_cart;
    $data['discount']       = $this->session->userdata('kmk_discount');

    if (empty($this->sess_cart)) {
      $data['cart']   = array();
    } else {
      $this->load->model('payment_model');
      $data['cart']      = $this->payment_model->get_cart_list($this->sess_cart);
    }

    if (empty($data['sess_profile'])) {
      $data['mst_propinsi']   = $this->core_model->get_data(array('table'=>'mst_propinsi', 'order_by'=>'nama_propinsi asc'));
      $data['mst_teams']      = $this->core_model->get_data(array('table'=>'teams', 'order_by'=>'team_name asc'));
    }

    $this->load->view('header', $data);
    $this->load->view('payment/checkout', $data);
    $this->load->view('footer');
  }

  function checkout_submit() {
    if ($this->input->post()) {
      if (empty($this->sess_cart) || empty($this->sess)) die();

      if (empty($this->sess_profile)) {
        $this->load->model('member_model');
        if (isset($_POST['email'])) $this->member_model->insert_profile($_POST);
      }
    }
  }

  function checkout_redirect($PAYMENTCHANNEL = '') {
    $this->_check_sess();
    if (empty($this->sess_cart)) die('No Session Cart');

    $data['sess']               = $this->session->userdata('kmk_member');
    $data['sess_profile']       = $this->session->userdata('kmk_member_profile');
    $data['sess_cart']          = $this->session->userdata('kmk_cart');
    $data['discount']           = $this->session->userdata('kmk_discount');
    $data['sess_campaign_id']   = $this->session->userdata('campaign_id');

    $this->load->model('payment_model');

    // temporary true for alpha version
    #die(print_r($data['discount']));
    $data['invoice']        = $this->payment_model->create_invoice($data['sess_cart'], $data['discount'], $data['sess_campaign_id']);
    $data['PAYMENTCHANNEL'] = ($this->input->post('PAYMENTCHANNEL')) ? $this->input->post('PAYMENTCHANNEL') : $PAYMENTCHANNEL;

    $id_invoice = $this->payment_model->id_invoice;

    $this->payment_model->invoice_to_match($data['invoice']['transidmerchant']);

    //jika mode pembayaran lewat atm
    if (in_array($data['PAYMENTCHANNEL'], array('bni', 'bca', 'mandiri'))) {
      $arr_data = array(
        'bank_name' => $data['PAYMENTCHANNEL'],
        'unic_code' => $this->session->userdata('unic_code'),
      );
      $this->payment_model->update_invoice($arr_data, $id_invoice);
      $invoice = $this->payment_model->get_by_id($id_invoice);
      redirect('payment/confirm/'.$invoice->no_invoice);
      exit;
    }
    //end atm

    if($data['invoice']['totalamount'] > 0){
      //submit to doku
      $this->load->view('payment/checkout_submit', $data);
    }else{
      redirect('payment/result/');
    }
  }

  function check_discount() {
    if ($this->input->post()) {
      //$this->_check_sess();

      //if (empty($this->sess_cart)) die(json_encode(array('status'=>'error','message'=>'Empty Cart')));

      $discount_code = trim($this->input->post('discount_code', TRUE));

      if ($discount_code == '') die(json_encode(array('status'=>'error','message'=>'Discount code required')));

      $result = $this->core_model->get_data(array('data'=>'row', 'table'=>'discountcodes', 'where'=>array('active'=>'1', 'code'=>$discount_code)));

      if (empty($result)) die(json_encode(array('status'=>'error','message'=>'Invalid discount code')));

      $this->session->set_userdata('kmk_discount', $result);

      $result['status'] = 'success';
      die(json_encode($result));
    }
  }

  function result() {
    redirect('pertandingan/index/'.$this->session->userdata('slug'));
  }

  function _check_sess() {
    if (empty($this->sess)) redirect();
    if (empty($this->sess_profile)) redirect();
    if ($this->sess_profile['is_validate'] == '0') redirect();
  }

  function invoice2match($no_invoice) {
    $this->load->model('payment_model');
    $this->payment_model->invoice_to_match($no_invoice);
  }

  function confirm($code='') {
    $this->load->model(array('payment_model'));

    if ($this->input->post()) {

      if (!isset($_POST['account_bank_name'])) die(json_encode(array('status'=>'error', 'message'=>'Nama pemilik rekening tidak boleh kosong')));
      if (!isset($_POST['total_transfer'])) die(json_encode(array('status'=>'error', 'message'=>'Jumlah transfer tidak boleh kosong')));
      if (empty($this->sess)) die(json_encode(array('status'=>'error', 'message'=>'Anda Harus Login Sebelum Confirm')));

      $arr_data = array(
        'account_bank_name' => $_POST['account_bank_name'],
        'total_transfer' => $_POST['total_transfer'],
      );

      $this->payment_model->update_invoice($arr_data, $_POST['id_invoice']);

      die(json_encode(array('status'=>'success', 'message'=>'OK')));
    }

    if (empty($code)) redirect();

    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;

    $data['row'] = $this->payment_model->get_by_no($code);

    if (empty($data['row'])) redirect();

    $data['packages'] = $this->payment_model->get_packages($data['row']->id_invoice);

    //show_code($data['package']);
    $data['page'] = empty($this->sess) ? 'login' : 'confirm';
    $this->load->view('v2/template', $data);

  }
}
