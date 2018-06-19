<?php

function userGet($item = '') {
	if(isset($_GET['user_id'])) {
		global $connection;
		$userId = $_GET['user_id'];
		$query = "SELECT * FROM users WHERE user_id = $userId";
		$user = mysqli_query($connection, $query);
		$user = mysqli_fetch_assoc($user);
		if(!defined('ROLE')) {
			define('ROLE', $user['user_role']);
		}
		switch ($item) {
			case 'username':
				echo $user['user_username'];
				break;

			case 'password':
				echo $user['user_password'];
				break;

			case 'firstname':
				echo $user['user_firstname'];
				break;

			case 'lastname':
				echo $user['user_lastname'];
				break;

			case 'email':
				echo $user['user_email'];
				break;

			case 'image':
				echo $user['user_image'];
				break;

			default:
				echo $user['user_role'];
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

if(isset($_POST['edit_user'])) {
	global $connection;
	$username = $_POST['username'];
	$password = $_POST['password'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];

	$image = $_FILES['image']['name'];
	$tmpImage = $_FILES['image']['tmp_name'];

	$email = $_POST['email'];
	$role = $_POST['role'];

	move_uploaded_file($tmpImage, "../images/$image");

	if(empty($image)) {
		$query = " SELECT user_image FROM users WHERE user_id = {$_GET['user_id']}";
		$image = mysqli_query($connection, $query);

		$image = mysqli_fetch_assoc($image);
		$image = $image['user_image'];
	}

	$query="
				UPDATE users SET
				user_username = '$username',
				user_password = '$password',
				user_firstname = '$firstname',
				user_lastname = '$lastname',
				user_role = '$role',
				user_email = '$email',
				user_image = '{$image[0]}'
				WHERE user_id = {$_GET['user_id']}
				";

	$updateQuery = mysqli_query($connection,$query);
	if (confirm($updateQuery)) {
		header("Location: users.php");
	}

}
function checkSelected($role) {
	if ($role == ROLE) {
		echo 'selected';
	}
}

?>

<form action="" method="post" enctype="multipart/form-data" >
	<div class="form-group col-xs-3">
		<lable for="username" > Username</lable>
		<input type="text" value="<?php userGet('username'); ?>" name="username" id="" class="form-control">
	</div>
	<div class="form-group col-xs-3">
		<lable for="password">Password</lable>
		<input type="text" name="password" value="<?php userGet('password'); ?>" id="" class="form-control">
	</div>
	<div class="form-group col-xs-3">
		<lable for="firstname">First Name</lable>
		<input type="text" name="firstname" value="<?php userGet('firstname'); ?>" id="" class="form-control">
	</div>
	<div class="form-group col-xs-3">
		<lable for="lastname">Last Name</lable>
		<input type="text" name="lastname" id="" value="<?php userGet('lastname'); ?>" class="form-control">
	</div>
	<div class="form-group col-xs-4">
		<lable for="email">Email</lable>
		<input type="text" name="email" id="" value="<?php userGet('email'); ?>" class="form-control">
	</div>
	<div class="form-group col-xs-2">
		<lable for="role">Role</lable>
		<select name="role" id="" class="form-control">
			<option value="Admin" <?php checkSelected('Admin'); ?>>Admin</option>
			<option value="User" <?php checkSelected('User'); ?> >User</option>
		</select>
		</select>
	</div>
	<div class="form-group col-xs-2">
		<lable for="image">Upload Image</lable>
		<input type="file" name="image" id="" class="form-control">
	</div>
	<div class="form-group col-xs-4">
		<lable for="image">Image</lable>
		<img src="../images/<?php userGet('image'); ?>" class="form-control img-responsive" alt="">
	</div>
	<div class="form-group col-xs-1">
		<input type="submit" value="Edit User" class="btn btn-primary" name="edit_user">
	</div>
</form>