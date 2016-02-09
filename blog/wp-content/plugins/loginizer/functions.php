<?php

// Get the client IP
function lz_getip(){
	if(isset($_SERVER["REMOTE_ADDR"])){
		return $_SERVER["REMOTE_ADDR"];
	}elseif(isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
		return $_SERVER["HTTP_X_FORWARDED_FOR"];
	}elseif(isset($_SERVER["HTTP_CLIENT_IP"])){
		return $_SERVER["HTTP_CLIENT_IP"];
	}
}

// Execute a select query and return an array
function lz_selectquery($query, $array = 0){
	global $wpdb;
	
	$result = $wpdb->get_results($query, 'ARRAY_A');
	
	if(empty($array)){
		return current($result);
	}else{
		return $result;
	}
}

// Check if an IP is valid
function lz_valid_ip($ip){

	if(!ip2long($ip)){
		return false;
	}	
	return true;
}

// Check if a field is posted via POST else return default value
function lz_optpost($name, $default = ''){
	
	if(!empty($_POST[$name])){
		return lz_inputsec(lz_htmlizer(trim($_POST[$name])));
	}
	
	return $default;	
}

// Check if a field is posted via GET else return default value
function lz_optget($name, $default = ''){
	
	if(!empty($_GET[$name])){
		return lz_inputsec(lz_htmlizer(trim($_GET[$name])));
	}
	
	return $default;	
}

// Check if a field is posted via GET or POST else return default value
function lz_optreq($name, $default = ''){
	
	if(!empty($_REQUEST[$name])){
		return lz_inputsec(lz_htmlizer(trim($_REQUEST[$name])));
	}
	
	return $default;	
}

function lz_inputsec($string){

	if(!get_magic_quotes_gpc()){
	
		$string = addslashes($string);
	
	}else{
	
		$string = stripslashes($string);
		$string = addslashes($string);
	
	}
	
	// This is to replace ` which can cause the command to be executed in exec()
	$string = str_replace('`', '\`', $string);
	
	return $string;

}

function lz_htmlizer($string){

	$string = htmlentities($string, ENT_QUOTES, 'UTF-8');
	
	$string = preg_replace('/(&amp;#(\d{1,7}|x[0-9a-fA-F]{1,6});)/e', 'entity_check(\\2);', $string);
	
	return $string;
	
}

// Check if a checkbox is selected
function lz_is_checked($post){

	if(!empty($_POST[$post])){
		return true;
	}	
	return false;
}

// Reoort an error
function lz_report_error($error = array()){

	if(empty($error)){
		return true;
	}
	
	$error_string = '<b>Please fix the below error(s) :</b> <br />';
	
	foreach($error as $ek => $ev){
		$error_string .= '* '.$ev.'<br />';
	}
	
	echo '<div id="message" class="error"><p>'
					. __($error_string, 'loginizer')
					. '</p></div>';
}

// Report a notice
function lz_report_notice($notice = array()){

	global $wp_version;
	
	if(empty($notice)){
		return true;
	}
	
	// Which class do we have to use ?
	if(version_compare($wp_version, '3.8', '<')){
		$notice_class = 'updated';
	}else{
		$notice_class = 'updated';
	}
	
	$notice_string = '<b>Please check the below notice(s) :</b> <br />';
	
	foreach($notice as $ek => $ev){
		$notice_string .= '* '.$ev.'<br />';
	}
	
	echo '<div id="message" class="'.$notice_class.'"><p>'
					. __($notice_string, 'loginizer')
					. '</p></div>';
}

// Convert an objext to array
function lz_objectToArray($d){
	
	if(is_object($d)){
		$d = get_object_vars($d);
	}
	
	if(is_array($d)){
		return array_map(__FUNCTION__, $d); // recursive
	}elseif(is_object($d)){
		return lz_objectToArray($d);
	}else{
		return $d;
	}
}

// Sanitize variables
function lz_sanitize_variables($variables = array()){
	
	if(is_array($variables)){
		foreach($variables as $k => $v){
			$variables[$k] = trim($v);
			$variables[$k] = escapeshellcmd($v);
		}
	}else{
		$variables = escapeshellcmd(trim($variables));
	}
	
	return $variables;
}

// Is multisite ?
function lz_is_multisite() {
	
	if(function_exists('get_site_option') && function_exists('is_multisite') && is_multisite()){
		return true;
	}
	
	return false;
}

