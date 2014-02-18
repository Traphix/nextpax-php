<?php

 class Nextpax_Xml {
	
	public $Message;
	
	public function __construct($SessionId, $ServerSessionId)
	{
		$ControlMessage = array (
			$SessionId => 'SenderSessionID',
			$ServerSessionId => 'ReceiverSessionID',
			date('Y-m-d') => 'Date',
			date('H:i:s') => 'Time',
			'1' => 'MessageSequence',
			Nextpax_Config::NEXTPAX_ID => 'SenderID',
			'NPS001' => 'ReceiverID',
			'' => 'RequestID',
			'' => 'ResponseID',
		);
		
		$xml = new SimpleXMLElement('<TravelMessage xmlns:xsi="http://www.w3.org/2001/XMLSchemainstance" VersionID="1.8N" xsi:noNamespaceSchemaLocation="..\travmessage_v1.8N.xsd"><Control Language="NL" Test="ja"/><TRequest/></TravelMessage>');
		
		array_walk_recursive($ControlMessage, array ($xml->Control, 'addChild'));
		
		$this->Message = $xml;
	}
	
	public function insertXml($Array)
	{
		array_walk_recursive($Array, array ($xml->TRequest, 'addChild'));
		
		$this->Message = $xml;
	}
	
	public function __toString()
	{
		return $this->Message->asXML();
	}
	
 }