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
                        Categories
                        <small>Author</small>
                    </h1>
                    <div class="col-xs-6">

                    <?php insert_cat(); ?>

                        <form action="" method="post">
                            <div class="form-group">
                                <label for="cat_title">New Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add">
                            </div>
                        </form>

                        <hr>

                        <?php

                        // UPDATE AND INCLUDE QUERY

                        if(isset($_GET['edit'])){
                            $cat_id = $_GET['edit'];

                            include "./includes/update_cat.php";
                        }
                        
                        ?>
                    </div>
                    <!-- /.Add Category form -->

                    <!-- Category Table -->
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php findAllCat(); ?>
                            <?php deleteCat(); ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.Category Table -->

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