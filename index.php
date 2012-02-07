<?php
ob_start("ob_gzhandler");
 //load the template engine
require('./includes/h2o/h2o.php');

//load the configuration file
require('./config.php');

$template = (isset($_GET['lookup'])) ? 'lookup' : 'index';
if(strlen($_SERVER["REQUEST_URI"]) > 1 && !isset($_GET['lookup']) ){
  $url = substr_replace($_SERVER["REQUEST_URI"],'', 0, 2);
  header('Location: ?lookup='.$url);
}
$h2o = new h2o('./themes/'.THEME.'/'.$template.'.html', 
  array('safeClass' => array('SimpleXMLElement','stdClass', 'Noobita'))
);

$url = (isset($_GET['lookup'])) ?  urldecode($_GET['lookup']) : '';

echo $h2o->render(array('full_url' => $url,'url' => parse_url($url)));
?>