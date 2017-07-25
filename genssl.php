<?php
error_reporting(0);
$dn = array(
    "countryName" => ($regen?$c:$_POST["country"]),
    "stateOrProvinceName" => ($regen?$st:$_POST["state"]),
    "localityName" => ($regen?$l:$_POST["locality"]),
    "organizationName" => ($regen?$o:$_POST["organization"]),
    "organizationalUnitName" => ($regen?"Security":$_POST["organizationalunit"]),
    "commonName" => ($regen?$cn:$_POST["commonname"]),
    "emailAddress" => ($regen?"support@hosting.com":$_POST["email"])
);
if($_POST["oldkey"]){
$privkey=openssl_pkey_get_private($_POST["oldkey"]);
}
// Generate a new private (and public) key pair
//$privkey = openssl_pkey_new();
//var_dump(openssl_pkey_get_details($privkey));
$configargs = array(
   'private_key_bits' => (int)$_POST["bits"]);

// Generate a certificate signing request
$csr = openssl_csr_new($dn, $privkey,$configargs);
openssl_csr_export($csr, $csrout);// and
$certinfo['csr']=$csrout;
openssl_pkey_export($privkey, $pkeyout);// and
$certinfo['key']=$pkeyout;
if($regen==NULL) echo json_encode($certinfo);
?>