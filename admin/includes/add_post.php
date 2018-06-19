
<?php
	if(isset($_POST['create_post'])) {
		global $connection;
		$title = $_POST['title'];
		$author = $_POST['author'];
		$categoryId = $_POST['cat_id'];
		$status = $_POST['status'];

		$image = $_FILES['image']['name'];
		$tmpImage = $_FILES['image']['tmp_name'];

		$tags = $_POST['tags'];
		$content = $_POST['content'];
		$date = date('d-m-y');

		move_uploaded_file($tmpImage, "../images/$image");

		$query="
					INSERT INTO posts(post_cat_id, post_title, post_content, post_author, post_date, post_image, post_tags, post_status)
					VALUES($categoryId, '$title', '$content', '$author', now(), '$image', '$tags', '$status')
					";

		$postQuery = mysqli_query($connection,$query);
		confirm($postQuery);

	}

	function populateCategories() {
		global $connection;
	$query = "SELECT * FROM catagories";
	$catagories = mysqli_query($connection, $query);
	confirm($catagories);

	while($catagory = mysqli_fetch_assoc($catagories)) {
		echo "<option value='{$catagory['cat_id']}'> {$catagory['cat_title']}</option>";
	}
	}
?>

<form action="" method="post" enctype="multipart/form-data" >
	<div class="form-group col-xs-12">
		<lable for="title">Title</lable>
		<input type="text" name="title" id="" class="form-control">
	</div>
	<div class="form-group col-xs-4">
		<lable for="cat_id">Category</lable>
		<select name="cat_id" id="" class="form-control">
			<?php populateCategories(); ?>
		</select>
	</div>
	<div class="form-group col-xs-4">
		<lable for="author">Author</lable>
		<input type="text" name="author" id="" class="form-control">
	</div>
	<div class="form-group col-xs-4">
		<lable for="status">Status</lable>
		<select name="status" id="" class="form-control">
			<option value="Draft">Draft</option>
			<option value="Published">Published</option>
		</select>
	</div>
	<div class="form-group col-xs-4">
		<lable for="image">Upload Image</lable>
		<input type="file" name="image" id="" class="form-control">
	</div>
	<div class="form-group col-xs-8">
		<lable for="tags">Tags</lable>
		<input type="text" name="tags" id="" class="form-control">
	</div>
	<div class="form-group col-xs-12">
		<lable for="content">Content</lable>
		<textarea name="content" id="" cols="30"  rows="10" class="form-control"></textarea>
	</div>
	<div class="form-group col-xs-1">
		<input type="submit" value="Publish Post" class="btn btn-primary" name="create_post">
	</div>
</form>