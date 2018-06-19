<?php include './includes/header.php' ?>
<?php include './functions.php' ?>

<?php

function display() {
	$source = '';
	if(isset($_GET['source'])) {
		$source = $_GET['source'];
	}
	switch ($source) {
		case 'add_post':
			include "includes/add_post.php";
			break;

		case 'edit_post':
			include "includes/edit_post.php";
			break;

		default:
			include "includes/view_all_comments.php";
			break;
	}
}

?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include './includes/navigation.php' ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            View Posts
                            <small>Admin</small>
                        </h1>
                        <!--<ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
						</ol>-->
						<?php display(); ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
<?php include './includes/footer.php' ?>