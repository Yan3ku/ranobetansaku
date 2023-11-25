<div class="search">
  <input class="search__input" placeholder="Search for title, author, etc." id="search" type="text">
  <button class="search__button"><iconify-icon icon="material-symbols:search"></iconify-icon></button>
  <?php include $app->path["src"]."comp/dropdown.html" ?>
</div>
<?php include $app->path["src"]."comp/card.php" ?>
