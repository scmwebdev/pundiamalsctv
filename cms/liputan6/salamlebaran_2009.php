<?php
require "../incs/config.inc.php";
require_once PEAR_DIR.'MDB2.php';

/**
 * Salam Lebaran 2009 Object
 *
 * @access		public
 * @package		SQL
 * @author 		asep.aiw
 * @since 		2009-09-10
 * @version 	1.0 MDB2
 * @notes     Salam Lebaran 2009
 */

class SalamLebaran2009
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
	function updateData($pin, $mobile, $salam, $datetime)
	{

		$v_pin = $pin;
		$v_mobile = $mobile;
		$v_salam = $salam;
		$v_datetime = $datetime;

		$s_sql = "
			INSERT INTO tbl_salam_lebaran 
				 SET pin='$v_pin', 
						 mobile='$v_mobile', 
						 salam='$v_salam', 
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

$v_pin = trim($_GET['pin']);
$v_mobile = trim($_GET['mobile']);
$v_salam = trim($_GET['salam']);
$v_datetime = trim($_GET['datetime']);
if ($v_datetime) $v_datetime = substr($v_datetime,0,4).'-'.substr($v_datetime,4,2).'-'.substr($v_datetime,6,2).' '.substr($v_datetime,8,2).':'.substr($v_datetime,10,2).':'.substr($v_datetime,12,2);

// print info to display

if ($blnProcess)
{

	$bcms =& new SalamLebaran2009();
	$_sql = $bcms->updateData($v_pin, $v_mobile, $v_salam, $v_datetime);	
	echo "1";	

}
else
{

	echo "0";

}	
?>