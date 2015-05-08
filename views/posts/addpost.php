<form method="POST">
	<div class="actionMessage"><?php echo $this->actionMessage; ?></div>
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
	<input type="submit" name="submit" value="Publish"/>
</form>