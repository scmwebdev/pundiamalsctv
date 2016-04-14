<?php
require "../incs/config.inc.php";
require_once PEAR_DIR.'MDB2.php';

/**
 * Pemilu 2009 object
 *
 * @access		public
 * @package		SQL
 * @author 		asep.aiw
 * @since 		2009-07-06
 * @version 	1.0 MDB2
 * @notes     Pemilu 2009 CAPRES
 */

class Pemilu2009
{

	// database object
	var $mdb = null;	

	/**
   * Constructor
   */
	function __construct()
	{

		// database initial
		$this->mdb =& MDB2::factory(DSN_LIPUTAN6);
		$this->mdb->setFetchMode(MDB2_FETCHMODE_ASSOC);

	}
	
	/**
	 * update data
	 *
	 * @param array $formvars 
	 */
	function updateData($datetime, $suara_masuk, $mega, $sby, $jk, $random_quality, $partisipasi, $s_sumatra, $s_dki, $s_jabar, $s_jateng, $s_jatim, $s_kalsul, $s_lain)
	{

		$v_datetime = $datetime;
		$v_suara_masuk = $suara_masuk ? $suara_masuk : 0;
		$v_mega = $mega ? $mega : 0;
		$v_sby = $sby ? $sby : 0;
		$v_jk = $jk ? $jk : 0;
		$v_random_quality = $random_quality ? $random_quality : 0;
		$v_partisipasi = $partisipasi ? $partisipasi : 0;
		$v_s_sumatra = $s_sumatra ? $s_sumatra : 0;
		$v_s_dki = $s_dki ? $s_dki : 0;
		$v_s_jabar = $s_jabar ? $s_jabar : 0;
		$v_s_jateng = $s_jateng ? $s_jateng : 0;
		$v_s_jatim = $s_jatim ? $s_jatim : 0;
		$v_s_kalsul = $s_kalsul ? $s_kalsul : 0;
		$v_s_lain = $s_lain ? $s_lain : 0;

		$s_sql = "
			UPDATE tbl_pemilu_capres_2009_cirus 
				 SET datetime='$v_datetime', 
						 suara_masuk='$v_suara_masuk', 
						 mega='$v_mega', 
						 sby='$v_sby', 
						 jk='$v_jk', 
						 random_quality='$v_random_quality', 
						 partisipasi='$v_partisipasi', 
						 s_sumatra='$v_s_sumatra', 
						 s_dki='$v_s_dki', 
						 s_jabar='$v_s_jabar', 
						 s_jateng='$v_s_jateng', 
						 s_jatim='$v_s_jatim', 
						 s_kalsul='$v_s_kalsul', 
						 s_lain='$v_s_lain'";
		$res = $this->mdb->exec($s_sql);
		if (PEAR::isError($res)) die($res->getMessage());

		$ROOT_DIR = $_SERVER['DOCUMENT_ROOT'] ? $_SERVER['DOCUMENT_ROOT'] : str_replace ($_SERVER['PATH_INFO'], '', str_replace ('\\\\', '/', $_SERVER['PATH_TRANSLATED'])) ;
		$ori = $ROOT_DIR."/data/main/capres2009.xml";
		$log = $ROOT_DIR."/data/logs/main/capres2009.xml";
		$target = $ROOT_DIR."/data/main/capres2009_".time().".xml";
		$status = false;

		$content  = '<?xml version="1.0" encoding="UTF-8"?>'."\r\n";
		$content .= '<pilpres>'."\r\n";
		$content .= "\t".'<megaprabowo>'.$v_mega.'</megaprabowo>'."\r\n";
		$content .= "\t".'<sbybudiono>'.$v_sby.'</sbybudiono>'."\r\n";
		$content .= "\t".'<jkwiranto>'.$v_jk.'</jkwiranto>'."\r\n";
		$content .= "\t".'<totalsuara>'.$v_suara_masuk.'</totalsuara>'."\r\n";		

		$s_sql = "
			SELECT datetime, suara_masuk, mega, sby, jk, random_quality, partisipasi, s_sumatra, s_dki, s_jabar, s_jateng, s_jatim, s_kalsul, s_lain, 
						 UPPER(DATE_FORMAT(datetime,'%e %M %Y, %H.%i')) datetime_formatted 
				FROM tbl_pemilu_capres_2009_kpu 
			 WHERE id=1";
		$res = $this->mdb->queryRow($s_sql);
    if (PEAR::isError($res)) die($res->getMessage());

		$content .= "\t".'<megaprabowokpu>'.$res["mega"].'</megaprabowokpu>'."\r\n";
		$content .= "\t".'<sbybudionokpu>'.$res["sby"].'</sbybudionokpu>'."\r\n";								
		$content .= "\t".'<jkwirantokpu>'.$res["jk"].'</jkwirantokpu>'."\r\n";
		$content .= "\t".'<totalsuarakpu>'.$res["suara_masuk"].'</totalsuarakpu>'."\r\n";				

		$content .= '</pilpres>'."\r\n";

		if ($handle = fopen($target, 'w+')) {
			fwrite($handle, $content);
			fclose($handle);
			$status = true;

			copy($ori, $log);
			copy($target, $ori);
			unlink($target);
		}


		return $s_sql;

	}
	
	/**
	 * Disconnect 
	 */
	function disconnect()
	{

		$this->mdb->disconnect();

	}

}

$blnProcess = true;

$v_datetime = trim($_GET['datetime']);
if ($v_datetime) $v_datetime = substr($v_datetime,0,4).'-'.substr($v_datetime,4,2).'-'.substr($v_datetime,6,2).' '.substr($v_datetime,8,2).':'.substr($v_datetime,10,2).':'.substr($v_datetime,12,2);

$v_suara_masuk = trim($_GET['suara_masuk']);
$v_suara_masuk = $v_suara_masuk ? $v_suara_masuk : 0;

$v_mega = trim($_GET['mega']);
$v_mega = $v_mega ? $v_mega : 0;

$v_sby = trim($_GET['sby']);
$v_sby = $v_sby ? $v_sby : 0;

$v_jk = trim($_GET['jk']);
$v_jk = $v_jk ? $v_jk : 0;

$v_random_quality = trim($_GET['random_quality']);
$v_random_quality = $v_random_quality ? $v_random_quality : 0;

$v_partisipasi = trim($_GET['partisipasi']);
$v_partisipasi = $v_partisipasi ? $v_partisipasi : 0;

$v_s_sumatra = trim($_GET['s_sumatra']);
$v_s_sumatra = $v_s_sumatra ? $v_s_sumatra : 0;

$v_s_dki = trim($_GET['s_dki']);
$v_s_dki = $v_s_dki ? $v_s_dki : 0;

$v_s_jabar = trim($_GET['s_jabar']);
$v_s_jabar = $v_s_jabar ? $v_s_jabar : 0;

$v_s_jateng = trim($_GET['s_jateng']);
$v_s_jateng = $v_s_jateng ? $v_s_jateng : 0;

$v_s_jatim = trim($_GET['s_jatim']);
$v_s_jatim = $v_s_jatim ? $v_s_jatim : 0;

$v_s_kalsul = trim($_GET['s_kalsul']);
$v_s_kalsul = $v_s_kalsul ? $v_s_kalsul : 0;

$v_s_lain = trim($_GET['s_lain']);
$v_s_lain = $v_s_lain ? $v_s_lain : 0;

// print info to display

if ($blnProcess)
{

	$bcms =& new Pemilu2009();
	$_sql = $bcms->updateData($v_datetime, $v_suara_masuk, $v_mega, $v_sby, $v_jk, $v_random_quality, $v_partisipasi, $v_s_sumatra, $v_s_dki, $v_s_jabar, $v_s_jateng, $v_s_jatim, $v_s_kalsul, $v_s_lain);	
	echo "1";	

}
else
{

	echo "0";

}	
?>