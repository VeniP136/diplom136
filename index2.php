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
		<title>Автолюбителю</title>
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

	<body>

		<!-- Wrapper -->
			<div id="wrapper">

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
        <a class="nav-link" href="#">Автолюбителю</a>
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

				<!-- Main -->
					<div id="main" class="container">

						<!-- Post -->
							<article class="post">
								<?php foreach ($posts as $key => $post): ?>
								<header>
									<div class="title">
										<h2><a href="#"><?=$post['title']?></a></h2>
										<p><?=$post['subtitle']?></p>
									</div>
									<div class="meta">
										<time class="published"><?= date('d.m.Y', strtotime($post['timestamp']))?></time>
										<a href="#" class="author"><span class="name"><?= $post['login']?></span><img src="images/avatar.jpg" alt="" /></a>
									</div>
								</header>
								<a href="#" class="image featured"><img src="<?= $post['img_path']?>" alt="" /></a>
								<p><?=$post['resume']?></p>
								<footer>
									<ul class="actions">
										<li><a href="single.php?id=<?=$post['id'] ?>" class="button big">Редактировать</a></li>
									</ul>
									<ul class="stats">
                                        <li><a href="add_like.php?id=<?=$post['id']?>" class="icon fa-heart"><?=$post['count_likes']?></a></li>
                                        <li><a href="single.php?id=<?=$post['id']?>" class="icon fa-comment"><?=$post['count_com']?></a></li>
									</ul>
								</footer>
								<?php endforeach; ?>
							</article>				

					</div>

				

						

				
							

					

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>