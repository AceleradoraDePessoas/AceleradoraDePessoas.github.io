<?php

$config = parse_ini_file(str_replace('//', '/', dirname(__FILE__) . '/') . '../config.ini');

/**
 * HybridAuth
 * http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
 * (c) 2009-2015, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
 */
// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

return
        array(
            "base_url" => "http://www.aceleradoradepessoas.com.br/auth/",
            "providers" => array(
                // openid providers
                "OpenID" => array(
                    "enabled" => false
                ),
                "Yahoo" => array(
                    "enabled" => false,
                    "keys" => array("key" => "", "secret" => ""),
                ),
                "AOL" => array(
                    "enabled" => false
                ),
                "Google" => array(
                    "enabled" => false,
                    "keys" => array("id" => $config['Google_ID'], "secret" => $config['Google_Secret']),
                ),
                "Facebook" => array(
                    "enabled" => true,
                    "keys" => array("id" => $config['FB_ID'], "secret" => $config['FB_Secret']),
                    "scope" => "email, public_profile, user_friends",
                    "trustForwarded" => false
                ),
                "Twitter" => array(
                    "enabled" => false,
                    "keys" => array("key" => "", "secret" => ""),
                    "includeEmail" => false
                ),
                // windows live
                "Live" => array(
                    "enabled" => false,
                    "keys" => array("id" => "", "secret" => "")
                ),
                "LinkedIn" => array(
                    "enabled" => false,
                    "keys" => array("key" => "", "secret" => "")
                ),
                "Foursquare" => array(
                    "enabled" => false,
                    "keys" => array("id" => "", "secret" => "")
                ),
            ),
            // If you want to enable logging, set 'debug_mode' to true.
            // You can also set it to
            // - "error" To log only error messages. Useful in production
            // - "info" To log info and error messages (ignore debug messages)
            "debug_mode" => false,
            // Path to file writable by the web server. Required if 'debug_mode' is not false
            "debug_file" => "",
);
