<?php
include("popup.php");

//CHECKBOX

if(isset($_POST['checkBoxArray'])){
    $checkBoxArray = $_POST['checkBoxArray'];
    foreach($checkBoxArray as $checkBoxVal){
        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxVal} ";
                $update_to_published = mysqli_query($connection,$query);
                confirmQuery($update_to_published);
                break;
            
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxVal} ";
                $update_to_draft = mysqli_query($connection,$query);
                confirmQuery($update_to_draft);
                break;
            
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = {$checkBoxVal} ";
                $delete_post = mysqli_query($connection,$query);
                confirmQuery($delete_post);
                break;
            
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$checkBoxVal}' ";
                $select_clone_post = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_clone_post)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_cat_id = $row['post_cat_id'];
                    $post_date = $row['post_date'];
                    $post_img = $row['post_img'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_status = $row['post_status'];
                }

                $query = "INSERT INTO posts(post_title, post_author, post_cat_id, post_date, post_img, post_content, post_tags, post_comment_count, post_status) ";
                $query .= "VALUES('{$post_title}', '{$post_author}', '{$post_cat_id}', now(), '{$post_img}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}') ";
                $clone_query = mysqli_query($connection,$query);
                confirmQuery($clone_query);
                break;
            
            case 'reset': 
                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$checkBoxVal} ";
                $reset_query = mysqli_query($connection,$query);
                confirmQuery($reset_query);
                break;
        }
    }   
}

?>
<form action="" method="post">
    <div class="bulkOptionsContainer">
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
                <option value="reset">Reset Views Count</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" id="applyBtn" class="btn btn-primary" value="Apply">
            <script>
                window.onload = () => {
                    var applyBtn = document.getElementById('applyBtn');
                    applyBtn.onclick = () => {
                        return confirm("Are you sure you want to apply this option?");
                    }
                }
            </script>
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Status</th>
                <th>Link</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Views</th>
            </tr>
        </thead>

        <tbody>
            <?php
            //FIND ALL POSTS QUERY

            $query = "SELECT * FROM posts ORDER BY post_id DESC";
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
                $post_views_count = $row['post_views_count'];
            
                echo "<tr>";
                ?>

            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

            <?php
                echo "<td>$post_id</td>";
                echo "<td>$post_author</td>";
                echo "<td>$post_title</td>";

                $query = "SELECT * FROM categories WHERE cat_id = {$post_cat_id}";
                $select_cat_id = mysqli_query($connection,$query);
            
                while($row = mysqli_fetch_assoc($select_cat_id)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    echo "<td>{$cat_title}</td>";

                }

                echo "<td>$post_date</td>";
                echo "<td><img width='100' src='../images/$post_img' alt='image'></td>";
                echo "<td>$post_tags</td>";

                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $send_comment_query = mysqli_query($connection,$query);
                $row = mysqli_fetch_array($send_comment_query);
                $count_comments = mysqli_num_rows($send_comment_query);
                while ($row = mysqli_fetch_array($send_comment_query)) {
                    $comment_id = $row['comment_id'];
                }
                echo "<td><a href='./post_comment.php?id=$post_id'>$count_comments</a></td>";
                
                echo "<td>$post_status</td>";
                echo "<td><a href='../post.php?p_id={$post_id}'>View</a></td>";
                echo "<td><a href='./posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a rel='{$post_id}' href='javascript:void(0)' class='delete_link'>Delete</a></td>";
                // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" href='./posts.php?delete={$post_id}'>Delete</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to reset?'); \" href='./posts.php?reset={$post_id}'>$post_views_count</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</form>

<?php
// DELETE POST QUERY

if(isset($_GET['delete'])){
    $the_post_id = $_GET['delete'];
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
    $delete_post_query = mysqli_query($connection,$query);
    header("Location: ./posts.php");
}


// RESET POST VIEWS COUNT

if(isset($_GET['reset'])){
    $the_post_id = $_GET['reset'];
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) ." ";
    $reset_post_query = mysqli_query($connection,$query);
    header("Location: ./posts.php");
}

?>

<script>
    $(document).ready(function(){
        $(".delete_link").on('click', function(){
            var id = $(this).attr("rel");
            var delete_url = `posts.php?delete=${id}`;

            $(".modal_delete_link").attr("href", delete_url);
            
            $("#exampleModal").modal('show');
        });
    });
</script>

