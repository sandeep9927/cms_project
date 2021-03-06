<?php
include('includes/header.php');
include('includes/database.php');
include('includes/navigation.php');
?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php

                $post_query_count = "SELECT * FROM `posts`";
                $find_count = mysqli_query($connection,$post_query_count);
                $count = mysqli_num_rows($find_count);
                $count = ceil($count/5);


                $query = "SELECT * FROM `posts`";
                $all_post_query = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($all_post_query)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_auther = $row['post_auther'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'],0,100);
                    
                
                ?>



            <!-- First Blog Post -->
            <h2>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a
                    href="author_posts.php=<?php echo $post_auther;?>&p_id =<?php echo $post_id;?>"><?php echo $post_auther;?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date;?></p>
            <hr>
            <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive"
                    src="image/<?php echo $post_image;?>" alt="image destroyed "></a>

            <hr>
            <p><?php echo $post_content;?></p>
            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span
                    class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>


            <?php  }


?>
        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php
            include('includes/sidebar.php');
            ?>
    </div>
    <!-- /.row -->

    <hr><h1>view_all_post_here_and_click_here</h1>
    <ul class="pager">
        <?php 
        for($i=1;$i<=$count;$i++){
            echo "<li><a href=''>{$i}</a></li>";
        }
        ?>
<!--         
        <li><a href="">2</a></li> -->
    </ul>
<?php
include('includes/footer.php');
?>