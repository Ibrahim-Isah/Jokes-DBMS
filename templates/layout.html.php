<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet"  href="joke.css">
		<meta name="viewport" content="width=device-width ,initial-scale=1.0">
		<title><?=$title?></title>

	</head>
	<body>
		<header>
			<p>INTERNET JOKES DATABASE</p>
		</header>
		<nav>
			<ul>
				<li><a href = "index.php?route=joke/home">Home</a></li>
				<li><a href = "index.php?route=joke/list">Jokes List</a></li>
				<li><a href = "index.php?route=joke/edit">Add jokes</a></li>
				<?php if($loggedIn): ?>
				<li><a href = "index.php?route=logout">Log out</a></li>
				<?php else:?>
				<li><a href = "index.php?route=login">Log in</a></li>
				<?php endif;?>
			</ul>
		</nav>
		<main>
			<?php echo $output;?>
		</main>
		<footer>
			<?php echo "&copy; Muhammad's tech ". date('Y');?>
		</footer>
	</body>
</html>