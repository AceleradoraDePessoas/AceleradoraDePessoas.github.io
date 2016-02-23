<?php


           $config = dirname(__FILE__) . '/auth/config.php';
           require_once( dirname(__FILE__) . "/auth/Hybrid/Auth.php" );
           
           
           try{
               $hybridauth = new Hybrid_Auth( $config );
 
              $hybridauth->logoutAllProviders();
              
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

