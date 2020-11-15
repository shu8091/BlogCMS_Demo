<?php include "./includes/header.php"; ?>
<?php include "./includes/nav.php"; ?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php

            if(isset($_GET['p_id'])){
                $the_post_id = $_GET['p_id'];
                
                $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id ";
                $send_query = mysqli_query($connection,$view_query);

                if(!$send_query){
                    die("Query Failed" . mysqli_error($connection));
                }

                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                }else{
                    $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'published'";
                }
             
                $select_all_post_query = mysqli_query($connection,$query);

                // ERROR MSG
                if(!$select_all_post_query){
                    echo "Error: " . mysqli_error($connection);
                    exit();
                }

                if(mysqli_num_rows($select_all_post_query) < 1){
                    echo "<h3 class='text-center'>No posts available</h3>";
                }else{

                while($row = mysqli_fetch_assoc($select_all_post_query)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_img = $row['post_img'];
                    $post_content = $row['post_content'];

                ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p>
                    <?php
                        if (session_status() === PHP_SESSION_NONE) session_start();
                        if(isset($_SESSION['user_role'])){
                            if(isset($_GET['p_id'])){
                                $the_post_id = $_GET['p_id'];
                                echo "<i class='fa fa-pencil' aria-hidden='true'></i> <a href='./admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a>";
                            }
                        }
                    ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <!-- <hr> -->
                <img class="img-responsive" src="./images/<?php echo $post_img;?>" alt="">
                <!-- <hr> -->
                <p><?php echo $post_content; ?></p>

                <hr>
                <?php } ?>

                <!-- Blog Comments -->
                <?php
                //CREATE COMMENT

                if(isset($_POST['create_comment'])){
                    $the_post_id = $_GET['p_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){

                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                        $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'approved', now()) ";

                        $create_comments_query = mysqli_query($connection,$query);

                        if(!$create_comments_query){
                            die('QUERY FAILED' . mysqli_error($connection));
                        }

                        //COMMENT COUNT DYNAMICALLY
                        // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                        // $query .="WHERE post_id = $the_post_id";

                        // $update_comment_count = mysqli_query($connection,$query);
                        // header("Location: ./post.php?p_id=$the_post_id");
                    }else{
                        echo "<script>alert('Fields can not be empty')</script>";
                    }
                }           
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" enctype="mutipart/form-data">
                        <div class="form-group">
                        <label for="comment_author">Name</label>
                            <input class="form-control" type="text" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input class="form-control" type="email" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>
                <!-- /.Comments Form -->

                <hr>

                <!-- Posted Comments -->

                <?php
                //SELECT COMMENT QUERY
                $query = "SELECT * FROM comments WHERE comment_post_id = $the_post_id ";
                $query .= "AND comment_status = 'approved' ";
                $query .= "ORDER BY comment_id DESC ";
                $select_comment_query = mysqli_query($connection,$query);
                
                if(!$select_comment_query){
                    die("QUERY FAILED" . mysqli_error($connection));
                }

                while($row = mysqli_fetch_assoc($select_comment_query)){
                    $comment_id = $row['comment_id'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];
                    $comment_date = $row['comment_date'];
                ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">
                        <?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
            <?php } } }else{
                header("Location: index.php");
            }?>
            <!-- /.Comment -->
        </div>
        
        <!-- Blog Sidebar Widgets Column -->
        <?php include "./includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

<!-- Footer -->
<?php include "./includes/footer.php"?>