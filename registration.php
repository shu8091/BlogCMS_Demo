<?php  include "includes/header.php"; ?>
<?php  include "includes/nav.php"; ?>

<?php
//SELECT RANDSALT QUERY

if(isset($_POST['submit'])){
    // $password = "secret";
    // $has_format = "$2y$10&";
    // $salt = "iusesomecrazystrings22";
    // echo strlen($salt);

    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($username) && !empty($email) && !empty($password)){
        $username = mysqli_real_escape_string($connection, $username);
        $firstname = mysqli_real_escape_string($connection, $firstname);
        $lastname = mysqli_real_escape_string($connection, $lastname);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);

        // USING PASSWORD_HASH()
        $password = password_hash('password', PASSWORD_BCRYPT, array('cost' => 12));

        // USING SALT FOR PASSWORD
        // $query = "SELECT randSalt FROM users";
        // $select_randsalt = mysqli_query($connection,$query);
        // if(!$select_randsalt){
        //     die("Query Failed". mysqli_error($connection));
        // }
        // $row = mysqli_fetch_array($select_randsalt);
        // $salt = $row['randSalt'];
        // $password = crypt($password, $salt);

        $query = "INSERT INTO users(username, user_firstname, user_lastname, user_email, user_password, user_role, user_date) ";
        $query .= "VALUES('{$username}', '{$firstname}', '{$lastname}', '{$email}', '{$password}', 'subscriber',now())";
        $registrater_user = mysqli_query($connection,$query);

        if(!$registrater_user){
            die("Query Failed" . mysqli_error($connection));
        }

        // $message = "Your Registration has been submitted";
        echo "<script>alert('Successed')</script>";
        header("Location: ./index.php");

    }else{
        echo "<script>alert('Field cannot be empty')</script>";
    }

    
}else{
    $message = '';
}

?>

<!-- Page Content -->
<div class="container">
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="sr-only">firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Firstname">
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="sr-only">lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Lastname">
                        </div>

                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>

                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
<hr>

<?php include "includes/footer.php";?>
