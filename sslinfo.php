<?php
try{
$get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE,"capture_peer_cert_chain" => TRUE)));
$read = stream_socket_client("ssl://".htmlspecialchars($_GET["url"]).":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
if(!$read){
echo "Could Not Find Certificate:".htmlspecialchars($_GET["url"]);
}else{
error_reporting(0);
//print_r($read);
//echo "<br /><br />";
$cert = stream_context_get_options($read);
$my509=openssl_x509_parse($cert["ssl"]["peer_certificate"]);
/*
print_r($cert);
echo "<br /><br />";
print_r($my509);
echo "<br /><br />";
print_r($cert["ssl"]["peer_certificate_chain"]);
echo "<br /><br />";
*/
$subject=$my509["subject"];
$cn=$certinfo['commonName']=$subject["CN"];
$l=$certinfo['locality']=$subject["L"];
$st=$certinfo['state']=$subject["ST"];
$c=$certinfo['country']=$subject["C"];
$o=$certinfo['organization']=$subject["O"];
$certinfo['ip'] = gethostbyname($_GET["url"]);
$certinfo['date']=date('F j, Y', $my509["validTo_time_t"]);
if($regen=$_GET["regen"]) include 'genssl.php';
echo json_encode($certinfo);
}
}catch(Exception $e){
echo "Error: Could Not Find Certificate.";
}



?>