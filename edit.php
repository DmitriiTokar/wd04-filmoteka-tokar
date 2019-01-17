<?php

require('config.php');
require('database.php');
$link = db_connect();

require('models/films.php');


if ( array_key_exists('update-film', $_POST) ) {
	
	// Обработка ошибок
	if ( $_POST['title'] == '') {
		$errors[] = "<p>Необходимо ввести название фильма!</p>";
	}
	if ( $_POST['genre'] == '') {
		$errors[] = "<p>Необходимо ввести жанр фильма!</p>";
	}
	if ( $_POST['year'] == '') {
		$errors[] = "<p>Необходимо ввести год фильма!</p>";
	}

	// Если ошщибок нет - сохраняем фильм
	if ( empty($errors) ) {

		$result = film_update($link, $_POST['title'], $_POST['genre'], $_POST['year'], $_POST['description'], $_GET['id']);

		if ($result) {
			$resultSuccess = "<p>Фильм обновлен успешно</p>";
		} else {
			$resultError = "<p>Что-то пошло не так. Обновите фильм еще раз</p>";
		}
	}
}

$film = get_film($link, $_GET['id']);

include('views/head.tpl');
include('views/notifications.tpl');
include('views/edit.tpl');
include('views/footer.tpl');

?>
