
<?php
if(isset($_GET['post_id'])){

    $the_post_id = $_GET['post_id'];
    
    $query = "SELECT * FROM `posts`";
    $post_data = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($post_data)){
    $post_id = $row['post_id'];
    $post_auther = $row['post_auther'];
    $post_title = $row['post_title'];
    echo $post_title;
    $post_cat_id = $row['post_cat_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tag = $row['post_tag'];
    $post_commencts_count = $row['post_commencts_count'];
    $post_date = $row['post_date'];

}
}

 
 ?> 

<form action="" method="post" enctype="multipart/form-data">    
     
     
     <div class="form-group">
        <label for="title">Post Title</label>
         <input type="text" class="form-control" name="title" <?php  echo $post_title;?>>
     </div>

        <div class="form-group">
      <label for="category">Category</label>
      <input type="text" class="form-control" name="post_category">
      <!-- <select name="post_category" id=""> -->       
       
      </select>
     
     </div>
      <div class="form-group">
      <label for="users">Users</label>
      <input   <?php  echo $post_auther;?> type="text" class="form-control" name="post_user">
      <!-- <select name="post_user" id=""> -->
          
       
      </select>
     
     </div>

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