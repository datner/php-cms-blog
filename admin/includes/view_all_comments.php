<?php
	function populatePosts() {
		global $connection;
		$query = "SELECT * FROM comments";
		$comments = mysqli_query($connection, $query);

		while($comment = mysqli_fetch_assoc($comments)) {
			$id = $comment['comment_id'];
			$postId = $comment['comment_post_id'];
			$author = $comment['comment_author'];
			$email = $comment['comment_email'];
			$content = $comment['comment_content'];
			$date = $comment['comment_date'];
			$status = $comment['comment_status'];

			global $connection;
			$query = "SELECT post_title FROM posts WHERE post_id = $postId";
			$post = mysqli_query($connection, $query);
			confirm($post);
			$post = mysqli_fetch_row($post);



			echo "<tr>
						<td>$id</td>
						<td>$author</td>
						<td>$email</td>
						<td><a href='../post.php?post_id=$postId' >{$post[0]}</a></td>
						<td>$content</td>
						<td>$date</td>
						<td>$status</td>
						<td><a href='comments.php?comment_id=$id&status=Approved' > Approve</a></td>
						<td><a href='comments.php?comment_id=$id&status=Unapproved'> Unapprove</a></td>
						<td><a href='comments.php?delete=$id'> delete</a></td>
						</tr>";
		}
	}

	function deleteComment() {
		if(isset($_GET['delete'])) {
			global $connection;
			$id = $_GET['delete'];

			$query = "DELETE FROM comments WHERE comment_id=$id";
			$deleteQuery = mysqli_query($connection, $query);
			if(confirm($deleteQuery)) {
				$query =
				"UPDATE posts SET post_comment_count + 1
				WHERE post_id = $postId";
				$updatePost = mysqli_query($connection,$query);
				confirm($updatePost);
				header('Location: comments.php');
			}
		}
	}

	function changeStatus() {
		if(isset($_GET['status'])) {
			global $connection;
			$id = $_GET['comment_id'];
			$status = $_GET['status'];

			$query = "UPDATE comments SET comment_status='$status' WHERE comment_id=$id";
			$statusQuery = mysqli_query($connection, $query);
			if(confirm($statusQuery)) {
				header('Location: comments.php');
			}
		}

	}

?>

<table class="table table-bordered table-hover" >
	<thead>
		<tr>
			<th>Id</th>
			<th>Author</th>
			<th>Email</th>
			<th>In Response To</th>
			<th>Comment</th>
			<th>Date</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php populatePosts(); ?>
		<?php changeStatus(); ?>
		<?php deleteComment(); ?>
	</tbody>
</table>