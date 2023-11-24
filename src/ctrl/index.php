<?php
$view = $app->path["view"]."index.php";
if (isset($app->url[1]))
	$view = $app->path["src"]."ajax/".$app->url[1].".php";
require_once($view);
