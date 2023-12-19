<div class="card">
    <h2 class="card__title"><?= $novel["title"] ?></h2>
    <div class="card__content">
        <a href="<?= $app->getCover($novel["cover-mark"]) ?>"><img class="card__img" src="<?= $app->getCover($novel["cover-min"]); ?>"></a>
        <div class="card__description"><?= $novel["desc"] ?></div>
        <div class="card__tags">
            <div class="card__author-and-publisher">
                <span class="card__tag"><?= $novel["author"] ?></span>
                <span class="card__tag"><?= $novel["pub"] ?></span>
            </div>
            <div class="card__genre">
                <?php foreach ($novel["genre"] as $g): ?>
                    <span class="card__tag"><?= $g ?></span>
                <?php endforeach ?>
            </div>
            <div class="card__langs">
                <?php foreach ($novel["lang"] as $l): ?>
                    <span class="card__tag"><?= $l ?></span>
                <?php endforeach ?>
            </div>
            <div class="card__date"><?= $novel["date"] ?></div>
        </div>
    </div>
</div>
