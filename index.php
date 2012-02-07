<?php
ob_start("ob_gzhandler");
/**
 * Front to the Noobita application. This file doesn't do anything, but loads
 * noobita loader which does and tells WordPress to load the theme.
 *
 * @package Noobita
 */

/*
Copyright 2010 Mochammad Masbuchin (buchin@masbuchin.com)
Author: Mochammad Masbuchin
Author URL: http://ninjaplugins.com
Script URL: http://ninjaplugins.com/script/noobita

Version: 0.1
*/ 
 //load the template engine
require('./includes/h2o/h2o.php');

//load the configuration file
require('./config.php');

 /** Loads the Noobita Environment and Template */
require('./includes/noobita.php');
$template = (isset($_GET['lookup'])) ? 'lookup' : 'index';
if(count_chars($_SERVER["REQUEST_URI"]) > 1 && !isset($_GET['lookup']) ){
  $url = substr_replace($_SERVER["REQUEST_URI"],'', 0, 2);
  header('Location: ?lookup='.$url);
}
$h2o = new h2o('./themes/'.THEME.'/'.$template.'.html', 
  array('safeClass' => array('SimpleXMLElement','stdClass', 'Noobita'))
);
echo $h2o->render(array('full_url' => urldecode($_GET['lookup']),'url' => parse_url(urldecode($_GET['lookup']))));
?>