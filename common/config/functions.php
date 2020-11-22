<?php

function myDebug($arr, $die = false){
	echo '<pre>' . print_r($arr, true) . '</pre>';
	if ($die) die;
}
return [];

function clearPhone($mobile = '') {
	return str_replace(' ', '',
			str_replace('(', '',
				str_replace(')', '',
					str_replace('-', '', $mobile))));
}