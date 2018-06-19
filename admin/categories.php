<?php include './includes/header.php' ?>
<?php include './functions.php' ?>
<?php deleteRow(); ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include './includes/navigation.php' ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>
                        <!--<ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
						</ol>-->
						<div class="col-xs-6">
							<?php submitRow(); ?>
							<form action="" method="post">
								<div class="form-group">
									<lable for="cat_title">Add Category</lable>
									<input class="form-control" type="text" name="cat_title">
								</div>
								<div class="form-group"><input class="btn btn-primary" type="submit" name="submit" value="Add Category"></div>
							</form>
							<?php createUpdateForm(); ?>
						</div>
						<div class="col-xs-6">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Category Title</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<?php populateTable(); ?>
									</tr>
								</tbody>
							</table>
						</div>
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