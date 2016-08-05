#!/usr/bin/php
<?php

require_once('functions-chip-gpio.php');


$gpio = new chipGpio();

$gpio->activatePin('XIO-P0', 'out', 1);


$i = 1;

//$gpio->pins['XIO-P0']->debug = FALSE;

while(true){

	if($i == 0){$i = 1;}else{$i = 0;}
	$gpio->pins['XIO-P0']->value($i);
	sleep(1);
	
};


?>
