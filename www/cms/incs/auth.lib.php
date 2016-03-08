<?
/**
 * AUTH objek
 *
 * @access      public
 * @package     SQL
 * @author      bonny.hp
 * @since       2007-05-06
 * @version     2.1 MDB2
 * @note        add var ugID
 */

class Auth{
    // database object
    var $mdb = null;
    // error messages
    var $error = null;

    var $ugId = 0; // ugId = 1 (admin group), else non

    /**
     * Constructor
     */
    function __construct() {
        // database initial
        $options = array(
            'debug' => 2,
            'result_buffering' => false,
        );

        $this->mdb = MDB2::factory(DSN,$options);
        if(PEAR::isError($this->mdb)) die($this->mdb->getMessage());
        $this->mdb->setFetchMode(MDB2_FETCHMODE_ASSOC);
    }

    /**
     * check session
     *
     * return nosess=1,expr=2,main=0
     */
    function checkSession(){
        if (!isset($_SESSION["login"]) || $_SESSION["login"] == "" || empty($_SESSION["login"])){
            if (isset($_SESSION['login'])) {
                session_unset($_SESSION["login"]);
            }
            //session_destroy();
            return "1";
        } else if((time() - $_SESSION["lastsession"]) > SESS_TIME) {
            if (isset($_SESSION['login'])) {
                session_unset($_SESSION["login"]);
            }
            //session_destroy();
            return "2";
        } else {
            $_SESSION["lastsession"] = time();
            return "0";
        }
    }

    /**
     * check auth
     *
     * return y=1 or n=0
     */
    function checkAuth($mId,$typeAuth="view") {
        $ugId = $this->mdb->queryOne("SELECT ug_id FROM s_user WHERE login='".(!empty($_SESSION["login"])?$_SESSION["login"]:"")."' AND active='1' ");
        $this->ugId = $ugId;
        $_query = "
            SELECT count(id) FROM s_mod_auth
            WHERE (login = '".(!empty($_SESSION["login"])?$_SESSION["login"]:"")."' OR ug_id='".$ugId."')
            AND m_id = '".$mId."' AND auth LIKE '%".$typeAuth."%' ";
        return  $this->mdb->queryOne($_query);
    }

    /**
     * get auth
     *
     * return array auth
     */
    function getAuth($mId) {
        $ugId = $this->mdb->queryOne("SELECT ug_id FROM s_user WHERE login='".(!empty($_SESSION["login"])?$_SESSION["login"]:"")."' AND active='1' ");

        $_query = "
            SELECT auth FROM s_mod_auth
            WHERE (login = '".(!empty($_SESSION["login"])?$_SESSION["login"]:"")."' OR ug_id='".$ugId."')
            AND m_id = '".$mId."' ";
        $arrAuth = $this->mdb->queryAll($_query);
        if(count($arrAuth)){
            foreach($arrAuth as $k => $v){
                $_auth = explode("|",$v["auth"]);
                foreach($_auth as $kk => $vv) $auth[$vv] = "1";
            }
        }
        return @$auth;
    }

    /**
     * check login
     *
     * return 1 or 0
     */
    function checkLogin($login,$pass) {
        $login_temp = 0;
        $_query = "SELECT count(*) FROM s_user WHERE login = '".$login."' AND pass = '".md5($pass)."' AND active='1' ";
        $login_temp = $this->mdb->queryOne($_query);

        if($login_temp) $this->mdb->exec("UPDATE s_user SET lastlogin = NOW() WHERE login = '".$login."' ");

        return $login_temp;
    }

    /**
     * change password
     *
     * return 1 or 0
     */
    function changePassword($login,$pass) {
        $res = $this->mdb->exec("UPDATE s_user SET pass = '".MD5($pass)."' WHERE login = '".$login."' ");
        if (PEAR::isError($res)) die($res->getMessage());

        return 1;
    }

    function changeProfile($login,$data) {
        $res = $this->mdb->exec("UPDATE s_user SET fullname = '".trim($data['fullname'])."' WHERE login = '".$login."' ");
        if (PEAR::isError($res)) die($res->getMessage());

        return 1;
    }
    
    function getProfile($login) {
        $_query = "SELECT fullname,email FROM s_user WHERE login = '".$login."' AND active='1' LIMIT 1";
        $res = $this->mdb->query($_query);

        return $res->fetchRow();
    }
    
    /**
     * Disconnect
     */
    function disconnect(){
        $this->mdb->disconnect();
    }
}
?>
