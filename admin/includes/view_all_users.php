<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th> 
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Date</th>
            <th>Role</th>
            <th>Change Role(A)</th>
            <th>Change Role(S)</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>
        <?php
        //FIND ALL POSTS QUERY

        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($select_users)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_img = $row['user_img'];
            $user_role = $row['user_role'];
            $user_date = $row['user_date'];

            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            echo "<td>$user_date</td>";
            echo "<td>$user_role</td>";
            echo "<td><a href='./users.php?change_role=$user_id'>Change to Admin</a></td>";
            echo "<td><a href='./users.php?change_role2=$user_id'>Change to Subscriber</a></td>";
            echo "<td><a href='./users.php?source=edit_user&u_id=$user_id'>Edit</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='./users.php?delete=$user_id'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<?php
//CHANGE ROLE

if(isset($_GET['change_role'])){
    $the_user_id = $_GET['change_role'];

    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
    $change_admin = mysqli_query($connection,$query);
    header("Location: ./users.php");
}



//CHANGE ROLE2

if(isset($_GET['change_role2'])){
    $the_user_id = $_GET['change_role2'];

    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id ";
    $change_subscriber = mysqli_query($connection,$query);
    header("Location: ./users.php");
}



// DELETE USER
if(isset($_GET['delete'])){
    if(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 'admin'){
            $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);

            $query = "DELETE FROM users WHERE user_id = $the_user_id ";
            $delete_user = mysqli_query($connection,$query);
            header("Location: ./users.php");
        }
    }
}

?>