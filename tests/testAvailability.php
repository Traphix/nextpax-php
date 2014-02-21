<?php
 require('../autoload.php');
 
 // Create new Availability object
 $Object = new Anvrg7_Availability();
 
 $Object->packageID = '71941607137';
 $Object->numberOfAdults = '2';
 $Object->numberOfChildren = '0';
 $Object->numberOfBabies = '0';
 $Object->departureDate = '2014-07-13';
 $Object->duration = '7';
 
 $Nextpax = new Nextpax_Request('mySessionId01', 'hisSessionId01');
 if($Nextpax->makeRequest($Object))
 {
	 echo 'Connection is working.';
 } else {
	 echo 'Error: Got not the response we wanted.';
 }
?>