<?php 
    //SHOW POST DATA

    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];
    }

    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $select_posts_by_id = mysqli_query($connection,$query);
    
    while($row = mysqli_fetch_assoc($select_posts_by_id)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_cat_id = $row['post_cat_id'];
        $post_date = $row['post_date'];
        $post_img = $row['post_img'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_status = $row['post_status'];
        $post_content = $row['post_content'];
    }



    //EDIT POST

    if(isset($_POST['update_post'])){
        $post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];
        $post_cat_id = $_POST['post_cat'];
        $post_img = $_FILES['post_img']['name'];
        $post_img_tmp = $_FILES['post_img']['tmp_name'];
        $post_status = $_POST['post_status'];
        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];

        move_uploaded_file($post_img_tmp, "../images/$post_img");

        if(empty($post_img)){
            $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
            $select_img = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($select_img)){
                $post_img = $row['post_img'];
            }
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_cat_id = '{$post_cat_id}', ";
        $query .= "post_date = now(), ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_img = '{$post_img}' ";
        $query .= "WHERE post_id = {$the_post_id} ";

        $update_post = mysqli_query($connection,$query);
        // header("Location: ./posts.php");

        confirmQuery($update_post);

        echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More Post</a></p>";
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
        <label for="post_cat">Post Category</label>
        <br>
        <select name="post_cat" id="post_cat">
        <?php
        //SELECT CATEGORIES (ADD POST)

        $query = "SELECT * FROM categories";
        $select_cat= mysqli_query($connection,$query);

        confirmQuery($select_cat);

        while($row = mysqli_fetch_assoc($select_cat)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            if($cat_id == $post_cat_id){
                echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
            }else{
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
        }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <br>
        <select name="post_status">
        <option value="draft">Draft</option>
        <option value="published" selected>Published</option>
        <!-- <option value="<?php //$post_status; ?>"><?php //echo $post_status; ?></option> -->
        <?php
        
        // if($post_status == 'published'){
        //     echo "<option value='draft'>Draft</option>";
        // }else{
        //     echo "<option value='published'>Published</option>";
        // }

        ?>
        </select>
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_img; ?>" alt="">
        <label for="post_img">Post Image</label>
        <input type="file" name="post_img">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea  class="form-control" name="post_content" id="body" cols="30" rows="10">
        <?php echo $post_content; ?>
        </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>
</form>