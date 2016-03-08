<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config['app_title']        = "Berita Liputan6.com - Aktual Tajam dan Terpercaya";
$config['copyright']        = "&copy;2000-".date('Y')." PT. Surya Citra Televisi. All Rights Reserved";

// META
$config['meta_all'] = array(
    array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
    array('name' => 'robots', 'content' => 'no-cache'),
    array('name' => 'author', 'content' => 'IT Multimedia SCTV'),
    array('name' => 'googlebot', 'content' => 'NOODP, follow'),
    array('name' => 'alexaVerifyID', 'content' => 'G7ZPEmioLJlrR2IHhDhUjAAlm9Q'),
    array('name' => 'verify-v1', 'content' => 'fOQMqwwo+72yk0hn9FipFIQ5iNAv67msBkQ4xbAzEmw='),
    array('name' => 'google-site-verification', 'content' => '-SFiI3CrV5q-tmFoyFxZM-76S9O3vlY98O5sPlk8V-g'),
    array('name' => 'y_key', 'content' => 'a508874a985e7829')
);

$config['arr_liga'] =  array(
    "60" => array("id" => "27", "name" => "Liga Inggris"),
    "61" => array("id" => "29", "name" => "Liga Italia"),
    "62" => array("id" => "28", "name" => "Liga Spanyol"),
    "63" => array("id" => "40", "name" => "Liga Jerman"),
    "64" => array("id" => "42", "name" => "Liga Belanda"),
    "65" => array("id" => "43", "name" => "Liga Prancis"),
);

$config['arr_webtorial'] = array(79,164,165,166,167,168,192); # ini adalah ID yg dipakai untuk memfilter berita yg tdk ditampilkan (WEBTORIAL & CITIZEN6)

$config['array_keyword'] = array('news', 'liputan', 'aktual');
$config['sphinx_ip']    = '192.168.7.11';
$config['sphinx_port']  = 9312;
$config['sphinx_dsn']   = "mysql:host=192.168.7.11;port=9306;charset=latin1";
$config['HOSTMONGO']    = "192.168.7.11:27017";
$config['DBMONGO']      = "counter";
