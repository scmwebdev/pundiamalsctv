<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

# September 2012
# by Wisnu Alamsyah
# www.alamsyah.org - vespagaul@gmail.com

function str2num($string, $clear=false) {
    // $string = 'Nrs 89,994,874.0098'; output: 89994874.0098
    return ($clear) ? preg_replace("/[^0-9]/", '', $string) : preg_replace("/[^0-9\.]/", '', $string);
}

function str_rand($length, $all_char = false) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if ($all_char) $characters .= 'abcdefghijklmnopqrstuvwxyz';
    $charlen    = strlen($characters) - 1;
    $string     = '';
    for ($i = 0; $i < $length; $i++) $string .= $characters[rand(0, $charlen)];
    return $string;
}

function format_rupiah($n) {
    $n = trim($n);
    return number_format($n, 0, ',', '.');
}

function add_char($txt, $length, $char=' ', $pre=false) {
    $txt = trim($txt);
    $txt_length = strlen($txt);

    if ($txt_length >= $length) return $txt;

    return ($pre) ? str_repeat($char, ($length - $txt_length)).$txt : $txt.str_repeat($char, ($length - $txt_length));
}

function set_tanggal($tgl, $time=false) {
    if ($tgl == '') return '';
    return ($time) ? date("d-M-Y H:i", strtotime($tgl)) : date("d-M-Y", strtotime($tgl));
}

function set_tanggalx($tgl) {
    if ($tgl == '') return '';

    $time       = strtotime($tgl);

	$tanggal    = date('j', $time);
	$bulan      = nama_bulan(date('n', $time));
	$tahun      = date('Y', $time);

	return $tanggal.' '.$bulan.' '.$tahun;
}

function nama_bulan($bln)
{
	switch($bln)
	{
		case 1:
			return "Januari";
			break;
		case 2:
			return "Februari";
			break;
		case 3:
			return "Maret";
			break;
		case 4:
			return "April";
			break;
		case 5:
			return "Mei";
			break;
		case 6:
			return "Juni";
			break;
		case 7:
			return "Juli";
			break;
		case 8:
			return "Agustus";
			break;
		case 9:
			return "September";
			break;
		case 10:
			return "Oktober";
			break;
		case 11:
			return "Nopember";
			break;
		case 12:
			return "Desember";
			break;
	}
}

function str_enc($str) {
    return strtr(base64_encode($str), array('+' => '.', '=' => '-', '/' => '~'));
}

function str_dec($str) {
    return base64_decode(strtr($str, array('.' => '+', '-' => '=', '~' => '/')));
}

function utc_to_local($date, $time)
{
    $date = new DateTime($date.' '.$time, new DateTimeZone('UTC'));
    $date->setTimeZone(new DateTimeZone('Asia/Jakarta'));

    $dates = $date->format('Y-m-d H:i:s');
    return $dates;
}

function local_from_utc($date, $time)
{
    $date = new DateTime($date.' '.$time, new DateTimeZone('UTC'));
    $date->setTimeZone(new DateTimeZone('Asia/Jakarta'));

    return $date;
}

function tgl_indo($tgl,$isJadwal=false){
	  date_default_timezone_set("Asia/Jakarta");

	  $tanggal 	= substr($tgl,8,2);
	  $bulan    = getBulan(substr($tgl,5,2));
	  $tahun    = substr($tgl,0,4);

	  $day 		= date("l", strtotime($tgl));

	  $hari 	= getHari($day);

      if($isJadwal == true){
        $data = $hari.'<br> '.$tanggal.' '.$bulan.' '.$tahun;
      }else{
        $data = $hari.', '.$tanggal.' '.$bulan.' '.$tahun;
      }

	  return $data;
}


function getHari($day){
	if ($day == "Sunday") $namahari = "Minggu";
	else if ($day == "Monday") $namahari = "Senin";
	else if ($day == "Tuesday") $namahari = "Selasa";
	else if ($day == "Wednesday") $namahari = "Rabu";
	else if ($day == "Thursday") $namahari = "Kamis";
	else if ($day == "Friday") $namahari = "Jumat";
	else if ($day == "Saturday") $namahari = "Sabtu";

	return $namahari;
}

function getBulan($bln){
      switch ($bln){
        case 1:
          return "Januari";
          break;
        case 2:
          return "Februari";
          break;
        case 3:
          return "Maret";
          break;
        case 4:
          return "April";
          break;
        case 5:
          return "Mei";
          break;
        case 6:
          return "Juni";
          break;
        case 7:
          return "Juli";
          break;
        case 8:
          return "Agustus";
          break;
        case 9:
          return "September";
          break;
        case 10:
          return "Oktober";
          break;
        case 11:
          return "November";
          break;
        case 12:
          return "Desember";
          break;
    }
}


function cleanString($text) {
    // 1) convert á ô => a o
    $text = preg_replace("/[áàâãªä]/u","a",$text);
    $text = preg_replace("/[ÁÀÂÃÄ]/u","A",$text);
    $text = preg_replace("/[ÍÌÎÏ]/u","I",$text);
    $text = preg_replace("/[íìîï]/u","i",$text);
    $text = preg_replace("/[éèêë]/u","e",$text);
    $text = preg_replace("/[ÉÈÊË]/u","E",$text);
    $text = preg_replace("/[óòôõºö]/u","o",$text);
    $text = preg_replace("/[ÓÒÔÕÖ]/u","O",$text);
    $text = preg_replace("/[úùûü]/u","u",$text);
    $text = preg_replace("/[ÚÙÛÜ]/u","U",$text);
    $text = preg_replace("/[’‘‹›‚]/u","'",$text);
    $text = preg_replace("/[“”«»„]/u",'"',$text);
    $text = str_replace("–","-",$text);
    $text = str_replace(" "," ",$text);
    $text = str_replace("ç","c",$text);
    $text = str_replace("Ç","C",$text);
    $text = str_replace("ñ","n",$text);
    $text = str_replace("Ñ","N",$text);

    //2) Translation CP1252. &ndash; => -
    $trans = get_html_translation_table(HTML_ENTITIES);
    $trans[chr(130)] = '&sbquo;';    // Single Low-9 Quotation Mark
    $trans[chr(131)] = '&fnof;';    // Latin Small Letter F With Hook
    $trans[chr(132)] = '&bdquo;';    // Double Low-9 Quotation Mark
    $trans[chr(133)] = '&hellip;';    // Horizontal Ellipsis
    $trans[chr(134)] = '&dagger;';    // Dagger
    $trans[chr(135)] = '&Dagger;';    // Double Dagger
    $trans[chr(136)] = '&circ;';    // Modifier Letter Circumflex Accent
    $trans[chr(137)] = '&permil;';    // Per Mille Sign
    $trans[chr(138)] = '&Scaron;';    // Latin Capital Letter S With Caron
    $trans[chr(139)] = '&lsaquo;';    // Single Left-Pointing Angle Quotation Mark
    $trans[chr(140)] = '&OElig;';    // Latin Capital Ligature OE
    $trans[chr(145)] = '&lsquo;';    // Left Single Quotation Mark
    $trans[chr(146)] = '&rsquo;';    // Right Single Quotation Mark
    $trans[chr(147)] = '&ldquo;';    // Left Double Quotation Mark
    $trans[chr(148)] = '&rdquo;';    // Right Double Quotation Mark
    $trans[chr(149)] = '&bull;';    // Bullet
    $trans[chr(150)] = '&ndash;';    // En Dash
    $trans[chr(151)] = '&mdash;';    // Em Dash
    $trans[chr(152)] = '&tilde;';    // Small Tilde
    $trans[chr(153)] = '&trade;';    // Trade Mark Sign
    $trans[chr(154)] = '&scaron;';    // Latin Small Letter S With Caron
    $trans[chr(155)] = '&rsaquo;';    // Single Right-Pointing Angle Quotation Mark
    $trans[chr(156)] = '&oelig;';    // Latin Small Ligature OE
    $trans[chr(159)] = '&Yuml;';    // Latin Capital Letter Y With Diaeresis
    $trans['euro'] = '&euro;';    // euro currency symbol
    ksort($trans);

    foreach ($trans as $k => $v) {
        $text = str_replace($v, $k, $text);
    }

    // 3) remove <p>, <br/> ...
    $text = strip_tags($text);

    // 4) &amp; => & &quot; => '
    $text = html_entity_decode($text);

    // 5) remove Windows-1252 symbols like "TradeMark", "Euro"...
    $text = preg_replace('/[^(\x20-\x7F)]*/','', $text);

    $targets=array('\r\n','\n','\r','\t');
    $results=array(" "," "," ","");
    $text = str_replace($targets,$results,$text);

    //XML compatible
    /*
    $text = str_replace("&", "and", $text);
    $text = str_replace("<", ".", $text);
    $text = str_replace(">", ".", $text);
    $text = str_replace("\\", "-", $text);
    $text = str_replace("/", "-", $text);
    */

    return ($text);
}


function set_tanggal_jam($time) {
  $bulan  = getBulan(date("m", $time));
  $hari   = getHari(date("l", $time));

  $tanggal = $hari.', '.date("j", $time).' '.$bulan.date(" Y | H:i", $time);
  return $tanggal;
}

function show_code($code) {
  echo "<pre>";
  print_r($code);
  die;
}

if ( ! function_exists('format_duit')) {
  function format_duit($duit, $space=false) {
    $rp = ($space)?"Rp. ":"Rp.";
    return $rp.number_format($duit,0,",",".")."";
  }
}

function liga_name($id){
  switch($id) {
    case 10 : return 'champions'; break;
    case 18 : return 'europa'; break;
    case 13 : return 'serie-a'; break;
    case 9  : return 'bundesliga'; break;
    case 16 : return 'ligue-1'; break;
    default : return 'bpl';
  }
}