<form method="POST">
	<?php if(!empty($this->actionMessage)): ?><div class="actionMessage"><?php echo $this->actionMessage; ?></div><?php endif; ?>
	
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
			<div class="inputField">
				<label>Username:</label>
				<input type="text" name="username" />
			</div>
			<div class="inputField">
				<label>Password:</label> 
				<input type="password" name="password" />
			</div>

			<input type="submit"  class="button" name="submit" value="Sign up"/>
		</div>
	</div>
</form>