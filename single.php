<?php

require('config.php');
require('database.php');
$link = db_connect();

require('models/films.php');
if ( @$_GET['action'] == 'delete') {
	$result = delete_film($link, $_GET['id']);

	if ( $result ) {
	 	$resultInfo = "<p>Фильм был удален!</p>";
	 } else {
	 	$resultError = "<p>Что-то пошло не так!</p>";
	 }
}

$film = get_film($link, $_GET['id']);

include('views/head.tpl');
include('views/notifications.tpl');
include('views/film-single.tpl');
include('views/footer.tpl');



// Deleting film



// Saving form data to db

$errors = array();



?>

		<?php if (@$resultSuccess != '') { ?>
			<div class="notify notify--success mb-20"><?=$resultSuccess?></div>
		<?php } ?>

		<?php if (@$resultInfo != '') { ?>
			<div class="notify notify--deleted mb-20"><?=$resultInfo?></div>
		<?php } ?>

		<?php if (@$resultError != '') { ?>
			<div class="notify notify--error mb-20"><?=$resultError?></div>
		<?php } ?>