<?php session_start(); ?>
<!DOCFILE html>
<html>
<body>
	<meta charset="utf-8">
	<head>
	<title> blog.ru </title>
         <nav>
    
    	    <ul>
    		    <li><a href=my_articles.php>Мои статьи</a></li>
    		    <?php  if(isset($_SESSION['logged_user'])):  //Если пользователь авторизован, но на главной странице в меню отображается "Выйти"
    		    	?>  
    		    <li><a href=log_out.php>Выйти</a></li> 
    		    <?php endif;
                   if(!isset($_SESSION['logged_user']))://Если пользователь не авторизован, ему предлагается "Войти"
                   	?>
                      <li><a href=log_in.php>Войти</a></li>
                  <?php endif;      
    		    ?>
    	    </ul>
    	  </nav>
    </head>
	<h1> Все статьи: </h1>
</body>
</html>	

<?php  //Вывод всех сообщений
require_once("config.php");
$page=$_GET['page'];
if(empty($page)){$page=1;}
$result=mysqli_query($connection,"SELECT * FROM `articles`");
$articles = mysqli_num_rows($result); 
if(!$articles){ echo "Сообщений пока нет<br/>"; }
$total = intval(($articles - 1) / $num) + 1;// Находим общее число страниц
// Если значение $page меньше единицы или отрицательно 
// переходим на первую страницу 
// А если слишком большое, то переходим на последнюю 
if(empty($page) or $page < 0) $page = 1; 
if($page > $total) $page = $total;
// Вычисляем начиная к какого номера 
// следует выводить сообщения 
$start = $page * $num - $num; 
// Выбираем $num сообщений начиная с номера $start
$result = mysqli_query($connection,"SELECT * FROM `articles` LIMIT $start, $num"); 
if($result){ 
	while ( $record = mysqli_fetch_array($result)) 
    {
	echo'<div style="background-color:#E4E4E4;border:1px solid #323232">'."<p><h2><a href=/article.php?id=".$record['id'].">".$record["title"]."</a></h2></p><p>".$record["summary content"]."</p></div>";
		
    }
}
print "<table border=0 align=center width=80%>";

// Проверяем нужны ли стрелки назад 
if ($page != 1) $prevpage = "<a href= ./index.php?page=1><<</a> 
                               <a href= ./index.php?page=". ($page - 1) ."><</a>"; 
// Проверяем нужны ли стрелки вперед 
if ($page != $total) $nextpage = " <a href= ./index.php?page=". ($page + 1) .">></a> 
                                   <a href= ./index.php?page=" .$total. ">>></a>"; 
// Находим две ближайшие страницы с обоих краев, если они есть 
if($page - 2 > 0) $page2left = " <a href= ./index.php?page=". ($page - 2) .">". ($page - 2) ."</a> | ";  
if($page - 1 > 0) $page1left = "<a href= ./index.php?page=". ($page - 1) .">". ($page - 1) ."</a> | ";
if($page + 2 <= $total) $page2right = " | <a href= ./index.php?page=". ($page + 2) .">". ($page + 2) ."</a>";
if($page + 1 <= $total) $page1right = " | <a href= ./index.php?page=". ($page + 1) .">". ($page + 1) ."</a>"; 

// Вывод меню 
if($page!=0){echo $prevpage.$page2left.$page1left."<b>".$page."</b>".$page1right.$page2right.$nextpage;} 
print "</table>"; 

?>
