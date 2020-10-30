<?php include "./includes/admin_header.php"; ?>

<div id="wrapper">

    <?php include "./includes/admin_nav.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">

                <!-- Add Category Form-->
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Posts
                        <small>Author</small>
                    </h1>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Image</th>
                                <th>Tags</th>
                                <th>Comments</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php findAllPosts(); ?>
                        </tbody>
                    </table>

                </div>
                <!-- /.col-lg-12-->

            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "./includes/admin_footer.php"; ?>