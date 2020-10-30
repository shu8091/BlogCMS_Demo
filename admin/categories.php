<?php include "./includes/admin_header.php"; ?>

<div id="wrapper">

    <?php include "./includes/admin_nav.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">

                <!-- Add Category Form-->
                <?php
                $query = "SELECT * FROM categories";
                $select_cat = mysqli_query($connection,$query);
                ?>
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>
                    <div class="col-xs-6">
                    <?php
                    if(isset($_POST["submit"])){
                        echo "yes";
                    }

                    ?>
                        <form action="./categories.php" method="post">
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>
                    </div>
                    <!-- /.Add Category form -->

                    <!-- Category Table -->
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            while($row = mysqli_fetch_assoc($select_cat)){
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];

                                echo "<tr>";
                                echo "<td>{$cat_id}</td>";
                                echo "<td>{$cat_title}</td>";
                                echo "</tr>";
                            }
                            ?>
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