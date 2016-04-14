<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Code Igniter
*
* ott.liputan6.com
*
* @author      Yuda Cogati (28-08-2013)
* @email       yuda.pc@gmail.com
* modif        indra.trisetyanto
*
*
**/

/** begin modif by drg **/
function construct_livestream_url_($base, $path, $start_time=false, $end_time=false, $token=true, $isFlash=false) {
  $params = '';
  if($token){
    $params .= '?';

    if($start_time) $params .= 'stime='.$start_time;

    if($end_time) $params .= '&etime='.$end_time;

    $params .= construct_token_param($path.$params);
    if($isFlash) $params = urlencode($params);
  }
  return $base.$path.$params;
}

function channel_livestream_url_rtmp_($type="mbr", $match_media_id, $start_time=false, $end_time=false, $token=true) {
  $base = ($type=='mbr'?'http://edge.telin.swiftserve.com':'rtmp://live.stream.telin.swiftserve.com');
  $path = ($type=='mbr'?'/livemeta/'.$match_media_id.'.rtmp.f4m':'/live/viocorp-sctv/'.$match_media_id);
  return construct_livestream_url_($base, $path, $start_time, $end_time, $token);
}

function channel_livestream_url_http_($type="mbr", $match_media_id, $start_time=false, $end_time=false, $token=true) {
  $base = 'http://edge.telin.swiftserve.com';
  $path = '/live/viocorp-sctv/'.($type=='mbr'?'amlst:':'').$match_media_id.'/manifest.f4m';
  return construct_livestream_url_($base, $path, $start_time, $end_time, $token, true);
}

function channel_livestream_url_rtsp_($type="mbr", $match_media_id, $start_time=false, $end_time=false, $token=true) {
  //if($type=='mbr')return false; karena mbr gak ada rtsp jadi kita ambil aja lewat sbr, dengan catatan diaktifkan channel rtsp tersebut
  $base = 'rtsp://live.stream.telin.swiftserve.com';
  $path = '/live/viocorp-sctv/'.$match_media_id;
  return construct_livestream_url_($base, $path, $start_time, $end_time, $token);
}

function channel_livestream_url_ios_($type="mbr", $match_media_id, $start_time=false, $end_time=false, $token=true) {
  $base = 'http://edge.telin.swiftserve.com';
  $path = '/live/viocorp-sctv/'.($type=='mbr'?'amlst:':'').$match_media_id.'/playlist.m3u8';
  return construct_livestream_url_($base, $path, $start_time, $end_time, $token);
}
/** end modif by drg **/
?>
