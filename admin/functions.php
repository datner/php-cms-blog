<?php

function confirm($query) {
	global $connection;
	if (!$query) {
		die("QUERY FAILED " . mysqli_error($connection));
		return false;
	} else {
		return true;
	}
}


function populateTable() {
	global $connection;
	$query = "SELECT * FROM catagories";
	$catagories = mysqli_query($connection, $query);
	confirm($catagories);

	while($row = mysqli_fetch_assoc($catagories)) {
		$id = $row['cat_id'];
		$title = $row['cat_title'];
		echo "<tr>
					<td>$id</td>
					<td>$title</td>
					<td><a href='categories.php?delete=$id'>Delete</a></td>
					<td><a href='categories.php?edit=$id'>Edit</a></td>
				</tr>";
	}
}

function submitRow() {
	if(isset($_POST['submit'])) {
		global $connection;
		$title = $_POST['cat_title'];

		if($title == "" || empty($title)) {
			echo "This field should not be empty.";
		} else {
			$query = "INSERT INTO catagories(cat_title)
							VALUES('$title')";
			$create_cat_query = mysqli_query($connection, $query);
			confirm($create_cat_query);

		}
	}
}

function deleteRow() {
	if(isset($_GET['delete'])) {
		global $connection;
		$id = $_GET['delete'];
		$query = "DELETE FROM catagories WHERE cat_id = $id";
		$deleteQuery = mysqli_query($connection, $query);

		if (confirm($deleteQuery)) {
			header("Location: categories.php");
		}

	}
}

function getEditCatName() {
	if (isset($_GET['edit'])) {
		global $connection;
		$id = $_GET['edit'];
		if (isset($_POST['update'])) {
			$title = $_POST['cat_title'];
			$query = "UPDATE catagories SET cat_title ='$title' WHERE cat_id = $id";
			$updateQuery = mysqli_query($connection, $query);
			confirm($updateQuery);
		} else {
			$query = "SELECT * FROM catagories WHERE cat_id = $id";
			$editQuery = mysqli_query($connection, $query);
			confirm($editQuery);
			return mysqli_fetch_assoc($editQuery)['cat_title'];
		}
	}
}

function createUpdateForm() {
	global $connection;
	if (isset($_POST['update'])) {
		$title = $_POST['cat_title'];
		$id = $_GET['edit'];
		$query = "UPDATE catagories SET cat_title ='$title' WHERE cat_id = $id"; #UPDATE categories SET cat_title=
		$updateQuery = mysqli_query($connection, $query);
		header('Location: categories.php');
	} elseif (isset($_GET['edit'])) {
		$title = getEditCatName();
		echo "
		<form action='' method='post'>
			<div class='form-group'>
				<lable for='cat_title'>Edit Category</lable>
				<input class='form-control' type='text' name='cat_title' value=$title >
			</div>
			<div class='form-group'><input class='btn btn-primary' type='submit' name='update' value='Update Category'></div>
		</form>
				";
	}
}
?>