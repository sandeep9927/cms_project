<?php 
function confirm_data($result){
    global $connection;
    if(!$result){
        die("query failed".mysqli_error($connection));
    }
}

?>
<?php
if(isset($_GET['post_id'])){
    $the_post_id = $_GET['post_id']; 
    $query = "SELECT * FROM `posts` WHERE `post_id` = $the_post_id";
    $post_data = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($post_data)){
        $post_id = $row['post_id'];
        $post_auther = $row['post_auther'];
        $post_title = $row['post_title'];
        // echo $post_title;
        $post_cat_id = $row['post_cat_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tag = $row['post_tag'];
        $post_content = $row['post_content'];
        $post_commencts_count = $row['post_commencts_count'];
        $post_date = $row['post_date'];
    }
if(isset($_POST['update_post'])){

    $post_user           =  ($_POST['post_user']);
    $post_title          =  ($_POST['post_title']);
    $post_category_id    =  ($_POST['post_category']);
    $post_status         =  ($_POST['post_status']);
    $post_image          =  ($_FILES['image']['name']);
    $post_image_temp     =  ($_FILES['image']['tmp_name']);
    $post_content        =  ($_POST['post_content']);
    $post_tags           =  ($_POST['post_tags']);
    $post_date          =   $_POST['post_date'];
    move_uploaded_file($post_image_temp,"../image/$post_image");
    if(empty($post_image)){
        $query = "SELECT FROM `post` WHERE `popst_id` ='$the_post_id'";
        $img_query = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($img_query)){
            $post_image = $row['post_image'];  
        }
    }

    $query = "UPDATE `posts` SET `post_title`='$post_title',`post_auther`='$post_user',

    `post_date`=now(),`post_image`='$post_image',`post_content`='$post_content',`post_tag`= '$post_tags',
    
    `post_status`='$post_status',`view_count`='$post_user' WHERE `post_id`= '$the_post_id' ";
    $update_query = mysqli_query($connection,$query);
    confirm_data($update_query);
    // $the_post_id = mysqli_insert_id($connection);
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?post_id={$the_post_id}'>View Post </a> or <a href='post.php'>Edit More Posts</a></p>";
    

}

}?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php  echo $post_title;?>">
    </div>

    <div class="form-group">
        <select name="post_category" id="">

            <?php
			$query = "SELECT * FROM catagory";
            $select_categories= mysqli_query($connection, $query);
		    while ($row = mysqli_fetch_assoc($select_categories)) 
            {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
        //    query_  fail($select_categories);
			?>

        </select>
    </div>
   
    <div class="form-group">
        <label for="users">Users</label>
        <input value="<?php  echo $post_auther;?>" type="text" class="form-control" name="post_user">
        <!-- <select name="post_user" id=""> -->
        </select>

    </div>



    <div class="form-group">
        <select name="post_status" id="">

            <option value='<?php echo $post_status ?>'><?php echo $post_status; ?></option>

            <?php
          
          if($post_status == 'published' ) {
          
              
    echo "<option value='draft'>Draft</option>";
           
          } else {
           
    echo "<option value='published'>Publish</option>"; 
          }    
              
        ?>
        </select>
    </div>


    <!-- <div class="form-group">
        <select name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div> -->

    <div class="form-group">
        <!-- <label for="post_image">Post Image</label> -->
        <img width="100" src="../image/<?php  echo $post_image;?>" alt="">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php  echo $post_tag;?>">
    </div>
    <div class="form-group">
        <label for="post_tags">Date</label>
        <input type="text" class="form-control" name="post_date" value="<?php  echo $post_date;?>">
    </div>
    <head>

        <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
    </head>
    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control " name="post_content" id="editor" cols="30" rows="10">
<?php  echo $post_content;?>
</textarea>
    </div>
    <script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
    </script>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Publish Post">
    </div>


</form>
