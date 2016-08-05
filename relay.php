#!/bin/php5
<?php

require_once('functions-chip-gpio.php');


$gpio = new chipGpio();

$gpio->activatePin('XIO-P0', 'in', 1);
$gpio->activatePin('XIO-P4', 'out', 1);

$i = 1;

$gpio->pins['XIO-P0']->debug = FALSE;

while(true){
	$bval = $gpio->pins['XIO-P0']->value();
		
	if($bval > 0){
		if($i == 0){$i = 1;}else{$i = 0;}
		$gpio->pins['XIO-P4']->value($i);
		usleep(500000);
	};
	
	usleep(100000);
	
};


?>
