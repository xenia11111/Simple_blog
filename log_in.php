<?php //Страница для авторизации
         //Если пользователь ещё не зарегистрирован,ему предлагается зарегистрироваться
  require_once("config.php");
  $data=$_POST;
  if(isset($data['do_log_in'])){   //Если нажата кнопка "Войти",обрабатываем данные
  	$login=$data['login'];
    $password=$data['password'];
  	$errors=array();             //Массив для ошибок
  	if(trim($login)==''){ $errors[]="Вы не ввели логин!";}
  	if(trim($password)==''){ $errors[]="Вы не ввели пароль!";} 
  	else{  
        $result=mysqli_query($connection, "SELECT * FROM `users` WHERE `login`='$login'" );
        $info=mysqli_fetch_assoc($result);
        $there_is=mysqli_num_rows($result);
        if($there_is){   
    	    $this_password=($info)['password'];
    	    if(password_verify($password, $this_password)){
    		      session_start();
                  $_SESSION['logged_user']=$info['login'];
                  echo '<div style="color: green;background-color:#E4E4E4;border:1px solid #323232">'."Вы успешно авторизованы!".'</div><hr/>';
                  echo "<a href=/>"."Перейти на главную страницу"."</a>";
                 }
            else{
                 $errors[]="Неверный пароль!";
                }
        }
        else{
    	   $errors[]="Пользователь с данным логином не найден!";
        }
  	    
  	}
    
    if(!empty(errors)){ //Вывод ошибок
         echo'<div style="color: red;background-color:#E4E4E4;border:1px solid #323232">'.array_shift($errors).'</div><hr/>';
    }
  }
?>
<form action="log_in.php" method="POST">
	<p>
		<p><strong>Логин</strong>:</p>
		<input type="text" name="login" value="<?php echo @$data['login'];?>" >
		</p>
		<p><strong>Пароль</strong>:</p>
		<input type="text" name="password" value="<?php echo @$data['password'];?>" >
		</p>
		<p>
	  <button type="submit" name="do_log_in">Войти</button>
	    </p>
</form>

<?php 
    if(!isset($_SESSION['logged_user'])) {  
	echo "<a href=sign_up.php>"."Зарегистрироваться"."</a>";
 } 
 ?>