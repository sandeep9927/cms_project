<?php
include('database.php');
?>
<div class="col-md-4">

    <!-- Blog Search Well -->

    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="POST">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>



    <!--Login -->
    <div class="well">



        <h4>Login</h4>

        <form method="post" action="includes/login.php">
            <div class="form-group">
                <input name="username" type="text" class="form-control" placeholder="Enter Username">
            </div>

            <div class="input-group">
                <input name="password" type="password" class="form-control" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Submit</button>
                </span>
            </div>

            <div class="form-group">

                <a href="forgot.php?forgot=''">Forgot Password</a>


            </div>

        </form>

        <?php 

$query = "SELECT * FROM `catagory`";
$run = mysqli_query($connection,$query);

?>



        <!-- Blog Categories Well -->
        <div class="well">
            <h4>Blog Categories</h4>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled">
                        <?php 
               
               
                while($row = mysqli_fetch_assoc($run)){
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                    echo "<li><a href='catagory.php?catagory=$cat_id'>{$cat_title}</a></li>";
                }
               ?>
                    </ul>
                </div>
                <!-- /.col-lg-6 -->

                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>

        <!-- Side Widget Well -->
        <?php  include('widget.php') ?>

    </div>
