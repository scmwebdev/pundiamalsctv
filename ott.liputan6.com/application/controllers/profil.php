<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profil extends MY_Controller {

  function __construct()
  {
    parent::__construct();

    if (empty($this->sess)) redirect();
    $this->load->model(array('member_model', 'core_model', 'payment_model'));
  }

  public function index()
  {
    $data['page_title']     = 'Profil';
    $data['link_active']    = 'profil';

    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;

    if (empty($data['sess_profile'])) redirect();
    if ($data['sess_profile']['is_validate'] == '0') redirect();

    /*
     * kode untuk menampilkan
     * list history transaksi
     */
    $data['history'] = $this->payment_model->findAll($data['sess_profile']['id_profile']);
    $data['mst_propinsi']   = $this->core_model->get_data(array('table'=>'mst_propinsi', 'order_by'=>'nama_propinsi asc'));
    $data['mst_teams']      = $this->core_model->get_data(array('table'=>'gsm_team', 'order_by'=>'club_name asc'));

    #$this->load->view('header', $data);
    #$this->load->view('profil/index', $data);
    #$this->load->view('footer');
    $data['page'] = 'profil';
    $this->load->view('v2/template', $data);
  }

  function submit()
  {
    if (isset($_POST['email'])) $this->member_model->update_profile($_POST);
  }

/*
   * fungsi untuk menampilkan detail history
   */
  function history($id)
  {
    if (empty($id) || $id ==0) redirect();
    $data['no_trans'] = $id;
    $invoice = $this->payment_model->getIdInvoice($id);
    $data['invoice']  = $this->payment_model->findInvoiceById($invoice->id_invoice);
    $data['jadwal']   = $this->payment_model->findJadwal($invoice->id_invoice);
    $data['paket']    = $this->payment_model->findDetailInvoiceById($invoice->id_invoice);
    $this->load->view('profil/history',$data);

  }

  function confirm()
  {
    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;
    $data['rows'] = $this->payment_model->get_by_user($data['sess_profile']['id_profile']);

    $data['page'] = 'list_confirm';
    $this->load->view('v2/template', $data);

  }
}
