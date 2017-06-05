<?php
////Define Function
function bar128($text) {						// Part 1, make list of widths
  $char128asc=' !"#$%&\'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}~';					
	$char128wid = array(
		'212222','222122','222221','121223','121322','131222','122213','122312','132212','221213', // 0-9 
		'221312','231212','112232','122132','122231','113222','123122','123221','223211','221132', // 10-19 
		'221231','213212','223112','312131','311222','321122','321221','312212','322112','322211', // 20-29 			
		'212123','212321','232121','111323','131123','131321','112313','132113','132311','211313', // 30-39 
		'231113','231311','112133','112331','132131','113123','113321','133121','313121','211331', // 40-49 
		'231131','213113','213311','213131','311123','311321','331121','312113','312311','332111', // 50-59 
		'314111','221411','431111','111224','111422','121124','121421','141122','141221','112214', // 60-69 
		'112412','122114','122411','142112','142211','241211','221114','413111','241112','134111', // 70-79 
		'111242','121142','121241','114212','124112','124211','411212','421112','421211','212141', // 80-89 
		'214121','412121','111143','111341','131141','114113','114311','411113','411311','113141', // 90-99
		'114131','311141','411131','211412','211214','211232','23311120'   );	
  $w = $char128wid[$sum = 104];							// START symbol
  $onChar=1;
  for($x=0;$x<strlen($text);$x++)								// GO THRU TEXT GET LETTERS
    if (!( ($pos = strpos($char128asc,$text[$x])) === false )){	// SKIP NOT FOUND CHARS
	  $w.= $char128wid[$pos];
	  $sum += $onChar++ * $pos;
	}					
  $w.= $char128wid[ $sum % 103 ].$char128wid[106];  		//Check Code, then END
	$pn=0;
	for($x=0;$x<strlen($w);$x+=2) 
	{
		$pn+=$w[$x];
	} 					 		
	 					 						//Part 2, Write rows
  //$html="<table cellpadding=0 cellspacing=0 ><tr>";				
  $html="<div style=\"padding-left:0px;margin:0 auto;text-align:center;width:".($pn*2)."px;\">";				
  

  
  for($x=0;$x<strlen($w);$x+=2)   						// code 128 widths: black border, then white space
	$html .= "<div class=\"b128\" style=\"float:left;border-left-width:{$w[$x]}px;width:{$w[$x+1]}px !important\"></div>";	
  return "$html<div style='width:".($pn*2)."px;margin-left:-10px;float:left;text-align:center' id='a2'><font family=arial size=2><b>$text</b></font></div></div>";		
  //return "$html";		
}

function encrypt_decrypt($action, $string) {
    $output = false;

    $encrypt_method = "AES-256-CBC";
    $secret_key = '!!qutubulamin.org!! key';
    $secret_iv = '!!qutubulamin.org!! iv';

    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();
    
    foreach($array as $val) {
        if (!in_array($val->$key, $key_array)) {
            $key_array[$i] = $val->$key;
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}

?>
