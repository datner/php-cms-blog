<?php include "./includes/header.php" ?>
<?php include "./includes/navigation.php" ?>
	<!-- Page Content -->
	<div class="container">

		<div class="row">

			<!-- Blog Entries Column -->
			<div class="col-md-8">
			<h1 class="page-header">
				Page Heading
				<small>Secondary Text</small>
			</h1>

				<?php

				$query = "SELECT * FROM posts WHERE post_status = 'Published' ";
				$posts = mysqli_query($connection, $query);

				while ($post = mysqli_fetch_assoc($posts)) {
					$id = $post['post_id'];
					$title = $post['post_title'];
					$author = $post['post_author'];
					$date = $post['post_date'];
					$image = './images/' . $post['post_image'];
					$content = substr($post['post_content'],0,100). '...';

					if ($image ==  '') {
						$image = "http://placehold.it/900x300";
					}
					?>

						<!-- First Blog Post -->
						<h2>
							<a href="post.php?post_id=<?php echo $id ?>"><?php echo $title ?></a>
						</h2>
						<p class="lead">
							by
							<a href="index.php"><?php echo $author ?></a>
						</p>
						<p>
							<span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date ?></p>
						<hr>
						<img class="img-responsive" src="<?php echo $image; ?>" alt="">
						<hr>
						<p><?php echo $content ?></p>
						<a class="btn btn-primary" href="post.php?post_id=<?php echo $id ?>">Read More
							<span class="glyphicon glyphicon-chevron-right"></span>
						</a>

						<hr>


					<?php

				}

				?>

				<!-- Pager -->
				<ul class="pager">
					<li class="previous">
						<a href="#">&larr; Older</a>
					</li>
					<li class="next">
						<a href="#">Newer &rarr;</a>
					</li>
				</ul>

			</div>
            <?php include "./includes/sidebar.php" ?>
            <?php include "./includes/footer.php" ?>