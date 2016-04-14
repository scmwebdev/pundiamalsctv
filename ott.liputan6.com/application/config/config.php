<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['base_url']	= 'http://kickoff.liputan6.com/';
$config['index_page'] = '';
$config['uri_protocol']	= 'AUTO';

$config['url_suffix'] = '';
$config['language']	= 'english';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = FALSE;
$config['subclass_prefix'] = 'MY_';
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['allow_get_array']		= TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']	= 'c';
$config['function_trigger']		= 'm';
$config['directory_trigger']	= 'd'; // experimental not currently in use
$config['log_threshold'] = 1;
$config['log_path'] = '/home/logs';
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['cache_path'] = '';

$config['encryption_key']       = "098765432100112";
$config['sess_cookie_name']		= '_sesliputan6';
$config['sess_expiration']		= 28800;
$config['sess_expire_on_close']	= FALSE;
$config['sess_encrypt_cookie']	= TRUE;
$config['sess_use_database']	= FALSE;
$config['sess_table_name']		= 'ci_sessions';
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update']	= 28800;

$config['cookie_prefix']	= "";
$config['cookie_domain']	= ".liputan6.com";
$config['cookie_path']		= "/";
$config['cookie_secure']	= FALSE;

$config['global_xss_filtering'] = TRUE;

$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 28800;


$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';
