<?php include "./includes/admin_header.php"; ?>
<?php
// GET PROFILE INFO

if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_profile = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_profile)){
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
        $user_img = $row['user_img'];
        $user_role = $row['user_role'];
    }
}
?>


<?php
// UPDATE PROFILE
if(isset($_POST['update_profile'])){
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}', ";
    $query .= "user_role = '{$user_role}' ";
    $query .= "WHERE username= '{$username}' ";

    $update_profile = mysqli_query($connection,$query);

    header("Location: ./profile.php");
    confirmQuery($update_profile);
}

?>

<div id="wrapper">

    <?php include "./includes/admin_nav.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">

                <!-- Add Category Form-->
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Users
                        <small>Author</small>
                    </h1>
                </div>
                <!-- /.col-lg-12-->

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="user_firstname">Firstname</label>
                        <input type="text" class="form-control" name="user_firstname"
                            value="<?php echo  $user_firstname;?>">
                    </div>

                    <div class="form-group">
                        <label for="user_lastname">Lastname</label>
                        <input type="text" class="form-control" name="user_lastname"
                            value="<?php echo  $user_lastname;?>">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" value="<?php echo  $username;?>">
                    </div>

                    <div class="form-group">
                        <label for="user_email">Email</label>
                        <input type="email" class="form-control" name="user_email" value="<?php echo  $user_email;?>">
                    </div>

                    <div class="form-group">
                        <label for="user_password">Password</label>
                        <input type="password" class="form-control" name="user_password"
                            value="<?php echo  $user_password;?>">
                    </div>

                    <!-- <div class="form-group">
                        <label for="post_img">Post Image</label>
                        <input type="file" name="post_img">
                    </div> -->

                    <div class="form-group">
                        <label for="user_role">Role</label>
                        <br>
                        <p><?php echo $user_role; ?></p>
                        <!--
                        <select name="user_role">
                        
                            <option value=""></option>
                            <?php
                            // if($user_role == 'admin'){
                            //     echo "<option value='subscriber'>subscriber</option>";
                            // }elseif($user_role == 'subscriber'){
                            //     echo "<option value='admin'>admin</option>";
                            // }else{
                            //     echo "<option value='admin'>admin</option>";
                            //     echo "<option value='subscriber'>subscriber</option>";
                            // }
            
                            ?>
                        </select>
                        -->
                    </div>

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                    </div>
                </form>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "./includes/admin_footer.php"; ?>