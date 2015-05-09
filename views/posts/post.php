<?php
if(!empty($this->post)) {
	$post = $this->post[0];
?>
	<div class="post marginTop">
		<div class="postImage"><img src="http://photos2.appleinsidercdn.com/gallery/12086-5647-150309-MacBook-1-l.jpg" alt="Image"></div>
		<div class="row">
			<div class="col-md-2">
				<div class="smallbox published"><i class="fa fa-calendar"></i> <?php echo date("F j, Y", strtotime($post['date'])); ?></div>
				<div class="smallbox author"><i class="fa fa-user"></i> <a href=""><?php echo $post['author_user']; ?></a></div>
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
							$tags .= ' <a href="'.ROOT_URL.'posts/bytag/'.$tag['id'].'">'.$tag['title'].'</a> / ';
						}	
						
						echo substr($tags, 0, -3);
					}
					?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-9">
				 <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="<?php echo $this->model->get_gravatar('cvetanov@gmail.com'); ?>" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small class="pull-right">August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>
			</div>
		</div>
	</div>
<?php
}