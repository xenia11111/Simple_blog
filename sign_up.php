<?php //Регистрация пользователя
    require_once("config.php");
    $data=$_POST;
	if(isset($data['do_sign_up'])){   //Если нажата кнопка "Зарегистрироваться", обрабаьываем переданные данные
        $login=$data['login'];
	    $password=password_hash($data['password'], PASSWORD_DEFAULT);
		$errors=array();
		if(trim($data['login'])==''){
			$errors[]="Введите логин!";
		}
		if($data['password']==''){
			$errors[]="Введите пароль!";
		}
		if($data['password_2']!=$data['password']){
			$errors[]="Пароли не совпадают!";
		}
        $result=mysqli_query($connection, "SELECT * FROM `users` WHERE `login`='$login'" );
        $this_login_number=mysqli_num_rows($result);
        if($this_login_number>0){
            $errors[]="Пользователь с таким логином уже существует!";
        }
		if(empty($errors)){
			//Вставляем логин и пароль в базу данных, если данные введены верно
          $result=mysqli_query($connection, "INSERT INTO `users` (`login`,  `password`) VALUES ('$login',  '$password' ) " ); 
          echo '<div style="color: green; background-color:#E4E4E4;border:1px solid #323232">'."Вы успешно зарегистрированы!".'</div><hr/>';
          echo "<a href=/>"."Перейти на главную страницу"."</a>";
		}
		else{ //Вывод ошибок
			echo'<div style="color: red;background-color:#E4E4E4;border:1px solid #323232">'.array_shift($errors).'</div><hr/>';
		}
	}
?>

<form action="/sign_up.php" method="POST">
	<p>
	  <p><strong>Ваш логин</strong>:</p>
	  <input type="text" name="login" value="<?php echo @$data['login']?>">
	</p>
	<p>
	  <p><strong>Ваш пароль</strong>:</p>
	  <input type="password" name="password">
	</p>
	<p>
	  <p><strong>Введите ваш пароль ещё раз</strong>:</p>
	  <input type="password" name="password_2">
	</p>
	<p>
	  <button type="submit" name="do_sign_up">Зарегистрироваться</button>
	</p>
</form>