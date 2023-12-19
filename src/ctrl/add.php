<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novel = [
        "title"  => $_POST["title"],
        "author" => $_POST["author"],
        "lang"   => $_POST["lang"],
        "pub"    => $_POST["pub"],
        "mark"   => $_POST["mark"],
        "genre"  => $_POST["genre"],
        "desc"   => $_POST["desc"],
        "cover"  => $_FILES["cover"],
        "date"   => $_POST["date"],
    ];
    $app->addNovel($novel);
    header("Location: index");
    exit;
}

require_once($app->path["view"]."index.php");
