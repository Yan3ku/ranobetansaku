<?php
if (isset($app->url[1])) { /* detect ajax call */
	$ext = isset(pathinfo($app->url[1])['extension']) ? "" : ".php";
	$file = $app->path["view"]."index/".$app->url[1].$ext;
	if (file_exists($file)) require_once($file);
	else error_log($app->url[1].": invalid ajax call");
	exit();
}

if (isset($_POST["login-action"])) {
    if (!($user = $app->findUser($_POST["login"]))) {
        $app->setError("Invalid login, user doesn't exists");
        header("Location: index.php");
        exit;
    }
    if ($user["passwd"] === $_POST["passwd"]) $app->loginas($user);
    else $app->setError("Password doesn't match");
} else if (isset($_POST["logout-action"])) {
    session_unset();
} else if (isset($_POST["signup-action"])) {
    if ($app->findUser($_POST["login"])) {
        $app->setError("This login is taken.");
        header("Location: index.php");
        exit;
    }
    $app->getUsers()->insertOne([
        "login"  => $_POST["login"],
        "passwd" => $_POST["passwd"],
        "email"  => $_POST["email"],
    ]);
    $app->setError("Created user");
}


require_once($app->path["view"]."index.php");
