<?php
	function populatePosts() {
		global $connection;
		$query = "SELECT * FROM users";
		$users = mysqli_query($connection, $query);

		while($user = mysqli_fetch_assoc($users)) {
			$id = $user['user_id'];
			$username = $user['user_username'];
			$password = $user['user_password'];
			$email = $user['user_email'];
			$firstname = $user['user_firstname'];
			$lastname = $user['user_lastname'];
			$role = $user['user_role'];

			echo "<tr>
						<td>$id</td>
						<td>$username</td>
						<td>$firstname</td>
						<td>$lastname</td>
						<td>$password</td>
						<td>$email</td>
						<td>$role</td>
						<td><a href='users.php?source=edit_user&user_id=$id'> Edit</a></td>
						<td><a href='users.php?delete=$id' style='color:red' > DELETE</a></td>
						</tr>";
		}
	}

	function deleteComment() {
		if(isset($_GET['delete'])) {
			global $connection;
			$id = $_GET['delete'];

			$query = "DELETE FROM users WHERE user_id=$id";
			$deleteQuery = mysqli_query($connection, $query);
			if(confirm($deleteQuery)) {
				header('Location: users.php');
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
			<th>Username</th>
			<th>First Name</th>
			<th>Surname</th>
			<th>Password</th>
			<th>Email</th>
			<th>Role</th>
		</tr>
	</thead>
	<tbody>
		<?php populatePosts(); ?>
		<?php changeStatus(); ?>
		<?php deleteComment(); ?>
	</tbody>
</table>