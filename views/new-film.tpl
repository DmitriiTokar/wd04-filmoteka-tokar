<?php if (@$resultSuccess != '') { ?>
	<div class="notify notify--success mb-20">
    <?=$resultSuccess?>
	</div>
<?php } ?>

<?php if (@$resultInfo != '') { ?>
	<div class="notify notify--deleted mb-20">
    <?=$resultInfo?>
	</div>
<?php } ?>
<?php if (@$resultError != '') { ?>
	<div class="notify notify--error mb-20">
    <?=$resultError?>
	</div>
<?php } ?>
<div class="container user-content pt-35">

	<div class="title-1">Добавить новый фильм</div>

	<div class="panel-holder mt-80 mb-40">
				<div class="title-3 mt-0">Добавить фильм</div>
				<form action="new.php" method="POST">

					<?php

					if (!empty($errors)) {
						foreach ($errors as $key => $value) {
						echo "<div class='notify notify--error mb-20'>$value</div>";
						}
					}

					?>
					<div class="form-group"><label class="label">Название фильма<input class="input" name="title" type="text" placeholder="Такси 2" /></label></div>
					<div class="row">
						<div class="col">
							<div class="form-group"><label class="label">Жанр<input class="input" name="genre" type="text" placeholder="комедия" /></label></div>
						</div>
						<div class="col">
							<div class="form-group"><label class="label">Год<input class="input" name="year" type="text" placeholder="2000" /></label></div>
						</div>
					</div><input class="button" type="submit" value="Добавить" name="add-film" />
				</form>
	</div>
</div>