<?php
  $host = 'localhost'; // адрес сервера 
  $database = 'name_bd'; // имя базы данных
  $user = 'name_user'; // имя пользователя
  $password = 'password'; // пароль

  $link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

  $query = "SELECT * FROM tablename";
  $result = mysqli_query($link, $query) or die('Is not work!');

  $id = 0;

  $quantity = mysqli_num_rows($result);

  while ($row = $result->fetch_assoc())
  {
    $id++;
    if($id == $quantity)
    {
      $id = $row['id'];
      $temp1 = $row['temp1'];
      $temp2 = $row['temp2'];
      $temp3 = $row['temp3'];
      $temp4 = $row['temp4'];
      $hum1 = $row['hum1'];
      $hum2 = $row['hum2'];
      $hum3 = $row['hum3'];
      $hum4 = $row['hum4'];
   }
  }

  // Закрываем соединение
  mysql_close($link);

  $condition_1 = true;
  $condition_2 = true;
  $condition_3 = true;
  $condition_4 = true;
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
        <title>AWP Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="private"> 
    <link href="css/styles.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
      <header>
          <div class="row">
            <div class="col-md-5 col-sm-5 col-lg-3 col-xs-8 logo">
            <p>AWP project</p>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-3 mon col-xs-7 gren">
            <a href="index.php">мониторинг</a>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-3 mon col-xs-7 proj">
            <a href="project.html">о проекте</a>
            </div>
          </div>
      </header>
    <div  class="container">
       <div class="row">
       <?php if($temp1 != 100) {
          echo 
          '<div class=" col-lg-10 col-md-10 col-sm-10 plant">
            <p class="plantname">Растение 1:</p>
             <div class="row">
                <div class=" col-lg-12 col-md-12 col-sm-12 temp">
                   <img src="src/temp.png">
                   <p class="har">Температура:</p>
                    <p class="pokaz">'.$temp1.'*C</p>
                </div>
                <div class=" col-lg-12 col-md-12 col-sm-12 humid">
                   <img src="src/humid.png" class="humidimg">
                   <p class="har">Влажность:</p>';
                      if($hum1 == 3){
                        echo '<p class="pokaz">Высокая</p>';
                      }
                      elseif($hum1 == 2) {
                        echo '<p class="pokaz">Средняя</p>';
                      }
                      elseif($hum1 == 1) {
                        echo '<p class="pokaz">Низкая</p>';
                      }
                      else {
                        echo '<p class="pokaz">Не определена</p>';
                      }
                   echo '
                </div>
             </div>
         </div>'; 
       } 

       else {
       		$condition_1 = false;
          echo '
          <div class=" col-lg-10 col-md-10 col-sm-10 plant badplant">
            <p class="plantname">Растение 1:</p>
            <div class="row">
                <p class="row_p">Растение не подключено.</p>
            </div>
          </div>';
          }
        ?>
         
         <!-- Растение второе, вывод. -->
        <?php 
        if($temp2 != 100)
        {
          echo '
          <div class="col-lg-10 col-md-10 col-sm-10 plant">
            <p class="plantname">Растение 2:</p>
            <div class="row">
                <div class=" col-lg-12 col-md-12 col-sm-12 temp">
                   <img src="src/temp.png">
                   <p class="har">Температура:</p>'; 
                      echo '<p class="pokaz">'.$temp2.'*C</p>';
                   echo '
                </div>
                <div class=" col-lg-12 col-md-12 col-sm-12 humid">
                   <img src="src/humid.png" class="humidimg">
                   <p class="har">Влажность:</p>';
                      if($hum2 == 3){
                        echo '<p class="pokaz">Высокая</p>';
                      }
                      elseif($hum2 == 2) {
                        echo '<p class="pokaz">Средняя</p>';
                      }
                      elseif($hum2 == 1) {
                        echo '<p class="pokaz">Низкая</p>';
                      }
                      else {
                        echo '<p class="pokaz">Не определена</p>';
                      }
                      echo '
                </div>
             </div>
         </div>
       </div>';
      }
       else {
       		$condition_2 = false;
        echo '
          <div class="col-lg-10 col-md-10 col-sm-10 plant badplant">
            <p class="plantname">Растение 2:</p>
            <div class="row">
              <p class="row_p">Растение не подключено.</p>
            </div>
          </div>';
        }
        ?> 
    
       <div class="row row2">
       <!-- Растение третье, вывод. -->
       <?php 
          if($temp3 != 100)
          {
            echo ' 
            <div class=" col-lg-10 col-md-10 col-sm-10 plant">
            <p class="plantname">Растение 3:</p>
             <div class="row">
                <div class=" col-lg-12 col-md-12 col-sm-12 temp">
                   <img src="src/temp.png">
                   <p class="har">Температура:</p>';
                      echo '<p class="pokaz">'.$temp3.'*C</p>';
                      echo'
                </div>
                <div class=" col-lg-12 col-md-12 col-sm-12 humid">
                   <img src="src/humid.png" class="humidimg">
                   <p class="har">Влажность:</p>';
                      if($hum3 == 3){
                        echo '<p class="pokaz">Высокая</p>';
                      }
                      elseif($hum3 == 2) {
                        echo '<p class="pokaz">Средняя</p>';
                      }
                      elseif($hum3 == 1) {
                        echo '<p class="pokaz">Низкая</p>';
                      }
                      else {
                        echo '<p class="pokaz">Не определена</p>';
                      }
                   echo '
                </div>
             </div>
         </div>';
          }
         else {
         	$condition_3 = false;
         	echo '<div class=" col-lg-10 col-md-10 col-sm-10 plant badplant">
         	<p class="plantname">Растение 3:</p>
             <div class="row">
							<p class="row_p">Растение не подключено.</p>
             </div>
					</div>
         	';
         }
       ?>
       
        <!-- Растение четвертое, вывод. -->
        <?php 
          if($temp4 != 100)
          {
            echo '<div class=" col-lg-10 col-md-10 col-sm-10 plant">
              <p class="plantname">Растение 4:</p>
              <div class="row">
                <div class=" col-lg-12 col-md-12 col-sm-12 temp">
                   <img src="src/temp.png">
                   <p class="har">Температура:</p>';
                      echo '<p class="pokaz">'.$temp4.'*C</p>';
                      echo '</div>
                <div class=" col-lg-12 col-md-12 col-sm-12 humid">
                   <img src="src/humid.png" class="humidimg">
                   <p class="har">Влажность:</p>';
                      if($hum4 == 3){
                        echo '<p class="pokaz">Высокая</p>';
                      }
                      elseif($hum4 == 2) {
                        echo '<p class="pokaz">Средняя</p>';
                      }
                      elseif($hum4 == 1) {
                        echo '<p class="pokaz">Низкая</p>';
                      }
                      else {
                        echo '<p class="pokaz">Не определена</p>';
                      }
                   echo '</div></div></div>';
        }
        else {
        		$condition_4 = false;
          echo '
         <div class=" col-lg-10 col-md-10 col-sm-10 plant badplant">
            <p class="plantname">Растение 4:</p>
            <div class="row">
                <p class="row_p">Растение не подключено.</p>
             </div>
         </div>';
       } 
      ?>
       </div>
        
        <?php
        if($condition_1 or $condition_2 or $condition_3 or $condition_4)
        {
       //Кнопка
        echo '<a href="#" id="toggler" class="btn btn-graph btn-success btn-lg">ПОСТРОИТЬ ГРАФИКИ</a>';
        }
        ?>
       <div id="box">
        <?php 
        if($condition_1)
        {
          echo '<p class="box_p_zag">Растение 1:</p>
        <canvas id="hum1"></canvas> 
        <p class="box_p">Значения: 1 - Низкая. 2 - Нормальная. 3 - Высокая. 4 - Не определена.</p>
        <canvas id="temp1"></canvas>';
        }
        
        if($condition_2)
        {
          echo '<p class="box_p_zag">Растение 2:</p>
        <canvas id="hum2"></canvas> 
        <p class="box_p">Значения: 1 - Низкая. 2 - Нормальная. 3 - Высокая. 4 - Не определена.</p>
        <canvas id="temp2"></canvas>';
        }

        if($condition_3)
        {
          echo '<p class="box_p_zag">Растение 3:</p>
        <canvas id="hum3"></canvas> 
        <p class="box_p">Значения: 1 - Низкая. 2 - Нормальная. 3 - Высокая. 4 - Не определена.</p>
        <canvas id="temp3"></canvas>';
        }

        if($condition_4)
        {
          echo '<p class="box_p_zag">Растение 4:</p>
        <canvas id="hum4"></canvas> 
        <p class="box_p">Значения: 1 - Низкая. 2 - Нормальная. 3 - Высокая. 4 - Не определена.</p>
        <canvas id="temp4"></canvas>';
       }
        ?>
       </div>

       <script type="text/javascript" src="js/jquery.min.js"></script>
       <script type="text/javascript" src="js/Chart.min.js"></script>
       <script type="text/javascript" src="js/linegraph.js"></script>
       <script type="text/javascript">
         window.onload= function() {
          document.getElementById('toggler').onclick = function() {
            openbox('box', this);
            return false;
          };
        };
        function openbox(id, toggler) {
          var div = document.getElementById(id);
          if(div.style.display == 'block') {
            div.style.display = 'none';
            toggler.innerHTML = 'ПОСТРОИТЬ ГРАФИКИ';
          }
          else {
            div.style.display = 'block';
            toggler.innerHTML = 'УБРАТЬ ГРАФИКИ';
          }
        }

       </script>
       </div>
    </div>
    <footer class="footer">
              <div class="open ">
                  <p>open-sourse project.</p>
                  </div>
            </footer>
  </body>
  </html>