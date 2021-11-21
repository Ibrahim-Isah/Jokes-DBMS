<?php if(isset($error)):
    echo '<div class="error">' . $error . '</div>';
endif;    
?>
<form  action="" method="post"> <!-- we can use the post when we dont want it to appear on the URL. we use post in places that should be secure-->
			<div class="container">
				<form>
					<div class = "row">
						<div class = "col-25">
							<label for= "email">Email: </label>
						</div>
						<div class = "col-75">
							<input type="text" name = "email" id="email" placeholder="Ummi Abraham">
						</div>
					</div>
					<div class = "row">
						<div class = "col-25">
							<label for= "password">Password: </label>
						</div>
						<div class = "col-75">
							<input type="password" name="password" id="password" >
						</div>
					</div>
					<div class="row">
						<div class="col-75">
							<input type="submit" name="submit" id="submit" value="Register">
						</div>
					</div>
				</form>
			</div>

		</form>
        <p> Don't have an account yet?</p>
        <p><a href = "index.php?route=author/register">Click here to new account</a></p>
