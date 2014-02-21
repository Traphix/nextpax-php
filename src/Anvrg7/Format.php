<?php

 class Anvrg7_Format {
	
	private $RootKey;
	
	public $requestType;
	public $responseType;
	
	public function as_array(){
		return $this->buildTree();
	}
	
	public function buildTree()
	{
		return null;
	}
	
 }