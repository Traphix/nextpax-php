<?php

 class Nextpax_Xml {
	
	public $Message;
	
	public function __construct($SessionId, $ServerSessionId)
	{
		$ControlMessage = array (
			'SenderSessionID' => $SessionId,
			'ReceiverSessionID' => $ServerSessionId,
			'Date' => date('Y-m-d'),
			'Time' => date('H:i:s'),
			'MessageSequence' => '1',
			'SenderID' => Nextpax_Config::NEXTPAX_ID,
			'ReceiverID' => 'NPS001',
		);
		
		$xml = new SimpleXMLElement('<TravelMessage VersionID="1.8N"><Control Language="NL" Test="ja"/><TRequest/></TravelMessage>');
		
		foreach($ControlMessage AS $Key => $Value)
		{
			$xml->Control->addChild($Key, $Value);
		}
		
		$this->Message = $xml;
	}
	
	public function insertXml($Array, $RequestID, $ResponseID)
	{
		$xml = $this->Message;
		
		// Build xml for request
		$this->addArrayToXml($xml->TRequest, $Array);
		
		// Set request type
		$xml->Control->addChild('RequestID', $RequestID);
		$xml->Control->addChild('ResponseID', $ResponseID);
		
		//array_walk_recursive($Array, array ($xml->TRequest, 'addChild'));
		
		$this->Message = $xml;
	}
	
	public function __toString()
	{
		return $this->Message->asXML();
	}
	
	private function addArrayToXml($XmlObj, $Array)
	{
		if($XmlObj === null)
		{
			//$XmlObj = new SimpleXMLElement('<key/>');
		}
		
		foreach($Array AS $Key => $Value)
		{
			if(!is_array($Value))
				$XmlObj->addChild($Key, $Value);
			else {
				$Node = $XmlObj->addChild($Key);
				$this->addArrayToXml($Node, $Value);
			}
		}
		
		return $XmlObj;
	}
	
 }