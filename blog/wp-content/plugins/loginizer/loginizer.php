<?php
/**
 * @package loginizer
 * @version 1.0.1
 */
/*
Plugin Name: Loginizer
Plugin URI: http://wordpress.org/extend/plugins/loginizer/
Description: Loginizer is a WordPress plugin which helps you fight against bruteforce attack by blocking login for the IP after it reaches maximum retries allowed. You can blacklist or whitelist IPs for login using Loginizer.
Version: 1.0.1
Author: Raj Kothari
Author URI: http://www.loginizer.com
License: GPLv3 or later
*/

/*
Copyright (C) 2013  Raj Kothari (email : support@loginizer.com)
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

if(!function_exists('add_action')){
	echo 'You are not allowed to access this page directly.';
	exit;
}

define('LOGINIZER_VERSION', '1.0.1');

include_once('functions.php');

// Ok so we are now ready to go
register_activation_hook( __FILE__, 'loginizer_activation');

// Is called when the ADMIN enables the plugin
function loginizer_activation(){

	global $wpdb;

	$sql = array();
	
	$sql[] = "CREATE TABLE `".$wpdb->prefix."loginizer_logs` (
				`username` varchar(255) NOT NULL DEFAULT '',
				`time` int(10) NOT NULL DEFAULT '0',
				`count` int(10) NOT NULL DEFAULT '0',
				`lockout` int(10) NOT NULL DEFAULT '0',
				`ip` varchar(255) NOT NULL DEFAULT '',
				UNIQUE KEY `ip` (`ip`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8;";

	foreach($sql as $sk => $sv){
		$wpdb->query($sv);
	}
	
	add_option('loginizer_version', LOGINIZER_VERSION);
	add_option('loginizer_options', array());
	add_option('loginizer_last_reset', 0);
	add_option('loginizer_whitelist', array());
	add_option('loginizer_blacklist', array());

}

// Checks if we are to update ?
function loginizer_update_check(){

global $wpdb;

	$sql = array();
	$current_version = get_option('loginizer_version');
	
	// It must be the 1.0 pre stuff
	if(empty($current_version)){
		$current_version = get_option('lz_version');
	}
	
	$version = (int) str_replace('.', '', $current_version);
	
	// No update required
	if($current_version == LOGINIZER_VERSION){
		return true;
	}
	
	// Is it first run ?
	if(empty($current_version)){
		
		// Reinstall
		loginizer_activation();
		
		// Trick the following if conditions to not run
		$version = (int) str_replace('.', '', LOGINIZER_VERSION);
		
	}
	
	// Is it less than 1.0.1 ?
	if($version < 101){
		
		// TODO : GET the existing settings
	
		// Get the existing settings		
		$lz_failed_logs = lz_selectquery("SELECT * FROM `".$wpdb->prefix."lz_failed_logs`;", 1);
		$lz_options = lz_selectquery("SELECT * FROM `".$wpdb->prefix."lz_options`;", 1);
		$lz_iprange = lz_selectquery("SELECT * FROM `".$wpdb->prefix."lz_iprange`;", 1);
				
		// Delete the three tables
		$sql = array();
		$sql[] = "DROP TABLE IF EXISTS ".$wpdb->prefix."lz_failed_logs;";
		$sql[] = "DROP TABLE IF EXISTS ".$wpdb->prefix."lz_options;";
		$sql[] = "DROP TABLE IF EXISTS ".$wpdb->prefix."lz_iprange;";

		foreach($sql as $sk => $sv){
			$wpdb->query($sv);
		}
		
		// Delete option
		delete_option('lz_version');
	
		// Reinstall
		loginizer_activation();
	
		// TODO : Save the existing settings

		// Update the existing failed logs to new table
		if(is_array($lz_failed_logs)){
			foreach($lz_failed_logs as $fk => $fv){
				$wpdb->query("INSERT INTO ".$wpdb->prefix."loginizer_logs SET `username` = '".$fv['username']."', `time` = '".$fv['time']."', `count` = '".$fv['count']."', `lockout` = '".$fv['lockout']."', `ip` = '".$fv['ip']."';");
			}			
		}

		// Update the existing options to new structure
		if(is_array($lz_options)){
			foreach($lz_options as $ok => $ov){
				
				if($ov['option_name'] == 'lz_last_reset'){
					update_option('loginizer_last_reset', $ov['option_value']);
					continue;
				}
				
				$old_option[str_replace('lz_', '', $ov['option_name'])] = $ov['option_value'];
			}
			// Save the options
			update_option('loginizer_options', $old_option);	
		}

		// Update the existing iprange to new structure
		if(is_array($lz_iprange)){
			
			$old_blacklist = array();
			$old_whitelist = array();
			$bid = 1;
			$wid = 1;
			foreach($lz_iprange as $ik => $iv){
				
				if(!empty($iv['blacklist'])){
					$old_blacklist[$bid] = array();
					$old_blacklist[$bid]['start'] = long2ip($iv['start']);
					$old_blacklist[$bid]['end'] = long2ip($iv['end']);
					$old_blacklist[$bid]['time'] = strtotime($iv['date']);
					$bid = $bid + 1;
				}
				
				if(!empty($iv['whitelist'])){
					$old_whitelist[$wid] = array();
					$old_whitelist[$wid]['start'] = long2ip($iv['start']);
					$old_whitelist[$wid]['end'] = long2ip($iv['end']);
					$old_whitelist[$wid]['time'] = strtotime($iv['date']);
					$wid = $wid + 1;
				}
			}
			
			if(!empty($old_blacklist)) update_option('loginizer_blacklist', $old_blacklist);
			if(!empty($old_whitelist)) update_option('loginizer_whitelist', $old_whitelist);
		}
		
	}
	
	// Save the new Version
	update_option('loginizer_version', LOGINIZER_VERSION);
	
}

// Add the action to load the plugin 
add_action('plugins_loaded', 'loginizer_load_plugin');

// The function that will be called when the plugin is loaded
function loginizer_load_plugin(){
	
	global $loginizer;
	
	// Check if the installed version is outdated
	loginizer_update_check();
	
	$options = get_option('loginizer_options');
	
	$loginizer = array();
	$loginizer['max_retries'] = empty($options['max_retries']) ? 3 : $options['max_retries'];
	$loginizer['lockout_time'] = empty($options['lockout_time']) ? 900 : $options['lockout_time']; // 15 minutes
	$loginizer['max_lockouts'] = empty($options['max_lockouts']) ? 5 : $options['max_lockouts'];
	$loginizer['lockouts_extend'] = empty($options['lockouts_extend']) ? 86400 : $options['lockouts_extend']; // 24 hours
	$loginizer['reset_retries'] = empty($options['reset_retries']) ? 86400 : $options['reset_retries']; // 24 hours
	$loginizer['notify_email'] = empty($options['notify_email']) ? 0 : $options['notify_email'];
	
	$includes = get_included_files();
	if(basename($includes[0]) != 'wp-login.php'){
		return false;
	}
	
	// Load the blacklist and whitelist
	$loginizer['blacklist'] = get_option('loginizer_blacklist');
	$loginizer['whitelist'] = get_option('loginizer_whitelist');
	
	// When was the database cleared last time
	$loginizer_last_reset = get_option('loginizer_last_reset');
	
	//print_r($loginizer);
	
	// Clear retries
	if((time() - $loginizer_last_reset) >= $loginizer['reset_retries']){
		loginizer_reset_retries();
	}
	
	// Set the current IP
	$loginizer['current_ip'] = lz_getip();

	/* Filters and actions */
	
	// Use this to verify before WP tries to login
	// Is always called and is the first function to be called
	add_action('wp_authenticate', 'loginizer_wp_authenticate', 10, 2);
	
	// This is used for additional validation
	// This function is called after the form is posted
	add_filter('wp_authenticate_user', 'loginizer_wp_authenticate_user', 99999, 2);
	
	// Is called when a login attempt fails
	// Hence Update our records that the login failed
	add_action('wp_login_failed', 'loginizer_login_failed');
	
	// Is called before displaying the error message so that we dont show that the username is wrong or the password
	// Update Error message
	add_action('login_errors', 'loginizer_update_error_msg');

}

function loginizer_wp_authenticate($username, $password){
	
	global $lz_error, $lz_cannot_login, $lz_user_pass;
	
	if(!empty($username) && !empty($password)){	
		$lz_user_pass = 1;
	}
	
	// Are you whitelisted ?
	if(loginizer_is_whitelisted()){
		return $username;
	}
	
	// Are you blacklisted ?
	if(loginizer_is_blacklisted()){	
		$lz_cannot_login = 1;		
		$error = new WP_Error();
		$error->add('ip_blacklisted', implode('', $lz_error));
		return $error;
	}
	
	if(loginizer_can_login()){
		return $username;
	}
	
	$lz_cannot_login = 1;
	
	$error = new WP_Error();
	$error->add('ip_blocked', implode('', $lz_error));
	return $error;
	
}

function loginizer_can_login(){
	
	global $wpdb, $loginizer, $lz_error;
	
	// Get the logs
	$result = lz_selectquery("SELECT * FROM `".$wpdb->prefix."loginizer_logs` WHERE `ip` = '".$loginizer['current_ip']."';");
		
	if(!empty($result['count']) && $result['count'] >= $loginizer['max_retries']){
		
		// Has he reached max lockouts ?
		if($result['lockout'] >= $loginizer['max_lockouts']){
			$loginizer['lockout_time'] = $loginizer['lockouts_extend'];
		}
		
		// Is he in the lockout time ?
		if($result['time'] >= (time() - $loginizer['lockout_time'])){
			$banlift = ceil((($result['time'] + $loginizer['lockout_time']) - time()) / 60);
			
			//echo 'Current Time '.date('m/d/Y H:i:s', time()).'<br />';
			//echo 'Last attempt '.date('m/d/Y H:i:s', $result['time']).'<br />';
			//echo 'Unlock Time '.date('m/d/Y H:i:s', $result['time'] + $loginizer['lockout_time']).'<br />';
			
			$_time = $banlift.' minute(s)';
			
			if($banlift > 60){
				$banlift = ceil($banlift / 60);
				$_time = $banlift.' hour(s)';
			}
			
			$lz_error['ip_blocked'] = 'You have exceeded maximum login retries<br /> Please try after '.$_time;
			
			return false;
		}
	}
	
	// We need to add one as this is a failed attempt as well
	$result['count'] = $result['count'] + 1;
	
	if(!empty($result['count']) && $result['count'] <= $loginizer['max_retries']){
		$loginizer['retries_left'] = $loginizer['max_retries'] - $result['count'];
	}
	
	return true;
}

function loginizer_is_blacklisted(){
	
	global $wpdb, $loginizer, $lz_error;
	
	$blacklist = $loginizer['blacklist'];
			
	foreach($blacklist as $k => $v){
		
		// Is the IP in the blacklist ?
		if(ip2long($v['start']) <= ip2long($loginizer['current_ip']) && ip2long($loginizer['current_ip']) <= ip2long($v['end'])){
			$result = 1;
			break;
		}
		
	}
		
	// You are blacklisted
	if(!empty($result)){
		$lz_error['ip_blacklisted'] = 'Your IP has been blacklisted';
		return true;
	}
	
	return false;
	
}

function loginizer_is_whitelisted(){
	
	global $wpdb, $loginizer, $lz_error;
	
	$whitelist = $loginizer['whitelist'];
			
	foreach($whitelist as $k => $v){
		
		// Is the IP in the blacklist ?
		if(ip2long($v['start']) <= ip2long($loginizer['current_ip']) && ip2long($loginizer['current_ip']) <= ip2long($v['end'])){
			$result = 1;
			break;
		}
		
	}
		
	// You are whitelisted
	if(!empty($result)){
		return true;
	}
	
	return false;
	
}

// Returns an error if the users IP is blocked
function loginizer_wp_authenticate_user($user, $username){
	
	global $lz_error, $lz_cannot_login;
	
	// Is there a regulare error ?
	if(is_wp_error($user)){
		return $user;
	}
	
	// If we havent blocked it yet, just return $user
	if(empty($lz_cannot_login)){
		return $user;
	}
	
	// We have blocked the IP
	$error = new WP_Error();
	$error->add('ip_blocked', implode('', $lz_error));
	return $error;
	
}

// When the login fails, then this is called
// We need to update the database
function loginizer_login_failed($username){
	
	global $wpdb, $loginizer, $lz_cannot_login;
	
	if(empty($lz_cannot_login)){
		
		$result = lz_selectquery("SELECT * FROM `".$wpdb->prefix."loginizer_logs` WHERE `ip` = '".$loginizer['current_ip']."';");
		
		if(!empty($result)){
			$lockout = floor((($result['count']+1) / $loginizer['max_retries']));
			$sresult = $wpdb->query("UPDATE `".$wpdb->prefix."loginizer_logs` SET `username` = '".$username."', `time` = '".time()."', `count` = `count`+1, `lockout` = '".$lockout."' WHERE `ip` = '".$loginizer['current_ip']."';");
			
			// Do we need to email admin ?
			if(!empty($loginizer['notify_email']) && $lockout >= $loginizer['notify_email']){
				
				$sitename = lz_is_multisite() ? get_site_option('site_name') : get_option('blogname');
				$mail = array();
				$mail['to'] = lz_is_multisite() ? get_site_option('admin_email') : get_option('admin_email');	
				$mail['subject'] = 'Failed Login Attempts from IP '.$loginizer['current_ip'].' ('.$sitename.')';
				$mail['message'] = 'Hi,

'.($result['count']+1).' failed login attempts and '.$lockout.' lockout(s) from IP '.$loginizer['current_ip'].'

Last Login Attempt : '.date('d/m/Y H:i:s', time()).'
Last User Attempt : '.$username.'
IP has been blocked until : '.date('m/d/Y H:i:s', time() + $loginizer['lockout_time']).'

Regards,
Loginizer';

				@wp_mail($mail['to'], $mail['subject'], $mail['message']);
			}
		}else{
			$result = $wpdb->query("INSERT INTO `".$wpdb->prefix."loginizer_logs` SET `username` = '".$username."', `time` = '".time()."', `count` = '1', `ip` = '".$loginizer['current_ip']."', `lockout` = '0';");
		}
	}
}

// Modifies the default error messages shown
function loginizer_update_error_msg($default_msg){
	
	global $wpdb, $loginizer, $lz_user_pass, $lz_cannot_login;
	
	$msg = '';
	
	if(!empty($lz_user_pass) && empty($lz_cannot_login)){
		
		$msg = '<b>ERROR:</b> Incorrect Username or Password';
		
		// If we are to show the number of retries left
		if(isset($loginizer['retries_left'])){
			$msg .= '<br /><b>'.$loginizer['retries_left'].'</b> attempt(s) left';
		}
	}
	
	if(!empty($msg)){
		return $msg;
	}else{
		return $default_msg;
	}
	
}

function loginizer_reset_retries(){
	
	global $wpdb, $loginizer;
	
	$deltime = time() - $loginizer['reset_retries'];	
	$result = $wpdb->query("DELETE FROM `".$wpdb->prefix."loginizer_logs` WHERE `time` <= '".$deltime."';");
	
	update_option('loginizer_last_reset', time());
	
}

// Add settings link on plugin page
function loginizer_settings_link($links) { 
	$settings_link = '<a href="options-general.php?page=loginizer">Settings</a>'; 
	array_unshift($links, $settings_link); 
	return $links;
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'loginizer_settings_link' );

add_action('admin_menu', 'loginizer_admin_menu');

// Shows the admin menu of Loginizer
function loginizer_admin_menu() {
	global $wp_version;

	// Modern WP?
	if (version_compare($wp_version, '3.0', '>=')) {
	    add_options_page('Loginizer', 'Loginizer', 'manage_options', 'loginizer', 'loginizer_option_page');
	    return;
	}

	// Older WPMU?
	if (function_exists("get_current_site")) {
	    add_submenu_page('wpmu-admin.php', 'Loginizer', 'Loginizer', 9, 'loginizer', 'loginizer_option_page');
	    return;
	}

	// Older WP
	add_options_page('Loginizer', 'Loginizer', 9, 'loginizer', 'loginizer_option_page');
}

// The Loginizer Admin Options Page
function loginizer_option_page(){

	global $wpdb, $wp_roles, $loginizer;
	 
	if(!current_user_can('manage_options')){
		wp_die('Sorry, but you do not have permissions to change settings.');
	}

	/* Make sure post was from this page */
	if(count($_POST) > 0){
		check_admin_referer('loginizer-options');
	}
	
	// Load the blacklist and whitelist
	$loginizer['blacklist'] = get_option('loginizer_blacklist');
	$loginizer['whitelist'] = get_option('loginizer_whitelist');
	
	if(isset($_POST['save_lz'])){
		
		$max_retries = (int) lz_optpost('max_retries');
		$lockout_time = (int) lz_optpost('lockout_time');
		$max_lockouts = (int) lz_optpost('max_lockouts');
		$lockouts_extend = (int) lz_optpost('lockouts_extend');
		$reset_retries = (int) lz_optpost('reset_retries');
		$notify_email = (int) lz_optpost('notify_email');
		
		$lockout_time = $lockout_time * 60;
		$lockouts_extend = $lockouts_extend * 60 * 60;
		$reset_retries = $reset_retries * 60 * 60;
		
		if(empty($error)){
			
			$option['max_retries'] = $max_retries;
			$option['lockout_time'] = $lockout_time;
			$option['max_lockouts'] = $max_lockouts;
			$option['lockouts_extend'] = $lockouts_extend;
			$option['reset_retries'] = $reset_retries;
			$option['notify_email'] = $notify_email;
			
			// Save the options
			update_option('loginizer_options', $option);
			
			$saved = true;
			
		}else{
			lz_report_error($error);
		}
	
		if(!empty($notice)){
			lz_report_notice($notice);	
		}
			
		if(!empty($saved)){
			echo '<div id="message" class="updated fade"><p>'
				. __('The settings were saved successfully', 'loginizer')
				. '</p></div>';
		}
	
	}
	
	// Delete a Blackist IP range
	if(isset($_GET['bdelid'])){
		
		$delid = (int) lz_optreq('bdelid');
		
		// Unset and save
		$blacklist = $loginizer['blacklist'];
		unset($blacklist[$delid]);
		update_option('loginizer_blacklist', $blacklist);
		
		echo '<div id="message" class="updated fade"><p>'
			. __('The Blacklist IP range has been deleted successfully', 'loginizer')
			. '</p></div>';
			
	}
	
	// Delete a Whitelist IP range
	if(isset($_GET['delid'])){
		
		$delid = (int) lz_optreq('delid');
		
		// Unset and save
		$whitelist = $loginizer['whitelist'];
		unset($whitelist[$delid]);
		update_option('loginizer_whitelist', $whitelist);
		
		echo '<div id="message" class="updated fade"><p>'
			. __('The Whitelist IP range has been deleted successfully', 'loginizer')
			. '</p></div>';
			
	}
	
	if(isset($_POST['blacklist_iprange'])){

		$start_ip = lz_optpost('start_ip');
		$end_ip = lz_optpost('end_ip');
		
		if(empty($start_ip)){
			$error[] = 'Please enter the Start IP';
		}
		
		// If no end IP we consider only 1 IP
		if(empty($end_ip)){
			$end_ip = $start_ip;
		}
				
		if(!lz_valid_ip($start_ip)){
			$error[] = 'Please provide a valid start IP';
		}
		
		if(!lz_valid_ip($end_ip)){
			$error[] = 'Please provide a valid end IP';			
		}
			
		if(ip2long($start_ip) > ip2long($end_ip)){
			$error[] = 'The End IP cannot be smaller than the Start IP';
		}
		
		if(empty($error)){
			
			$blacklist = $loginizer['blacklist'];
			
			foreach($blacklist as $k => $v){
				
				// This is to check if there is any other range exists with the same Start or End IP
				if(( ip2long($start_ip) <= ip2long($v['start']) && ip2long($v['start']) <= ip2long($end_ip) )
					|| ( ip2long($start_ip) <= ip2long($v['end']) && ip2long($v['end']) <= ip2long($end_ip) )
				){
					$error[] = 'The Start IP or End IP submitted conflicts with an existing IP range !';
					break;
				}
				
				// This is to check if there is any other range exists with the same Start IP
				if(ip2long($v['start']) <= ip2long($start_ip) && ip2long($start_ip) <= ip2long($v['end'])){
					$error[] = 'The Start IP is present in an existing range !';
					break;
				}
				
				// This is to check if there is any other range exists with the same End IP
				if(ip2long($v['start']) <= ip2long($end_ip) && ip2long($end_ip) <= ip2long($v['end'])){
					$error[] = 'The End IP is present in an existing range!';
					break;
				}
				
			}
			
			$newid = ( empty($blacklist) ? 0 : max(array_keys($blacklist)) ) + 1;
		
			if(empty($error)){
				
				$blacklist[$newid] = array();
				$blacklist[$newid]['start'] = $start_ip;
				$blacklist[$newid]['end'] = $end_ip;
				$blacklist[$newid]['time'] = time();
				
				update_option('loginizer_blacklist', $blacklist);
				
				echo '<div id="message" class="updated fade"><p>'
						. __('Blacklist IP range added successfully', 'loginizer')
						. '</p></div>';
				
			}
			
		}
		
		if(!empty($error)){
			lz_report_error($error);			
		}
		
	}
	
	if(isset($_POST['whitelist_iprange'])){

		$start_ip = lz_optpost('start_ip_w');
		$end_ip = lz_optpost('end_ip_w');
		
		if(empty($start_ip)){
			$error[] = 'Please enter the Start IP';
		}
		
		// If no end IP we consider only 1 IP
		if(empty($end_ip)){
			$end_ip = $start_ip;
		}
				
		if(!lz_valid_ip($start_ip)){
			$error[] = 'Please provide a valid start IP';
		}
		
		if(!lz_valid_ip($end_ip)){
			$error[] = 'Please provide a valid end IP';			
		}
			
		if(ip2long($start_ip) > ip2long($end_ip)){
			$error[] = 'The End IP cannot be smaller than the Start IP';
		}
		
		if(empty($error)){
			
			$whitelist = $loginizer['whitelist'];
			
			foreach($whitelist as $k => $v){
				
				// This is to check if there is any other range exists with the same Start or End IP
				if(( ip2long($start_ip) <= ip2long($v['start']) && ip2long($v['start']) <= ip2long($end_ip) )
					|| ( ip2long($start_ip) <= ip2long($v['end']) && ip2long($v['end']) <= ip2long($end_ip) )
				){
					$error[] = 'The Start IP or End IP submitted conflicts with an existing IP range !';
					break;
				}
				
				// This is to check if there is any other range exists with the same Start IP
				if(ip2long($v['start']) <= ip2long($start_ip) && ip2long($start_ip) <= ip2long($v['end'])){
					$error[] = 'The Start IP is present in an existing range !';
					break;
				}
				
				// This is to check if there is any other range exists with the same End IP
				if(ip2long($v['start']) <= ip2long($end_ip) && ip2long($end_ip) <= ip2long($v['end'])){
					$error[] = 'The End IP is present in an existing range!';
					break;
				}
				
			}
			
			$newid = ( empty($whitelist) ? 0 : max(array_keys($whitelist)) ) + 1;
			
			if(empty($error)){
				
				$whitelist[$newid] = array();
				$whitelist[$newid]['start'] = $start_ip;
				$whitelist[$newid]['end'] = $end_ip;
				$whitelist[$newid]['time'] = time();
				
				update_option('loginizer_whitelist', $whitelist);
				
				echo '<div id="message" class="updated fade"><p>'
						. __('Whitelist IP range added successfully', 'loginizer')
						. '</p></div>';
				
			}
			
		}
		
		if(!empty($error)){
			lz_report_error($error);			
		}
	}
	
	// Get the logs
	$result = array();
	$result = lz_selectquery("SELECT * FROM `".$wpdb->prefix."loginizer_logs` ORDER BY `count` DESC LIMIT 0, 10;", 1);
	//print_r($result);
	
	// Reload the settings
	$loginizer['blacklist'] = get_option('loginizer_blacklist');
	$loginizer['whitelist'] = get_option('loginizer_whitelist');
	
	?>
<div class="wrap">
    	<!--This is intentional-->
	<h2></h2>
	
	<h1><center><?php echo __('Loginizer','loginizer'); ?></center></h1><hr /><br />
     
	<script src="http://api.loginizer.com/news.js""></script>
	
	<h2><?php echo __('Failed Login Attempts Logs &nbsp; (Past '.($loginizer['reset_retries']/60/60).' hours)','loginizer'); ?></h2><hr /><br />
	
	<table class="wp-list-table widefat fixed users" border="0">
		<tr>
			<th scope="row" valign="top" style="background:#EFEFEF;"><?php echo __('IP','loginizer'); ?></th>
			<th scope="row" valign="top" style="background:#EFEFEF;"><?php echo __('Last Failed Attempt  (DD/MM/YYYY)','loginizer'); ?></th>
			<th scope="row" valign="top" style="background:#EFEFEF;"><?php echo __('Failed Attempts Count','loginizer'); ?></th>
			<th scope="row" valign="top" style="background:#EFEFEF;"><?php echo __('Lockouts Count','loginizer'); ?></th>
		</tr>
		<?php
			if(empty($result)){
				echo '
				<tr>
					<td colspan="4">
						No Logs. You will see logs about failed login attempts here.
					</td>
				</tr>';
			}else{
				foreach($result as $ik => $iv){
					$status_button = (!empty($iv['status']) ? 'disable' : 'enable');
					echo '
					<tr>
						<td>
							'.$iv['ip'].'
						</td>
						<td>
							'.date('d/m/Y H:i:s', $iv['time']).'
						</td>
						<td>
							'.$iv['count'].'
						</td>
						<td>
							'.$iv['lockout'].'
						</td>
					</tr>';
				}
			}
		?>
	</table>
	<br />
	<h2><?php echo __('Loginizer Settings','loginizer'); ?></h2><hr /><br />

	<form action="options-general.php?page=loginizer" method="post" enctype="multipart/form-data">
	<?php wp_nonce_field('loginizer-options'); ?>
	<table class="form-table">
		<tr>
			<th scope="row" valign="top"><label for="max_retries"><?php echo __('Max Retries','loginizer'); ?></label></th>
			<td>
				<input type="text" size="3" value="<?php echo lz_optpost('max_retries', $loginizer['max_retries']); ?>" name="max_retries" id="max_retries" /> <?php echo __('Maximum failed attempts allowed before lockout','loginizer'); ?> <br />
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><label for="lockout_time"><?php echo __('Lockout Time','loginizer'); ?></label></th>
			<td>
			<input type="text" size="3" value="<?php echo (!empty($lockout_time) ? $lockout_time : $loginizer['lockout_time']) / 60; ?>" name="lockout_time" id="lockout_time" /> <?php echo __('minutes','loginizer'); ?> <br />
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><label for="max_lockouts"><?php echo __('Max Lockouts','loginizer'); ?></label></th>
			<td>
				<input type="text" size="3" value="<?php echo lz_optpost('max_lockouts', $loginizer['max_lockouts']); ?>" name="max_lockouts" id="max_lockouts" /> <?php echo __('','loginizer'); ?> <br />
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><label for="lockouts_extend"><?php echo __('Extend Lockout','loginizer'); ?></label></th>
			<td>
				<input type="text" size="3" value="<?php echo (!empty($lockouts_extend) ? $lockouts_extend : $loginizer['lockouts_extend']) / 60 / 60; ?>" name="lockouts_extend" id="lockouts_extend" /> <?php echo __('hours. Extend Lockout time after Max Lockouts','loginizer'); ?> <br />
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><label for="reset_retries"><?php echo __('Reset Retries','loginizer'); ?></label></th>
			<td>
				<input type="text" size="3" value="<?php echo (!empty($reset_retries) ? $reset_retries : $loginizer['reset_retries']) / 60 / 60; ?>" name="reset_retries" id="reset_retries" /> <?php echo __('hours','loginizer'); ?> <br />
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><label for="notify_email"><?php echo __('Email Notification','loginizer'); ?></label></th>
			<td>
				<?php echo __('after ','loginizer'); ?>
				<input type="text" size="3" value="<?php echo (!empty($notify_email) ? $notify_email : $loginizer['notify_email']); ?>" name="notify_email" id="notify_email" /> <?php echo __('lockouts <br />0 to disable email notifications','loginizer'); ?>
			</td>
		</tr>
	</table><br />
	<input name="save_lz" class="button action" value="<?php echo __('Save Settings','loginizer'); ?>" type="submit" />		
	</form>
            
	<br /><br />
	<hr />      
	<h2><?php echo __('Blacklist IP','loginizer'); ?></h2>
	<?php echo __('Enter the IP you want to blacklist from login','loginizer'); ?>
	<form action="options-general.php?page=loginizer" method="post">
	<?php wp_nonce_field('loginizer-options'); ?>
	<table class="form-table">
		<tr>
			<th scope="row" valign="top"><label for="start_ip"><?php echo __('Start IP','loginizer'); ?></label></th>
			<td>
				<input type="text" size="25" value="<?php echo(lz_optpost('start_ip')); ?>" name="start_ip" id="start_ip"/> <?php echo __('Start IP of the range','loginizer'); ?> <br />
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><label for="end_ip"><?php echo __('End IP (Optional)','loginizer'); ?></label></th>
			<td>
				<input type="text" size="25" value="<?php echo(lz_optpost('end_ip')); ?>" name="end_ip" id="end_ip"/> <?php echo __('End IP of the range. <br />If you want to blacklist single IP leave this field blank.','loginizer'); ?> <br />
			</td>
		</tr>
	</table><br />
	<input name="blacklist_iprange" class="button action" value="<?php echo __('Blacklist IP range','loginizer'); ?>" type="submit" />		
	</form>
	<br />
	<table class="wp-list-table widefat fixed users" border="0">
		<tr>
			<th scope="row" valign="top" style="background:#EFEFEF;"><?php echo __('Start IP','loginizer'); ?></th>
			<th scope="row" valign="top" style="background:#EFEFEF;"><?php echo __('End IP','loginizer'); ?></th>
			<th scope="row" valign="top" style="background:#EFEFEF;"><?php echo __('Date (DD/MM/YYYY)','loginizer'); ?></th>
			<th scope="row" valign="top" style="background:#EFEFEF;"><?php echo __('Options','loginizer'); ?></th>
		</tr>
		<?php
			if(empty($loginizer['blacklist'])){
				echo '
				<tr>
					<td colspan="4">
						No Blacklist IPs. You will see blacklisted IP ranges here.
					</td>
				</tr>';
			}else{
				foreach($loginizer['blacklist'] as $ik => $iv){
					echo '
					<tr>
						<td>
							'.$iv['start'].'
						</td>
						<td>
							'.$iv['end'].'
						</td>
						<td>
							'.date('d/m/Y', $iv['time']).'
						</td>
						<td>
							<a class="submitdelete" href="options-general.php?page=loginizer&bdelid='.$ik.'" onclick="return confirm(\'Are you sure you want to delete this IP range ?\')">Delete</a>
						</td>
					</tr>';
				}
			}
		?>
	</table>
	<br />
	<hr />      
	<h2><?php echo __('Whitelist IP','loginizer'); ?></h2>
	<?php echo __('Enter the IP you want to whitelist for login','loginizer'); ?>
	<form action="options-general.php?page=loginizer" method="post">
	<?php wp_nonce_field('loginizer-options'); ?>
	<table class="form-table">
		<tr>
			<th scope="row" valign="top"><label for="start_ip_w"><?php echo __('Start IP','loginizer'); ?></label></th>
			<td>
				<input type="text" size="25" value="<?php echo(lz_optpost('start_ip_w')); ?>" name="start_ip_w" id="start_ip_w"/> <?php echo __('Start IP of the range','loginizer'); ?> <br />
			</td>
		</tr>
		<tr>
			<th scope="row" valign="top"><label for="end_ip_w"><?php echo __('End IP (Optional)','loginizer'); ?></label></th>
			<td>
				<input type="text" size="25" value="<?php echo(lz_optpost('end_ip_w')); ?>" name="end_ip_w" id="end_ip_w"/> <?php echo __('End IP of the range. <br />If you want to whitelist single IP leave this field blank.','loginizer'); ?> <br />
			</td>
		</tr>
	</table><br />
	<input name="whitelist_iprange" class="button action" value="<?php echo __('Whitelist IP range','loginizer'); ?>" type="submit" />
	</form>
	<br />
	<table class="wp-list-table widefat fixed users" border="0">
	<tr>
		<th scope="row" valign="top" style="background:#EFEFEF;"><?php echo __('Start IP','loginizer'); ?></th>
		<th scope="row" valign="top" style="background:#EFEFEF;"><?php echo __('End IP','loginizer'); ?></th>
		<th scope="row" valign="top" style="background:#EFEFEF;"><?php echo __('Date (DD/MM/YYYY)','loginizer'); ?></th>
		<th scope="row" valign="top" style="background:#EFEFEF;"><?php echo __('Options','loginizer'); ?></th>
	</tr>
	<?php
		if(empty($loginizer['whitelist'])){
			echo '
			<tr>
				<td colspan="4">
					No Whitelist IPs. You will see whitelisted IP ranges here.
				</td>
			</tr>';
		}else{
			foreach($loginizer['whitelist'] as $ik => $iv){
				echo '
				<tr>
					<td>
						'.$iv['start'].'
					</td>
					<td>
						'.$iv['end'].'
					</td>
					<td>
						'.date('d/m/Y', $iv['time']).'
					</td>
					<td>
						<a class="submitdelete" href="options-general.php?page=loginizer&delid='.$ik.'" onclick="return confirm(\'Are you sure you want to delete this IP range ?\')">Delete</a>
					</td>
				</tr>';
			}
		}
	?>
	</table>
	<br />
</div>
	<?php
	
	echo '<br /><br /><hr />
	<a href="http://www.loginizer.com" target="_blank">Loginizer</a> v'.LOGINIZER_VERSION.' <br />
	You can report any bugs <a href="http://wordpress.org/support/plugin/loginizer" target="_blank">here</a>.';
	
}	

// Sorry to see you going
register_uninstall_hook( __FILE__, 'loginizer_deactivation');

function loginizer_deactivation(){

global $wpdb;

	$sql = array();
	$sql[] = "DROP TABLE ".$wpdb->prefix."loginizer_logs;";

	foreach($sql as $sk => $sv){
		$wpdb->query($sv);
	}

	delete_option('loginizer_version');
	delete_option('loginizer_options');
	delete_option('loginizer_last_reset');
	delete_option('loginizer_whitelist');
	delete_option('loginizer_blacklist');

}

