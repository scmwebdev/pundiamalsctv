<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Match_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
    $this->DB_WRITE = $this->load->database('db_lip6_write', true);
  }

  public function match_by_id($id){
    $sql = $this->db->query("select gm.*, m.video_player_type from gsm_match gm left join media m on m.id = gm.media_id where gm.match_id=$id");
    return $sql->row();
  }

  public function getEvent($params = array()){
    $match_id         = isset($params["match_id"]) ? $params["match_id"] : 0;
    $limit            = isset($params["limit"]) ? $params["limit"] : 100;

    $sql = $this->db->query("SELECT
      *
      FROM gsm_match_event_live
      LEFT JOIN gsm_team
      ON gsm_match_event_live.team_id = gsm_team.team_id
      WHERE match_id = '".$match_id."'
      ");

    $data = $sql->result_array();
    return $data;
  }

  public function skor_now($id=0){
    $_query = "SELECT * FROM gsm_match_live
      WHERE match_id = {$id}";

    $result = $this->db->query($_query);
    return $result;
  }

  public function getLastMatchDate() {
    $sql = $this->db->query("SELECT MAX(date_utc) AS max_date
      FROM gsm_match gm
      WHERE active = TRUE");
    return $sql->row()->max_date;
  }

  public function getMatchesByLocalDate($localDate, $competition_id=0) {
    $startOfDayUTC = new DateTime("$localDate 00:00:00");
    $startOfDayUTC->setTimeZone(new DateTimeZone('UTC'));

    $endOfDayUTC = new DateTime("$localDate 23:59:59");
    $endOfDayUTC->setTimeZone(new DateTimeZone('UTC'));

    $sql = "SELECT gm.*, gml.fs_A, gml.fs_B
      FROM gsm_match gm
      LEFT JOIN gsm_match_live gml ON gml.match_id = gm.match_id
      WHERE ((gm.date_utc = '".$startOfDayUTC->format('Y-m-d')."' AND gm.time_utc >= '".$startOfDayUTC->format('H:i:s')."')
      OR (gm.date_utc = '".$endOfDayUTC->format('Y-m-d')."' AND gm.time_utc <= '".$endOfDayUTC->format('H:i:s')."'))
      AND gm.active = 1
      AND gm.competition_id = '$competition_id'
      ORDER BY gm.date_utc, gm.time_utc ASC";
    return $this->db->query($sql)->result_array();
  }

  public function getMatchesByCompetitions($competition_id=0, $limit=10) {
    $localDate = date('Y-m-d');
    $startOfDayUTC = new DateTime("$localDate 00:00:00");
    $startOfDayUTC->setTimeZone(new DateTimeZone('UTC'));
    $sql = "SELECT gm.*, gml.fs_A, gml.fs_B
      FROM gsm_match gm
      LEFT JOIN gsm_match_live gml ON gml.match_id = gm.match_id
      WHERE gm.date_utc >= '".$startOfDayUTC->format('Y-m-d')."'
        AND gm.active = 1
        AND gm.competition_id = '$competition_id'
      ORDER BY gm.date_utc, gm.time_utc ASC
      LIMIT $limit ";
    return $this->db->query($sql)->result_array();
  }

  public function cek_match($id_match) {
    $id_profile = $this->sess['id_profile'];
    $sql = "SELECT id_match FROM profiles_invoice_matches
            WHERE id_match = '$id_match'
              AND id_profile = '$id_profile'";
    $get = $this->db->query($sql)->row_array();
    return empty($get) ? FALSE : TRUE;
  }

}
