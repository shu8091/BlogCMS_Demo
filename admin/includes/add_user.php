<?php

//CREATE POST QUERY

if(isset($_POST['create_user'])){
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    
    // $post_img = $_FILES['post_img']['name'];
    // $post_img_tmp = $_FILES['post_img']['tmp_name'];
    
    $user_role = $_POST['user_role'];
    $user_date = date('d-m-y');

    $password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

    // move_uploaded_file($post_img_tmp, "../images/$post_img");
    $query = "INSERT INTO users(user_id, username, user_password, user_firstname, user_lastname, user_email, user_role, user_date) ";
    $query .= "VALUES ('{$user_id}', '{$username}', '{$password}', '{$user_firstname}', '{$user_lastname}', '{$user_email }', '{$user_role}', now()) ";
   
    $create_user = mysqli_query($connection,$query);

    header("Location: ./users.php");
    confirmQuery($create_user);

}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">Firstname</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>

    <div class="form-group">
        <label for="user_lastname">Lastname</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>

    <!-- <div class="form-group">
        <label for="post_img">Post Image</label>
        <input type="file" name="post_img">
    </div> -->
    
    <div class="form-group">
        <label for="user_role">Role</label>
        <br>
        <select name="user_role">
            <option value="subscriber" selected>Subscriber</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
</form>