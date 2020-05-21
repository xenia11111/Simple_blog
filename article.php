<?php session_start(); //Страница с сообщением и комментариями к нему
?>
<!DOCFILE html>
<html>
<body>
	<header>
	<nav>
		<ul>
			<li><a href=/ >На главную</a></li>
		</ul>
	</nav>
    </header>
   <div class="main">
	
	<?php    //Вывод сообщения
	include("config.php");
	$article_id=$_GET['id'];// article_id=page_id
	$res=mysqli_query($connection,"SELECT * FROM `articles` WHERE `id`='$article_id'");
	while($rec=mysqli_fetch_assoc($res)){
		$login=$rec['login'];
		echo "<p><h1>".($rec)['title']."</h1></p>";
		echo "<p><h2>"."Автор: ".($rec)['author']."</h2></p>";
		echo "<p>".($rec)['summary content']."</p>";
		echo "<p>".($rec)['full content']."</p>";

	}
	?>

	</div>

<form name="comment" action="/article.php?id=<?php echo $article_id; ?>" method="post">
  <p>
    <label>Оставить комментарий:</label>
    <br />
    <textarea name="text_comment" cols="70" rows="5" >
    </textarea>
  </p>
  <p>
  	<input type="hidden" name="id" value="<?php echo "$article_id"?>">
    <input type="submit" value="Отправить" />
  </p>
</form>

<?php //Редактировать сообщение может только пользователь,который его написал
          //Чтобы появилась кнопка "Редактировать" пользователь должен быть авторизован
    if(isset($_SESSION['logged_user'])) { 
	$current_login=$_SESSION['logged_user'];
	if($login==$current_login){ ?>
<form name="update" action="update_article.php"  method="post">
   		<p>
  	        <input type="hidden" name="id" value="<?php echo "$article_id"?>">
            <input type="submit" value="Редактировать" />
        </p>
</form>
<?php } } 
       //Если оставлен комментарий добавляем его в базу данных
    if(isset($_POST['id'])) {
	$page_id = $_POST["id"];
  	$text_comment = $_POST["text_comment"];
  	$text_comment = htmlspecialchars($text_comment);
 	$res=mysqli_query($connection,"INSERT INTO `comments` (`comment`, `article_id`) VALUES ( '$text_comment','$page_id')");
 	}
    $result=mysqli_query($connection,"SELECT * FROM `comments` 
  	WHERE `article_id`='$article_id'"); //Выводим все комментарии для данной страницы
    echo "Комментарии: "."<br/>";
  
    while ($record=mysqli_fetch_assoc($result)) {
  	echo "<hr/>";
  	echo "<article>"." >".($record)['comment']."</article>";
  	} ?>
</body>
</html>