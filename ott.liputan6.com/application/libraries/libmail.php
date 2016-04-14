<?php
class Libmail {
	
	public function sendMail($params = array())
	{
		$replyTo    = isset($params["replyTo"]) ? $params["replyTo"] : "default@kmkonline.co.id";
		$senderName = isset($params["senderName"]) ? $params["senderName"] : "default sender";
		$to			= isset($params["to"]) ? $params["to"] : "dev.it@kmkonline.co.id";
		$subject 	= isset($params["subject"]) ? $params["subject"] : "default subject";
		$message	= isset($params["message"]) ? $params["message"] : "default message";		
		
		
		$CI =& get_instance();
		
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'kmkonline2@gmail.com',
			'smtp_pass' => 'sebenernyakacunglho',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
		);
		$CI->load->library('email', $config);
		$CI->email->set_newline("\r\n");
		
		$CI->email->initialize($config);
		
		$CI->email->from($replyTo, $senderName);
		$CI->email->to($to); 
		//~ $CI->email->cc('another@another-example.com'); 
		//~ $CI->email->bcc('them@their-example.com'); 

		$CI->email->subject($subject);
		$CI->email->message($message);	

		$CI->email->send();
		
		/*
		if ( ! $CI->email->send())
		{
			die('oops, something wrong');
		}
		*/
		

		//~ echo $this->email->print_debugger();
	}
	
}

/* End of file libmail.php */
