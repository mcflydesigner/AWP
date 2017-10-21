<?php 
	header('Content-Type: application/json');

	$host = 'localhost'; // адрес сервера 
  $database = 'name_bd'; // имя базы данных
  $user = 'name_users'; // имя пользователя
  $password = 'password'; // пароль

  $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

  $query = "SELECT time FROM tablename";
  $result = mysqli_query($link, $query) or die('Is not work!');

  $id = 0;

  $quantity = mysqli_num_rows($result);

  while ($row = $result->fetch_assoc())
  {
    $id++;
    if($id == $quantity)
    {
      $time = $row['time']; //Запрашиваем последнее время прихода запроса.
   }
  }

  $query = "SELECT * FROM tablename";
  $result = mysqli_query($link, $query) or die('Is not work!');

  //print json_encode($time);
  //echo '<br />';

  list($year, $month, $day_with_time) = split('[-]', $time);

  //echo 'Year - '.$year."<br />";
  //echo 'Month - '.$month."<br />";

  $days = explode(" ", $day_with_time);
  $day = $days[0];

  //echo 'Day - '.$day.'<br />';

  $newdate = $year.'-'.$month.'-'.$day.' 00:00:00';
  $newdate2 = $year.'-'.$month.'-'.$day.' 23:59:59';

  $query = "SELECT * FROM `tablename` WHERE time BETWEEN '".$newdate."' AND '".$newdate2."'";

  //echo $query;
  $result = mysqli_query($link, $query) or die('Is not work!');

  //echo "<br />";

  $data = array();
  foreach ($result as $row)
  {
    $data[] = $row;
  }

  print json_encode($data);
?>