<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jadwal extends CI_Controller {
  var $sess           = NULL;
  var $sess_profile   = NULL;

  function __construct() {
    parent::__construct();
    $this->sess         = $this->session->userdata('kmk_member');
    $this->sess_profile = $this->session->userdata('kmk_member_profile');

    $this->load->model('campaign_model');
    /*
    if(empty($this->sess_profile)){
      redirect(site_url('home/login'));
    }*/
  }

  public function _content($competition_id='',$title_jadwal='') {
    $this->load->model('match_model');
    //$campaign = $this->campaign_model->get_default();

    #if (empty($campaign)) redirect();

    $data['page_title']     = 'Jadwal';
    $data['link_active']    = 'jadwal';

    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;

    //$data['campaign']       = $campaign;
    //$data['slug']           = @$campaign[0]['slug'];

    $data['matches_by_date'] = array();
    $lastDateInDatabase = $this->match_model->getLastMatchDate();
    $now = new DateTime();
    while (true) {
      if (count($data['matches_by_date']) >= 7) break;

      $date = date('Y-m-d', $now->getTimestamp());
      if ($date > $lastDateInDatabase) break;

      $matches = $this->match_model->getMatchesByLocalDate($date, $competition_id);
      if (count($matches) > 0) {
        $data['matches_by_date'][$date] = $matches;
      }

      $now->add(new DateInterval("P1D"));
    }
    //show_code($data['matches_by_date']);

    #$this->load->view('header', $data);
    #$this->load->view('jadwal/index', $data);
    #$this->load->view('footer');

    $data['page'] = 'jadwal';
    $data['title_jadwal'] = $title_jadwal;
    $this->load->view('v2/template', $data);
  }

/*
  'premier_league'        => 8318,
  'uefa_champions_league' => 8381,
  'uefa_europa_league'    => 8295,
  'serie_a'               => 8398,
  'bundesliga'            => 8467,
  'ligue_1'               => 8463,

  8 => 'Premier League',
  10 => 'UEFA Champions League',
  18 => 'UEFA Europa League',
  13 => 'Serie A',
  9 => 'Bundesliga',
  16 => 'Ligue 1',
*/

  public function index($liga)
  {
    switch($liga) {
      case 'champions'  : $this->_content(10, 'Liga Champions'); break;
      case 'europa'     : $this->_content(18, 'Liga Eropa'); break;
      case 'serie-a'    : $this->_content(13, 'Liga Itali'); break;
      case 'bundesliga' : $this->_content(9, 'Liga Jerman'); break;
      case 'ligue-1'    : $this->_content(16, 'Liga Perancis'); break;
      default : $this->_content(8, 'Liga Inggris');
    }
  }

}
