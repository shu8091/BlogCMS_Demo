<?php include "./includes/header.php"; ?>
<?php include "./includes/nav.php"; ?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                CMS Demo
                <small>Built on PHP/MySQL</small>
            </h1>

            <?php
             
            $query = "SELECT * FROM posts WHERE post_status = 'published' ";
            $select_all_post_query = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($select_all_post_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_img = $row['post_img'];
                $post_content = substr($row['post_content'],0,150);
                $post_status = $row['post_status'];

                if($post_status == 'published'){

            ?>

            <!-- First Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
            <!-- <hr> -->
            <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="./images/<?php echo $post_img;?>" alt="Blog Picture">
            </a>
            <!-- <hr> -->
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>


            <?php }}?>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "./includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

    <!-- Footer -->
    <?php include "./includes/footer.php"?>