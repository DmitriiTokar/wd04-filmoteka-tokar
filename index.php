<?php

require('config.php');
require('database.php');
$link = db_connect();

require('models/films.php');
$films = films_all($link);

include('views/head.tpl');
include('views/index.tpl');
include('views/footer.tpl');



// Deleting film

if ( @$_GET['action'] == 'delete') {
	$query = "DELETE FROM films WHERE id = ' " . mysqli_real_escape_string($link, $_GET['id'] ) . "' LIMIT 1";

	mysqli_query($link, $query);

	if ( mysqli_affected_rows($link) > 0 ) {
	 	$resultInfo = "<p>Фильм был удален!</p>";
	 } 
}

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
	
		
	
	