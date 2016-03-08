<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//$config['base_url']             = "http://localhost/kmk/web/new.pundiamalsctv.com/";	
$root  = "http://".$_SERVER['HTTP_HOST'];
$root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
$config['base_url']    = "$root";
$config['index_page']           = "";
$config['uri_protocol']	= 'AUTO';
//$config['uri_protocol']         = "REQUEST_URI";
$config['url_suffix']           = "";
$config['language']             = "english";
$config['charset']              = "UTF-8";
$config['enable_hooks']         = FALSE;
$config['subclass_prefix']      = 'MY_';
$config['permitted_uri_chars']  = 'a-z 0-9~%.:_\+\=\-';

$config['enable_query_strings'] = FALSE;
$config['directory_trigger']    = 'd';
$config['controller_trigger']   = 'c';
$config['function_trigger']     = 'm';

$config['log_threshold']        = 0;
$config['log_path']             = '';
$config['log_date_format']      = 'Y-m-d H:i:s';
$config['cache_path']           = '';
$config['encryption_key']       = "098765432100112";
$config['sess_cookie_name']     = '_sesliputan6';
$config['sess_expiration']      = 7200;
$config['sess_encrypt_cookie']  = TRUE;
$config['sess_use_database']    = FALSE;
$config['sess_table_name']      = 'tbl_liputanbola_sessions_table';
$config['sess_match_ip']        = FALSE;
$config['sess_match_useragent'] = TRUE;
$config['sess_time_to_update']  = 300;

$config['cookie_prefix']        = "";
$config['cookie_domain']        = ".liputan6.com";
$config['cookie_path']          = "/";
$config['global_xss_filtering'] = TRUE;

$config['compress_output']      = FALSE;
$config['time_reference']       = 'local';
$config['rewrite_short_tags']   = FALSE;

$config['allow_get_array']		= TRUE;
