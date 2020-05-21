<?php 
       //Страница для редактирования сообщения
	require_once("config.php");
	if(isset($_POST['change'])){  //Если нажата кнопка "Изменить", обновляем данные и переходим на главную страницу
		$article_id=$_POST['id'];
	    $title=$_POST['title'];
	    $name=$_POST['author'];
	    $summary_content=$_POST['summary_content'];
        $full_content=$_POST['full_content'];
	    $res=mysqli_query($connection,"UPDATE `articles` SET `title`='$title',`author`='$name',`summary content`='$summary_content',`full content`='$full_content' WHERE `id`='$article_id'"); //Обновляем данные в базе данных
	    header("Location: http://blog.ru/article.php?id="."$article_id"); //Возвращаемся на страницу с сообщением 
	}
?>
<html>
<body>
	<header>
	<nav>
		<ul>
			<li><a href=/ >На главную</a></li>
		</ul>
	</nav>
    </header>
</body>
</html>

<?php //Достаем данные из базы данных для редактирования
	$article_id=$_POST['id'];
	$res=mysqli_query($connection,"SELECT * FROM `articles` 
		WHERE `id`='$article_id'");
	$rec=mysqli_fetch_assoc($res);
	$title=($rec)['title'];
	$name=($rec)['author'];
	$summary_content=($rec)['summary content'];
    $full_content=($rec)['full content'];
?>
<form name="change" action="update_article.php" method="post">
	<p><label>Изменить название:</label><br/>
	<textarea name="title" cols="70" rows="1"> <?php echo $title ?> </textarea></p>
	<p><label>Изменить имя автора:</label><br/>
	<textarea name="author" cols="70" rows="1"> <?php echo $name ?> </textarea></p>
	<p><label>Изменить краткое содержание:</label><br/>
	<textarea name="summary_content" cols="70" rows="5"> <?php echo $summary_content ?> </textarea></p>
	<p><label>Изменить полное содержание:</label><br/>
	<textarea name="full_content" cols="70" rows="20"> <?php echo $full_content ?> </textarea></p>
    <p>
    	    <input type="hidden" name="id" value="<?php echo "$article_id"?>">
			<input type="submit" name="change" value="Изменить" /> 
    </p> 
</form>
