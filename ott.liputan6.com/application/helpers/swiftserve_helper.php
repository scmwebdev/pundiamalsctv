<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Code Igniter
*
* ott.liputan6.com
*
* @author      Yuda Cogati (28-08-2013)
* @email       yuda.pc@gmail.com
*
*
**/
    if ( ! function_exists('generate_token')) {
        function generate_token($resource, $generator, $secret_key) {
            /* accepts arguments:
               $resource = a resource on a web server e.g. /path/to/resource?option=33
               $generator = an integer generator value
               $secret_key = the secret key for the HMAC construction.

               Returns the concaternation of the generator and the first 20 characters
               of the HMAC of $resource using key $secret_key and the SHA1 algorithm.
             */
            $hmac_str = hash_hmac('sha1', $resource, $secret_key);
            return $generator . substr($hmac_str, 0, 20);
        }
    }

    if ( ! function_exists('construct_token_param')) {
        function construct_token_param($resource, $generator = 0) {
            /* construct_url_with token takes arguments:
               $resource = a resource on a web server e.g. /path/to/resource?option=33
               $generator = an integer generator value
               $secret_key = the secret key for the HMAC construction.

               This will append &encoded=token to your resource url
             */

            $secret_key = "fqvwxlJWwAIAZIHphXluOjXofEGOPXKaRNTysXkrOrSGRCqMURmxuFRDzygREKBL";
            $token = generate_token($resource, $generator, $secret_key);
            return "&encoded=" . $token;
        }
    }

    if ( ! function_exists('construct_livestream_url')) {
      function construct_livestream_url($base, $path, $start_time=false, $end_time=false, $ip_address=false) {
          $params = array();

          if($start_time) $params[] = 'stime='.$start_time;
          if($end_time)   $params[] = 'etime='.$end_time;
          if($ip_address) $params[] = 'ip='.$ip_address;

          if (!empty($params)) {
            $params = '?'.implode("&", $params);
            $params .= construct_token_param($path.$params);
          }

          return $base.$path.$params;
        }
    }

    if ( ! function_exists('channel_livestream_url')) {
        function channel_livestream_url($match_media_id, $start_time=false, $end_time=false, $ip_address=false, $mobile='') {
          $base = 'http://edge.telin.swiftserve.com';
          $path = '/live/viocorp-sctv/amlst:sctv-channel-'.sprintf('%02d',$match_media_id).$mobile.'/manifest.f4m';
          return construct_livestream_url($base, $path, $start_time, $end_time, $ip_address);
        }
    }

    if ( ! function_exists('channel_livestream_url_rtmp')) {
        function channel_livestream_url_rtmp($match_media_id, $start_time=false, $end_time=false, $ip_address=false, $mobile='') {
          $base = 'http://live.stream.telin.swiftserve.com';
          $path = '/live/viocorp-sctv/sctv-channel-'.sprintf('%02d',$match_media_id).$mobile.'/rtmp.f4m';
          return construct_livestream_url($base, $path, $start_time, $end_time, $ip_address);
        }
    }

    if ( ! function_exists('channel_livestream_url_ios')) {
        function channel_livestream_url_ios($match_media_id, $start_time=false, $end_time=false, $ip_address=false, $mobile='') {
          $base = 'http://edge.telin.swiftserve.com';
          $path = '/live/viocorp-sctv/amlst:sctv-channel-'.sprintf('%02d',$match_media_id).$mobile.'/playlist.m3u8';
          return construct_livestream_url($base, $path, $start_time, $end_time, $ip_address);
        }
    }

?>
