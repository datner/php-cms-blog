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

				if(isset($_GET['cat_id'])){
					$catId = $_GET['cat_id'];
					$query = "SELECT * FROM posts WHERE post_cat_id = $catId AND post_status = 'Published' ";
					$posts = mysqli_query($connection, $query);

					while ($post = mysqli_fetch_assoc($posts)) {
						$id = $post['post_id'];
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
									<a href='post.php?post_id= $id'> $title </a>
								</h2>
								<p class='read'
									by
									<a href='index.php'> $author </a>
								</p>
								<p>
									<span class='glyphicon glyphicon-time'></span> Posted on $date </p>
								<hr>
								<img class='img-responsive'src='$image 'alt='' >
								<hr>
								<p> $content </p>
								<a class='btn btn-primary'href='post.php?post_id= $id' >Read More
									<span class='glyphicon glyphicon-chevron-right' ></span>
								</a>
								";
					}
				} else {
					echo "404";
				}

					?>


						<hr>

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