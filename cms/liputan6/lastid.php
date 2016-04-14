<?php
require "../incs/config.inc.php";
require_once PEAR_DIR.'MDB2.php';

/**
 * Last ID Object
 *
 * @access		public
 * @package		SQL
 * @author 		asep.aiw
 * @since 		2009-09-10
 * @version 	1.0 MDB2
 * @notes     Salam Lebaran 2009
 */

class LastID
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
	function getData($table_name)
	{

		$v_table_name = $table_name;

		$s_sql = "
			SELECT MAX(id) AS last_id FROM ".$v_table_name;
		$res = $this->mdb->queryOne($s_sql);
		if (PEAR::isError($res)) die($res->getMessage());
		
		return $res;

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

$v_table_name = trim($_GET['table_name']);
$last_id = 0;

// print info to display

if ($blnProcess)
{

	$bcms =& new LastID();
	$_sql = $bcms->getData($v_table_name);	
	echo $last_id;	

}
else
{

	echo $last_id;

}	
?>