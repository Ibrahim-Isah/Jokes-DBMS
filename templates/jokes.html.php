<!doctype html>
<html>
<head>
	<title>List of Jokes</title>
	<meta charset="utf8">
</head>
<body>
	<?php if(isset($error)):?>
	<p><?php echo $error?></p>
	<?php else:?>
	<?php  foreach($jokes as $joke):?>
	<blockquote>
	<!-- the code below displays the jokes and also allow the edit and delete button to be visible to the eyes-->
	
		<p style="background-image:url(jokes.jpg); background-size:cover; opacity:1;">
			<?php echo htmlspecialchars($joke['joketext'] , ENT_QUOTES , 'utf-8');//print each joke?>
			(by <a href = "mailto: <?=htmlspecialchars($joke['email'] , ENT_QUOTES , 'UTF-8' );//link to sending email?>">
			<?=htmlspecialchars($joke['name'] , ENT_QUOTES , 'UTF-8');//displays name of author of joke?></a>
			on <i><?php $date = new DateTime($joke['jokedate']);
			echo $date->format('jS F Y');//using the DateTime class to create instance and give the format of date?></i>)
			<?php if($userId == $joke['authorid']):?>
				<a href="index.php?route=joke/edit&id=<?=$joke['id'];?>" class="top">Edit</a>
				<form action="index.php?route=joke/deleteall" method="post">
					<input type="hidden" name="id" value="<?=$joke['id'];//gives the id of the joke to be deleted?>">
					<input type="submit" value="DELETE">
				</form>
			<?php endif;?>	
		</p>
	</blockquote>
	
	<?php endforeach;?>
	<?php endif;?>

</body>
</html>