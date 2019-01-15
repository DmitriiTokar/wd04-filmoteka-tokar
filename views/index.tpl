<div class="container user-content section-page">
    <div class="title-1">Фильмотека</div>
<?php foreach ($films as $key => $film) { ?>
    <div class="card mb-20">
        <div class="card__header">
            <h4 class="title-4"><?=$film['title']?></h4>
            <div>
                <a href="edit.php?id=<?=$film['id']?>" class="button button--editsmall">Редактировать</a>
                <a href="?action=delete&id=<?=$film['id']?>" class="button button--removesmall">Удалить</a>
            </div>
        </div>
        <div class="badge">
            <?=$film['genre']?>
        </div>
        <div class="badge">
            <?=$film['year']?>
        </div>
    </div>
<?php } ?>