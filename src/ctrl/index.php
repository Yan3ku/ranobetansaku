<?php
if (isset($app->url[1])) { /* detect ajax call */
	$ext = isset(pathinfo($app->url[1])['extension']) ? "" : ".php";
	$file = $app->path["view"]."index/".$app->url[1].$ext;
	if (file_exists($file)) require_once($file);
	else error_log($app->url[1].": invalid ajax call");
	exit();
}


require_once($app->path["view"]."index.php");
