<!-- row -->         
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php
                        
                        $query = "SELECT * FROM posts ";
                        $select_all_post = mysqli_query($connection,$query);
                        $post_count = mysqli_num_rows($select_all_post);
                        echo "<div class='huge'>{$post_count}</div>";
                        
                        ?>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="./posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php

                        $query = "SELECT * FROM users ";
                        $select_all_comment = mysqli_query($connection,$query);
                        $comment_count = mysqli_num_rows($select_all_comment);
                        echo "<div class='huge'>{$comment_count}</div>";
                    
                        ?>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="./comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php

                        $query = "SELECT * FROM users ";
                        $select_all_user = mysqli_query($connection,$query);
                        $user_count = mysqli_num_rows($select_all_user);
                        echo "<div class='huge'>{$user_count}</div>";
                    
                        ?>
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="./users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <?php

                        $query = "SELECT * FROM categories ";
                        $select_all_cat = mysqli_query($connection,$query);
                        $cat_count = mysqli_num_rows($select_all_cat);
                        echo "<div class='huge'>{$cat_count}</div>";

                        ?>
                        <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="./categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->