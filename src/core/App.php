<?php

class App {
	public $ctrl;
	public $path;
	public $url;

	public function __construct() {
		$this->path["root"] = realpath(__DIR__."/../..")."/";
		$this->path["src"]  = $this->path["root"]."src/";
		$this->path["view"] = $this->path["src"] ."view/";
		$this->path["ctrl"] = $this->path["src"] ."ctrl/";

		require_once($this->path["root"]."vendor/autoload.php");
		if (isset($_GET["url"])) {
			$this->url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}

		if (file_exists($ctrl = $this->path["ctrl"].$this->url[0].".php")) {
			$this->ctrl = $ctrl;
			unset($this->url[0]);
		} else $this->ctrl = $this->path["ctrl"]."index.php";

		$app = $this;
		require_once $this->ctrl;

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
}


function option($options) {
	foreach($options as $opt) {
		echo "<option ";
		/*
		if ($opt === $_GET["q"]) {
			echo "selected";
		}
		 */
		$tmp = ucfirst($opt);
		echo ">${tmp}</option>";
	}
}
