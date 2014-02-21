<?php

 class Anvrg7_Availability extends Anvrg7_Format {
	
	private $RootKey = 'AvailabilityRequest';
	
	public $requestType = 'AvailabilityRequest';
	public $responseType = 'AvailabilityResponse';
	
	public $packageID;
	public $numberOfAdults;
	public $numberOfChildren;
	public $numberOfBabies;
	public $departureDate;
	public $duration;
	
	public function buildTree()
	{
		if($this->packageID === null)
			throw new Anvrg7_Exception('packageID must be not empty');
		
		if($this->numberOfAdults === null)
			throw new Anvrg7_Exception('numberOfAdults must be not empty');
		
		if($this->numberOfChildren === null)
			throw new Anvrg7_Exception('numberOfChildren must be not empty');
		
		if($this->numberOfBabies === null)
			throw new Anvrg7_Exception('numberOfBabies must be not empty');
		
		if($this->departureDate === null)
			throw new Anvrg7_Exception('departureDate must be not empty');
		
		if($this->duration === null)
			throw new Anvrg7_Exception('duration must be not empty');
		
		
		return array(
			$this->RootKey => array(
				'PackageDetails' => array(
					'PackageID' => $this->packageID,
					'NumberOfAdults' => $this->numberOfAdults,
					'NumberOfChildren' => $this->numberOfChildren,
					'NumberOfBabies' => $this->numberOfBabies,
					'DepartureDate' => $this->departureDate,
					'Duration' => $this->duration,
				)
			)
		);
	}
	
 }