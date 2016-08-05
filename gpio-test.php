#!/bin/php5
<?php

require_once('functions-chip-gpio.php');


$gpio = new chipGpio();

$gpio->activatePin('XIO-P1', 'out', 1);
$gpio->activatePin('XIO-P2', 'out', 1);
$gpio->activatePin('XIO-P3', 'out', 1);


$i = 1;
$n = 1;

$gpio->pins['XIO-P0']->debug = FALSE;

while(true){
	//$bval = $gpio->pins['XIO-P0']->value();
	
	//echo $bval;
	$bval = 1;
	
	if($bval > 0){
		//if($i == 0){$i = 1;}else{$i = 0;}
		$gpio->pins['XIO-P1']->value(1);
		usleep(100000);
		$gpio->pins['XIO-P1']->value(0);
		$gpio->pins['XIO-P2']->value(1);
		usleep(100000);
		$gpio->pins['XIO-P2']->value(0);
		$gpio->pins['XIO-P3']->value(1);
		usleep(100000);
		$gpio->pins['XIO-P3']->value(0);

		file_put_contents('/dev/ttyS0', 'Blinkenlights~Numer: '.$n."\n");
		$n++;
	};
	
	usleep(10000);
	
};


?>
