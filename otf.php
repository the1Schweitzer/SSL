<?php //Generate text file on the fly

   header("Content-type: ".$_POST["filetype"]);
   header("Content-Disposition: attachment; filename=".$_POST["filename"]);
   //$content="Text file on the flt";
   echo (base64_decode($_POST["filecontent"]));
   
?>