<?php
$server = "http://192.168.2.205:9000";
     $headers = array( "Content-type: text/xml" ,"Content-length: ".strlen($strXML) ,"Connection: close" );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$server);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $strXML);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $server_output = curl_exec($ch);



    if(curl_errno($ch)){
        echo curl_error($ch);
        echo " $server  something went wrong..... try later ";
        if($_GET[counter]==$_GET[total])
        echo 'done###';
    }else{

        curl_close($ch);
    }
?>
