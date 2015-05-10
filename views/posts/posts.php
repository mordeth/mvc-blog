<?php
if(!empty($this->posts)) {
	$i = 0;
	if(!empty($this->archive_title)) {
		echo '<h1>Posts by '.$this->archive_type.': '.$this->archive_title.'</h1>';
	}
	foreach($this->posts as $post) {
		?>
			<div class="post <?php if($i == 0) { echo 'marginTop'; } ?>">
				<div class="postImage"><img src="http://photos2.appleinsidercdn.com/gallery/12086-5647-150309-MacBook-1-l.jpg" alt="Image"></div>
				<div class="row">
					<div class="col-md-2">
						<div class="smallbox published"><i class="fa fa-calendar"></i> <?php echo date("F j, Y", strtotime($post['date'])); ?></div>
						<div class="smallbox author"><i class="fa fa-user"></i> <a href=""><?php echo $post['author_user']; ?></a></div>
						<div class="smallbox views"><i class="fa fa-bar-chart"></i> <?php echo $post['views']; ?> views</div>
					</div>
					<div class="col-md-9">
						<h2><a href="<?php echo ROOT_URL; ?>posts/view/<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
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
			</div>
		<?php
		$i++;
	}
} else {
	echo '<h1>No posts match your criteriea'; 
}