<?php session_start(); //Вывод сообщений пользователя
?>
<html>
 <body>
	<nav>
		<ul>
			<li><a href=/>На главную</a></li>
		</ul>
	</nav>
  </body>
</html>

<?php // Если пользователь авторизован, то выводятся его сообщения
  require_once("config.php");
  
if(isset($_SESSION['logged_user'])){ 
  $login=$_SESSION['logged_user'];
  $result=mysqli_query($connection,"SELECT * FROM `articles` WHERE `login`='$login'");
  if(mysqli_num_rows($result)==0){
  	echo  "<p>$login, Вы ещё не написали ни одного сообщения!</p><br/>"; //Если пользователь не написал сообщения, то ничего не выводится
  }
  echo "<a href=make_article.php>Написать сообщение</a>"; //Предлагается написать сообщение
  while($my_articles=mysqli_fetch_assoc($result)){  //Если же пользователь писал сообщение,они выводятся
        echo "<p>";
		echo "<h2><a href=/article.php?id=".$my_articles['id'].">".$my_articles["title"]."</a></h2>";
		echo $my_articles["summary content"]."<p/>";
		echo "<hr/>";
  }
 }
 else{  //Иначе предлагается написать сообщение
 	echo "<a href=make_article.php>Написать сообщение</a>";
 }
 
?>