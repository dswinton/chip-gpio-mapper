#!/usr/bin/php5
<?php

$gpio = $argv[1];

$gpioFile = '/gpio/xio-p'.$gpio.'/value';

$value = 0;
while(true){
	if($value == 0){$value = 1;}else{$value = 0;};
	file_put_contents($gpioFile, $value);
	//echo 'Setting GPIO '.$gpio.' to: '.$value."\n";
	usleep(40000);
};


?>
