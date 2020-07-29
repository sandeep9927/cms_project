<?php
include('includes/header.php');
include('includes/database.php');
include('includes/navigation.php');
include('admin/functions.php');
?>
<?php 
if(isset($_POST['liked'])){
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];
    //select post
    $query = "SELECT * FROM  posts WHERE post_id = $post_id";
    $postResult = mysqli_query($connection,$query);
    $post = mysqli_fetch_array($postResult);
    $like = $post['likes'];
    // if(mysqli_num_rows($postResult)>=1){
    //     echo $post['post_id'];
    // }
    //update post with likes
   mysqli_query($connection,"UPDATE posts SET likes = $like +1 WHERE post_id = $post_id");
   //create likes for post
   mysqli_query($connection,"INSERT INTO likes(user_id,post_id) VALUES ($user_id,$post_id)");
    exit();
}

if(isset($_POST['unliked'])){
    //echo "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx=============";
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];
    //select post
    $query = "SELECT * FROM  posts WHERE post_id = $post_id";
    $postResult = mysqli_query($connection,$query);
    $post = mysqli_fetch_array($postResult);
    $like = $post['likes'];
    if(mysqli_num_rows($post)>=1){
        echo $post['post_id'];
    }
    //update post with likes
    mysqli_query($connection,"DELETE FROM likes WHERE post_id = $post_id AND user_id = $user_id");
   mysqli_query($connection,"UPDATE posts SET likes = $like -1 WHERE post_id = $post_id");
   //create likes for post
  
    exit();
}



?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
                if(isset($_GET['p_id'])){
                    $the_post_id = $_GET['p_id'];
                    // echo $the_post_id;
                    // die;
                

                $update_statement = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id";

                $send_query =mysqli_query($connection,$update_statement);
                

                $query = "SELECT * FROM `posts` WHERE `post_id`= $the_post_id";
                $all_post_query = mysqli_query($connection,$query);

                while($row = mysqli_fetch_assoc($all_post_query)){
                    $post_title = $row['post_title'];
                    $post_auther = $row['post_auther'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    
                
                ?>



            <!-- First Blog Post -->
            <h2>
                <a href="#"><?php echo $post_auther; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_auther;?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date;?></p>
            <hr>
            <img class="img-responsive" src="image/<?php echo $post_image;?>" alt="image destroyed ">

            <hr>
            <p><?php echo $post_content;?></p>


                </php  
                mysqli_stmt_free
                ?>
            <hr>
                    <div class="row">
                    <p class="pull-right" ><a class="like" href="#"><span class="glyphicon glyphicon-thumbs-up"></span><?php //echo userLikedThisPost($the_post_id) ? 'Unkile' : 'Like' ?>like</a></p>
                    </div>
                    <div class="row">
                    <p class="pull-right" ><a class="unlike" href="#"><span class="glyphicon glyphicon-thumbs-down"></span> Unlike</a></p>
                    </div>
                    <div class="row">
                        <?php 
                        $result = "SELECT * FROM likes WHERE post_id = $the_post_id";
                        $run = mysqli_query($connection,$result);
                        $likes_count = mysqli_num_rows($run);
                        ?>
                    <p class="pull-right" >Likes:<?php  echo $likes_count;?></a></p>
                    </div>


            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>


            <?php  }
        
        
        
        }else{
            header('Location:index.php');
        }
        ?>



            <!-- Blog Comments -->

            <?php 
                $the_post_id = $_GET['p_id'];
                if(isset($_POST['create_comment'])){
                    
                    $comment_aouthor = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    
                    $query = "INSERT INTO `comments`(
                        `comment_post_id`,
                        `comment_author`,
                        `comment_email`,
                        `comment_content`,
                        `comment_date`
                    )
                    VALUES('$the_post_id','$comment_aouthor','$comment_email',' $comment_content',now())";
                    $run = mysqli_query($connection,$query);
                    // if(!$run){
                    //     die("Query fialed".$connection);
                    // }
                }

?>

            <!-- Comments Form -->
            <div class="well">



                <h4>Leave a Comment:</h4>
                <form action="#" method="post" role="form">

                    <div class="form-group">
                        <label for="Author">Author</label>
                        <input type="text" name="comment_author" class="form-control" name="comment_author">
                    </div>

                    <div class="form-group">
                        <label for="Author">Email</label>
                        <input type="email" name="comment_email" class="form-control" name="comment_email">
                    </div>

                    <div class="form-group">
                        <label for="comment">Your Comment</label>
                        <textarea name="comment_content" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>



            <!-- Posted Comments -->
            <?php 


            $query = "SELECT * FROM `comments` WHERE `comment_post_id` = '$the_post_id' AND
            `comment_status` = 'Approve' ORDER BY `comment_id` DESC";
            $select_comment_query = mysqli_query($connection, $query);
            //print_r($query);
            if(!$select_comment_query) {

                die('Query Failed' . mysqli_error($connection));
            }
            while ($row = mysqli_fetch_array($select_comment_query)) {
            echo $comment_date   = $row['comment_date']; 
            $comment_content= $row['comment_content'];
            $comment_author = $row['comment_author'];
            
                
                ?>

            <!-- Comment -->
            <div class="media">
                     
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author;   ?>
                            <small><?php echo $comment_date;   ?></small>
                        </h4>
                        
                        <?php echo $comment_content;   ?>
 
                    </div>
                </div>

            <?php }?>




            <!-- Comment -->


        </div>

        <!-- Blog Sidebar Widgets Column -->

        <?php
            include('includes/sidebar.php');
            ?>
    </div>
    <!-- /.row -->

    <hr>

    <?php
include('includes/footer.php');
?>
<script>
    $(document).ready(function(){
        console.log ("working perfect");
        var post_id = <?php echo $the_post_id;?>;
        var user_id = 28;
       // onsole.log ("working perfect");
        $('.like').click(function(){
            $.ajax({
                url:"post.php?p_id=<?php echo $the_post_id;?>",
                type:'post',
                data:{
                    'liked':1,
                    'post_id':post_id,
                    'user_id':user_id
                }
            })
        });

            //unlike 
            $('.unlike').click(function(){
            $.ajax({
                url:"post.php?p_id=<?php echo $the_post_id;?>",
                type:'post',
                data:{
                    'unliked':1,
                    'post_id':post_id,
                    'user_id':user_id
                }
            })
        });


    });
</script>