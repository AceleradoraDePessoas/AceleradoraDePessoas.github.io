<?php
 
/*
* get the user data from database by provider name and provider user id
**/

require_once('db.php');

function get_user_by_provider_and_id( $provider_name, $provider_user_id )
{

    $provider_name = db_quote($provider_name);
    $provider_user_id = db_quote($provider_user_id);
    
    return db_select_single_row( "SELECT * FROM users WHERE hybridauth_provider_name = $provider_name AND hybridauth_provider_uid = " );
}
 
/*
* get the user data from database by provider name and provider user id
**/
function create_new_hybridauth_user( $email, $first_name, $last_name, $provider_name, $provider_user_id )
{
	// let generate a random password for the user
	$password = md5( str_shuffle( "0123456789abcdefghijklmnoABCDEFGHIJ" ) );
        
        
        $email = db_quote($email);
        $first_name = db_quote($first_name);
        $last_name = db_quote($last_name);
        $provider_name = db_quote($provider_name);
        $provider_user_id = db_quote($provider_user_id);
	db_query(
		"INSERT INTO users
		(
			email,
			password,
			first_name,
			last_name,
			hybridauth_provider_name,
			hybridauth_provider_uid,
			created_at
		)
		VALUES
		(
			$email,
			'$password',
			$first_name,
			$last_name,
			$provider_name,
			$provider_user_id,
			NOW()
		)"
	);
}


if( isset( $_REQUEST["provider"] ) )
{
	// the selected provider
	$provider_name = $_REQUEST["provider"];
 
	try
	{
		// inlcude HybridAuth library
		// change the following paths if necessary
		$config   = dirname(__FILE__) . '/auth/config.php';
		require_once( "auth/Hybrid/Auth.php" );
 
		// initialize Hybrid_Auth class with the config file
		$hybridauth = new Hybrid_Auth( $config );
 
		// try to authenticate with the selected provider
		$adapter = $hybridauth->authenticate( $provider_name );
 
		// then grab the user profile
		$user_profile = $adapter->getUserProfile();
	}
 
	// something went wrong?
	catch( Exception $e )
	{
            
            
		die($e->getMessage());
	}
 
	// check if the current user already have authenticated using this provider before
	$user_exist = get_user_by_provider_and_id( $provider_name, $user_profile->identifier );
 
	// if the used didn't authenticate using the selected provider before
	// we create a new entry on database.users for him
	if( !$user_exist===false )
	{
		create_new_hybridauth_user(
			$user_profile->email,
			$user_profile->firstName,
			$user_profile->lastName,
			$provider_name,
			$user_profile->identifier
		);
	}
 
	// set the user as connected and redirect him
	$_SESSION["user_connected"] = true;
 	$_SESSION["provider"] = $provider_name;
 //	$_SESSION["user_profile"] = $user_profile;
 
	require "index.php";

        
 }