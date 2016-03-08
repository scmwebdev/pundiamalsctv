<?php
/**
 * Users object
 *
 * @access		public
 * @package		SQL
 * @author 		bonny.hp
 * @since 		2006-10-01
 * @version 	2.1 MDB2
 * @notes     perbaikan edit auth
 */

class User{
    // database object
    var $mdb = null;
    var $totRec = 0;

    /**
   * Constructor
   */
    function User(){
        // database initial
        $this->mdb = MDB2::factory(DSN);
        $this->mdb->setFetchMode(MDB2_FETCHMODE_ASSOC);
    }

    /**
     * get data group
     */
    function getGroup($id=0,$strSrch=null,$fldSrch=null){
        $_query = "SELECT id,name,notes FROM s_user_group WHERE 1 ".($id?"AND id='".$id."' ":"");

        if(!empty($strSrch)){
            if(!empty($fldSrch)) $_query .= "AND ".$fldSrch." like '%".$strSrch."%' ";
            else $_query .= "AND (name like '%".$strSrch."%' OR notes like '%".$strSrch."%') ";
        }

        $res = $this->mdb->query($_query);
        $this->totRec = $res->numRows();

        $all = $this->mdb->queryAll($_query);
        return $all;
    }

    /**
     * get data user
     */
    function getUser($login=null,$strSrch=null,$fldSrch=null,$ugId=0,$page=1){
        $_query = "SELECT u.login,u.fullname,u.created,u.lastlogin,u.email,
                          u.active,u.notify,u.ug_id,ug.name as g_name
                   FROM s_user u, s_user_group ug
                   WHERE u.ug_id=ug.id ".
                   ($login?"AND u.login='".$login."' ":"").
                   ($ugId?"AND u.ug_id='".$ugId."' ":"");

        if(!empty($strSrch)){
            if(!empty($fldSrch)) $_query .= "AND ".$fldSrch." like '%".$strSrch."%' ";
            else $_query .= "AND (u.login like '%".$strSrch."%' OR u.email like '%".$strSrch."%') ";
        }

        $res = $this->mdb->query($_query);
        $this->totRec = $res->numRows();

        $_query .= "LIMIT ".(($page-1)*REC_PER_PAGE).",".REC_PER_PAGE."";

        $all = $this->mdb->queryAll($_query);
        return $all;
    }

    /**
     * get field
     */
    function getField($key=null){
        $_field = array( "u.login" => "Login", "u.email" => "Email", "ug.name" => "Group" );
        if($key) return $_field[$key];
        else return $_field;
    }

    /**
     * add group
     *
     * @param array $formvars
     */
    function addGroup($formvars){
        $_query = "INSERT INTO s_user_group(name,notes)
            VALUES('".htmlentities($formvars["name"])."','".htmlentities($formvars["notes"])."') ";
        $this->mdb->exec($_query);
        logging(htmlspecialchars($_query,ENT_QUOTES));
    }

    /**
     * edit group
     *
     * @param array $formvars
     */
    function editGroup($formvars){
        $_query = "UPDATE s_user_group SET name='".$formvars["name"]."',notes='".$formvars["notes"]."' WHERE id='".$formvars["ug_id"]."' ";
        $this->mdb->exec($_query);
        logging(htmlspecialchars($_query,ENT_QUOTES));
    }

    /**
     * delete group
     */
    function delGroup($id){
        $this->mdb->exec("DELETE FROM s_user_group WHERE id='".$id."' ");
        logging(htmlspecialchars("DELETE FROM s_user_group WHERE id='".$id."' ",ENT_QUOTES));
        $this->mdb->exec("DELETE FROM s_user WHERE ug_id='".$id."' ");
        logging(htmlspecialchars("DELETE FROM s_user WHERE ug_id='".$id."' ",ENT_QUOTES));
        $this->mdb->exec("DELETE FROM s_mod_auth WHERE ug_id = '".$id."' ");
        logging(htmlspecialchars("DELETE FROM s_mod_auth WHERE ug_id = '".$id."' ",ENT_QUOTES));
    }

    /**
     * add user
     *
     * @param array $formvars
     */
    function addUser($formvars){
        $_query = "INSERT INTO s_user(login,pass,created,lastlogin,ug_id,email,active,notify,fullname)
            VALUES('".htmlentities($formvars["id"])."','".md5($formvars["pass"])."',NOW(),NOW(),'".$formvars["ug_id"]."',
            '".$formvars["email"]."','".$formvars["active"]."','".$formvars["notify"]."','".$formvars["fullname"]."') ";
        $this->mdb->exec($_query);
        logging(htmlspecialchars($_query,ENT_QUOTES));
    }

    /**
     * edit user
     *
     * @param array $formvars
     */
    function editUser($formvars){
        $_query = "UPDATE s_user SET login='".$formvars["id"]."',".(!empty($formvars["pass"])?"pass='".md5($formvars["pass"])."',":"")."
            ug_id='".$formvars["ug_id"]."',email='".$formvars["email"]."',active='".$formvars["active"]."',notify='".$formvars["notify"]."',fullname='".$formvars["fullname"]."'
            WHERE login='".$formvars["login"]."' ";
        $this->mdb->exec($_query);
        logging(htmlspecialchars($_query,ENT_QUOTES));
    }

    /**
     * delete user
     */
    function delUser($arr_id){
        $this->mdb->exec("DELETE FROM s_user WHERE login IN (".$arr_id.") ");
        logging(htmlspecialchars("DELETE FROM s_user WHERE login IN (".$arr_id.") ",ENT_QUOTES));
        $this->mdb->exec("DELETE FROM s_mod_auth WHERE login IN (".$arr_id.") ");
        logging(htmlspecialchars("DELETE FROM s_mod_auth WHERE login IN (".$arr_id.") ",ENT_QUOTES));
    }

    /**
     * get auth
     */
    function getAuth($ugId=0,$login=null){
        if($ugId) $_str = "AND ma.ug_id = '".$ugId."' ";
        elseif($login) $_str = "AND ma.login = '".$login."' ";
        $_query = "SELECT m.id,m.name as m_name,m.auth_default,m.parent_id,
                          ma.id as ma_id,ma.auth
                   FROM s_module m LEFT JOIN s_mod_auth ma ON (m.id=ma.m_id ".$_str.")
                   WHERE m.publish=1 AND m.parent_id != 'hide' AND m.parent_id != 'droped'
                   ORDER BY m.forder ASC ";
        $all = $this->mdb->queryAll($_query);
        return $all;
    }

    /**
     * edit auth
     *
     * @param array $formvars
     */
    function editAuth($formvars){

        foreach ($formvars["m_id"] as $k => $v){

            if(!$formvars["auth_id"][$k]){ // insert
                $_auth = @implode("|",$formvars["auth"][$k]);

                if($_auth){ // ada data
                    if($formvars["dataType"] == "group") {// group
                        $_query = "INSERT INTO s_mod_auth(ug_id,m_id,auth) VALUE('".$formvars["ug_id"]."','".$formvars["m_id"][$k]."','".$_auth."') ";

                    }
                    elseif($formvars["dataType"] == "user"){
                        $_query = "INSERT INTO s_mod_auth(login,m_id,auth) VALUE('".$formvars["id"]."','".$formvars["m_id"][$k]."','".$_auth."') ";
                    }
                    $this->mdb->exec($_query);
                    logging(htmlspecialchars($_query,ENT_QUOTES));
                }
            } else { // update

                if($formvars["auth_id"][$k]){ // ada id
                    $_auth = @implode("|",$formvars["auth"][$k]);
                    $_query = "UPDATE s_mod_auth SET auth='".$_auth."' WHERE id = '".$formvars["auth_id"][$k]."' ";
                    $this->mdb->exec($_query);
                    logging(htmlspecialchars($_query,ENT_QUOTES));
                }
            }
        }
    }

    /**
     * Disconnect
     */
    function disconnect(){
        $this->mdb->disconnect();
    }
}
?>
