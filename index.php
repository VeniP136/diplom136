<?php
session_start();
session_id();
setcookie('user_id', session_id());
require "db.php";

if (isset($_GET['page'])){
    $page = $_GET['page'];
}else $page = 1;
$kol = 3;
$art = ($page * $kol) - $kol;
$res = $pdo->query("select count(*) as count from posts");
$row = $res->fetch();
$total = $row['count'];
$str_pag=ceil($total/$kol);

$stmt = $pdo->query("select p.*, u.login as login, 
(select count(*) from comments where post_id=p.id) as count_com,
(select count(*) from likes where post_id=p.id) as count_likes
from posts p inner join users u on p.user_id=u.id order by timestamp desc limit $art,$kol");
$posts = $stmt->fetchAll();
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <title>Автомастерская, Чебоксары</title>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
		 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		 <link rel="stylesheet" href="css/baguetteBox.min.css">
        <link rel="stylesheet" href="css/style.css">
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
  
    
    






                
    
    
    
    
  


    
</head>

<body class="bg-dack">
   
    <header class="text-center">
       <!-- Header -->
					<header id="header">
						<!-- Классы navbar и navbar-default (базовые классы меню) -->
               <nav class="navbar navbar-expand-lg navbar-light p-0">
               
  <a class="navbar-brand" href="../index.php">
                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-screwdriver" viewBox="0 0 16 16">
  <path d="M0 1l1-1 3.081 2.2a1 1 0 0 1 .419.815v.07a1 1 0 0 0 .293.708L10.5 9.5l.914-.305a1 1 0 0 1 1.023.242l3.356 3.356a1 1 0 0 1 0 1.414l-1.586 1.586a1 1 0 0 1-1.414 0l-3.356-3.356a1 1 0 0 1-.242-1.023L9.5 10.5 3.793 4.793a1 1 0 0 0-.707-.293h-.071a1 1 0 0 1-.814-.419L0 1zm11.354 9.646a.5.5 0 0 0-.708.708l3 3a.5.5 0 0 0 .708-.708l-3-3z"/>
</svg>
                   </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">Главная <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/index2.php">Автолюбителю</a>
      </li>
      <li class="nav-item dropdown">
        
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        </div>
      </li>
    </ul>
     
							<ul><a href="#menu">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
  <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
  <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
</svg>
                                </a></ul>
 
  </div>
</nav>
					</header>
       
        <div class="beige2 jumbotron container">
            <br><br><br>
            <h1 class="beige display-4">Привет!</h1>
            <p class="lead">Надежный и профессиональный автосервис города чебоксары &#9660; </p>
            <hr class="my-4">
           
           
        </div>
        <div class="text-light display-2 mt-5">Где мы</div>
        <div class="container embed-responsive embed-responsive-16by9 mt-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1323.8149421486962!2d47.31147804256211!3d56.08129800630499!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x415a374a956f6c7f%3A0x8b4847c2a6fbf7ae!2z0JDQstGC0L7QvNCw0YHRgtC10YDRgdC60LDRjw!5e0!3m2!1sru!2sru!4v1606812221371!5m2!1sru!2sru" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    
    
    
    <!-- Menu -->
					<section id="menu">

						<!-- Actions -->
							<section>
								<ul class="actions vertical">
									<?php if (isset($_SESSION['login'])) {?>
									<li>
										<p> <a href="user.php"><?=$_SESSION['login']?></a></p>
										<p> <a href="logout.php">Log Out</a></p>
									</li>
									<?php } else { ?>
									<li><h3>Login</h3></li>
									<li>
										<form action="auth.php" method="post">
											<input type="text" name="login" placeholder="Login"><br>
											<input type="password" name="password" placeholder="Password"><br>
											<input type="submit" class="button big fit" value="Log In">
										</form>
									</li>
									<?php } ?>
									<li><h3>Registration</h3></li>
									<li>
										<form action="reg.php" method="post">
											<input type="text" name="login" placeholder="Login"><br>
											<input type="password" name="password" placeholder="Password"><br>
											<input type="file" name="file"><br><br>
											<input type="submit" class="button big fit" value="Sign up">
										</form>
									</li>
								</ul>
							</section>

					</section>

    
    
    
    
    
    <main>
        <div class="container text-center my-5 ">
        </div>
        <div class="container gallery">
            <div class="row my-5">
              

            </div>
            <div class="row my-5">
                <div class="col-4">
                    <a href="img/935694.jpg" data-caption="Image caption">
                        <img src="img/935694.jpg" class="w-100 h-75 img" alt="First image">
                    </a>
                </div>
                <div class="col-4">
                    <a href="img/976013.jpg" data-caption="Image caption">
                        <img src="img/976013.jpg" class="w-100 h-75 img" alt="Second image">
                    </a>
                </div>
                <div class="col-4">
                    <a href="img/939344.jpg">
                        <img src="img/939344.jpg" class="w-100 h-75 img" alt="Second image">
                    </a>
                </div>

            </div>
            <div class="row my-5">
                <div class="col-4">
                    <a href="img/984733.jpg" data-caption="Image caption">
                        <img src="img/984733.jpg" class="w-100 h-150 img" alt="First image">
                    </a>
                </div>
                <div class="col-4">
                    <a href="img/979162.jpg">
                        <img src="img/979162.jpg" class="w-100  h-150  img" alt="Second image">
                    </a>
                </div>
                <div class="col-4">
                    <a href="img/LeroLeroLeroLeroLero.jpg">
                        <img src="img/LeroLeroLeroLeroLero.jpg" class="w-100   img" alt="Second image">
                    </a>
                </div>

            </div>
        </div>
    </main>
    
 <footer class="beige2">
        <div class="beige2 container">
            <div class="beige2 row">
                <div class="beige2 col-4 my-5">
                    <ul>
                        <a>Кузовной авторемонт</a><br>
                        <a>Окраска автомобиля</a><br>
                        <a>Полировка</a><br>
                        <a>тел. 8-927-852-94-93</a><br>
                        <a>адрес: г.Чебоксары, ул. Плеханова, 13а</a><br>
                    </ul>
                    
                </div>
                <div class="beige2 col-7 d-flex align-items-center my-5">Мы совсем рядом. Найди нас в своем городе, чтобы приобрести по доступным ценам высококачественный ремонт. Мы предлагаем только качественную продукцию, которую любят наши клиенты.</div>

            </div>
        </div>
    </footer>
    
   
    <script src="js/baguetteBox.min.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>
    <script>
        $(document).ready(function() {
            baguetteBox.run('.gallery');
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        });

    </script>
</body>

</html>
