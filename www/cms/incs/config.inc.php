<?php

    /**
     * Config file
     *
     * @access      public
     * @author      bonny.hp
     * @since       2006-10-14
     * @version     4.0 (for bcms ver 4.0)
     * @edited      2009-04-08
     * @modify      dragadu@yahoo.com
     */
    //error_reporting(0);
    $siteURL  = "http://".$_SERVER['SERVER_NAME']."/";
    $rootDir  = $_SERVER['DOCUMENT_ROOT']."/";

    $cmsDir   = "";
    $incDir   = "incs/";
    $fileDir  = "/san/static/";
    $libDir   = "libs/";
    $modDir   = "mods/";
    $tplDir   = "tpls/";
    $pearDir  = "";

    // in second
    $sessTime = 3600; // 3600 = 1 hour

    // record per page
    $recPerPage = 10;

    // database variable (mysql://username:password@hostname/dbname)
    define("DSN",                 "mysql://cmsall:bl@kangCMSP@ssw0rd14KmK@192.168.7.97/scm_cms_new");
    define("DSN_LIPUTAN6",        "mysql://cmsall:bl@kangCMSP@ssw0rd14KmK@192.168.7.97/liputan6_xxx");
    define("DSN_LIPUTAN6_OTT",    "mysql://cmsall:bl@kangCMSP@ssw0rd14KmK@192.168.7.97/liputan6_ott");
    define("DSN_LIPUTAN6_TOOLS",  "mysql://cmsall:bl@kangCMSP@ssw0rd14KmK@192.168.7.97/liputan6_tools");
    define("DSN_BLOG",            "mysql://cmsall:bl@kangCMSP@ssw0rd14KmK@192.168.7.97/liputan6_blog");
    define("DSN_MOBILE",          "mysql://internetDEV:arjuna2774@192.168.7.34:3306/mobile");
    define("DSN_SCTV",            "mysql://cmsall:bl@kangCMSP@ssw0rd14KmK@192.168.7.97/sctv_www");
    define("DSN_JOBS",            "mysql://cmsall:bl@kangCMSP@ssw0rd14KmK@192.168.7.97/sctv_jobs");
    define("DSN_SCTV_EVENT",      "mysql://cmsall:bl@kangCMSP@ssw0rd14KmK@192.168.7.97/sctv_events");
    define("DSN_PUNDIAMAL",       "mysql://cmsall:bl@kangCMSP@ssw0rd14KmK@192.168.7.97/pundiamalsctv_www");
    //define("DSN_PUNDIAMAL",       "mysql://pundiwww:reGmBtsSbh04@192.168.7.114/pundiamalsctv_www");
    define("DSN_SCM",             "mysql://cmsall:bl@kangCMSP@ssw0rd14KmK@192.168.7.97/scm_www");

    define("DSN_CMS",             "mysql:host=192.168.7.97;dbname=scm_cms_new;charset=latin1");
    define("USER_CMS",            "cmsall");
    define("PASS_CMS",            "bl@kangCMSP@ssw0rd14KmK");

    define("DSN_WRITE",           "mysql:host=192.168.7.97;dbname=liputan6_xxx;charset=latin1");
    define("USER_WRITE",          "cmsall");
    define("PASS_WRITE",          "bl@kangCMSP@ssw0rd14KmK");

    define("DSN_TOOLS",           "mysql:host=192.168.7.97;dbname=liputan6_tools;charset=latin1");
    define("USER_TOOLS",          "cmsall");
    define("PASS_TOOLS",          "bl@kangCMSP@ssw0rd14KmK");

    define("DSN_OTT",             "mysql:host=192.168.7.97;dbname=liputan6_ott;charset=latin1");
    define("USER_OTT",            "cmsall");
    define("PASS_OTT",            "bl@kangCMSP@ssw0rd14KmK");

    define("SPHINX_DSN",          "mysql:host=192.168.7.97;port=9306;charset=latin1");

    //18022010 untuk pundi amal
    define("WEB_PUNDIAMAL",       "http://www.pundiamalsctv.com");

    define("MEDIA_PUNDIAMAL",     "http://static.pundiamalsctv.com");
    define("FILES_PUNDIAMAL",     $siteURL.$fileDir."pundiamalsctv.com");
    define("FILE_DIR_PUNDIAMAL",  $fileDir."pundiamalsctv.com/");

    define("TV_LIPUTAN6",         "http://video.liputan6.com/main/read/");

    // database name
    define("DB_LIPUTAN6_WWW",     "liputan6_xxx");
    define("DB_LIPUTAN6_TOOLS",   "liputan6_tools");

    // month , day
    $arrBulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
    $arrHari  = array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');


    // Untuk keperluan CMS sctv.co.id modul 'Jadwal Acara' (Modified by WinX, Jan 2008)
    for($i=1;$i<=31;$i++) { $arrDay[$i] = $i; }

    $arrMainIndex = Array (
        0 => "none",
        1 => "Index Pertama",
        2 => "Index Kedua",
        3 => "Index Ketiga",
        4 => "Index Keempat",
        5 => "Index Kelima",
        9 => "Index Pertama - Hari Besok"
    );

    for($i=date("Y")+1;$i>=2003;$i--) { $arrYear[$i] = $i; }

    // mails
    define("CONTACT_MAIL", "webmaster@sctv.co.id");

    // logging system
    define("LOGGING", "MONTHLY"); // monthly or all or null/blank
    define("LOGGING_PREFIX", "log_");

    /**
     * Define Constant
     * Do Not Edit
     */
    define("CMS_DIR",   $rootDir.$cmsDir);
    define("INC_DIR",   $rootDir.$incDir);

    define("FILE_DIR",  $fileDir);

    define("LIB_DIR",   $rootDir.$libDir);
    define("MOD_DIR",   $rootDir.$modDir);
    define("TPL_DIR",   $rootDir.$tplDir);
    define("PEAR_DIR",  $pearDir);

    define("CMS_URL",   $siteURL.$cmsDir);
    define("INC_URL",   $siteURL.$incDir);
    define("FILE_URL",  $siteURL.$fileDir);
    define("LIB_URL",   $siteURL.$libDir);
    define("MOD_URL",   $siteURL.$modDir);
    define("TPL_URL",   $siteURL.$tplDir);
    define("SITE_URL",  $siteURL);

    define("ROOT_DIR",  $rootDir);

    // website url
    define("WEB_CMS_NEW",           "http://cms.scm.co.id/");
    define("WEB_LIPUTAN6",          "http://www.liputan6.com");
    define("VID_LIPUTAN6",          "http://video.liputan6.com"); /* <---- yg ini biar gini, jangan dirubah lagi, sudah ada VIDEO_LIPUTAN6 & TV_LIPUTAN6 (gak tau kenapa dibuat sama definenya???)*/
    define("VIDEO_LIPUTAN6",        "http://video.liputan6.com/main/read/");
    define("MEDIA_LIPUTAN6",        "http://static6.com");
    define("ASSETS",                "http://assets.liputan6.com/");
    define("FILES_LIPUTAN6",        $siteURL.$fileDir."liputan6.com");
    define("FILE_DIR_LIPUTAN6",     $fileDir."liputan6.com/");
    define("IMG_URL",               $siteURL.$tplDir.'webadmin/images/');

    define("MOBILE_LIPUTAN6",       $siteURL.$fileDir."mobile.liputan6.com");
    define("FILE_MOBILE_LIPUTAN6",  $fileDir."mobile.liputan6.com/");

    define("WEB_SCM",               "http://scm.co.id");
    define("MEDIA_SCM",             "http://static.scm.co.id/");
    define("FILES_SCM",             $siteURL.$fileDir."scm.co.id");
    define("FILE_DIR_SCM" ,         $fileDir."scm.co.id/" );

    define("SESS_TIME",             $sessTime);
    define("REC_PER_PAGE",          $recPerPage);
    define("SUBSITE_HAJI",          "1"); //default from tbl_subsite
    define("SUBSITE_OBAMA",         "2"); //default from tbl_subsite

    define("L6MEMCACHED_SERVER",    "192.168.7.22");
    define("L6MEMCACHED_PORT",      11211);
    define("L6MEMCACHED_EXPIRE",    300);
    define("MEMCACHED_ACTIVE",      true);

    $host = explode('.',$_SERVER['HTTP_HOST']);
    define('HOST', $host[0]);
?>
