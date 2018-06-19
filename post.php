<?php include "./includes/header.php" ?>
<?php include "./includes/navigation.php" ?>
<?php include "./admin/functions.php" ?>

<?php

function displayPost() {
    if(isset($_GET['post_id'])){
        global $connection;
        $query = "SELECT * FROM posts WHERE post_id = {$_GET['post_id']}";
        $posts = mysqli_query($connection, $query);

        $post = mysqli_fetch_assoc($posts);
        $title = $post['post_title'];
        $author = $post['post_author'];
        $date = $post['post_date'];
        $image = './images/' . $post['post_image'];
        $content = $post['post_content'];

        if ($image ==  '') {
            $image = "http://placehold.it/900x300";
        }
        echo "
                <h2>
                $title
                </h2>
                <p class='lead'>
                by
                <a href='index.php'> $author</a>
                </p>
                <p>
                <span class='glyphicon glyphicon-time'></span> Posted on $date</p>
                <hr>
                <img class='img-responsive' src='$image' alt=''>
                <hr>
                <p>$content</p>
                <hr>
                ";
            } else {
                echo "404 Post not found";
            }

        }

        function fetchComments() {
            if(isset($_GET['post_id'])) {
                global $connection;
                $id = $_GET['post_id'];
                $query = "SELECT * FROM comments
                         WHERE comment_post_id = $id
                         AND comment_status = 'Approved'
                         ORDER BY comment_id DESC";
        $comments = mysqli_query($connection, $query);
        confirm($comments);

        while($comment = mysqli_fetch_assoc($comments)) {
            $author = $comment['comment_author'];
            $content = $comment['comment_content'];
            $date = $comment['comment_date'];

            echo "
            <div class='media'>
                <a class='pull-left' href='#'>
                    <img class='media-object' src='http://placehold.it/64x64' alt=''>
                </a>
                <div class='media-body'>
                    <h4 class='media-heading'><strong>$author</strong>
                        <small>$date</small>
                    </h4>
                    $content
                </div>
            </div>
            ";
        }
    }
}
function submitComment() {
    if(isset($_POST['comment_submit'])) {
        global $connection;
        $postId = $_GET['post_id'];
        $author = $_POST['comment_author'];
        $email = $_POST['comment_email'];
        $content = $_POST['comment_content'];

        $query = "INSERT INTO comments(comment_post_id,comment_author,comment_email,comment_content,comment_date)
                        VALUES($postId, '$author', '$email', '$content', now()) ";
        $sendComment = mysqli_query($connection, $query);
        confirm($sendComment);
        $query =
        "UPDATE posts SET post_comment_count + 1
         WHERE post_id = $postId";
         $updatePost = mysqli_query($connection,$query);
         confirm($updatePost);
    }
}

?>
	<!-- Page Content -->
	<div class="container">

		<div class="row">

			<!-- Blog Entries Column -->
			<div class="col-md-8">
			<h1 class="page-header">
				Page Heading
				<small>Secondary Text</small>
			</h1>

				<?php displayPost(); ?>



                 <!-- Posted Comments -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group col-xs-6">
                            <label for="comment_author">Name</label>
                           <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group col-xs-6">
                            <label for="comment_email">Email</label>
                           <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group col-xs-12">
                            <label for="comment_content">Comment</label>
                            <textarea name="comment_content" id="" rows="5" class="form-control"></textarea>
                        </div>
                        <button type="submit" name="comment_submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <!-- Comment -->
                <?php fetchComments() ?>
                <?php submitComment() ?>
			</div>
            <?php include "./includes/sidebar.php" ?>
            <?php include "./includes/footer.php" ?>