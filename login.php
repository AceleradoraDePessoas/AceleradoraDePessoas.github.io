<?php
           $config = dirname(__FILE__) . '/auth/config.php';
           require_once( dirname(__FILE__) . "/auth/Hybrid/Auth.php" );
           require_once("db.php");
           
 
           
           try{
               $hybridauth = new Hybrid_Auth( $config );
 
               $facebook = $hybridauth->authenticate( "Facebook" );
 
               $user_profile = $facebook->getUserProfile();
                
              // $facebook->setUserStatus( "Hello world!" );
               
               $email=  db_quote($user_profile->email);
               
               $user_bd = db_select_single_row("SELECT * FROM `Logins` WHERE `email`=$email;");
 
               if (empty($user_bd)) {
                   
                   $fbID=  db_quote($user_profile->identifier);
                   $sql= "INSERT INTO `Logins`(`email`, `facebookID`, `admin`) VALUES ( $email , $fbID ,false);";
                   db_query($sql);
               }
               
               
               $user_contacts = $facebook->getUserContacts();
           }
           catch( Exception $e ){
               echo "Ooophs, we got an error: " . $e->getMessage();
           }
           
           ?><pre>
           
<?php print_r($user_profile); ?>
           
           </pre>

<pre>
           
<?php print_r($user_contacts); ?>
           
           </pre>

