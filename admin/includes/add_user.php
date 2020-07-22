<?php 
function confirm_data($result){
    global $connection;
    if(!$result){
        die("query failed".mysqli_error($connection));
    }
}

?>




<?php
   

   if(isset($_POST['create_post'])) {
   
            $post_title        = ($_POST['title']);
            $post_user         = ($_POST['post_user']);
            $post_category_id  = ($_POST['post_category']);
            $post_status       = ($_POST['post_status']);
    
            $post_image        = ($_FILES['image']['name']);
            $post_image_temp   = ($_FILES['image']['tmp_name']);
    
    
            $post_tags         = ($_POST['post_tags']);
            $post_content      = ($_POST['post_content']);
            $post_date         = (date('d-m-y'));

       
        move_uploaded_file($post_image_temp, "../image/$post_image" );
       
       $query = "INSERT INTO `posts`(`post_cat_id`, `post_title`, `post_auther`, `post_date`, `post_image`, `post_content`, `post_tag`, 
        `post_status`) VALUES ('$post_category_id','$post_title','$post_user ','$post_date','$post_image','$post_content','$post_tags','$post_status')";
             
      $create_post_query = mysqli_query($connection, $query);  
          
      confirm_data($create_post_query);

    //   $the_post_id = mysqli_insert_id($connection);


    //   echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'>View Post </a> or <a href='posts.php'>Edit More Posts</a></p>";
       


   }
    

    
    
?>

    <form action="" method="post" enctype="multipart/form-data">    
     
     
      <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="title">
      </div>

      <div class= "form-group">
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
       <input type="text" class="form-control" name="post_user">
       <!-- <select name="post_user" id=""> -->
           
<?php

        // $users_query = "SELECT * FROM users";
        // $select_users = mysqli_query($connection,$users_query);
        
        // confirmQuery($select_users);


        // while($row = mysqli_fetch_assoc($select_users)) {
        // $user_id = $row['user_id'];
        // $username = $row['username'];
            
            
        //     echo "<option value='{$username}'>{$username}</option>";
         
            
        // }

?>
           
        
       </select>
      
      </div>





      <!-- <div class="form-group">
         <label for="title">Post Author</label>
          <input type="text" class="form-control" name="author">
      </div> -->
      
      

       <div class="form-group">
         <select name="post_status" id="">
             <option value="draft">Post Status</option>
             <option value="published">Published</option>
             <option value="draft">Draft</option>
         </select>
      </div>
      
      
      
    <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
      </div>
      
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="" cols="30" rows="10">
         </textarea>
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>


</form>
    