<!doctype html>
<html>
	<head>
		<title><?=$title?></title>
		<link rel="stylesheet" href="form.css" type="text/css">
		<meta charset="utf-8">
	</head>
	<body>
		<form action="addjoke.php" method="post">
			<div class="row">
				<div class="col-25">
					<label for = "joketext">Add a joke: </label>
				</div>
				<div class="col-75">
					<textarea id="joketext" name="joketext" style="height:200px"></textarea>
				</div>
			</div>
			<div class="row">
				<input type="submit" name="submit" id="submit" value="submit">
			</div>
		</form>
	</body>
</html>