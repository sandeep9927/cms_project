<?php
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $query_delete = "DELETE FROM `posts` WHERE `post_id`=$delete_id";
    // echo $query_delete;
    $run = mysqli_query($connection,$query_delete);
    if($run){
        ?>
<script>
alert("Successfully deleted ")
</script>
<?php
    }
}
?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Auther</th>
            <th>Tilte</th>
            <th>Category</th>
            <th>Status </th>
            <th>Image</th>
            <th>Tags</th>
            <th>Date</th>
            <th>comments</th>
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
            echo "<td>$post_id</td>";
            echo "<td>$post_auther</td>";
            echo "<td>$post_title</td>";
            $e_qury = "SELECT * FROM `catagory` WHERE `cat_id` = '$post_cat_id '";
            $select_cat_id = mysqli_query($connection,$e_qury);
            while($row = mysqli_fetch_assoc($select_cat_id)){
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
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
    
            $row = mysqli_fetch_array($send_comment_query);
            $comment_id = $row['comment_id'];
            $count_comments = mysqli_num_rows($send_comment_query);
    
    
            echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";

            // echo "<td>4</td>";
            echo "<td><a href='post.php?source=edit_post&post_id={$post_id}'>Edit</a></td>";
            echo "<td><a href='post.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
            



        }
        ?>
    </tbody>
</table>
