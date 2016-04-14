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
	function updateData($datetime, $suara_masuk, $suara_masuk_total, $mega, $mega_total, $sby, $sby_total, $jk, $jk_total)
	{

		$v_datetime = $datetime;
		$v_suara_masuk = $suara_masuk ? $suara_masuk : 0;
		$v_suara_masuk_total = $suara_masuk_total ? $suara_masuk_total : 0;
		$v_mega = $mega ? $mega : 0;
		$v_mega_total = $mega_total ? $mega_total : 0;
		$v_sby = $sby ? $sby : 0;
		$v_sby_total = $sby_total ? $sby_total : 0;
		$v_jk = $jk ? $jk : 0;
		$v_jk_total = $jk_total ? $jk_total : 0;

		$s_sql = "
			UPDATE tbl_pemilu_capres_2009_kpu 
				 SET datetime='$v_datetime', 
						 suara_masuk='$v_suara_masuk', 
						 suara_masuk_total='$v_suara_masuk_total', 
						 mega='$v_mega', 
						 mega_total='$v_mega_total', 
						 sby='$v_sby', 
						 sby_total='$v_sby_total', 
						 jk='$v_jk', 
						 jk_total='$v_jk_total'";
		$res = $this->mdb->exec($s_sql);
		if (PEAR::isError($res)) die($res->getMessage());

		$ROOT_DIR = $_SERVER['DOCUMENT_ROOT'] ? $_SERVER['DOCUMENT_ROOT'] : str_replace ($_SERVER['PATH_INFO'], '', str_replace ('\\\\', '/', $_SERVER['PATH_TRANSLATED'])) ;
		$ori = $ROOT_DIR."/data/main/capres2009.xml";
		$log = $ROOT_DIR."/data/logs/main/capres2009.xml";
		$target = $ROOT_DIR."/data/main/capres2009_".time().".xml";
		$status = false;

		$content  = '<?xml version="1.0" encoding="UTF-8"?>'."\r\n";
		$content .= '<pilpres>'."\r\n";

		$s_sql = "
			SELECT datetime, suara_masuk, mega, sby, jk, 
						 UPPER(DATE_FORMAT(datetime,'%e %M %Y, %H.%i')) datetime_formatted 
				FROM tbl_pemilu_capres_2009_cirus 
			 WHERE id=1";
		$res = $this->mdb->queryRow($s_sql);
    if (PEAR::isError($res)) die($res->getMessage());

		$content .= "\t".'<megaprabowo>'.$res["mega"].'</megaprabowo>'."\r\n";
		$content .= "\t".'<sbybudiono>'.$res["sby"].'</sbybudiono>'."\r\n";								
		$content .= "\t".'<jkwiranto>'.$res["jk"].'</jkwiranto>'."\r\n";
		$content .= "\t".'<totalsuara>'.$res["suara_masuk"].'</totalsuara>'."\r\n";

		$content .= "\t".'<megaprabowokpu>'.$v_mega.'</megaprabowokpu>'."\r\n";
		$content .= "\t".'<sbybudionokpu>'.$v_sby.'</sbybudionokpu>'."\r\n";
		$content .= "\t".'<jkwirantokpu>'.$v_jk.'</jkwirantokpu>'."\r\n";
		$content .= "\t".'<totalsuarakpu>'.$v_suara_masuk_total.'</totalsuarakpu>'."\r\n";								

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

$v_suara_masuk_total = trim($_GET['suara_masuk_total']);
$v_suara_masuk_total = $v_suara_masuk_total ? $v_suara_masuk_total : 0;

$v_mega = trim($_GET['mega']);
$v_mega = $v_mega ? $v_mega : 0;

$v_mega_total = trim($_GET['mega_total']);
$v_mega_total = $v_mega_total ? $v_mega_total : 0;

$v_sby = trim($_GET['sby']);
$v_sby = $v_sby ? $v_sby : 0;

$v_sby_total = trim($_GET['sby_total']);
$v_sby_total = $v_sby_total ? $v_sby_total : 0;

$v_jk = trim($_GET['jk']);
$v_jk = $v_jk ? $v_jk : 0;

$v_jk_total = trim($_GET['jk_total']);
$v_jk_total = $v_jk_total ? $v_jk_total : 0;

// print info to display

if ($blnProcess)
{

	$bcms =& new Pemilu2009();
	$_sql = $bcms->updateData($v_datetime, $v_suara_masuk, $v_suara_masuk_total, $v_mega, $v_mega_total, $v_sby, $v_sby_total, $v_jk, $v_jk_total);	
	echo "1";	

}
else
{

	echo "0";

}	
?>