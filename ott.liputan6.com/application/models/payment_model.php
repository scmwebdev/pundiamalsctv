<?php
class Payment_model extends CI_Model {
  var $sess           = NULL;
  var $sess_profile   = NULL;
  var $sess_cart      = NULL;
  var $id_invoice     = NULL;

  public function __construct()
  {
    parent::__construct();
    $this->DB_WRITE = $this->load->database('db_lip6_write', true);

    $this->sess         = $this->session->userdata('kmk_member');
    $this->sess_profile = $this->session->userdata('kmk_member_profile');
    $this->sess_cart    = $this->session->userdata('kmk_cart');
  }

  function get_cart_list($data) {
    $currentTimeUTC = new DateTime();
    $currentTimeUTC->setTimeZone(new DateTimeZone('UTC'));
    $datetime = $currentTimeUTC->format("Y-m-d H:i:s");

    $this->DB_WRITE->select('cp.id, p.name, cp.price');
    $this->DB_WRITE->from('packages p');
    $this->DB_WRITE->join('campaigns_packages cp', 'cp.package_id = p.id');
    //$this->DB_WRITE->join('campaigns c', 'cp.campaign_id = c.id');
    //$this->DB_WRITE->where('cp.start_datetime <=', $datetime);
    //$this->DB_WRITE->where('cp.end_datetime >=', $datetime);
    $this->DB_WRITE->where_in('cp.id', $data);
    $this->DB_WRITE->order_by('cp.start_datetime asc');

    return $this->DB_WRITE->get()->result_array();
  }

  function create_invoice($data, $discount,  $id_campaign, $demo=false) {
    ($demo == true)?$paid_status = 'YES' : $paid_status = 'NO';

    $cart_list  = $this->get_cart_list($data);
    $amount     = 0;

    foreach($cart_list as $row) {
      $amount += $row['price'];
    }

    if (empty($discount)) {
      $discount_harga = 0;
      $discountcodes  = NULL;
    } else {

      $discount_harga = ($discount['type'] == 'percentage') ? ($discount['value']/100)*$amount : $discount['value'];
      $discountcodes  = $discount['code'];
      //Update Disocunt Code Usage
      $this->__updateDiscountCode($discount['code']);
    }

    $total_amount   = $amount - $discount_harga;
    // jika menggunakan discount code dan total amount nya 0
    if($total_amount < 1){
      $paid_status = 'YES';
    }


    $invoice['no_invoice']      = date("ymd").str_rand(8);
    $invoice['id_profile']      = $this->sess['id_profile'];
    $invoice['amount']          = $amount;
    $invoice['discount']        = $discount_harga;
    $invoice['total_amount']    = $total_amount;
    $invoice['tanggal_invoice'] = date("Y-m-d H:i:s");
    $invoice['is_paid']         = $paid_status;
    $invoice['discountcodes']   = $discountcodes; //add code coupon
    $invoice['id_campaign']     = $id_campaign;

    $this->DB_WRITE->insert('invoice', $invoice);
    $this->id_invoice   = $this->DB_WRITE->insert_id();
    $basket             = '';
    $doku_totalamount   = 0;

    foreach($cart_list as $row) {
      $detail = array();
      $detail['id_invoice']   = $this->id_invoice;
      $detail['id_package']   = $row['id'];
      $detail['amount']       = $row['price'];

      $this->DB_WRITE->insert('invoice_detail', $detail);

      if ($discount_harga > 0) {
        $doku_diskon = ($discount['type'] == 'percentage') ? ($discount['value']/100)*$row['price'] : $discount['value'];
        $row['price']= ($row['price'] - $doku_diskon).'.00';
        $row['name'] = $row['name'].' ('.(($discount['type'] == 'percentage') ? $discount['value'].'% OFF' : 'PROMO').')';
      }

      $basket             .= $row['name'].','.$row['price'].',1,'.$row['price'].';';
      $doku_totalamount   += $row['price'];
    }

    $basket     = substr($basket, 0, -1);

    //if ($discount_harga != 0) $basket .= ';Discount,'.$discount_harga.',1,'.$discount_harga;

    $doku = array();
    $doku['transidmerchant']    = $invoice['no_invoice'];
    $doku['totalamount']        = $doku_totalamount.'.00';
    $doku['trxstatus']          = 'Requested';

    $this->DB_WRITE->insert('dokupay', $doku);

    $return = array();
    $return['transidmerchant']  = $doku['transidmerchant'];
    $return['totalamount']      = $doku['totalamount'];
    $return['basket']           = $basket;

    return $return;
  }

  function __updateDiscountCode($code){
    $sql    = "SELECT * FROM discountcodes WHERE code = '{$code}' LIMIT 1";
    $query  = $this->db->query($sql);
    $result = $query->result_array();

    if(!empty($result)){

      $inc    = $result[0]['counter'] + 1;
      $dc_code= $result[0]['code'];

      //jika sudah sampai batas limit pemakaian kode diskon
      if($inc == $result[0]['limit_discount']){
        //disable discount code
        $last = "UPDATE discountcodes SET counter = '{$inc}' WHERE code = '{$dc_code}' ";
        $this->db->query($last);

        $update = "UPDATE discountcodes SET active = 0 WHERE code = '{$dc_code}' ";
        $this->db->query($update);
      }else{
        $update = "UPDATE discountcodes SET counter = '{$inc}' WHERE code = '{$dc_code}' ";
        $this->db->query($update);
      }


    }



  }

  function invoice_to_match($no_invoice) {
    // get invoice
    $this->DB_WRITE->select('i.id_profile, i.id_invoice, id.id_package as id_campaign_package');
    $this->DB_WRITE->from('invoice i');
    $this->DB_WRITE->join('invoice_detail id', 'i.id_invoice = id.id_invoice');
    $this->DB_WRITE->where('i.no_invoice', $no_invoice);
    //$this->DB_WRITE->where('i.is_paid', 'YES');
    $invoices = $this->DB_WRITE->get()->result_array();

    if (!empty($invoices)) {
      foreach($invoices as $invoice) {
        $this->DB_WRITE->select('cp.start_datetime, cp.end_datetime, p.type, p.value, p.competition_id');
        $this->DB_WRITE->from('campaigns_packages cp');
        $this->DB_WRITE->join('packages p', 'p.id = cp.package_id');
        $this->DB_WRITE->where('cp.id', $invoice['id_campaign_package']);
        $package = $this->DB_WRITE->get()->row_array();

        // echo $this->DB_WRITE->last_query();
        // echo '<hr>';

        if (!empty($package)) {
          // matching team with package
          $start_datetime = strtotime($package['start_datetime']);
          $end_datetime   = strtotime($package['end_datetime']);

          $matches = array();

          if ($package['type'] == 'month') {
            $this->DB_WRITE->select('id, match_id');
            $this->DB_WRITE->from('gsm_match');
            $this->DB_WRITE->where("TIMESTAMP(date_utc, time_utc) BETWEEN '$start_datetime' AND '$end_datetime'");
            $this->DB_WRITE->where("active", 1);
            $this->DB_WRITE->where("media_id >=", 0);
            $this->DB_WRITE->where("competition_id", $package['competition_id']);
            $matches = $this->DB_WRITE->get()->result_array();
          }

          if ($package['type'] == 'day') {
            if ($package['value'] != '') {
              $date_val = array();
              $days = explode(',', $package['value']);
              foreach($days as $day) {
                $currDate = $start_datetime;
                do {
                  if (date('w', $currDate) == $day) $date_val[] = date('Y-m-d', $currDate);
                  $currDate = strtotime('+1 day', $currDate);
                } while($currDate <= $end_datetime);
              }

              if (!empty($date_val)) {
                $this->DB_WRITE->select('id, match_id');
                $this->DB_WRITE->from('gsm_match');
                $this->DB_WRITE->where_in('date_utc', $date_val);
                $this->DB_WRITE->where("competition_id", $package['competition_id']);
                $this->DB_WRITE->where("active", 1);
                $this->DB_WRITE->where("media_id >=", 0);
                $matches = $this->DB_WRITE->get()->result_array();

                // echo $this->DB_WRITE->last_query();
                // echo '<hr>';
              }
            }
          }

          // die();

          foreach($matches as $match) {
            $sql = "INSERT INTO profiles_invoice_matches (id_profile, id_invoice, id_campaign_package, id_match) VALUES (".$invoice['id_profile'].",".$invoice['id_invoice'].",".$invoice['id_campaign_package'].",".$match['match_id'].")";
            $this->DB_WRITE->simple_query($sql);

                        /*$data = array();
                        $data['id_profile']         = $invoice['id_profile'];
                        $data['id_invoice']         = $invoice['id_invoice'];
                        $data['id_campaign_package']= $invoice['id_campaign_package'];
                        $data['id_match']           = $match['match_id'];

                        $this->DB_WRITE->insert('profiles_invoice_matches', $data);*/
          }
        }
      }
    }
  }

  function findAll($id_profile = 0){
    $this->db->select('*');
    $this->db->from('invoice');
    $this->db->where('id_profile',$id_profile);
    $this->db->where('is_paid','YES');
    $this->db->order_by('id_invoice','DESC');
    $q = $this->db->get();
    return $q->result_array();
  }

  function findDetailInvoiceById($id_invoice = 0){
    $q = $this->db->query("
      SELECT a.*,b.*,c.name FROM `invoice_detail` a
      LEFT JOIN campaigns_packages AS b on a.id_package = b.id
      LEFT JOIN packages AS c on b.package_id = c.id
      WHERE a.id_invoice = {$id_invoice}
      ");


    return $q->result_array();
  }

  function findInvoiceById($id){
    $this->db->select('*');
    $this->db->from('invoice');
    $this->db->where('id_invoice',$id);
    //$this->db->where('is_paid','YES');
    $q = $this->db->get();
    return $q->row();
  }

  function findJadwal($id){
    $this->db->select('b.team_A_name,b.team_B_name,b.date_utc,b.time_utc,b.team_A_id,b.team_B_id, b.match_id,
      t1.tla_name as team_A_tla, t2.tla_name as team_B_tla');
    $this->db->from('profiles_invoice_matches a');
    $this->db->join('gsm_match b', 'a.id_match = b.match_id');
    $this->db->join('gsm_team t1', 't1.team_id = b.team_A_id', 'LEFT');
    $this->db->join('gsm_team t2', 't2.team_id = b.team_B_id', 'LEFT');
    $this->db->where('a.id_invoice',$id);
    $this->db->where('b.active',true);
    $this->db->order_by('b.date_utc, b.time_utc');

    $q = $this->db->get();
    return $q->result_array();
  }

  function getIdInvoice($id){
    return $this->db->get_where('invoice',array('no_invoice' => $id))->row();
  }

  function update_invoice($data, $id) {
    $this->DB_WRITE->where('id_invoice', $id);
    $this->DB_WRITE->update('invoice', $data);
  }

  function get_by_no($no){
    return $this->db->get_where('invoice',array('no_invoice' => $no))->row();
  }

  function get_by_id($id){
    $this->db->select('i.*, d.id_package, d.amount, p.name as package_name');
    $this->db->from('invoice i');
    $this->db->join('invoice_detail d', 'i.id_invoice = d.id_invoice', 'left');
    $this->db->join('campaigns_packages cp', 'd.id_package = cp.id', 'left');
    $this->db->join('packages p', 'cp.package_id = p.id', 'left');
    $this->db->where('i.id_invoice', $id);
    return $this->db->get()->row();
  }

  function get_by_user($id_profile){
    $this->db->from('invoice');
    $this->db->where('id_profile', $id_profile);
    $this->db->where('is_paid', 'NO');
    return $this->db->get()->result();
  }

  function get_packages($id_invoice){
    $this->db->select('d.*, p.name');
    $this->db->from('invoice_detail d');
    $this->db->join('campaigns_packages cp', 'd.id_package = cp.id');
    $this->db->join('packages p', 'cp.package_id = p.id', 'left');
    $this->db->where('d.id_invoice', $id_invoice);
    return $this->db->get()->result();
  }
}
