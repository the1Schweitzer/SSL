<?php
$x509=$_POST['crt'];
$priv_key=$_POST['key'];
try{
if (openssl_x509_check_private_key ( $x509 , $priv_key )){
echo "Success";
}else{
echo "Failure";
}
}
catch(Exception $e)
  {
  
  }
?>