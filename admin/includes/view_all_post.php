<?php 
include('delete_modal.php');
function confirm_data($result){
    global $connection;
    if(!$result){
        die("query failed".mysqli_error($connection));
    }
}


if(isset($_GET['delete'])){
    IF(isset($_SESSION['user_role'])){
        if($_SESSION['user_role'] == 'admin'){
            $delete_id =mysqli_real_escape_string($connection, $_GET['delete']);
            $query_delete = "DELETE FROM `posts` WHERE `post_id`=$delete_id";
            // echo $query_delete;
            $run = mysqli_query($connection,$query_delete);
           // header('Location:users.php');
            if($run){
                ?>
        <script>
        alert("Successfully deleted ")
        </script>

        
   
<?php
    }
}
}
}
?>

<?php 
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $postValueId){
        // echo $checkBoxValue;
         $bulk_options = $_POST['bulk_options'];
        switch($bulk_options){
            case 'published';
            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";
        
            $update_to_published_status = mysqli_query($connection,$query);       
            confirm_data($update_to_published_status);
        break;
            case 'draft';
            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId}  ";
        
            $draft_to_published_status = mysqli_query($connection,$query);       
            confirm_data($draft_to_published_status);
        break;
            case 'delete';
        
            $query ="DELETE FROM posts WHERE post_id = $postValueId";
            $delete_to_published_status = mysqli_query($connection,$query);       
            confirm_data($delete_to_published_status);
            
         break;

         case 'clone':


            $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
            $select_post_query = mysqli_query($connection, $query);


          
            while ($row = mysqli_fetch_array($select_post_query)) {
            $post_title         = $row['post_title'];
            $post_category_id   = $row['post_cat_id'];
            $post_date          = $row['post_date']; 
            $post_author        = $row['post_auther'];
            $post_status        = $row['post_status'];
            $post_image         = $row['post_image'] ; 
            $post_tags          = $row['post_tag']; 
            $post_content       = $row['post_content'];

          }

                 
      $query = "INSERT INTO posts(post_cat_id, post_title, post_auther, post_date,post_image,post_content,post_tag,post_status) ";
             
      $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') "; 

                $copy_query = mysqli_query($connection, $query);   

               if(!$copy_query ) {

                die("QUERY FAILED" . mysqli_error($connection));
               }   
                 
                 break;

        }

    }
}

?>

<form action="" method='post'>

    <table class="table table-bordered table-hover">
        <div id="bulkOptionContainer" class="col-xs-4">

            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Options</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
            </select>

        </div>


        <div class="col-xs-4">

            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="post.php?source=add_post">Add New</a>

        </div>




        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllcheck"></th>
                <th>Id</th>
                <th>Auther</th>
                <th>Tilte</th>
                <th>Category</th>
                <th>Status </th>
                <th>Image</th>
                <th>Tags</th>
                <th>Date</th>
                <th>comments</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>

            </tr>
        </thead>
        <tbody>

            <?php
        
        $query = "SELECT * FROM `posts`";
        $post_data = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($post_data)){
            $post_id = $row['post_id'];
            $post_auther = $row['post_auther'];
            $post_title = $row['post_title'];
            $post_cat_id = $row['post_cat_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tag = $row['post_tag'];
            $post_commencts_count = $row['post_commencts_count'];
            $post_date = $row['post_date'];


            echo "<tr>";


?>
            <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id;?>'></td>
            <?php
            

            echo "<td>$post_id</td>";
            echo "<td>$post_auther</td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>$post_title</td></a>";
            $e_qury = "SELECT * FROM `catagory` WHERE `cat_id` = '$post_cat_id '";
            $select_cat_id = mysqli_query($connection,$e_qury);
            while($row1 = mysqli_fetch_assoc($select_cat_id)){
            $cat_id = $row1['cat_id'];
            $cat_title = $row1['cat_title'];
            echo "<td>$cat_title</td>";
            }
            echo "<td>$post_status</td>";
            echo "<td><img style='width: 70px; height:50px' src='../image/$post_image' alt='no image' class='img-responsive' style=''></td>";
            echo "<td>$post_tag</td>";
            // echo "<td>$post_commencts_count</td>";
            echo "<td>$post_date</td>";

            //<-----------------comments count query ----------------->
            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
            $send_comment_query = mysqli_query($connection, $query);
    
            $row1 = mysqli_fetch_array($send_comment_query);
            // echo '<pre>';
            $count_comments = 0;
            if($row1){
                $comment_id = $row1['comment_id'];
                $count_comments = mysqli_num_rows($send_comment_query);
            }
            
    
    
            echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
            echo "<td><a href='post.php?source=edit_post&post_id={$post_id}'>Edit</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure ?');\" href='post.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
            



        }
        ?>
        </tbody>
    </table>
</form>
