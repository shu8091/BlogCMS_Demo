<?php

function insert_cat(){
    // CREATE CATEGORIES QUERY
    
    global $connection;

    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        }else{
            $query = "INSERT INTO categories(cat_title) VALUE ('{$cat_title}') ";
            $create_cat_query = mysqli_query($connection,$query); 
            if(!$create_cat_query){
                die("Query Failed" . mysqli_error($connection));
            }
        }
    }
}


function findAllCat(){
    //FIND ALL CATEGORIES QUERY

    global $connection;

    $query = "SELECT * FROM categories";
    $select_cat = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_cat)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}


function deleteCat(){
    //DELETE CATEGORIES QUERY

    global $connection;

    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $delete_query = mysqli_query($connection,$query);
        header("Location: categories.php");
    }
}


###

function findAllPosts(){
    //FIND ALL POSTS QUERY

    global $connection;

    $query = "SELECT * FROM posts";
    $select_page = mysqli_query($connection,$query);
    
    while($row = mysqli_fetch_assoc($select_page)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_cat_id = $row['post_cat_id'];
        $post_date = $row['post_date'];
        $post_img = $row['post_img'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
        
        echo "<tr>";
        echo "<td>$post_id</td>";
        echo "<td>$post_author</td>";
        echo "<td>$post_title</td>";
        echo "<td>$post_cat_id</td>";
        echo "<td>$post_date</td>";
        echo "<td><img width='100' src='../images/$post_img' alt='image'></td>";
        echo "<td>$post_tags</td>";
        echo "<td>$post_comment_count</td>";
        echo "<td>$post_status</td>";
        echo "</tr>";
    }
}

?>