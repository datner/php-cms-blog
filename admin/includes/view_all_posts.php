<?php
	function populatePosts() {
		global $connection;
		$query = "SELECT * FROM posts";
		$posts = mysqli_query($connection, $query);

		while($post = mysqli_fetch_assoc($posts)) {
			$id = $post['post_id'];
			$author = $post['post_author'];
			$title = $post['post_title'];
			$categoryId = $post['post_cat_id'];
			$status = $post['post_status'];
			$image = $post['post_image'];
			$tags = $post['post_tags'];
			$commentCount = $post['post_comment_count'];
			$date = $post['post_date'];

			global $connection;
			$query = "SELECT cat_title FROM catagories WHERE cat_id = $categoryId";
			$category = mysqli_query($connection, $query);
			confirm($category);
			$category = mysqli_fetch_row($category);



			echo "<tr>
						<td>$id</td>
						<td>$author</td>
						<td>$title</td>
						<td>{$category[0]}</td>
						<td>$status</td>
						<td><img width='100' src='../images/$image'></td>
						<td>$tags</td>
						<td>$commentCount</td>
						<td>$date</td>
						<td><a href='posts.php?source=edit_post&p_id=$id' > Edit</a></td>
						<td><a href='posts.php?delete=$id'> Delete</a></td>
						</tr>";
		}
	}

	function deletePost() {
		global $connection;
		if(isset($_GET['delete'])) {
			$id = $_GET['delete'];

			$query = "DELETE FROM posts WHERE post_id=$id";
			$deleteQuery = mysqli_query($connection, $query);
			if(confirm($deleteQuery)) {
				header('Location: posts.php');
			}
		}
	}

?>

<table class="table table-bordered table-hover" >
	<thead>
		<tr>
			<th>Id</th>
			<th>Author</th>
			<th>Title</th>
			<th>Category</th>
			<th>Status</th>
			<th>Image</th>
			<th>Tags</th>
			<th>Comments</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
		<?php populatePosts(); ?>
		<?php deletePost(); ?>
	</tbody>
</table>