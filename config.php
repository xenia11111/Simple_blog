<?php

	$num=1;//число статей на странице
	$db_host="";//сервер 
	$db_username="";//имя пользователя
	$db_password="";//пароль
	$db_name="";//имя базы данных
    $connection=mysqli_connect($db_host, $db_username, $db_password,$db_name);
     if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
    }
?>