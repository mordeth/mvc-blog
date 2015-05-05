<form method="POST">
	<div class="actionMessage"><?php echo $this->actionMessage; ?></div>
	<div class="inputField">
		<label>Yout Name:</label>
		<input type="text" name="name" />
	</div>
	<div class="inputField">
		<label>Username:</label>
		<input type="text" name="username" />
	</div>
	<div class="inputField">
		<label>Password:</label> 
		<input type="password" name="password" />
	</div>
	
	<div class="inputField">
		<label>Repeat Password:</label> 
		<input type="password" name="repassword" />
	</div>

	<input type="submit" name="submit" value="Register"/>
</form>