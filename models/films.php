<?php

function films_all($link) {
	$query = "SELECT * FROM films";
	$films = array();
	$result = mysqli_query($link, $query);

	if ($result) {
		while ($row = mysqli_fetch_array($result)) {
			$films[] = $row;
		}

	}

	return $films;

}

function film_new($link, $title, $genre, $year, $description) {

	if (isset($_FILES['photo']['name']) && $_FILES['photo']['tmp_name'] !== "") {
		$fileName = $_FILES['photo']['name'];
		$fileTmpLoc = $_FILES['photo']['tmp_name'];
		$fileType = $_FILES['photo']['type'];
		$fileSize = $_FILES['photo']['size'];
		$fileErrorMessage = $_FILES['photo']['error'];
		$kaboom = explode('.', $fileName);
		$fileExt = end($kaboom);

		list($width, $heigth) = getimagesize($fileTmpLoc);
		if ($width < 10 || $heigth < 10) {
			$errors[] = 'That image has no dimentions';
		}

		$db_file_name = rand(10000000, 99999999) . "." . $fileExt;
		
		if($fileSize > 10485760) {
			$errors[] = 'Your image file was larger than 10mb';
		} else if (!preg_match("/\.(gif|jpg|png|jpeg)$/i", $fileName) ) {
			$errors[] = 'Your image file was not jpg, jpeg, gif or png type';
		} else if ($fileErrorMsg == 1) {
			$errors[] = 'An unknown error occurred';
		}

		$photoFolderLocation = ROOT . 'data/films/full/';
		$photoFolderLocationMin = ROOT . 'data/films/min/';

		$uploadFile = $photoFolderLocation . $db_file_name;
		$moveResult = move_uploaded_file($fileTmpLoc, $uploadFile);

		if ($moveResult != true) {
			$errors[] = 'File upload failed';
		}

		require_once( ROOT . "/functions/image_resize_imagick.php");
		$target_file = $photoFolderLocation . $db_file_name;
		$resized_file = $photoFolderLocationMin . $db_file_name;
		$wmax = 137;
		$hmax = 200;
		$img = createThumbnail($target_file, $wmax, $hmax);
		$img->writeImage($resized_file);
	}
	
	$query = "INSERT INTO films (title, genre, year, description, photo) VALUES (
		'". mysqli_real_escape_string($link, $title) ."', 
		'". mysqli_real_escape_string($link, $genre) ."', 
		'". mysqli_real_escape_string($link, $year) ."',
		'". mysqli_real_escape_string($link, $description) ."',
		'". mysqli_real_escape_string($link, $db_file_name) ."'
		)";

	$result = mysqli_query($link, $query);	

		if ($result) {
				$result = true;
		} else {
				$result = false;
		}

	return true;		
}

function get_film($link,$id) {
	$query = "SELECT * FROM films WHERE id = ' " . mysqli_real_escape_string($link, $id) . "' LIMIT 1";
	$result = mysqli_query($link, $query);
	if ( $result = mysqli_query($link, $query) ) {
		$film = mysqli_fetch_array($result);
	}

	return $film;
}

function film_update($link, $title, $genre, $year, $id, $description){

	if (isset($_FILES['photo']['name']) && $_FILES['photo']['tmp_name'] !== "") {
		$fileName = $_FILES['photo']['name'];
		$fileTmpLoc = $_FILES['photo']['tmp_name'];
		$fileType = $_FILES['photo']['type'];
		$fileSize = $_FILES['photo']['size'];
		$fileErrorMessage = $_FILES['photo']['error'];
		$kaboom = explode('.', $fileName);
		$fileExt = end($kaboom);

		list($width, $heigth) = getimagesize($fileTmpLoc);
		if ($width < 10 || $heigth < 10) {
			$errors[] = 'That image has no dimentions';
		}

		$db_file_name = rand(10000000, 99999999) . "." . $fileExt;
		
		if($fileSize > 10485760) {
			$errors[] = 'Your image file was larger than 10mb';
		} else if (!preg_match("/\.(gif|jpg|png|jpeg)$/i", $fileName) ) {
			$errors[] = 'Your image file was not jpg, jpeg, gif or png type';
		} else if ($fileErrorMsg == 1) {
			$errors[] = 'An unknown error occurred';
		}

		$photoFolderLocation = ROOT . 'data/films/full/';
		$photoFolderLocationMin = ROOT . 'data/films/min/';

		$uploadFile = $photoFolderLocation . $db_file_name;
		$moveResult = move_uploaded_file($fileTmpLoc, $uploadFile);

		if ($moveResult != true) {
			$errors[] = 'File upload failed';
		}

		require_once( ROOT . "/functions/image_resize_imagick.php");
		$target_file = $photoFolderLocation . $db_file_name;
		$resized_file = $photoFolderLocationMin . $db_file_name;
		$wmax = 137;
		$hmax = 200;
		$img = createThumbnail($target_file, $wmax, $hmax);
		$img->writeImage($resized_file);
	}

	$query = "	UPDATE films 
				SET title = '". mysqli_real_escape_string($link, $title) ."', 
					genre = '". mysqli_real_escape_string($link, $genre) ."', 
					year = '". mysqli_real_escape_string($link, $year) ."', 
					description = '". mysqli_real_escape_string($link, $description) ."', 
					photo = '". mysqli_real_escape_string($link, $db_file_name) ."' 
					WHERE id = ".mysqli_real_escape_string($link, $id)." LIMIT 1";

	if ( mysqli_query($link, $query) ) {
		$result = true;
	} else { 
		$result = false;
	}
	
	return $result;
}

function delete_film($link, $id) {
	$query = "DELETE FROM films WHERE id = ' " . mysqli_real_escape_string($link, $id ) . "' LIMIT 1";

	mysqli_query($link, $query);

	if ( mysqli_affected_rows($link) > 0 ) {
	 	$result = true;
	 } else {
	 	$result = false;
	 }
	 return $result;
}

?>