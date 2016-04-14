<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fbconnect extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('facebook_model');
    }

    function index(){}

    function login() {
        $ref = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : '';
        $redirect = site_url('fbconnect/redirect/in/'.$this->_txtenc($ref));
        $loginURL = $this->facebook_model->getLoginURL(array('scope' => 'email,publish_actions,publish_stream,read_stream,read_friendlists,user_birthday,user_likes,user_online_presence,user_actions.news,user_actions.video', 'redirect_uri' => $redirect));
        //$loginURL = $this->facebook_model->getLoginURL(array('redirect_uri' => $redirect));
        redirect($loginURL);
        //echo '<script type="text/javascript">window.location="'.$loginURL.'"</script>';
    }
       
    function logout() {
        $ref = (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : '';
        $redirect = site_url('fbconnect/redirect/out/'.$this->_txtenc($ref));
        $logoutURL = $this->facebook_model->getLogoutURL(array('next' => $redirect));
        redirect($logoutURL);
        //echo '<script type="text/javascript">window.location="'.$logoutURL.'"</script>';
    }
        
    function check() {
        if (isset($_POST['uid'])) {
            $sess = ($this->session->userdata('kmk_member')) ? $this->session->userdata('kmk_member') : array('lookup'=>'');

            if (isset($sess['source']) && $sess['source'] != 'facebook') die('no');

            if ($_POST['uid'] == $sess['lookup']) {
                die(json_encode($sess));
            } else {
                if ($sess['lookup'] != '') {
                    $this->session->unset_userdata('kmk_member');
                    die('no');
                }

                $fb_data = $this->facebook_model->getUserData();
                if (count($fb_data) > 0) {
                    $fb_data['is_validate'] = '0';
                    
                    if ($fb_data['id_profile'] > 0) {
                        $this->load->model('member_model');
                        $profile = $this->member_model->get_profile($fb_data['id_profile']);
                    }
                    
                    if (!empty($profile)) {
                        $fb_data['full_name']   = $profile['first_name'].' '.$profile['last_name'];
                        $fb_data['email']       = $profile['email'];
                        $fb_data['is_validate'] = $profile['is_validate'];
                    }
                    $this->session->sess_expiration = 28800; //expires in 8 hours
                    $this->session->set_userdata('kmk_member', $fb_data);

                    die('ok');
                } else {
                    die('ok');
                }
            }
        } else {
            die('no');
        }
    }
         
    function redirect() {
        if ($this->uri->segment(3) == "in") {
            $fb_data = $this->facebook_model->getUserData();
            if (count($fb_data) > 0) {
                $fb_data['is_validate'] = '0';
                
                if ($fb_data['id_profile'] > 0) {
                    $this->load->model('member_model');
                    $profile = $this->member_model->get_profile($fb_data['id_profile']);
                }
                
                if (!empty($profile)) {
                    $fb_data['full_name']   = $profile['first_name'].' '.$profile['last_name'];
                    $fb_data['email']       = $profile['email'];
                    $fb_data['is_validate'] = $profile['is_validate'];
                }
                
                $this->session->set_userdata('kmk_member', $fb_data);
            } else {
                die('fb login error');
            }
        } else {
            $this->facebook->destroySession();
            $this->session->unset_userdata('kmk_member');
        }

        $ref = $this->_txtdec($this->uri->segment(4));
        $ref = str_replace('#_=_', '', $ref);
        
        redirect($ref);
    }

    function _txtenc($str) {
        return strtr(base64_encode($str), array('+' => '.', '=' => '-', '/' => '~'));
    }

    function _txtdec($str) {
        return base64_decode(strtr($str, array('.' => '+', '-' => '=', '~' => '/')));
    }
}
?>
