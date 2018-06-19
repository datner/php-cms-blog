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

				if (isset($_POST['submit'])) {
					$search = $_POST['search'];

					$query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' AND post_status = 'Published' ";
					$posts = mysqli_query($connection, $query);

					if (!$posts) {
						die( "ERROR!! " . mysqli_error($connection));
					}

					$count = mysqli_num_rows($posts);

					if ($count == 0) {
						echo "<h1>NO RESULTS</h1>";
					}

				} else {
					$query = "SELECT * FROM posts WHERE post_status = 'Published' ";
					$posts = mysqli_query($connection, $query);
				}


				while ($post = mysqli_fetch_assoc($posts)) {
					$title = $post['post_title'];
					$author = $post['post_author'];
					$date = $post['post_date'];
					$image = './images/' . $post['post_image'];
					$content = $post['post_content'];

					if ($image ==  '') {
						$image = "http://placehold.it/900x300";
					}
					?>

						<!-- First Blog Post -->
						<h2>
							<a href="#"><?php echo $title ?></a>
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
						<a class="btn btn-primary" href="#">Read More
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