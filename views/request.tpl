<h1>Укажите ваши данные</h1>


<form action="set-cookie.php" method="POST">

	<div>
		<label class="label">Ваше имя</label>
		<input class="input mt-10" type="text" placeholder="Ваше имя" name="user-name" />
	</div>			
	<div class="mt-20">
		<label class="label">Ваш город</label>
		<input class="input" type="text" placeholder="Ваш город" name="user-city" />
	</div>			
		
		<input class="button mt-20" type="submit" value="Сохранить" name="user-submit" />
</form>

<form action="unset-cookie.php" method="POST">			
		
		<input class="button mt-20" type="submit" value="Удалить данные" name="user-unset" />
</form>