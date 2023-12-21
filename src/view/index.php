<!DOCTYPE html>
<html lang="en">

<head>
  <title>ラノベ探索</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/style.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;700&family=Roboto:ital,wght@0,300;0,700;1,100;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
  <script src="/js/dropdown.js" type="module" defer></script>
  <script src="/js/contentload.js" type="module" defer></script>
  <script src="/js/validatepasswd.js" type="module" defer></script>
</head>

<body>
  <nav>
    <ul class="topbar">
      <li>何ですか</li>
<?php if ($app->islogged()): ?>
      <li><?php include $app->path["src"]."comp/logout.php" ?></li>
<?php else: ?>
      <li><?php include $app->path["src"]."comp/login.php" ?></li>
      <li><?php include $app->path["src"]."comp/signup.php" ?></li>
<?php endif ?>
    </ul>
  </nav>
  <main>
    <header class="header">
      <h1 class="header__h1">ラノベ探索</h1>
      <p class="header__p">
        <select class="header__select" data-select-query>
          <?php foreach (["index", "popular", "release", "add"] as $opt) : ?>
            <option value=<?= $opt ?>><?= ucfirst($opt) ?></option>
          <?php endforeach ?>
        </select>
      </p>
    </header>
    <div class="content" data-content>
      <!-- body of ajax call --!>
    </div>
  </main>
</body>

</html>
