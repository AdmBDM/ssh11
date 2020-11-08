<?php

function myDebug($arr, $die = false){
	echo '<pre>' . print_r($arr, true) . '</pre>';
	if ($die) die;
}
return [];