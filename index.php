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
if(strlen($_SERVER["REQUEST_URI"]) > 1 && !isset($_GET['lookup']) ){
  $url = substr_replace($_SERVER["REQUEST_URI"],'', 0, 2);
  header('Location: ?lookup='.$url);
}
$h2o = new h2o('./themes/'.THEME.'/'.$template.'.html', 
  array('safeClass' => array('SimpleXMLElement','stdClass', 'Noobita'))
);

$url = (isset($_GET['lookup'])) ?  urldecode($_GET['lookup']) : '';

$counter = 0;
if(isset($_SERVER['ENV']) && $_SERVER['ENV'] == 'PAGODA' && $url != ''){
  /* procedural API */
  $memcache_obj = memcache_connect($_SERVER['MEMCACHE_HOST'], $_SERVER['MEMCACHE_PORT']);
  /* increment counter by 2 */
  $counter = memcache_increment($memcache_obj, 'counter', 2);
}

echo $h2o->render(array('counter' => $counter, 'full_url' => $url,'url' => parse_url($url)));
?>