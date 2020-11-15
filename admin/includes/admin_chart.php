<!-- row chart -->
<?php
// PUBLISHED POSTS COUNT
$query = "SELECT * FROM posts WHERE post_status = 'published'";
$select_published_posts = mysqli_query($connection,$query);
$post_published_count = mysqli_num_rows($select_published_posts);

// DRAFT POSTS COUNT
$query = "SELECT * FROM posts WHERE post_status = 'draft'";
$select_all_draft_posts = mysqli_query($connection,$query);
$post_draft_count = mysqli_num_rows($select_all_draft_posts);

//UNAPPROVE COMMENTS COUNT
$query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
$select_unapproved_comments = mysqli_query($connection,$query);
$unapproved_comment_count = mysqli_num_rows($select_unapproved_comments);

//SUBSCRIBERS
$query = "SELECT * FROM users WHERE user_role = 'subscriber'";
$select_subscribers = mysqli_query($connection,$query);
$subscriber_count = mysqli_num_rows($select_subscribers);

?>
<div class="row">
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Data', 'Count'],

            <?php
            
            $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'All Comments', 'Pending Comments', 'All Users', 'Subscribers', 'Categories'];
            $element_count = [$post_count, $post_published_count, $post_draft_count, $comment_count, $unapproved_comment_count, $user_count, $subscriber_count,$cat_count];

            for( $i=0; $i<8; $i++){
                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
            }
            
            ?>
        ]);

        var options = {
            chart: {
                title: '',
                subtitle: '',
            }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>
<div id="columnchart_material" style="width: auto; height: 500px;"></div>
</div>
<!-- /.row chart -->