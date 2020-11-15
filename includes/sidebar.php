<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">




    <!-- Blog Search Well -->
    <div class="well">
        <h4>Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
            <!-- /.input-group -->
        </form>
        <!-- search form  -->
    </div>
    <!-- /.Blog Search Well -->


    <!-- Login Form -->
    <?php if(!isset($_SESSION['username'])):?>
        <div class="well">
        <h4>Login</h4>
        <form action="./includes/login.php" method="post">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Username">
            </div>
            <div class="input-group">
                <input name="password" type="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button name="login" type="submit" class="btn btn-primary">Login</button>
                </span>
            </div>
            <!-- /.input-group -->
        </form>
        <!-- search form  -->
    </div>
    
    <!-- /.Login Form -->
    <?php endif; ?>
    



    <!-- Blog Categories Well -->
    <div class="well">
        <?php
        $query = "SELECT * FROM categories";
        $select_cat_sidebar = mysqli_query($connection,$query);
        ?>

        <h4>Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    
                    while($row = mysqli_fetch_assoc($select_cat_sidebar)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
    
                        echo "<li><a href='./category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }

                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>







    <!-- Side Widget Well -->
    <?php include "widght.php"; ?>

</div>