<?php
require "../incs/config.inc.php";
require_once PEAR_DIR.'MDB2.php';

/**
 * Pesan Mudik 2009 Object
 *
 * @access		public
 * @package		SQL
 * @author 		asep.aiw
 * @since 		2009-09-10
 * @version 	1.0 MDB2
 * @notes     Pesan Mudik 2009
 */

class PesanMudik2009
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
	function updateData($email, $mobile, $komentar, $datetime)
	{

		$v_email = $email;
		$v_mobile = $mobile;
		$v_komentar = $komentar;
		$v_datetime = $datetime;

		$s_sql = "
			INSERT INTO tbl_pesan_mudik 
				 SET email='$v_email', 
						 mobile='$v_mobile', 
						 komentar='$v_komentar', 
						 datetime='$v_datetime'";
		$res = $this->mdb->exec($s_sql);
		if (PEAR::isError($res)) die($res->getMessage());

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

$v_email = trim($_GET['email']);
$v_mobile = trim($_GET['mobile']);
$v_komentar = trim($_GET['komentar']);
$v_datetime = trim($_GET['datetime']);
if ($v_datetime) $v_datetime = substr($v_datetime,0,4).'-'.substr($v_datetime,4,2).'-'.substr($v_datetime,6,2).' '.substr($v_datetime,8,2).':'.substr($v_datetime,10,2).':'.substr($v_datetime,12,2);

// print info to display

if ($blnProcess)
{

	$bcms =& new PesanMudik2009();
	$_sql = $bcms->updateData($v_email, $v_mobile, $v_komentar, $v_datetime);	
	echo "1";	

}
else
{

	echo "0";

}	
?>