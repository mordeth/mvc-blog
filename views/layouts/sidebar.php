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
				<a href="<?php echo ROOT_URL; ?>posts/add">Add new post</a>
			</li>
			<li>
				<a href="<?php echo ROOT_URL; ?>user/profile">Profile</a>
			</li>
			<li>
				<a href="<?php echo ROOT_URL; ?>user/logout">Logout</a>
			</li>
			<?php } ?>
		</ul>
		
		<div class="search">
			<form class="input-group form-group" method="post" action="<?php echo ROOT_URL; ?>posts/search">
				<input type="text" class="form-control" placeholder="Search posts by tag..." name="search">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-default button">
						<span class="fa fa-search" aria-hidden="true"></span>
					</button>
				</span>
			</form>
		</div>
		
		<div class="popular_tags">
			<?php if(!empty($this->popular_tags)): ?>
				<h3>Popular tags</h3>
				<ul>
				<?php foreach($this->popular_tags as $tag): ?>
					<?php if(!empty($tag[1])): ?>
						<li><a href="<?php echo ROOT_URL; ?>posts/bytag/<?php echo $tag[1]; ?>"><?php echo $tag[1]; ?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		
		<div class="archive">
			<?php if(!empty($this->archives)): ?>
				<h3>Archive</h3>
				<ul>
				<?php foreach($this->archives as $archive): ?>
					<li><a href="<?php echo ROOT_URL; ?>posts/bydate/<?= $archive['year'] . '/' . $archive['month'] ?>"><?= $archive['monthname'] . ' ' . $archive['year'] ?></a></li>
				<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

	</div>
	<div class="col-md-8">