<?
/**
 * KursValas
 * 
 * Version : 1.3
 * Date    : 19 October 2011
 * Author  : Fajar Yoseph Chandra <contact@jar2.net>
 * 
 * Copyright © 2011 Fajar Yoseph Chandra. All rights reserved.
 * Released under MIT License.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * 
 * Scrapper kurs valuta asing yang diambil secara real-time dari situs-
 * situs perbankan Indonesia.
 * 
 * Situs-situs perbankan yang saat ini sudah dapat diambil informasi 
 * kurs-nya oleh pustaka ini yaitu:
 * - Bank Central Asia
 * - Bank Indonesia *
 * - Bank Negara Indonesia
 * - Bank Mandiri
 * 
 * * Catatan untuk Bank Indonesia sementara tidak bisa digunakan karena 
 *   script tidak mampu membuka situs tersebut.
 * 
 * Keunggulan pustaka ini adalah bahwa program hanya akan melakukan 
 * fetch dan parsing satu kali untuk satu sumber (kecuali diminta 
 * memuat ulang secara explisit), meskipun diakses oleh banyak instance 
 * objek KursValas. Hal ini dapat mengurangi jumlah koneksi antar server 
 * yang dapat menghambat penyajian data.
 * 
 * Disclaimer: KursValas tidak memiliki hubungan apapun dengan Bank 
 * maupun situs manapun yang terdapat dalam pustaka ini.
 * 
 * KursValas menggunakan pustaka simple_html_dom.php © S.C. Chen dkk.
 * dibawah lisensi MIT. Pustaka ini bisa diunduh dari situsnya di 
 * http://sourceforge.net/projects/simplehtmldom/ namun disertakan 
 * bersama pusaka ini untuk kenyamanan pengguna. 
 * 
 */
 
require_once "simple_html_dom.php";
 
/**
 * Class: KursValas
 * 
 * Scrapper untuk mendapatkan update kurs valuta asing terbaru dari 
 * situs perbankan Indonesia.
 */
class KursValas {
	 
	protected static $s_kurs = array();

	private $src;
	private $type;
	
	const max_redirects = 20;

	private static $s_source = array(
		'bi*' => array(
			'notes' => "http://www.bi.go.id/web/id/Moneter/Kurs+Bank+Indonesia/Kurs+Transaksi/",
			'trx' => "http://www.bi.go.id/web/id/Moneter/Kurs+Bank+Indonesia/Kurs+Transaksi/",
		),
		'bca' => array(
			'trx' => "http://www.klikbca.com/individual/silver/ind/rates.html",
			'notes' => "http://www.klikbca.com/individual/silver/ind/rates.html",
		),
		'bni' => array(
			'notes' => "http://www.bni.co.id/InfoKurs/tabid/287/Default.aspx",
			'trx' => "http://www.bni.co.id/InfoKurs/tabid/287/Default.aspx",
		),
		'mandiri' => array(
			'notes' => "http://www.bankmandiri.co.id/resource/kurs.asp",
			'trx' => "http://www.bankmandiri.co.id/resource/kurs.asp",
		),
	);
	 
	/**
	 * Function: __construct
	 * 
	 * Inisialisasi objek KursValas, dengan mengambil data kurs dari 
	 * sumber situs perbankan tertentu.
	 * 
	 * Parameters:
	 *   $src - Kode situs perbankan sebagai sumber data. Lihat 
	 *          <set_src()> untuk daftar kode yang bisa digunakan.
	 *          Default = bca
	 *   $type - [trx|notes] Jenis kurs, apakah kurs transaksi atau 
	 *           kurs mata uang asing. Default = trx
	 */
	function __construct($src = "bca", $type = "trx") {
		$this->src = $src;
		$this->type = $type;
	}
	
	/**
	 * Function: set_src
	 * 
	 * Mengeset sumber data kurs.
	 * 
	 * Parameters:
	 *   $src - [bca|bni|mandiri] String kode sumber data.
	 * 
	 * Return:
	 *   Boolean TRUE jika berhasil diset, FALSE sebaliknya.
	 */
	public function set_src($src) {
		if(!isset(self::$s_source[$src]))
			return false;
		
		$this->src = $src;
		return true;
	}
	
	/**
	 * Function: get_src
	 * 
	 * Mengambil nilai kode sumber data kurs diambil saat ini.
	 */
	public function get_src() {
		return $this->src;
	}
	
	/**
	 * Function: set_type
	 * 
	 * Mengeset jenis kurs, apakah ingin memuat kurs transaksi atau kurs 
	 * uang kertas asing.
	 * 
	 * Parameters:
	 *   $type - [trx|notes] String jenis kurs yang akan dimuat.
	 * 
	 * Return:
	 *   Boolean TRUE jika berhasil diset, FALSE sebaliknya.
	 */
	public function set_type($type) {
		if($type != 'trx' && $type != 'notes')
			return false;
		
		$this->type = $type;
		return true;
	}
	
	/**
	 * Function: get_type
	 * Mengambil nilai jenis kurs (trx|notes) saat ini.
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Function: reload
	 * 
	 * Memuat ulang data kurs dari sumber situs perbankan.
	 * 
	 * Return:
	 *   Boolean hasil apakah proses reload berhasil.
	 */
	public function reload() {
		if(!isset(self::$s_source[$this->src]) 
		|| !isset(self::$s_source[$this->src][$this->type]) ) 
			return false;
		
		$context = array(
			'http'=>array('max_redirects' => self::max_redirects)
		);
		$context = stream_context_create($context);

		if(($file_str = file_get_contents(self::$s_source[$this->src][$this->type], 'r', $context)) === FALSE) 
			return false;

		switch($this->src) {
			case 'bca':
				return self::_parse_bca($file_str); break;
			case 'bi*':
				return self::_parse_bi_notes($file_str); break;
			case 'bni':
				return self::_parse_bni($file_str); break;
			case 'mandiri':
				return self::_parse_mandiri($file_str); break;
		}

		return false;
	}

	/**
	 * Function: get
	 * 
	 * Meminta data kurs untuk mata uang dan jenis tertentu.
	 * 
	 * Parameters:
	 *   $currency - Kode mata uang 3 huruf besar, misalnya USD.
	 *   $type - [buy|sell] jenis kurs.
	 * 
	 * Return:
	 *   Number besaran kurs.
	 * 
	 * See also:
	 *   <get_all()>
	 */
	public function get($currency, $type) {
		if(!$this->_is_data_loaded()) {
			if(!$this->reload())
				return false;
		}
			
		return self::$s_kurs[$this->src][$this->type][$currency][$type];
	}
	
	/**
	 * Function: get_all
	 * 
	 * Meminta data kurs untuk semua mata uang.
	 * 
	 * Return:
	 *   Array data kurs dengan contoh format sbb:
	 *   array( 
	 *     USD => array( 
	 *       buy => 8725,
	 *       sell => 8975
	 *     )
	 *   )
	 * 
	 * See also:
	 *   <get()>
	 */
	public function get_all() {
		if(!$this->_is_data_loaded()) {
			if(!$this->reload())
				return false;
		}
			
		return self::$s_kurs[$this->src][$this->type];
	}
	
	/**
	 * Function: get_date
	 * 
	 * Mendapatkan tanggal pembaharuan kurs.
	 * 
	 * Return:
	 *   Integer waktu dalam format UNIX_TIMESTAMP.
	 */
	public function get_date() {
		if(!$this->_is_data_loaded()) {
			if(!$this->reload())
				return false;
		}
			
		return self::$s_kurs[$this->src][$this->type.'_date'];
	}
	
	/**
	 * Function: trim
	 * 
	 * Mengubah spasi dalam format HTML entity menjadi spasi biasa, 
	 * kemudian memangkas (trim) kelebihan whitespace di awal/akhir 
	 * string.
	 * 
	 * Parameters:
	 *   $str - String yang akan dipangkas
	 * 
	 * Return:
	 *   String hasil pemangkasan.
	 */
	protected static function trim($str) {
		$str = str_replace('&nbsp;', ' ', $str);
		$str = trim($str);
		return $str;
	}
	
	/**
	 * Function: _is_data_loaded
	 * 
	 * Memeriksa apakah data kurs yang diperlukan sudah dimuat ke objek 
	 * KursValas. Data kurs yang diperiksa sesuai dengan nilai property 
	 * $src dan $type.
	 * 
	 */
	private function _is_data_loaded() {
		if(!isset(self::$s_kurs[$this->src])) {
			self::$s_kurs[$this->src] = array();
			return false;
		}
		if(count(self::$s_kurs[$this->src]) == 0) {
			return false;
		}
		if(!isset(self::$s_kurs[$this->src][$this->type])) {
			self::$s_kurs[$this->src][$this->type] = array();
			self::$s_kurs[$this->src][$this->type.'_date'] = null;
			return false;
		}
		if(count(self::$s_kurs[$this->src][$this->type]) == 0) {
			return false;
		}
		return true;
	}
	
	/**
	 * Function: _parse_bca
	 * 
	 * Melakukan parsing halaman Kurs Bank Central Asia, 
	 * yang hasilnya disimpan di member statis $s_kurs['bca']. Fungsi 
	 * ini mencakup kurs transaksi dan uang kertas.
	 * 
	 * Parameters:
	 *   $file_str - String isi halaman web (HTML)
	 * 
	 * Return:
	 *   Boolean status keberhasilan parsing.
	 * 
	 * See also:
	 *   <$s_kurs>
	 *   <reload()>
	 */
	private static function _parse_bca($file_str) {
		$month_list = array(1 => 
			"Jan", "Feb", "Mar", "Apr", "Mei", "Jun", 
			"Jul", "Agt", "Sep", "Okt", "Nov", "Des"
		);
		$month_keys = array(
			"jan" => 1, 
			"feb" => 2, 
			"mar" => 3, 
			"apr" => 4, 
			"mei" => 5, 
			"jun" => 6, 
			"jul" => 7, 
			"agt" => 8, 
			"sep" => 9, 
			"okt" => 10, 
			"nov" => 11, 
			"des" => 12
		);
		
		$html = new simple_html_dom();
		$html->load($file_str);
		
		self::$s_kurs['bca'] = array(
			'trx' => array(),
			'trx_date' => null,
			'notes' => array(),
			'notes_date' => null,
		);
		
		$valas_list = array();
		
		/* KURS TRANSAKSI */
		
		// Ambil tanggal
		$node = $html->find('table[class=testL]', 0)->children(0);
		$date_str = $node->children(0)->children(0)->children(2)->innertext;
		preg_match('/(?<d>\d+)\-(?<m>\w+)\-(?<y>\d{4})/', $date_str, $date_arr);
		self::$s_kurs['bca']['trx_date'] = mktime(0, 0, 0, $month_keys[strtolower($date_arr['m'])], $date_arr['d'], $date_arr['y']);
		
		// Ambil nilai
		$node = $node->next_sibling();
		$node = $node->next_sibling();
		
		
		while($node != null) {
			$valas = self::trim($node->children(0)->children(0)->innertext);
			$jual = self::trim($node->children(1)->innertext);
			$beli = self::trim($node->children(2)->innertext);
			self::$s_kurs['bca']['trx'][$valas] = array(
				'sell' => $jual,
				'buy' => $beli,
			);
			$node = $node->next_sibling();
			
			array_push($valas_list, $valas);
		}
		
		////
		
		/* KURS UANG KERTAS */
		
		// Ambil tanggal
		$node = $html->find('table[class=testL]', 1);
		$date_str = $node->children(0)->children(0)->children(0)->children(0)->children(2)->innertext;
		preg_match('/(?<d>\d+)\-(?<m>\w+)\-(?<y>\d{4})/', $date_str, $date_arr);
		self::$s_kurs['bca']['notes_date'] = mktime(0, 0, 0, $month_keys[strtolower($date_arr['m'])], $date_arr['d'], $date_arr['y']);
		
		// Ambil nilai
		
		foreach($valas_list as $key => $valas) {
			$node_v = $node->children($key+2);
			
			$jual = self::trim($node_v->children(0)->innertext);
			$beli = self::trim($node_v->children(1)->innertext);
			self::$s_kurs['bca']['notes'][$valas] = array(
				'sell' => $jual,
				'buy' => $beli,
			);
		}
		return true;
	}
	
	/**
	 * Function: _parse_bi_notes
	 * 
	 * Melakukan parsing halaman Kurs Uang Kertas Asing Bank Indonesia, 
	 * yang hasilnya disimpan di member statis $s_kurs['bi']['notes'].
	 * 
	 * Parameters:
	 *   $file_str - String isi halaman web (HTML)
	 * 
	 * Return:
	 *   Boolean status keberhasilan parsing.
	 * 
	 * See also:
	 *   <$s_kurs>
	 *   <reload()>
	 */
	private static function _parse_bi_notes($file_str) {
		
		$html = new simple_html_dom();
		$html->load($file_str);
		
		if(!isset(self::$s_kurs['bi'])) {
			self::$s_kurs['bi'] = array();
		}
		
		if(!isset(self::$s_kurs['bi']['notes'])) {
			self::$s_kurs['bi']['notes'] = array();
			self::$s_kurs['bi']['notes_date'] = null;
		}
		
		/* KURS UANG KERTAS */
		
		// Ambil tanggal
		$node = $html->find('#tblHeader7', 0)->next_sibling()
			->children(0)->children(0)->children(0)->children(0)->children(0);
			
		$date_str = $node->children(1)->children(2)->innertext;
		preg_match('/(?<d>\d+) (?<m>\w+) (?<y>\d{4})/', $date_str, $date_arr);
		self::$s_kurs['bi']['notes_date'] = strtotime($date_arr[0]);
		
		// Ambil nilai
		$node = $node->children(3)->children(2);
		
		while($node != null) {
			$valas = self::trim($node->children(0)->children(0)->innertext);
			$satuan = self::trim($node->children(1)->children(0)->innertext);
			$jual = self::trim($node->children(2)->children(0)->innertext);
			$beli = self::trim($node->children(3)->children(0)->innertext);
			self::$s_kurs['bi']['notes'][$valas] = array(
				'sell' => $jual / $satuan,
				'buy' => $beli / $satuan,
			);
			$node = $node->next_sibling();
		}
		
		return true;
	}
	
	/**
	 * Function: _parse_bni
	 * 
	 * Melakukan parsing halaman Kurs Bank Negara Indonesia, 
	 * yang hasilnya disimpan di member statis $s_kurs['bni']. 
	 * Saat ini situs BNI hanya menyediakan satu jenis kurs. Jadi, nilai 
	 * kurs transaksi dan uang kertas disamakan.
	 * 
	 * Parameters:
	 *   $file_str - String isi halaman web (HTML)
	 * 
	 * Return:
	 *   Boolean status keberhasilan parsing.
	 * 
	 * See also:
	 *   <$s_kurs>
	 *   <reload()>
	 */
	private static function _parse_bni($file_str) {
		
		$html = new simple_html_dom();
		$html->load($file_str);
		
		self::$s_kurs['bni'] = array(
			'trx' => array(),
			'trx_date' => null,
			'notes' => array(),
			'notes_date' => null,
		);
		
		/* KURS TRANSAKSI */
		
		// Ambil tanggal
		$date_str = $html->find('#dnn_ctr1183_ViewKursDetail_lblUpdate', 0)->innertext;
		preg_match('/(?<d>\d+)\/(?<m>\d+)\/(?<y>\d{4}) (?<h>\d+):(?<i>\d+) /', $date_str, $date_arr);
		self::$s_kurs['bni']['trx_date'] = mktime($date_arr['h'], $date_arr['i'], 0, $date_arr['m'], $date_arr['d'], $date_arr['y']);
		self::$s_kurs['bni']['notes_date'] = self::$s_kurs['bni']['trx_date'];
		
		// Ambil nilai
		$node = $html->find('#kurs', 0)->children(1)->children(0);
		
		
		while($node != null) {
			$valas = self::trim($node->children(0)->children(0)->innertext);
			$jual = self::trim($node->children(1)->innertext);
			$jual = str_replace('.', '', $jual);
			$jual = str_replace(',', '.', $jual);
			$beli = self::trim($node->children(2)->innertext);
			$beli = str_replace('.', '', $beli);
			$beli = str_replace(',', '.', $beli);
			self::$s_kurs['bni']['trx'][$valas] = array(
				'sell' => $jual,
				'buy' => $beli,
			);
			self::$s_kurs['bni']['notes'][$valas] = self::$s_kurs['bni']['trx'][$valas];
			$node = $node->next_sibling();
		}
		
		return true;
	}
	
	/**
	 * Function: _parse_mandiri
	 * 
	 * Melakukan parsing halaman Kurs Bank Mandiri,
	 * yang hasilnya disimpan di member statis $s_kurs['mandiri']. 
	 * Saat ini situs Mandiri hanya menyediakan satu jenis kurs. 
	 * Jadi, nilai kurs transaksi dan uang kertas disamakan.
	 * 
	 * Parameters:
	 *   $file_str - String isi halaman web (HTML)
	 * 
	 * Return:
	 *   Boolean status keberhasilan parsing.
	 * 
	 * See also:
	 *   <$s_kurs>
	 *   <reload()>
	 */
	private static function _parse_mandiri($file_str) {
		$month_list = array(1 => 
			"Jan", "Feb", "Mar", "Apr", "Mei", "Jun", 
			"Jul", "Agt", "Sep", "Okt", "Nov", "Des"
		);
		$month_keys = array(
			"jan" => 1, 
			"feb" => 2, 
			"mar" => 3, 
			"apr" => 4, 
			"mei" => 5, 
			"jun" => 6, 
			"jul" => 7, 
			"agt" => 8, 
			"sep" => 9, 
			"okt" => 10, 
			"nov" => 11, 
			"des" => 12
		);
		
		$html = new simple_html_dom();
		$html->load($file_str);
		
		self::$s_kurs['mandiri'] = array(
			'trx' => array(),
			'trx_date' => null,
			'notes' => array(),
			'notes_date' => null,
		);
		
		/* KURS TRANSAKSI */
		
		// Ambil tanggal
		$date_str = $html->find('p[class=catatan]', 0)->innertext;
		preg_match('/Last Updated: (?<d>\d+) (?<m>\w+) (?<y>\d{2}) (?<h>\d+):(?<i>\d+) /i', $date_str, $date_arr);
		self::$s_kurs['mandiri']['trx_date'] = mktime($date_arr['h'], $date_arr['i'], 0, $month_keys[strtolower($date_arr['m'])], $date_arr['d'], $date_arr['y']);
		
		// Ambil nilai
		$node = $html->find('table[class=tbl-view]', 0)->children(1);
		
		while($node != null) {
			$valas = self::trim($node->children(1)->innertext);
			$jual = self::trim($node->children(4)->innertext);
			$jual = str_replace('.', '', $jual);
			$jual = str_replace(',', '.', $jual);
			$beli = self::trim($node->children(2)->innertext);
			$beli = str_replace('.', '', $beli);
			$beli = str_replace(',', '.', $beli);
			self::$s_kurs['mandiri']['trx'][$valas] = array(
				'sell' => $jual,
				'buy' => $beli,
			);
			self::$s_kurs['mandiri']['notes'][$valas] = self::$s_kurs['mandiri']['trx'][$valas];
			$node = $node->next_sibling();
		}
		
		return true;
	}
	
};
