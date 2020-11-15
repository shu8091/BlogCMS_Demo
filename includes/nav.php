<?php include "db.php"; ?>
 <!-- Navigation -->
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            
        <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./index.php">Bloggie</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                    $query = "SELECT * FROM categories";
                    $select_all_categories_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_all_categories_query)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];

                        $cat_class = '';
                        $registation_class= '';
                        $registation = 'registration.php';
                        $pageName = basename($_SERVER['PHP_SELF']);

                        if(isset($_GET['category']) && $_GET['category'] == $cat_id){
                            $cat_class = 'active';
                        }else{
                            switch ($pageName) {
                                case 'registration.php':
                                    $registation_class = 'active';
                                    break;
                                
                                default:
                                    $registation_class = '';
                                    break;
                            }
                        }
                        echo "<li class='$cat_class'><a href='category.php?category={$cat_id}'>{$cat_title}</a></li>";
                    }
                    
                    //if (session_status() === PHP_SESSION_NONE) session_start();
                    if(isset($_SESSION['username'])){

                        $username = $_SESSION['username'];
                        $user_role = $_SESSION['user_role'];

                        echo "<li><a><span class='badge badge-primary'>Hello, $username</span></a></li>";
                        
                        if($user_role == 'admin'){
                            echo "<li><a href='./admin'><span class='badge badge-info badge-bg'>Admin</span></a></li>";
                        }else{
                            echo "<li><a href='./includes/logout.php'><span class='badge badge-info badge-bg'>Log out</span></a></li>";
                        } 
                    }else{
                        echo "<li class='$registation_class'><a href='./registration.php'>Registration</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>