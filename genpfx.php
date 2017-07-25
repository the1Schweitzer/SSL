<?php
$x509=$_POST['crt'];
$priv_key=$_POST['key'];
$x509info=openssl_x509_parse($x509);
try{
if (openssl_x509_check_private_key ( $x509 , $priv_key )){
openssl_pkcs12_export ($x509 , $pfx ,$priv_key , $_POST["password"]);
$url=base64_encode($pfx);

$pfxarray=array(
	"filename"=>date('mdy').$x509info['subject']['CN'].".pfx",
	"filetype"=>"application/x-pkcs12",
	"filecontent"=>$url,
"successful"=>true
);
echo json_encode($pfxarray);
}
}
catch(Exception $e)
  {
  
  }
?>