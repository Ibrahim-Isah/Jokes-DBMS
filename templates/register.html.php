<?php if(!empty($error)):?>
<div class="error">
	<p>Please refill your form and fill all gaps</p>

	<ul>
		<?php foreach($error as $err):?>
		<li><?=$err?></li>
		<?php endforeach;?>
	</ul>

</div>
	<?php endif;?>
<html>
	<head>
		<title><?=$title?></title>
		<link rel="stylesheet" href="something.css">
	</head>
	<body>
		<form  action="" method="post"> <!-- we can use the post when we dont want it to appear on the URL. we use post in places that should be secure-->
			<div class="container">
				<form>
					<div class = "row">
						<div class = "col-25">
							<label for= "name">Full Name: </label>
						</div>
						<div class = "col-75">
							<input type="text" name = "author[name]" value = "<?php $author['name'] ?? '';?>" placeholder="Ummi Abraham">
						</div>
					</div>
					<div class = "row">
						<div class = "col-25">
							<label for= "email">Email: </label>
						</div>
						<div class = "col-75">
							<input type="email" name="author[email]" placeholder="example@email.com">
						</div>
					</div>
					<div class = "row">
						<div class = "col-25">
							<label for= "password">Password: </label>
						</div>
						<div class = "col-75">
							<input type="password" name="author[password]" >
						</div>
					</div>
					<div class="row">
						<div class="col-75">
							<input type="submit" name="submit" id="submit" value="Register">
						</div>
					</div>
				</form>
			</div>
			<p>Already have an account?<a href= "index.php?route=login">Click here to login</a></p>
		</form>
	</body>
</html>