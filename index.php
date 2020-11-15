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
            // LIMIT CONDITION

            $per_page = 5;

            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = "";
            }

            if($page == "" || $page == 1){
                $page_1 = 0;
            }else{
                $page_1 = ($page * $per_page) - $per_page;
            }

            
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                $post_query_count = "SELECT * FROM posts";
            }else{
                $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
            }

            if(!$post_query_count){
                echo "Error: " . mysqli_error($connection);
                exit();
            }

            // KNOW HOW MANY POST WE HAVE
            $find_count = mysqli_query($connection,$post_query_count);
            $count = mysqli_num_rows($find_count);

            if($count < 1){
                echo "<h3 class='text-center'>No posts available</h3>";
            }else{

            
            $count = ceil($count / $per_page);


            // SHOW POST
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin' ) {
                $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
            }else {
                $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id LIMIT $page_1, $per_page";
            }

            $select_all_post_query = mysqli_query($connection,$query);

            while($row = mysqli_fetch_assoc($select_all_post_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_img = $row['post_img'];
                $post_content = substr($row['post_content'],0,300);
                $post_status = $row['post_status'];

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
            <a class="btn btn-info" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>

            <?php } }?>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "./includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->
    <ul class="pager">
        <?php
        
        for($i=1; $i<=$count; $i++){
            if($i == $page){
                echo "<li><a class='active_link' href='./index.php?page={$i}'>{$i}</a></li>";
            }else{
                echo "<li><a href='./index.php?page={$i}'>{$i}</a></li>";
            }
        }
        ?>
    </ul>
    
    <hr>
    
    <!-- Footer -->
    <?php include "./includes/footer.php"?>