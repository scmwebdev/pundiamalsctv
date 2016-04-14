<?php
class Campaign_model extends CI_Model {
  var $sess           = NULL;
  var $sess_profile   = NULL;
  var $sess_cart      = NULL;

  public function __construct()
  {
    parent::__construct();
    $this->DB_WRITE = $this->load->database('db_lip6_write', true);

    $this->sess         = $this->session->userdata('kmk_member');
    $this->sess_profile = $this->session->userdata('kmk_member_profile');
    $this->sess_cart    = $this->session->userdata('kmk_cart');
  }

  function get_list() {
    $this->DB_WRITE->select('campaigns.*, templates.filename');
    $this->DB_WRITE->from('campaigns');
    $this->DB_WRITE->join('templates', 'templates.id = campaigns.template_id');
    $this->DB_WRITE->where('campaigns.is_active', 1);
    $this->DB_WRITE->order_by('campaigns.id desc');

    $result = $this->DB_WRITE->get()->result_array();
    return $result;
  }

  function get_listx($competition_id=0) {
    $currentTimeUTC = new DateTime();
    $currentTimeUTC->setTimeZone(new DateTimeZone('UTC'));
    $datetime = $currentTimeUTC->format("Y-m-d H:i:s");

    $this->DB_WRITE->select('c.*, cp.*, t.filename');
    $this->DB_WRITE->from('campaigns c');
    $this->DB_WRITE->join('campaigns_packages cp', 'cp.campaign_id = c.id');
    $this->DB_WRITE->join('packages p', 'cp.package_id = p.id');
    $this->DB_WRITE->join('templates t', 't.id = c.template_id');
    $this->DB_WRITE->where('cp.start_datetime <=', $datetime);
    $this->DB_WRITE->where('cp.end_datetime >=', $datetime);
    if (!empty($competition_id)) {
      $this->DB_WRITE->where('p.competition_id', $competition_id);
    }
    $this->DB_WRITE->order_by('cp.start_datetime asc');

    $result = $this->DB_WRITE->get()->result_array();
    return $result;
  }

  function get_detail($slug) {
    $currentTimeUTC = new DateTime();
    $currentTimeUTC->setTimeZone(new DateTimeZone('UTC'));
    $datetime = $currentTimeUTC->format("Y-m-d H:i:s");

    $this->DB_WRITE->select('c.id as campaign_id, c.name as campaign_name, c.key, cp.*, p.name as package_name,
      p.type as package_type, p.value as package_value, p.competition_id
      ');
    $this->DB_WRITE->from('campaigns c');
    $this->DB_WRITE->join('campaigns_packages cp', 'cp.campaign_id = c.id');
    $this->DB_WRITE->join('packages p', 'cp.package_id = p.id');

    #$this->DB_WRITE->where('cp.start_datetime <=', $datetime);
    #$this->DB_WRITE->where('cp.end_datetime >=', $datetime);

    $this->DB_WRITE->where('c.key', $slug);

    $xdata = $this->DB_WRITE->get()->result_array();

    $data = array();

    foreach ($xdata as $key => $row) {
      $start_datetime = strtotime($row['start_datetime']);
      $end_datetime   = strtotime($row['end_datetime']);

      $data[$key]['campaign_id']    = $row['campaign_id'];
      $data[$key]['campaign_name']  = $row['campaign_name'];
      $data[$key]['competition_id'] = $row['competition_id'];
      $data[$key]['key']            = $row['key'];
      $data[$key]['id']             = $row['id'];
      $data[$key]['package_id']     = $row['package_id'];
      $data[$key]['price']          = $row['price'];
      $data[$key]['start_datetime'] = $row['start_datetime'];
      $data[$key]['end_datetime']   = $row['end_datetime'];
      $data[$key]['package_name']   = $row['package_name'];
      $data[$key]['package_type']   = $row['package_type'];
      $data[$key]['package_value']  = $row['package_value'];
      $data[$key]['matches']        = $this->__getMatch($start_datetime, $end_datetime, $row['package_type'], $row['package_value'], $row['competition_id']);

    }

    return $data;
  }

  function get_default() {
    $currentTimeUTC = new DateTime();
    $currentTimeUTC->setTimeZone(new DateTimeZone('UTC'));
    $datetime = $currentTimeUTC->format("Y-m-d H:i:s");

    $this->DB_WRITE->select('c.id as campaign_id, c.enable_home_livestream, c.name as campaign_name, c.key, c.key as slug, cp.*,
      p.name as package_name, p.type as package_type, p.value as package_value');
    $this->DB_WRITE->from('campaigns c');
    $this->DB_WRITE->join('campaigns_packages cp', 'cp.campaign_id = c.id');
    $this->DB_WRITE->join('packages p', 'cp.package_id = p.id');
    $this->DB_WRITE->where('cp.start_datetime <=', $datetime);
    $this->DB_WRITE->where('cp.end_datetime >=', $datetime);
    $this->DB_WRITE->where('c.is_default', '1');

    // return $this->DB_WRITE->get()->result_array();

    $xdata = $this->DB_WRITE->get()->result_array();
    $data  = array();

    foreach ($xdata as $key => $row) {
      $start_datetime = strtotime($row['start_datetime']);
      $end_datetime   = strtotime($row['end_datetime']);

      $data[$key]['campaign_id']    = $row['campaign_id'];
      $data[$key]['enable_home_livestream'] = $row['enable_home_livestream'];
      $data[$key]['campaign_name']  = $row['campaign_name'];
      $data[$key]['key']            = $row['key'];
      $data[$key]['slug']           = $row['slug'];
      $data[$key]['id']             = $row['id'];
      $data[$key]['package_id']     = $row['package_id'];
      $data[$key]['price']          = $row['price'];
      $data[$key]['start_datetime'] = $row['start_datetime'];
      $data[$key]['end_datetime']   = $row['end_datetime'];
      $data[$key]['package_name']   = $row['package_name'];
      $data[$key]['package_type']   = $row['package_type'];
      $data[$key]['package_value']  = $row['package_value'];
      $data[$key]['matches']        = $this->__getMatch($start_datetime, $end_datetime, $row['package_type'], $row['package_value']);

    }

    return $data;

  }

  function __getMatch($start_datetime, $end_datetime, $packageType=NULL, $packagesValue=NULL, $competition_id=NULL){

    $matches = array();

    if($packageType == 'month'){
      $this->DB_WRITE->select('id, match_id, date_utc, time_utc, team_A_id, team_A_name, team_B_id, team_B_name,
                              (SELECT tla_name FROM gsm_team WHERE team_id=team_A_id) as team_A_tla,
                              (SELECT tla_name FROM gsm_team WHERE team_id=team_B_id) as team_B_tla');
      $this->DB_WRITE->from('gsm_match');
      $this->DB_WRITE->where('active', true);
      $this->DB_WRITE->where("TIMESTAMP(date_utc, time_utc) BETWEEN '$start_datetime' AND '$end_datetime'");

      if (!empty($competition_id)) {
        $this->DB_WRITE->where('competition_id', $competition_id);
      }

      $matches = $this->DB_WRITE->get()->result_array();

      //echo $this->DB_WRITE->last_query(); exit();
    }

    if($packageType == 'day'){
      if($packagesValue != ''){
        $date_val   = array();
        $days       = explode(',', $packagesValue);
        foreach($days as $day){
          $currDate = $start_datetime;
          do {
            if (date('w', $currDate) == $day) $date_val[] = date('Y-m-d', $currDate);
            $currDate = strtotime('+1 day', $currDate);
          } while($currDate <= $end_datetime);
        }

        if (!empty($date_val)) {
          $this->DB_WRITE->select('id, match_id, date_utc, time_utc, team_A_id, team_A_name, team_B_id, team_B_name,
                                  (SELECT tla_name FROM gsm_team WHERE team_id=team_A_id) as team_A_tla,
                                  (SELECT tla_name FROM gsm_team WHERE team_id=team_B_id) as team_B_tla');
          $this->DB_WRITE->from('gsm_match');
          $this->DB_WRITE->where('active', true);
          if (!empty($competition_id)) {
            $this->DB_WRITE->where('competition_id', $competition_id);
          }
          $this->DB_WRITE->where_in('date_utc', $date_val);
          $matches = $this->DB_WRITE->get()->result_array();
        }
      }
    }

    return $matches;
  }

  public function get_unic_code() {
    $sql = "SELECT max(unic_code)+1 as unic FROM `invoice` where left(tanggal_invoice, 10) = '2013-11-20'";
    $db = $this->DB_WRITE->query($sql);
    $result = $db->row_array();
    return $result['unic'];
  }

  public function is_buyed($slug){
    $id_profile = $this->sess['id_profile'];
    $sql = "
      SELECT COUNT(id_invoice) as total FROM invoice
      WHERE is_paid='YES'
      AND id_invoice IN (
        SELECT DISTINCT(id_invoice)
        FROM  `profiles_invoice_matches`
        WHERE id_campaign_package IN (
          SELECT id FROM `campaigns_packages`
          WHERE campaign_id = (SELECT id FROM campaigns WHERE `key` ='$slug')
        ) AND id_profile = '$id_profile'
      )
    ";
    $invoice = $this->db->query($sql)->row_array();
    return $invoice['total'] > 0 ? TRUE : FALSE;
  }

  public function get_by_competition($competition_id) {
    $sql = "SELECT c.*, p.competition_id FROM `campaigns` AS c
            LEFT JOIN `campaigns_packages` AS cp ON (c.id = cp.campaign_id)
            LEFT JOIN `packages` AS p ON (p.id = cp.package_id)
            WHERE p.competition_id ='$competition_id'
            AND c.is_active = 1
          ";
    return $this->db->query($sql)->row_array();
  }

  public function get_invoice_by_campaign($campaign_id) {
    $id_profile = $this->sess['id_profile'];
    $sql = "SELECT id_invoice FROM invoice
            WHERE `is_paid` ='YES' AND id_campaign = '$campaign_id'
            AND id_profile = '$id_profile' ";
    $get = $this->db->query($sql)->result_array();
    $result = array();
    foreach ($get as $key => $val) {
      $result[] = $val['id_invoice'];
    }
    return $result;
  }

  public function get_list_match_buyed($invoices = array()) {
    $sql = "SELECT gm.*, gml.fs_A, gml.fs_B
      FROM gsm_match gm
      LEFT JOIN gsm_match_live gml ON gml.match_id = gm.match_id
      LEFT JOIN profiles_invoice_matches pim ON gm.match_id = pim.id_match
      WHERE gm.active = 1
        AND pim.id_invoice IN (".implode(',', $invoices).")
      ORDER BY gm.date_utc, gm.time_utc ASC
    ";
    return $this->db->query($sql)->result_array();
  }
}
