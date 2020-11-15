<?php

// SHOW USER DATA

if(isset($_GET['u_id'])){
    $the_user_id = $_GET['u_id'];

    $query = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_user_by_id = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_user_by_id)){
        $user_id = $row['user_id'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
        $user_role = $row['user_role'];
    }

    // EDIT USER
    if(isset($_POST['edit_user'])){
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $user_role = $_POST['user_role'];

        if(!empty($user_password)){
            $query = "SELECT user_password FROM users WHERE user_id = $the_user_id";
            $get_user = mysqli_query($connection,$query);
            confirmQuery($get_user);

            $row = mysqli_fetch_array($get_user);
            $db_user_password = $row['user_password'];

            if($db_user_password != $user_password){
                $password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
            }

            $query = "UPDATE users SET ";
            $query .= "user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', ";
            $query .= "username = '{$username}', ";
            $query .= "user_email = '{$user_email}', ";
            $query .= "user_password = '{$password}', ";
            $query .= "user_role = '{$user_role}' ";
            $query .= "WHERE user_id = {$the_user_id}";

            $update_user = mysqli_query($connection,$query);
            // header("Location: ./users.php");

            confirmQuery($update_user);
            echo "User Updated" . " <a href='users.php'>View Users?</a>";
        } 
    }

}else{
    header("Location: index.php");
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo  $user_firstname;?>">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo  $user_lastname;?>">
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
        <input type="password" class="form-control" name="user_password" value="<?php //echo  $user_password;?>">
    </div>

    <!-- <div class="form-group">
        <label for="post_img">Post Image</label>
        <input type="file" name="post_img">
    </div> -->
    
    <div class="form-group">
        <label for="user_role">Role</label>
        <br>
        <select name="user_role">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php
            if($user_role == 'admin'){
                echo "<option value='subscriber'>subscriber</option>";
            }elseif($user_role == 'subscriber'){
                echo "<option value='admin'>admin</option>";
            }else{
                echo "<option value='admin'>admin</option>";
                echo "<option value='subscriber'>subscriber</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>
</form>