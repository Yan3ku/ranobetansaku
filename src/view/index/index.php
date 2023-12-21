<div class="search">
  <input class="search__input" placeholder="Search for title, author, etc." id="search" type="text">
  <button class="search__button"><iconify-icon icon="material-symbols:search"></iconify-icon></button>
  <?php include $app->path["src"]."comp/search.php" ?>
</div>


<?php
foreach ($app->getNovels() as $novel)
    include($app->path["src"] . "comp/card.php");
?>

<ul class="page__ul">
<?php for ($i = 1; $i <= $app->getPages(); $i++): ?>
    <a href="index.php?q=<?= $i ?>"><li><?= $i ?></li></a>
<?php endfor ?>
</ul>


<?php
if ($app->isError()) echo $app->alertError();
