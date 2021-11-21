<link rel="stylesheet" href="form.css">		
<?php if($userId == $joke['authorid']):?>
		<form action="" method="post">
			<input type="hidden" name="joke[id]" value="<?=$joke['id']?>">

			<div class="row">
				<div class="col-25">
					<label for = "joketext">Type your joke here: </label>
				</div>
				<div class="col-75">
					<textarea id="joketext" name="joke[joketext]" style="height:200px">
					<?= $joke['joketext']??'';?></textarea>
				</div>
			</div>
			<div class="row">
				<input type="submit" id="submit" value="Save">
			</div>
		</form>
<?php else:?>
<p>You can only edit jokes you created</p>
<?php endif;?>