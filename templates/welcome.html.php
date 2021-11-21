<html>
<head>
	<title>form example</title>
	<meta charset='utf-8'>
	<link rel='stylesheet' href='form.html'>
</head>
<body>
	<p>
	<?php echo $output;?><br>
	<?php
		if(!isset($_COOKIE[$cookie_name])){
			"cookie named '" . $cookie_name . "' is not set";
		} else {
			"cookie named '" . $cookie_name . "' is set<br>";
			"cookie value is " . $_COOKIE[$cookie_name];
		}
		
	?>
	</p>
	<form action = "jokes.php" method = "">
		<label for = 'jokes'>To view our jokes page, click on the button</label>
		<input type  = "submit" name="submit" id="submit" value="Jokes">
	</form>
</body>
</html>