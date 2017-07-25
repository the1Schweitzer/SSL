<?php
	echo json_encode(openssl_csr_get_subject($_POST["csr"]));
?>