<?php
class Member_model extends CI_Model {
  var $sess           = NULL;
  var $sess_profile   = NULL;

  public function __construct()
  {
    parent::__construct();
    $this->sess         = $this->session->userdata('kmk_member');
    $this->sess_profile = $this->session->userdata('kmk_member_profile');
    $this->DB_WRITE     = $this->load->database('db_lip6_write', true);
  }

  function insert_profile($data, $is_json=true) {
    if (empty($this->sess)) die(json_encode(array('status' => 'error', 'message' => 'No Session')));

    $profile = array();
    foreach($this->DB_WRITE->list_fields('member_profiles') as $row) if (isset($data[$row])) $profile[$row] = trim($data[$row]);
    $profile['create_date'] = date("Y-m-d H:i:s");

    //if ($profile['first_name'] == '' || $profile['last_name'] == '') die(json_encode(array('status' => 'error', 'message' => 'All * are required')));
    if ($profile['first_name'] == '') die(json_encode(array('status' => 'error', 'message' => 'All * are required')));

    $expl = explode(' ', $profile['first_name']);
    if (count($expl)>1) {
      $profile['first_name'] = $expl[0];
      $profile['last_name'] = $expl[1];
      if (isset($expl[2])) $profile['last_name'] .= ' '.$expl[2];
      if (isset($expl[3])) $profile['last_name'] .= ' '.$expl[3];
    }

    $this->load->helper('email');
    if (!valid_email($profile['email'])) die(json_encode(array('status' => 'error', 'message' => 'Invalid Email Address')));

    $this->DB_WRITE->select('id_profile');
    $this->DB_WRITE->from('member_profiles');
    $this->DB_WRITE->where('email', $profile['email']);
    $this->DB_WRITE->limit(1);
    $row = $this->DB_WRITE->get()->row_array();

    if (!empty($row)) die(json_encode(array('status' => 'error', 'message' => 'Email address already exist')));

        /*if ($this->sess['source'] == 'twitter') {
            $profile['is_validate'] = '0';
        } else {

        }*/

    $profile['is_validate'] = '1';
    $profile['hash'] = md5(uniqid(rand(), true));

    $this->DB_WRITE->insert('member_profiles', $profile);
    $id_profile = $this->DB_WRITE->insert_id();

    $this->DB_WRITE->where('id_credential', $this->sess['id_credential']);
    $this->DB_WRITE->update('member_credentials', array('id_profile' => $id_profile));

    $profile['teams'] = array();
    if (isset($_POST['team'])) {
      foreach($_POST['team'] as $id_team) {
        $team = array();
        $team['id_team']    = $id_team;
        $team['id_profile'] = $id_profile;

        $this->DB_WRITE->insert('profiles_teams', $team);

        $profile['teams'][] = $id_team;
      }
    }

    $this->sess['id_profile']   = $id_profile;
    $this->sess['is_validate']  = $profile['is_validate'];

    $this->session->set_userdata('kmk_member', $this->sess);
    //$this->session->set_userdata('kmk_member_profile', $profile);

    $this->get_profile($this->sess['id_profile']);

        /*if ($this->sess['source'] == 'twitter') {
        $link   = base_url()."twitter/validate/".$profile['hash'];

        //~ send email
        $this->load->library('libmail');
        $this->libmail->sendMail(array(
          "replyTo"   => "noreply@kmkonline.co.id",
          "to"      => $profile['email'],
          "senderName"  => "KMK OTT",
          "subject"   => "Twitter Email Validate",
          "message"   => "Validate your registration here: <a href='".$link."'>".$link."</a>"
        ));

        die(json_encode(array('status' => 'success', 'valid' => '0', 'message' => 'Check your email for last validation')));
        } else {
            die(json_encode(array('status' => 'success', 'valid' => '1', 'message' => 'Profile Added Successfully')));
        }*/

    if ($is_json) die(json_encode(array('status' => 'success', 'valid' => '1', 'message' => 'Profile Added Successfully')));
  }

  function update_profile($data) {
    if (empty($this->sess)) die(json_encode(array('status' => 'error', 'message' => 'No Session')));

    $profile = array();
    foreach($this->DB_WRITE->list_fields('member_profiles') as $row) if (isset($data[$row])) $profile[$row] = trim($data[$row]);

    if (!isset($data['send_email'])) $profile['send_email'] = '0';
    if ($profile['first_name'] == '' || $profile['last_name'] == '') die(json_encode(array('status' => 'error', 'message' => 'All * are required')));

    $this->load->helper('email');
    if (!valid_email($profile['email'])) die(json_encode(array('status' => 'error', 'message' => 'Invalid Email Address')));

    $this->DB_WRITE->select('id_profile');
    $this->DB_WRITE->from('member_profiles');
    $this->DB_WRITE->where('id_profile <>', $this->sess['id_profile']);
    $this->DB_WRITE->where('email', $profile['email']);
    $this->DB_WRITE->limit(1);
    $row = $this->DB_WRITE->get()->row_array();

    if (!empty($row)) die(json_encode(array('status' => 'error', 'message' => 'Email address already exist')));

    $this->DB_WRITE->where('id_profile', $this->sess['id_profile']);
    $this->DB_WRITE->update('member_profiles', $profile);

    $profile['is_validate'] = '1';

    $profile['teams'] = array();
    $this->DB_WRITE->delete('profiles_teams', array('id_profile' => $this->sess['id_profile']));
    if (isset($_POST['team'])) {
      foreach($_POST['team'] as $id_team) {
        $team = array();
        $team['id_team']    = $id_team;
        $team['id_profile'] = $this->sess['id_profile'];

        $this->DB_WRITE->insert('profiles_teams', $team);

        $profile['teams'][] = $id_team;
      }
    }

    $this->sess['full_name']= $profile['first_name'].' '.$profile['last_name'];
    $this->sess['email']    = $profile['email'];

    $this->session->set_userdata('kmk_member', $this->sess);
    //$this->session->set_userdata('kmk_member_profile', $profile);

    $this->get_profile($this->sess['id_profile']);

    die(json_encode(array('status' => 'success', 'message' => 'Profile Updated Successfully')));
  }

  function get_profile($id_profile) {
    $this->DB_WRITE->select('p.*, mp.nama_propinsi, mkk.nama_kabupaten_kota');
    $this->DB_WRITE->where('p.id_profile', $id_profile);
    $this->DB_WRITE->from('member_profiles p');
    $this->DB_WRITE->join('mst_propinsi mp', 'mp.id_propinsi = p.id_propinsi', 'left');
    $this->DB_WRITE->join('mst_kabupaten_kota mkk', 'mkk.id_kabupaten_kota = p.id_kabupaten_kota', 'left');
    $this->DB_WRITE->limit(1);
    $row = $this->DB_WRITE->get()->row_array();

    if (!empty($row)) {
      $this->DB_WRITE->select('id_team');
      $this->DB_WRITE->from('profiles_teams');
      $this->DB_WRITE->where('id_profile', $id_profile);
      $teams = $this->DB_WRITE->get()->result_array();

      $row['teams'] = array();
      foreach($teams as $team) $row['teams'][] = $team['id_team'];

      $this->session->set_userdata('kmk_member_profile', $row);
    }

    return $row;
  }

  function get_sources($id_profile) {
    $this->DB_WRITE->where('id_profile', $id_profile);
    $this->DB_WRITE->from('member_credentials');
    $row = $this->DB_WRITE->get()->result_array();

    return $row;
  }

  function add_profile_twitter($data)
  {
    $time = date("Y-m-d H:i:s");

    $xdata = array(
      'first_name'   => $data['first_name'] ,
      'email'      => $data['email'] ,
      'create_date'  => $time,
      'is_validate'  => 0,
    );

    $this->DB_WRITE->insert('member_profiles', $xdata);

    $id         = $this->DB_WRITE->insert_id();
    $data['id_profile'] = $id;

    $this->DB_WRITE->where('id_credential', $this->sess['id_credential']);
    $this->DB_WRITE->update('member_credentials', array('id_profile' => $id));

    return $data;

  }

  function twitter_member_active($id)
  {
    $data = array(
      'is_validate' => 1
    );

    $this->DB_WRITE->where('id_profile', $id);
    $this->DB_WRITE->update('member_profiles', $data);

  }

  function get_kabupaten_kota($id) {
    $this->DB_WRITE->select('id_kabupaten_kota, nama_kabupaten_kota');
    $this->DB_WRITE->from('mst_kabupaten_kota');
    $this->DB_WRITE->where('id_propinsi', $id);

    return $this->DB_WRITE->get()->result_array();
  }

  /*
   * fungsi checkmatchforuser
   * digunakan untuk cek apakah user boleh menonton pertandingan atau tidak
   */

  function checkmatchforuser($match_id,$id_profile){
    return $this->db->get_where('profiles_invoice_matches',array('id_profile'=>$id_profile,'id_match'=>$match_id));
  }

  function listMatchByProfile($id_profile=NULL){
    $this->DB_WRITE->select('*');
    $this->DB_WRITE->from('profiles_invoice_matches');
    $this->DB_WRITE->where('id_profile',$id_profile);

    return $this->DB_WRITE->get()->result_array();
  }

  function listActiveOngoingMatchesByProfile($id_profile=NULL){
    $localDate = date('Y-m-d');

    $startOfDayUTC = new DateTime("$localDate 00:00:00");
    $startOfDayUTC->setTimeZone(new DateTimeZone('UTC'));

    $sql = $this->db->query("
      SELECT pim.*
      FROM profiles_invoice_matches pim
      INNER JOIN gsm_match gm
      ON pim.id_match = gm.match_id
      WHERE pim.id_profile = {$id_profile}
      AND gm.active = TRUE
      AND ((gm.date_utc = '".$startOfDayUTC->format('Y-m-d')."' AND gm.time_utc >= '".$startOfDayUTC->format('H:i:s')."')
      OR (gm.date_utc >= '".$localDate."'))
    ");

    return $sql->result_array();
  }
}
