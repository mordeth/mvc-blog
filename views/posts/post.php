<?php
if(!empty($this->post)) {
	$post = $this->post[0];
?>
	<div class="post marginTop">
		<div class="postImage"><img src="http://lorempixel.com/700/250" alt="Image"></div>
		<div class="row">
			<div class="col-md-2">
				<div class="smallbox published"><i class="fa fa-calendar"></i> <?php echo date("F j, Y", strtotime($post['date'])); ?></div>
				<div class="smallbox author"><i class="fa fa-user"></i> <a href="<?php echo ROOT_URL; ?>posts/byauthor/<?php echo $post['author']; ?>"><?php echo $post['author_user']; ?></a></div>
				<div class="smallbox views"><i class="fa fa-bar-chart"></i> <?php echo $post['views']; ?> views</div>
			</div>
			<div class="col-md-9">
				<h2><?php echo $post['title']; ?></h2>
				<div class="postContent">
					<?php echo $post['content']; ?>
				</div>
				<div class="tags">
					<?php 
					if(!empty($post['tags'])) { 
						$tags = 'Tags:';
						foreach($post['tags'] as $tag) {
							$tags .= ' <a href="'.ROOT_URL.'posts/bytag/'.$tag['title'].'">'.$tag['title'].'</a> / ';
						}	
						
						echo substr($tags, 0, -3);
					}
					?>
				</div>
			</div>
		</div>
		<div class="row comments">
			<div class="col-md-2"></div>
			<div class="col-md-9">
				<?php if(!empty($this->post_comments)): ?>
				<h3>Comments</h3>
					<!-- Comment -->
					<?php foreach($this->post_comments as $comment): ?>
					<div class="media comment">
						<a class="pull-left" href="#">
							<img class="media-object" src="<?php echo $this->model->get_gravatar($comment['email']); ?>" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">
								<?php if(!empty($comment['email'])): ?>
									<a href="mailto:<?php echo $comment['email']; ?>"><?php echo $comment['name']; ?></a>
								<?php else: ?>	
									<?php echo $comment['name']; ?>
								<?php endif; ?>
								<small class="pull-right"><?php echo $comment['date']; ?></small>
							</h4>
							<?php echo $comment['text']; ?>
						</div>
					</div>
					<?php endforeach; ?>
				<?php endif; ?>

				<h3 class="marginTop">Write a comment</h3>
				
				<?php if(!empty($this->actionMessage)): ?><div class="actionMessage"><?php echo $this->actionMessage; ?></div><?php endif; ?>
				
				<form method="POST">
					<?php if(!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])): ?>
					<div class="col-md-6">
						<input type="text" name="name" placeholder="Your name">
					</div>
					<div class="col-md-6">
						<input type="email" name="email" placeholder="Youer email (optional)">
					</div>
					<?php endif; ?>
					<div class="col-md-12">
						<textarea name="text" placeholder="Your comment"></textarea>
					</div>
					<div class="col-md-12"><input type="submit" name="submit" value="Comment" class="button"></div>
				</form>
			</div>
		</div>
	</div>
<?php
}