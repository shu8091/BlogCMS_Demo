<?php

//CREATE POST QUERY

if(isset($_POST['create_post'])){
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_cat_id = $_POST['post_cat_id'];
    $post_status = $_POST['post_status'];
    
    $post_img = $_FILES['post_img']['name'];
    $post_img_tmp = $_FILES['post_img']['tmp_name'];
    
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');

    move_uploaded_file($post_img_tmp, "../images/$post_img");

    $query = "INSERT INTO posts(post_cat_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_status) ";
    $query .= "VALUES ('{$post_cat_id}','{$post_title}','{$post_author}',now(),'{$post_img}','{$post_content}','{$post_tags}','{$post_status}' ) ";

    $create_post_query = mysqli_query($connection,$query);
    
    confirmQuery($create_post_query);
    header("Location: ./posts.php");
    
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_cat_id">Post Category</label>
        <br>
        <select name="post_cat_id" id="post_category">
        <?php
        
        //SELECT CATEGORIES (ADD POST)

        $query = "SELECT * FROM categories";
        $select_cat= mysqli_query($connection,$query);

        confirmQuery($select_cat);

        while($row = mysqli_fetch_assoc($select_cat)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<option value='{$cat_id}'>{$cat_title}</option>";
        }

        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <br>
        <select name="post_status">
        <option value="draft">Draft</option>
        <option value="published" selected>Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_img">Post Image</label>
        <input type="file" name="post_img">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>
</form>