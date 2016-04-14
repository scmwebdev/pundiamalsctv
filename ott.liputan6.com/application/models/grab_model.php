<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Grab_model extends CI_Model {
  var $username   = 'liputan6';
  var $authkey    = 'a9c3a357b81dcb7e93844108cd7b6608';
  var $password   = '1iPu89n';

  public function __construct(){
    parent::__construct();
    $this->DB_WRITE = $this->load->database('db_lip6_write', true);
    $this->DB_READ = $this->load->database('db_lip6_read', true);
    $this->load->library('memcached_library');
    $this->load->model('match_model');
  }

  public function _get_match_live_memcache($type='season',$id=0){
    $datenow = date('Y-m-d');
    if($type=="match"){
      $_query = "
        SELECT * FROM gsm_match_live
        WHERE 1
        ".($type=='match'?" AND match_id=".$id."":"")."";

      $cachedName = "ott_match_live_".$type."_".$id;

      if ($this->memcached_library->get($cachedName)) {
        $result = $this->memcached_library->get($cachedName);
      } else {
        $result = $this->DB_READ->query($_query)->row_array();
        $this->memcached_library->set($cachedName, $result,0);
      }
    }else{
      # TODO: why isn't memcached turned on here?
      return $this->match_model->getMatchesByLocalDate(date('Y-m-d'));
    }
    return ($result?$result:false);
  }

  public function _get_match_event_live_memcache($match_id=0){
    $_query = "
      SELECT * FROM gsm_match_event_live
      WHERE 1
      ".($match_id?" AND match_id=".$match_id."":"")."";

    # TODO: why isn't memcached turned on here?
    $result = $this->DB_READ->query($_query)->result_array();

    return ($result?$result:false);
  }

  public function getTable($season_id=8318){

    $cacheKey = "ott_table_".$season_id;

    $result = $this->memcached_library->get($cacheKey);

    if (!empty($result)) {
      return $result;
    }

    $url = 'http://liputan6:1iPu89n@webpull.globalsportsmedia.com/soccer/get_tables?type=season&id='.$season_id.'&tabletype=total';
    $xml = @simplexml_load_file($url);

    $result = array();
    if($xml){
      if (in_array($season_id, array('8381','8295'))) {
        foreach($xml->children() as $competition){
          foreach($competition->children() as $season){
            foreach ($season->children() as $round) {
              foreach ($round->children() as $group) {
                foreach ($group->children() as $resultstable) {
                  $g = $group->attributes();
                  foreach ($resultstable->children() as $table) {
                    $attr = $table->attributes();

                    $result["$g->title"][] = array(
                      "rank"      => (string)$attr->rank,
                      "last_rank"   => (string)$attr->last_rank,
                      "zone_start"  => (string)$attr->zone_start,
                      "team_id"   => (string)$attr->team_id,
                      "club_name"   => (string)$attr->club_name,
                      "countrycode" => (string)$attr->countrycode,
                      "area_id"   => (string)$attr->area_id,
                      "matches_total" => (string)$attr->matches_total,
                      "matches_won" => (string)$attr->matches_won,
                      "matches_draw"  => (string)$attr->matches_draw,
                      "matches_lost"  => (string)$attr->matches_lost,
                      "goals_pro"   => (string)$attr->goals_pro,
                      "goals_against" => (string)$attr->goals_against,
                      "points"    => (string)$attr->points
                    );
                  }
                }
              }
            }
          }
        }

      } else {

        foreach($xml->children() as $competition){
          foreach($competition->children() as $season){
            foreach ($season->children() as $round) {
              foreach ($round->children() as $resultstable) {
                foreach ($resultstable->children() as $table) {
                  $attr = $table->attributes();

                  $result[] = array(
                    "rank" 			=> (string)$attr->rank,
                    "last_rank" 	=> (string)$attr->last_rank,
                    "zone_start"	=> (string)$attr->zone_start,
                    "team_id"		=> (string)$attr->team_id,
                    "club_name"		=> (string)$attr->club_name,
                    "countrycode"	=> (string)$attr->countrycode,
                    "area_id"		=> (string)$attr->area_id,
                    "matches_total"	=> (string)$attr->matches_total,
                    "matches_won"	=> (string)$attr->matches_won,
                    "matches_draw"	=> (string)$attr->matches_draw,
                    "matches_lost"	=> (string)$attr->matches_lost,
                    "goals_pro"		=> (string)$attr->goals_pro,
                    "goals_against"	=> (string)$attr->goals_against,
                    "points"		=> (string)$attr->points
                  );

                }
              }
            }
          }
        }
      }

    }

    $this->memcached_library->set($cacheKey, $result, 7200); // 2 jam

    return $result;

  }
}
