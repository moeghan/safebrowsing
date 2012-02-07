<?php
/**
 * The base configurations of the Noobita.
 * @package Noobita
 */
 
//name of your site
define('SITE_NAME','go');

//description of your site
define('SITE_DESC','hide referrer &amp; link anonymously');

//Redirection time, in seconds
define('REDIR', 25);

//change this to your own theme if you like
define('THEME','safebrowsing');


//stop editing here
/** Define ABSPATH as this files directory */
define( 'ABSPATH', dirname(__FILE__) . '/' );
?>