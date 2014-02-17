<?php
 require('../autoload.php');
 
 $Nextpax = new Nextpax_Request();
 if($Nextpax->testClient())
 {
	 echo 'Connection is working.';
 } else {
	 echo 'Error: Got not the response we wanted.';
 }
?>