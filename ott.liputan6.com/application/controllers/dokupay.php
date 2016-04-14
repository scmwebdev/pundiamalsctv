<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dokupay extends CI_Controller {
    var $sess   = NULL;
    
    function __construct() {
        parent::__construct();
        $this->sess     = $this->session->userdata('kmk_member');
        $this->load->model('doku_model');
    }
    
    function index() {
    }
    
	function notify()
	{
        if (!$this->input->post()) die();
        
        $this->doku_model->set_debug(print_r($_POST, TRUE), 'notify');
        
        if ($_POST['TRANSIDMERCHANT']) {
            $order_number = $_POST['TRANSIDMERCHANT'];        
        } else { 
            $order_number = 0; 
        }
        
        $totalamount        = $_POST['AMOUNT'];
        $words              = $_POST['WORDS'];
        $statustype         = $_POST['STATUSTYPE'];
        $response_code      = $_POST['RESPONSECODE'];
        $approvalcode       = $_POST['APPROVALCODE'];
        $status             = $_POST['RESULTMSG'];
        $paymentchannel     = $_POST['PAYMENTCHANNEL'];
        $paymentcode        = $_POST['PAYMENTCODE'];
        $session_id         = $_POST['SESSIONID'];
        $bank_issuer        = $_POST['BANK'];
        $cardnumber         = $_POST['MCN'];
        $payment_date_time  = $_POST['PAYMENTDATETIME'];
        $verifyid           = $_POST['VERIFYID'];
        $verifyscore        = $_POST['VERIFYSCORE'];
        $verifystatus       = $_POST['VERIFYSTATUS'];
        
        $qsql   = $this->core_model->get_data(array('data'=>'row', 'select'=>'id', 'table'=>'dokupay', 'where'=>array('transidmerchant'=>$order_number, 'trxstatus'=>'Requested')));
        $true   = (empty($qsql)) ? 0 : 1;
    
    	if (!$true) {
            echo 'Stop1';
    	} else {
            if ($status == "SUCCESS") {    		    
                $qsql   = $this->doku_model->update_data(array('trxstatus'=>'Success', 'words'=>$words, 'statustype'=>$statustype, 'response_code'=>$response_code, 'approvalcode'=>$approvalcode, 'trxstatus'=>$status, 'payment_channel'=>$paymentchannel, 'paymentcode'=>$paymentcode, 'session_id'=>$session_id, 'bank_issuer'=>$bank_issuer, 'creditcard'=>$cardnumber, 'payment_date_time'=>$payment_date_time, 'verifyid'=>$verifyid, 'verifyscore'=>$verifyscore, 'verifystatus'=>$verifystatus), array('transidmerchant'=>$order_number));
                if ($qsql) {
                    // update invoice is_paid = YES
                    $qsql   = $this->doku_model->update_invoice(array('is_paid'=>'YES'), array('no_invoice'=>$order_number));
                    
                    // create anuan
                    $this->load->model('payment_model');
                    $this->payment_model->invoice_to_match($order_number);
                    
                    echo "Continue";
                } else {
                    echo "Stop2";
                }
    		  
    		} else {                
                $qsql   = $this->doku_model->update_data(array('trxstatus'=>'Failed'), array('transidmerchant'=>$order_number));
                echo ($qsql) ? "Continue" : "Stop3";
    		}
    	}
	}
	
	function redirect()
	{
        if (!$this->input->post()) die();
        
        $this->doku_model->set_debug(print_r($_POST, TRUE), 'redirect');
        
        $this->session->unset_userdata('kmk_discount');
        $this->session->unset_userdata('kmk_cart');
        
        $data['order_number'] = $_POST['TRANSIDMERCHANT'];
        $data['purchase_amount'] = $_POST['AMOUNT'];
        $data['status_code'] = $_POST['STATUSCODE'];
        $data['words'] = $_POST['WORDS'];
        $data['paymentchannel'] = $_POST['PAYMENTCHANNEL'];
        $data['session_id'] = $_POST['SESSIONID'];
        $data['paymentcode'] = $_POST['PAYMENTCODE'];
        $data['redirect_url'] = site_url('payment/result');
        
        if ($data['status_code'] == '5510') {
            $slug = $this->session->userdata('kmk_last_purchased_campaign');
            redirect('campaign/'.$slug.'/buy');
        }
        
        $this->load->view('payment/redirect', $data);
	}
}