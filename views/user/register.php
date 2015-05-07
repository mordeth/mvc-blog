<form method="POST">
	<div class="actionMessage"><?php echo $this->actionMessage; ?></div>
	<div class="inputField">
		<label>Your Name:</label>
		<input type="text" name="name" value="<?php if(isset($this->user)) { echo $this->user[0]['name']; } ?>"/>
	</div>
	<div class="inputField">
		<label>Username:</label>
		<input type="text" name="username" value="<?php if(isset($this->user)) { echo $this->user[0]['username']; } ?>" <?php if(isset($this->user)) { echo 'disabled="disabled"'; } ?>/>
	</div>
	<div class="inputField">
		<label>Password:</label> 
		<input type="password" name="password" />
	</div>
	
	<div class="inputField">
		<label>Repeat Password:</label> 
		<input type="password" name="repassword" />
	</div>

	<input type="submit" name="submit" value="<?php if(isset($this->user)) { echo 'Update'; } else { echo 'Register'; } ?>"/>
</form>