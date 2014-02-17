<?php

 class Nextpax_Request {
	
	public function testClient()
	{
		$Response = $this->doRequest('/', '');
		
		if($Response->TResponse->Messages->Date == date('Y-m-d'))
			return true;
		else
			return false;
	}
	
	public function doRequest($Url, $sXMLRequest = false)
	{
		$Curl = curl_init(Nextpax_Config::XMLHOST.$Url);
		
		curl_setopt($Curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($Curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($Curl, CURLOPT_POST, 1);
		curl_setopt($Curl, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($Curl, CURLOPT_TIMEOUT, 120);
		
		if($sXMLRequest !== false)
		{
			// Set the XML request data.
			curl_setopt($Curl, CURLOPT_POSTFIELDS, $sXMLRequest);
		}
			
		// Execute the request.
		$sXMLResponse = curl_exec($Curl);
		
		if ($sXMLResponse == '') {
			$Curl = curl_init(Nextpax_Config::XMLHOST_BACKUP.$Url);
			curl_setopt($Curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($Curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($Curl, CURLOPT_POST, 1);
			
			if($sXMLRequest !== false)
			{
				curl_setopt($Curl, CURLOPT_POSTFIELDS, $sXMLRequest);
			}
			
			$sXMLResponse = curl_exec($Curl);
		}
		// Close the connection.
		curl_close($Curl);
		
		return simplexml_load_string($sXMLResponse);
	}
	
 }