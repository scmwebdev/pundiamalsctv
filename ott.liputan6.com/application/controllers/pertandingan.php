<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pertandingan extends CI_Controller {
  var $sess           = NULL;
  var $sess_profile   = NULL;
  var $key            = "fqvwxlJWwAIAZIHphXluOjXofEGOPXKaRNTysXkrOrSGRCqMURmxuFRDzygREKBL";
  var $generator      = 0;

  function __construct() {
    parent::__construct();
    $this->sess         = $this->session->userdata('kmk_member');
    $this->sess_profile = $this->session->userdata('kmk_member_profile');

    $this->load->helper(array('swiftserve'));
    $this->load->model(array('member_model', 'core_model', 'match_model','grab_model', 'campaign_model'));
  }

  public function _content($competition_id='', $data='')
  {

    $campaign = $this->campaign_model->get_by_competition($competition_id);
    //show_code($campaign);
    if (!empty($campaign)) {
      $data['link_buy'] = site_url('campaign/'.$campaign['key'].'/buy');
    }

    $listMatchLive  = $this->grab_model->_get_match_live_memcache();
/*
    foreach ($listMatchLive as $match){
      if ($match['media_id'] > 0){
        redirect('pertandingan/index/'.$competition_id.'/'.$match['match_id']);
      }
    }
*/
    $data['page_title']     = 'Pertandingan Live';
    $data['link_active']    = 'pertandingan';
    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;

    if(!empty($listMatchLive)){
      $data['liveReport'] = $this->grab_model->_get_match_event_live_memcache($listMatchLive[0]['match_id']);
    }

    //$data['listMatchLive']    = $this->match_model->getMatchesByLocalDate(date('Y-m-d'), $competition_id);

    $data['listMatchLive'] = $this->match_model->getMatchesByCompetitions($competition_id);
    $camp = $this->campaign_model->get_by_competition($competition_id);
    if (!empty($camp)) {
      $invoices = $this->campaign_model->get_invoice_by_campaign($camp['id']);
      if (!empty($invoices)) {
        $matches = $this->campaign_model->get_list_match_buyed($invoices);
        $data['listMatchLive'] = array();
        $data['listMatchLive'] = $matches;
        $data['is_buyed'] = TRUE;
      }
    }

    $data['uri_match_id'] = 0;

    $data['jadwal'] = $this->match_model->getMatchesByCompetitions($competition_id);

    $data['page'] = 'pertandingan';
    $this->load->view('v2/template', $data);
  }

  public function index($liga='bpl', $match_id='')
  {
    $data['liga'] = $liga;

    switch($liga) {
      case 'champions' :
        $season_id = 8381;
        $competition_id = 10;
        $url_feed_news = 'http://feed.liputan6.com/ott/index/0/84/4';
        $url_feed_videos = 'http://feed.liputan6.com/ott/video/50/4';
        $data['title_liga'] = 'Liga Champions';
        break;
      case 'europa' :
        $season_id = 8295;
        $competition_id = 18;
        $url_feed_news = 'http://feed.liputan6.com/ott/index/0/84/4';
        $url_feed_videos = 'http://feed.liputan6.com/ott/video/50/4';
        $data['title_liga'] = 'Liga Europa';
        break;
      case 'serie-a' :
        $season_id = 8398;
        $competition_id = 13;
        $url_feed_news = 'http://feed.liputan6.com/ott/index/61/0/4';
        $url_feed_videos = 'http://feed.liputan6.com/ott/video/71/4';
        $data['title_liga'] = 'Liga Italia';
        break;
      case 'bundesliga' :
        $season_id = 8467;
        $competition_id = 9;
        $url_feed_news = 'http://feed.liputan6.com/ott/index/63/0/4';
        $url_feed_videos = 'http://feed.liputan6.com/ott/video/72/4';
        $data['title_liga'] = 'Liga Jerman';
        break;
      case 'ligue-1' :
        $season_id = 8463;
        $competition_id = 16;
        $url_feed_news = 'http://feed.liputan6.com/ott/index/65/0/4';
        $url_feed_videos = 'http://feed.liputan6.com/ott/video/73/4';
        $data['title_liga'] = 'Liga Perancis';
        break;
      default :
        $season_id = 8318;
        $competition_id = 8;
        $url_feed_news = 'http://feed.liputan6.com/ott/bpl/4';
        $url_feed_videos = 'http://feed.liputan6.com/ott/video/70/4';
        $data['title_liga'] = 'Liga Inggris';
        break;
    }

    if (!empty($url_feed_news)) {
      //$json = file_get_contents($url_feed_news);
      //$data['news'] = json_decode($json, TRUE);
	$data['news'] = array();
    }

    if (!empty($url_feed_videos)) {
      //$json = file_get_contents($url_feed_videos);
      //$data['highlight'] = json_decode($json, TRUE);
	$data['highlight'] = array();
    }

    if (!empty($season_id)) {
      $data['klasemen'] = $this->grab_model->getTable($season_id);
    }
    //show_code($data['klasemen']);

    if (!empty($match_id)) {
      if(empty($this->sess)){
        redirect(site_url('home/login'));
      }
      if (!empty($this->sess) && $this->sess['id_profile'] == 0 && $this->sess['is_validate'] == '0'){
        redirect(site_url('home/warning'));
      }

      if (!$this->match_model->cek_match($match_id)) {
        redirect(site_url('home/warning'));
      }

      $detailmatch = $this->match_model->match_by_id($match_id);

      $this->load->model('grab_model');
      $data['chanel']  = $detailmatch->media_id;
      $data['video_player_type'] = $detailmatch->video_player_type;
      $data['is_play']   = true;

      $sdate           = new DateTime($detailmatch->date_london.' '.$detailmatch->time_london);
      $start_time      = date('YmdHis', $sdate->sub(new DateInterval('PT2H'))->getTimestamp());
      $end_time        = date('YmdHis', $sdate->add(new DateInterval('PT6H'))->getTimestamp());

      $this->load->helper('swiftserve');

      $ip_address         = false;
      if ($data['video_player_type'] == 1){
        $data['url']                = channel_livestream_url($data['chanel'],$start_time, $end_time, $ip_address);
        $data['url_mobile']         = channel_livestream_url($data['chanel'],$start_time, $end_time, $ip_address, 'm');
        $data['url_rtmp']           = channel_livestream_url_rtmp($data['chanel'], $start_time, $end_time, $ip_address);
        $data['url_rtmp_mobile']    = channel_livestream_url_rtmp($data['chanel'], $start_time, $end_time, $ip_address, 'm');
        $data['url_ios']            = channel_livestream_url_ios($data['chanel'], $start_time, $end_time, $ip_address);
        $data['url_ios_mobile']     = channel_livestream_url_ios($data['chanel'], $start_time, $end_time, $ip_address, 'm');
      } else {
        $this->load->helper('player');
        $type = 'mbr';
        $data['chanel'] = 'sctv-channel-'.sprintf('%02d',$data['chanel']);
        $data['url'] = channel_livestream_url_http_($type, $data['chanel'], $start_time, $end_time);
        $data['url_rtmp'] = channel_livestream_url_rtmp_('sbr', $data['chanel'], $start_time, $end_time);
        $data['url_rtsp'] = channel_livestream_url_rtsp_($type, $data['chanel'], $start_time, $end_time);
        $data['url_ios']  = channel_livestream_url_ios_($type, $data['chanel'], $start_time, $end_time);

        $data['url_mobile'] = channel_livestream_url_http_($type, $data['chanel'].'m', $start_time, $end_time);
        $data['url_rtmp_mobile'] = channel_livestream_url_rtmp_($type, $data['chanel'].'m', $start_time, $end_time);
        $data['url_ios_mobile']  = channel_livestream_url_ios_($type, $data['chanel'].'m', $start_time, $end_time);
      }

      $data['uri_match_id'] = $match_id;

    }

    $data['competition_id'] = $competition_id;
    $data['season_id'] = $season_id;

    $this->_content($competition_id, $data);
  }

  public function play($id){
    if(empty($this->sess)){
      redirect(site_url('home/login'));
    }

    if (!empty($this->sess) && $this->sess['id_profile'] == 0 && $this->sess['is_validate'] == '0'){
      redirect(site_url('home/warning'));
    }

    if(empty($id)) redirect();

    /*
     * cek user sudah beli livestreaming pertandingan atau belum,
     * jika belum redirect ke halaman buy
     *
     */

    $id_profile = $this->sess['id_profile'];
    $this->load->model('member_model','mm');
    $q = $this->mm->checkmatchforuser($id,$id_profile);

    if($q->num_rows() < 1)
      redirect(site_url('home/warning'));

    $detailmatch = $this->match_model->match_by_id($id);

    $this->load->model('grab_model');
    $data['page_title']     = 'Pertandingan Live';
    $data['link_active']  = 'pertandingan';
    $data['sess']           = $this->sess;
    $data['sess_profile']   = $this->sess_profile;

    $data['klasemen'] = $detailmatch->competition_id == 8 ? $this->grab_model->getTable() : '';

    if(!empty($data['listMatchLive'])){
      $data['liveReport'] = $this->grab_model->_get_match_event_live_memcache($data['listMatchLive'][0]['match_id']);
    }

    $data['chanel']  = $detailmatch->media_id;
    $data['video_player_type'] = $detailmatch->video_player_type;
    $data['tim_a']   = substr($detailmatch->team_A_name,0,3);
    $data['tim_b']   = substr($detailmatch->team_B_name,0,3);

    $sdate           = new DateTime($detailmatch->date_london.' '.$detailmatch->time_london);
    $start_time      = date('YmdHis', $sdate->sub(new DateInterval('PT2H'))->getTimestamp());
    $end_time        = date('YmdHis', $sdate->add(new DateInterval('PT6H'))->getTimestamp());

    $this->load->helper('swiftserve');

    $ip_address         = false;
    $data['url']                = channel_livestream_url($data['chanel'],$start_time, $end_time, $ip_address);
    $data['url_mobile']         = channel_livestream_url($data['chanel'],$start_time, $end_time, $ip_address, 'm');
    $data['url_rtmp']           = channel_livestream_url_rtmp($data['chanel'], $start_time, $end_time, $ip_address);
    $data['url_rtmp_mobile']    = channel_livestream_url_rtmp($data['chanel'], $start_time, $end_time, $ip_address, 'm');
    $data['url_ios']            = channel_livestream_url_ios($data['chanel'], $start_time, $end_time, $ip_address);
    $data['url_ios_mobile']     = channel_livestream_url_ios($data['chanel'], $start_time, $end_time, $ip_address, 'm');

    $data['uri_match_id'] = $id;

    $today = date('Y-m-d');
    $data['listMatchLive']    = $this->match_model->getMatchesByLocalDate($today);

    $this->load->view('pertandingan/index', $data);
    $this->load->view('footer');
  }


  public function get_match_live($type='season',$id=0){
    $this->load->model('grab_model');
    $res = $this->grab_model->_get_match_live_memcache($type,trim($id));
    if($res){
      echo json_encode($res);
    }
  }

  public function livescore($type='season',$id=0){
    $this->load->model('grab_model');
    $data['listMatchLive'] = $this->grab_model->_get_match_live_memcache($type,trim($id));
    $this->load->view('pertandingan/livescore', $data);
  }

  //for skor now ajax
  function skor_now($match_id = NULL){
    if(! $match_id) return;

    $res = $this->match_model->skor_now($match_id);

    $html = "";
    if($res->num_rows() > 0){
      $r = $res->row();

      $html .= "<span>".$r->fs_A."</span>-<span>".$r->fs_B."</span>";

    }else{
      $html .= "<span>0</span>-<span>0</span>";

    }
    echo $html;
  }

  function _get_match($competition_id=0)
  {
    $lastDateInDatabase = $this->match_model->getLastMatchDate();
    $now = new DateTime();
    $result = array();
    while (true) {
      if (count($result) >= 10) break;

      $date = date('Y-m-d', $now->getTimestamp());
      if ($date > $lastDateInDatabase) break;

      $matches = $this->match_model->getMatchesByLocalDate($date, $competition_id);
      if (count($matches) > 0) {
        $result = array_merge($result, $matches);
      }

      $now->add(new DateInterval("P1D"));
    }
    return $result;
  }
}
