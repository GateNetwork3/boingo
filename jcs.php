<?php
date_default_timezone_set('Asia/Jakarta');
echo "Insert Your Url\nInput : ";
$url = trim(fgets(STDIN));
echo "Set Delay 2 sec = 2000000\nInput : ";
$delay = trim(fgets(STDIN));
echo "Masukkan Password\nInput : ";
$password = trim(fgets(STDIN));
 
if($password == date('i')){
    while(true){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: */*",
            "X-Requested-With: com.jollycorp.jollychic",
            "Accept-Language: id,en-US;q=0.9",
            "Host: h5server.jollychic.com"
        ));
        curl_setopt($ch, CURLOPT_USERAGENT, "User-Agent: Mozilla/5.0 (Linux; Android 5.1.1; ASUS_X014D Build/LMY47V; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/62.0.3202.84 Mobile Safari/537.36");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        list($header, $body) = explode("\r\n\r\n", $result, 2);
        if(strpos($body, "({\"message\":\"SUKSES\",\"messageCode\":\"0\",\"messageType\":0,\"result\":0,\"status\":0});")){
            echo "Message => Sukses, Status => True".PHP_EOL;
        }elseif(strpos($body, "({\"message\":\"Success\",\"messageCode\":\"0\",\"messageType\":0,\"result\":0,\"status\":0});")){
            echo "Message => Sukses, Status => True".PHP_EOL;
        }elseif(strpos($body, "({\"message\":\"SUCCESS\",\"messageCode\":\"0\",\"messageType\":0,\"result\":0,\"status\":0});")){
            echo "Message => Sukses, Status => True, ".PHP_EOL;
        }else{
            echo "Message => Fail, Status => False".PHP_EOL;
        }
        usleep($delay);
    }
}else{
    echo "oreoin ajah\n";
}
?>