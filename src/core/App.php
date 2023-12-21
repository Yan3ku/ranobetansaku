<?php

class App {
    const ERROR = "ERROR";
    const EMAIL = "EMAIL";
    const LOGIN = "LOGIN";
    const PASSWD = "PASSWD";
    const PAGE = 3;
	public $ctrl;
	public $path;
	public $url;

	public function __construct() {
		$this->path["root"] = realpath(__DIR__."/../..")."/";
		$this->path["src"]  = $this->path["root"]."src/";
		$this->path["pub"] = $this->path["root"] ."pub/";
		$this->path["view"] = $this->path["src"] ."view/";
		$this->path["ctrl"] = $this->path["src"] ."ctrl/";
        $this->path["upload"] = $this->path["root"]."pub/upload/";

		if (isset($_GET["url"])) {
			$this->url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}

		$this->ctrl = $this->path["view"]."404.php";
		if (!$this->url[0]) $this->ctrl = $this->path["ctrl"]."index.php";
		if (file_exists($ctrl = $this->path["ctrl"].$this->url[0].".php")) {
			$this->ctrl = $ctrl;
			unset($this->url[0]);
		}
	}

	function getdb() {
		$mongo = new MongoDB\Client(
			"mongodb://localhost:27017/wai",
			[
				'username' => 'wai',
				'password' => 'wai',
			]);

		$db = $mongo->wai;
		return $db;
	}

    function alertError() {
        $error = $_SESSION[self::ERROR];
        unset($_SESSION[self::ERROR]);
        return <<<HTML
            <script>alert("{$error}")</script>
HTML;
    }

    function isError() {
        return isset($_SESSION[self::ERROR]);
    }

    function setError($msg) {
        $_SESSION[self::ERROR] = $msg;
    }

    function isGoodFormat($file) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $file);
        if ($mime_type === 'image/jpeg') {
            return "jpg";
        }
        $this->setError("Wrong format");
        return 0;
    }

    function getCoverPath($name) {
        return $this->path["upload"] . $name;
    }

    function islogged() {
        return isset($_SESSION[self::LOGIN]);
    }

    function saveCover($file, $title) {
        $target = $this->getCoverPath($title);
        if (!move_uploaded_file($file, $target)) {
            $this->setError("Can\'t move cover to upload directory.");
            return 0;
        }
        return 1;
    }

    function getCover($coverPath) { // too late
        return substr($coverPath, strlen($this->path["pub"]) - 1);
    }

    function genMinCover($file, $save) {
        $image = imagecreatefromjpeg($file);
        $image = imagescale($image, 125, 200); // holly moly php is functional?!?!
        imagejpeg($image, $save);
    }

    function genWatermark($file, $text, $save) {
        $image = imagecreatefromjpeg($file);
        $black = imagecolorallocate($image, 0, 0, 0);
        imagestring($image, 5, 20, 20, $text, $black);
        imagejpeg($image, $save);
    }

    function getUsers() {
        return $this->getdb()->users;
    }

    function loginas($user) {
        $_SESSION[self::LOGIN] = $user["login"];
        $_SESSION[self::PASSWD] = $user["passwd"];
        $_SESSION[self::EMAIL] = $user["email"];
    }

    function findUser($login) {
        return $this->getUsers()->findOne(["login" => $login]);
    }

    function getNovels() {
        $page = $_GET["q"] ?? 1;
        $pageSize = self::PAGE;
        $opts = [
            'skip' => ($page - 1) * $pageSize,
            'limit' => $pageSize
        ];

        try {
            return $this->getdb()->novels->find([], $opts);
        } catch (Exception $e) {
            echo "Something in universe went wrong";
            exit;
        }
    }

    function getPages() {
        return $this->getdb()->novels->count() / self::PAGE + 1;
    }

    function addNovel($novel) {
        if ($novel["cover"]["error"]) {
            $this->setError("Error uploading cover");
            return 1;
        }
        if (!($ext = $this->isGoodFormat($novel["cover"]["tmp_name"]))) return 1;
        $filename        = $novel["title"] . "." . $ext;
        $filenamemin     = $novel["title"] . "-min" . "." . $ext;
        $filenameminmark = $novel["title"] . "-mark" . "." . $ext;
        if (!$this->saveCover($novel["cover"]["tmp_name"], $filename)) return 1;
        $novel['cover'] = $this->getCoverPath($filename);
        $novel['cover-min'] = $this->getCoverPath($filenamemin);
        $novel['cover-mark'] = $this->getCoverPath($filenameminmark);
        $this->genMinCover($novel['cover'], $novel["cover-min"]);
        $this->genWatermark($novel['cover'], $novel["mark"], $novel["cover-mark"]);
        $this->getdb()->novels->insertOne($novel);
        return 0;
    }
}
