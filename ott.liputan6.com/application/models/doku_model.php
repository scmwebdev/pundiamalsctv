<?php
class Doku_model extends CI_Model {
    var $sess   = NULL;
    
	public function __construct()
	{
		parent::__construct();
		$this->DB_WRITE = $this->load->database('db_lip6_write', true);
	}

    function send_data($data) {
        //$url    = 'https://pay.doku.com/Suite/Receive';
        $url    = 'http://103.10.129.17/Suite/Receive';
        $ref    = base_url();
        $ch     = curl_init($url);
        
        $data['STOREID']= '708';
        $data['WORDS']  = '2P4TxbE2jz7X';
        
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)");
        curl_setopt($ch, CURLOPT_REFERER, $ref);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        
        $source = curl_exec($ch);
        
        curl_close($ch);
        
        return $source;
    }
    
    function update_data($data, $where) {
        $this->DB_WRITE->update('dokupay', $data, $where);
        $error = $this->core_model->db_error(TRUE);
        return ($error == '') ? TRUE : FALSE;
    }
    
    function update_invoice($data, $where) {
        $this->DB_WRITE->update('invoice', $data, $where);
        $error = $this->core_model->db_error(TRUE);
        return ($error == '') ? TRUE : FALSE;
    }
    
    function set_debug($data, $jenis) {
        $row['log']     = $data;
        $row['jenis']   = $jenis;
        $row['tanggal'] = date("Y-m-d H:i:s");
        $row['ip']      = $_SERVER['REMOTE_ADDR'];
        $this->DB_WRITE->insert('dokupay_debug', $row);
    }
}
