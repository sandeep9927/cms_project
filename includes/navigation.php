 <?php
 include('database.php');
 include('admin/function.php');
 ?>
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
                <a class="navbar-brand" href="/cms_project">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                <?php
                $query = "SELECT * FROM `catagory`";
                $run = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($run)){
                    $cat_title = $row['cat_title'];
                    $cat_id = $row['cat_id'];
                    echo "<li><a href='catagory.php?catagory=$cat_id'>{$cat_title}</a></li>";
                }
            
                ?>

                    <?php //if(isLoggedIn()): ?>
                    <li><a href="/cms_project/admin">Admin</a></li>
                    <li><a href="/cms_project/includes/logout.php">logout</a></li>
                    <?php //else: ?>

                    <li><a href="login.php">login</a></li>
                    <?php //endif; ?>

                <li><a href="/cms_project/registration">Registration</a></li>
                <li><a href="/cms_project/contact.php">contact</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
