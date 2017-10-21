<?php
	/*
		* Если кто-то когда-то решится работать с кодом, то прочитайте это:
		* Алгоритм проверяет влажность на каждом цветке и в БД заносит значение от 1 до 4:
		1 - влажность низкая.
		2 - влажность средняя.
		3 - влажность высокая.
		4 - влажность не получена.
		* Алгоритм проверяет значения с температуры, если все ок, то просто отправляет значение в БД, если значение == 1023, то в БД передается значение 100, что означает отсутствие значения температуры.
		Иными словами:
		просто соединяемся с БД ниже, проверяем все значения, сортируем и отправляем в БД. 
	*/
	$host = 'localhost'; // адрес сервера 
	$database = 'name_bd'; // имя базы данных
	$user = 'name_user'; // имя пользователя
	$password = 'password'; // пароль

	$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
  if($link) 
  {
  	echo 'bd connected <br>';
  }

  $temp1 = $_GET['temp1'];
  $temp2 = $_GET['temp2'];
  $temp3 = $_GET['temp3'];
  $temp4 = $_GET['temp4'];
	$hum1 = $_GET['hum1'];
	$hum2 = $_GET['hum2'];
	$hum3 = $_GET['hum3'];
	$hum4 = $_GET['hum4'];
	$id_device = $_GET['id_device'];

	if($id_device == "ID_device") 
	{
		//Проверяем степень влажности на первом цветке.
		if($hum1 <= 100) {
			$hum1 = 1;
		}
		elseif($hum1 <= 200) {
			$hum1 = 2;
		}
		elseif($hum1 <= 1023){
			$hum1 = 3;
		}
		else {
			$hum1 = 4;
		}

		//Проверяем степень влажности на втором цветке.
		if($hum2 <= 100) {
			$hum2 = 1;
		}
		elseif($hum2 <= 200) {
			$hum2 = 2;
		}
		elseif($hum2 <= 1023) {
			$hum2 = 3;
		}
		else {
			$hum2 = 4;
		}

		//Проверяем степень влажности на третьем цветке.
		if($hum3 <= 100) {
			$hum3 = 1;
		}
		elseif($hum3 <= 200) {
			$hum3 = 2;
		}
		elseif($hum3 <= 1023)
		{
			$hum3 = 3;
		}
		else {
			$hum3 = 4;
		}

		//Проверяем степень влажности на четвертом цветке.
		if($hum4 <= 100) {
			$hum4 = 1;
		}
		elseif($hum4 <= 200) {
			$hum4 = 2;
		}
		elseif($hum4 <= 1023) {
			$hum4 = 3;
		}
		else {
			$hum4 = 4;
		}

		//Теперь с температурой разберемся.
		if($temp1 == 1024)
		{
			$temp1 = 100;
		}
		if($temp2 == 1024)
		{
			$temp2 = 100;
		}
		if($temp3 == 1024)
		{
			$temp3 = 100;
		}
		if($temp4 == 1024)
		{
			$temp4 = 100;
		}

		if (!empty($_GET["temp1"]) && !empty($_GET["hum1"])) 
		{ 
			echo " Successful!: temp1 - ".$temp1.", hum1 - ".$hum1.", temp 2 - ".$temp2.", hum2 - ".$hum2.", temp 3 - ".$temp3.", hum 3 - ".$hum3.", temp 4 - ".$temp4.", hum 4 - ".$hum4." end." ;
		}  
		else 
		{ 
			echo "All is empty:(";
		}

		$query = "INSERT INTO tablename (`temp1`,`temp2`, `temp3`,`temp4`, `hum1`,`hum2`, `hum3`,`hum4`) VALUES ('$temp1','$temp2','$temp3','$temp4', '$hum1','$hum2', '$hum3','$hum4')";

		$result = mysqli_query($link, $query); 
		if($result)
		{
			echo '<br> BD table refresh.';
		}
		
		echo '<br>Thank you.<br>';
	}
?>