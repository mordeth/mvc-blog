<form method="POST">
	<?php if(!empty($this->actionMessage)): ?><div class="actionMessage"><?php echo $this->actionMessage; ?></div><?php endif; ?>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<?php if(!empty($this->title)): ?><h2><?php echo $this->title; ?></h2><?php endif; ?>
			<div class="inputField">
				<label>Post Title:</label>
				<input type="text" name="title"/>
			</div>
			<div class="inputField">
				<label>Post Content:</label>
				<textarea name="content"></textarea>
			</div>
			<div class="inputField">
				<label>Post Tags:</label>
				<input type="text" name="tags" data-role="tagsinput"/>
			</div>
			<input type="submit" name="submit" value="Publish"  class="button"/>
		</div>
	</div>
</form>