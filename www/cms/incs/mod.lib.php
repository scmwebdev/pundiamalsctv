<?
/**
 * Module object
 *
 * @access      public
 * @package     SQL
 * @author      bonny.hp
 * @since       2006-08-19
 * @version     2.0 MDB2
 * @modify      enang.yusup
 * @version     3.0 PDO
 */

class Mod{
    // database object
    var $mdb = null;

    /**
    * Constructor
    */
    function __construct(){
        // database initial
        //$this->mdb = MDB2::factory(DSN);
        //$this->mdb->setFetchMode(MDB2_FETCHMODE_ASSOC);
    }

    //untuk sementara sql_exec saya pindahkan dulu ke sini dalam rangka pengenmbangan
    function sql_exec($query, $param=array()) {
        $result = FALSE;
        try {
            $db = new PDO(DSN_CMS, USER_CMS, PASS_CMS);
            
            $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $db->setAttribute( PDO::ATTR_TIMEOUT , '60' ); // seconds
            
            $stmt = $db->prepare($query);
            $stmt->execute($param);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $db = NULL;
        } catch (PDOException $e) {
            echo "<b>Error:</b> <pre>";
            print_r($e->__toString());
            echo "</pre>";
        }

        return $result;
    }



    /**
    * get the data
    */
    function getData($strSrch=null,$fldSrch=null) {
        $_search = "";
        if(!empty($strSrch)){
            if(!empty($fldSrch)) $_search = "AND ".$fldSrch." LIKE '".$strSrch."' ";
            else
                $_search = "AND (id LIKE '%".$strSrch."%' OR name LIKE '%".$strSrch."%') ";
        } else {
            // add buat grouping
            $_search = "AND (parent_id='') ";
        }

        $_query = "SELECT * FROM s_module
            WHERE 1 ".(!empty($_search)?$_search:'')."
                AND publish=1
            ORDER BY forder ASC ";

        return $this->sql_exec($_query);
    }

    /**
     * Disconnect
     */
    function disconnect(){
        //$this->mdb->disconnect();
    }
}
?>
