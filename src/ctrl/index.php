<?php
$view = $app->path["view"]."index.php";
if (isset($app->url[1])) {
	if (file_exists($file = $app->path["view"]."index/".$app->url[1].".php"))
		$view = $file;
	else exit();
}
require_once($view);
