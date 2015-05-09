<form method="POST">
	<?php if(!empty($this->actionMessage)): ?><div class="actionMessage"><?php echo $this->actionMessage; ?></div><?php endif; ?>
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<?php if(!empty($this->title)): ?><h2><?php echo $this->title; ?></h2><?php endif; ?>
			<div class="inputField">
				<label>Your Name:</label>
				<input type="text" name="name" value="<?php if(isset($this->user)) { echo $this->user[0]['name']; } ?>"/>
			</div>
			<div class="inputField">
				<label>Username:</label>
				<input type="text" name="username" value="<?php if(isset($this->user)) { echo $this->user[0]['username']; } ?>" <?php if(isset($this->user)) { echo 'disabled="disabled"'; } ?>/>
			</div>
			<div class="inputField">
				<label>Email:</label>
				<input type="email" name="email" value="<?php if(isset($this->user)) { echo $this->user[0]['email']; } ?>"/>
			</div>
			<div class="inputField">
				<label>Password:</label> 
				<input type="password" name="password" />
			</div>
			
			<div class="inputField">
				<label>Repeat Password:</label> 
				<input type="password" name="repassword" />
			</div>

			<input type="submit" name="submit" class="button" value="<?php if(isset($this->user)) { echo 'Update'; } else { echo 'Register'; } ?>"/>
		</div>
	</div>
</form>