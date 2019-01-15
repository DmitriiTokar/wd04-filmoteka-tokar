<?php

require('config.php');
require('database.php');
$link = db_connect();

require('models/films.php');

if (array_key_exists('add-film', $_POST)) {

	if ($_POST['title'] == '') {
		$errors[] = "<p>Необходимо ввести название фильма!</p>";
	}

	if ($_POST['genre'] == '') {
		$errors[] = "<p>Необходимо ввести жанр фильма!</p>";
	}

	if ($_POST['year'] == '') {
		$errors[] = "<p>Необходимо ввести год выпуска фильма!</p>";
	}

	if ( empty($errors) ) {

		$result = film_new($link, $_POST['title'], $_POST['genre'], $_POST['year']);

	}


	if ($result) {
		$resultSuccess = "<p>Фильм добавлен успешно</p>";
	} else {
		$resultError = "<p>Что-то пошло не так. Доавьте фильм еще раз</p>";
	}


}

include('views/head.tpl');
include('views/new-film.tpl');
include('views/footer.tpl');

?>

