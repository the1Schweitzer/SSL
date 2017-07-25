<?php
	echo json_encode(openssl_x509_parse($_POST['crt']));
?>