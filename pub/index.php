<?php
session_start();
require_once("../src/init.php");
$app = new App();
require_once($app->path["root"]."vendor/autoload.php");
require_once($app->ctrl);
