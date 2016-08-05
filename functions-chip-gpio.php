<?php

class chipGpio {

	//Base number
	private $baseNumber = 1016; 

	//Pin number offsets
	private $pinOffsets = array (
		
		//Standard GPIO Pins
		"XIO-P0" => 0,
		"XIO-P1" => 1,
		"XIO-P2" => 2,
		"XIO-P3" => 3,
		"XIO-P4" => 4,
		"XIO-P5" => 5,
		"XIO-P6" => 6,
		"XIO-P7" => 7,

		"PWM0" => 34,
		
		//LCD Pins (re-purposed as GPIO)
		"LCD-D2" => 98,
		"LCD-D3" => 99,
		"LCD-D4" => 100,
		"LCD-D5" => 101,
		"LCD-D6" => 102,
		"LCD-D7" => 103,
		"LCD-D10" => 106,
		"LCD-D11" => 107,
		"LCD-D12" => 108,
		"LCD-D13" => 109,
		"LCD-D14" => 110,
		"LCD-D15" => 111,
		"LCD-D18" => 114,
		"LCD-D19" => 115,
		"LCD-D20" => 116,
		"LCD-D21" => 117,
		"LCD-D22" => 118,
		"LCD-D23" => 119

	);
	
	//Array of pin objects
	public $pins = array();
	
	function log($msg){
		echo "chipGpio: ".$msg."\n";
	}
	
	
	function __construct($pins = array()){
		$this->log('Constructing...');
		
		foreach($pins as $p => $d){
			$this->activatePin($p, $d);
		};
		
	}
	
	function activatePin($pin, $inOut = "out", $activeLow = "0"){
		
		$pinPath = ($this->baseNumber + $this->pinOffsets[$pin]);
		$fullPath = '/sys/class/gpio/gpio'.$pinPath.'/';
		
		$this->log('Activating pin '.$pin.' ('.$pinPath.', '.$inOut.', '.$activeLow.') at '.$fullPath);
		
		//Export the pin
		@file_put_contents('/sys/class/gpio/export', $pinPath);
		
		
		if(file_exists($fullPath)){
		
			//Create the object
			$this->pins[$pin] = new gpioPin();
			
			//Populate the object
			$this->pins[$pin]->number = $pin;
			$this->pins[$pin]->pinPath = $pinPath;
			$this->pins[$pin]->fullPath = $fullPath;
			
			
			//Configure the pin
			$this->pins[$pin]->direction($inOut);
			$this->pins[$pin]->value("0");
			$this->pins[$pin]->activeLow($activeLow);
		
		}else{
			$this->log('Failed to activate pin '.$pin);
		};
		
	}
	
};

class gpioPin {
	
	public $number;
	public $pinPath;
	public $fullPath;
	public $debug = TRUE;
	
	function log($msg){
		echo "chipGpio: pin[".$this->number."]: ".$msg."\n";
	}
	
	function _setManager($file, $set = NULL){
		if(!is_null($set)){
			if($this->debug){$this->log('set '.$file.': '.$set);};
			@file_put_contents($this->fullPath.$file, $set);
			return false;
		}else{
			$val = trim(file_get_contents($this->fullPath.$file));
			if($this->debug){$this->log('get '.$file.': '.$val);};
			return $val;
		};
	}
	
	function value($set = NULL){
		return $this->_setManager('value', $set);
	}
	
	function direction($set = NULL){
		return $this->_setManager('direction', $set);
	}
	
	function activeLow($set = NULL){
		return $this->_setManager('active_low', $set);
	}
	
};

?>
