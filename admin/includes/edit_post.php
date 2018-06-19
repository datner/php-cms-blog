<?php

function postGet($item = '') {
	if(isset($_GET['p_id'])) {
		global $connection;
		$postId = $_GET['p_id'];
		$query = "SELECT * FROM posts WHERE post_id = $postId";
		$post = mysqli_query($connection, $query);
		$post = mysqli_fetch_assoc($post);

		if(!defined('CAT_ID')) {
			define('CAT_ID', $post['post_cat_id']);
		}
		if(!defined('STATUS')) {
			define('STATUS', $post['post_status']);
		}
		switch ($item) {
			case 'author':
				echo $post['post_author'];
				break;

			case 'cat_id':
				echo $post['post_cat_id'];
				break;

			case 'status':
				echo $post['post_status'];
				break;

			case 'image':
				echo $post['post_image'];
				break;

			case 'tags':
				echo $post['post_tags'];
				break;

			case 'content':
				echo $post['post_content'];
				break;

			default:
				echo $post['post_title'];
				break;
		}
	}
}

function getCategories() {
	global $connection;
	$query = "SELECT * FROM catagories";
	$catagories = mysqli_query($connection, $query);
	confirm($catagories);

	while($row = mysqli_fetch_assoc($catagories)) {
		$id = $row['cat_id'];
		$title = $row['cat_title'];
		$selected = '';
		if ($id == CAT_ID) {
			$selected = 'selected';
		}
		echo "<option value='$id' $selected >$title</option>";
	}
}

if(isset($_POST['edit_post'])) {
	global $connection;
	$author = $_POST['author'];
	$title = $_POST['title'];
	$categoryId = $_POST['cat_id'];
	$status = $_POST['status'];
	if(!defined(STATUS)) {
		define('STATUS', $status);
	}

	$image = $_FILES['image']['name'];
	$tmpImage = $_FILES['image']['tmp_name'];

	$content = $_POST['content'];
	$tags = $_POST['tags'];

	move_uploaded_file($tmpImage, "../images/$image");

	if(empty($image)) {
		$query = " SELECT post_image FROM posts WHERE post_id = {$_GET['p_id']}";
		$image = mysqli_query($connection, $query);

		$image = mysqli_fetch_assoc($image);
		$image = $image['post_image'];
	}

	$query="
				UPDATE posts SET
				post_title = '$title',
				post_cat_id = $categoryId,
				post_date = now(),
				post_author = '$author',
				post_tags = '$tags',
				post_status = '$status',
				post_content = '$content',
				post_image = '$image'
				WHERE post_id = {$_GET['p_id']}
				";

	$updateQuery = mysqli_query($connection,$query);
	if (confirm($updateQuery)) {
		header("Location: posts.php");
	}

}
function checkSelected($status) {
	if ($status == STATUS) {
		echo 'selected';
	}
}

?>

<form action="" method="post" enctype="multipart/form-data" >
	<div class="form-group col-xs-12">
		<lable for="title" >Title</lable>
		<input type="text" value="<?php postGet(); ?>" name="title" id="" class="form-control">
	</div>
	<div class="form-group col-xs-4">
		<lable for="cat_id">Category</lable>
		<select name="cat_id" value="<?php postGet('cat_id'); ?>" id="" class="form-control">
			<?php getCategories(); ?>
		</select>
	</div>
	<div class="form-group col-xs-4">
		<lable for="author">Author</lable>
		<input type="text" name="author" value="<?php postGet('author'); ?>" id="" class="form-control">
	</div>
	<div class="form-group col-xs-4">
		<lable for="status">Status</lable>
		<select name="status" id="" class="form-control">
			<option value="Draft" <?php checkSelected('Draft'); ?>>Draft</option>
			<option value="Published" <?php checkSelected('Published'); ?> >Published</option>
		</select>
		</select>
	</div>
	<div class="form-group col-xs-2">
		<lable for="image">Upload Image</lable>
		<input type="file" name="image" id="" value="<?php postGet('image'); ?>" class="form-control">
	</div>
	<div class="form-group col-xs-2">
		<lable for="image">Image</lable>
		<img src="../images/<?php postGet('image'); ?>" class="form-control img-responsive" alt="">
	</div>
	<div class="form-group col-xs-8">
		<lable for="tags">Tags</lable>
		<input type="text" name="tags" id="" value="<?php postGet('tags'); ?>" class="form-control">
	</div>
	<div class="form-group col-xs-12">
		<lable for="content">Content</lable>
		<textarea name="content" id="" cols="30"  rows="10" class="form-control"><?php postGet('content'); ?></textarea>
	</div>
	<div class="form-group col-xs-1">
		<input type="submit" value="Edit Post" class="btn btn-primary" name="edit_post">
	</div>
</form>