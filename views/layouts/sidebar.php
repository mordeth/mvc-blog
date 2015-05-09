<div class="row">
	<div class="col-md-4 sidebar">
		<div class="logo">Blog</div>
		<div class="description">Another PHP MVC blog</div>
		<ul class="nav">
			<li>
				<a href="<?php echo ROOT_URL; ?>">Home</a>
			</li>
			<?php if(empty($this->logged_in_user)) { ?>
			<li>
				<a href="<?php echo ROOT_URL; ?>user/register">Register</a>
			</li>
			<li>
				<a href="<?php echo ROOT_URL; ?>user/login">Login</a>
			</li>
			<?php } else { ?>
			<li>
				<a href="<?php echo ROOT_URL; ?>user/profile">Profile</a>
			</li>
			<li>
				<a href="<?php echo ROOT_URL; ?>user/logout">Logout</a>
			</li>
			<?php } ?>
		</ul>
	</div>
	<div class="col-md-8 content">