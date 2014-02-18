<?php

 class Nextpax_Request {
 	
 	private $sessionId;
 	private $serverSessionId;
 	
 	public function __construct($SessionId, $ServerSessionId)
 	{
	 	$this->sessionId = $SessionId;
	 	$this->serverSessionId = $ServerSessionId;
 	}
	
	public function testClient($Mgs = false)
	{
		$Response = $this->doRequest($Mgs);
		
		if($Response->TResponse->Messages->Date == date('Y-m-d'))
			return true;
		else
			return false;
	}
	
	public function doRequest($sXMLRequest = false)
	{
		if($sXMLRequest === false OR empty($sXMLRequest))
		{
			$sXMLRequest = new Nextpax_Xml($this->sessionId, $this->serverSessionId);
		}
		
		$Curl = curl_init(Nextpax_Config::XMLHOST);
		
		curl_setopt($Curl, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($Curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($Curl, CURLOPT_POST, 1);
		curl_setopt($Curl, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($Curl, CURLOPT_TIMEOUT, 120);
		
		if($sXMLRequest !== false)
		{
			// Set the XML request data.
			curl_setopt($Curl, CURLOPT_POSTFIELDS, (string) $sXMLRequest);
		}
			
		// Execute the request.
		$sXMLResponse = curl_exec($Curl);
		
		if ($sXMLResponse == '') {
			$Curl = curl_init(Nextpax_Config::XMLHOST_BACKUP);
			curl_setopt($Curl, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($Curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($Curl, CURLOPT_POST, 1);
			
			if($sXMLRequest !== false)
			{
				curl_setopt($Curl, CURLOPT_POSTFIELDS, (string) $sXMLRequest);
			}
			
			$sXMLResponse = curl_exec($Curl);
		}
		// Close the connection.
		curl_close($Curl);
		echo $sXMLResponse;
		return simplexml_load_string($sXMLResponse);
	}
	
 }