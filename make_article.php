<?php  //Создание сообщения
	session_start();
	require_once("config.php");
	if(isset($_POST['do_send'])){  //Если переданы данные в переменную $_POST, обрабатываем их
		$login=$_SESSION['logged_user'];
		$name=htmlspecialchars($_POST["article_title"]);
	    $author=$_POST["author_name"];
		$summary_content=htmlspecialchars($_POST["summary_content"]);
		$full_content=htmlspecialchars($_POST["full_content"]);
		$errors=array();   //массив для ошибок
		if(trim($name)==''){ $errors[]="Введите название сообщения!";}
		if(trim($author)==''){ $errors[]="Введите имя автора!";}
		if(trim($summary_content)==''){ $errors[]="Введите краткое содержание!";}
		if(trim($full_content)==''){ $errors[]="Введите полное содержание!";}
		
		if(empty($errors)){
			//Если ошибок нет, все поля не пустые, вставляем данные в базу данных
	    	$res=mysqli_query($connection,"INSERT INTO `articles` (`login`,`title`, `author`, `summary content`,`full content`) VALUES ('$login', '$name', '$author', '$summary_content','$full_content')");
  	    	echo '<div style="color: green;background-color:#E4E4E4;border:1px solid #323232">'."Сообщение добавлено!".'</div><hr/>';
		}
		else{ //Иначе выводим ошибки
			echo'<div style="color: red;background-color:#E4E4E4;border:1px solid #323232">'.array_shift($errors).'</div><hr/>'; //Выводим первую ошибку
		}
	}
?>
<?php
   
   if(isset($_SESSION['logged_user'])){ //Если пользователь авторизован,то выводятся поля для заполнения
   	?>
 <!DOCFILE html>
<html>
 <body>
	<nav>
		<ul>
			<li><a href=/ >На главную</a></li>
		</ul>
	</nav>
	<form name="article" action="make_article.php" method="post">
		<p>
			<p><label>Название сообщения: </label><br/>
			<textarea name="article_title" cols="70" rows="1" value="<?php echo ""?>">
			    <?php echo $_POST['article_title']?>  
			</textarea></p>
			<p><label>Имя автора: </label><br/>
			<textarea name="author_name" cols="70" rows="1" value="author_name">
			    <?php echo $_POST['author_name']?>  
			</textarea></p>
			<p><label>Краткое содержание: </label><br/>
			<textarea name="summary_content" cols="70" rows="5" value="summary_content"> 
				<?php echo $_POST['summary_content']?> 
			</textarea></p>
			<p><label>Полное содержание: </label><br/>
			<textarea name="full_content" cols="70" rows="20" value="full_content"> 
				<?php echo $_POST['full_content']?>
			</textarea></p>
		</p>
		<p>
			<input type="submit" name="do_send" value="Отправить" /> 
		</p>
</form>
</body>
</html>
<?php } 
else{ 
	echo '<div style="color: red; background-color:#E4E4E4;border:1px solid #323232">Чтобы написать сообщение нужно авторизоваться!</div><br/>';//Иначе предлагается авторизоваться
    echo '<a href=log_in.php>Войти</a>';
}
?>