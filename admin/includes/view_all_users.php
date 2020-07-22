<?php
if(isset($_GET['delete'])){
    $comment_id = $_GET['delete'];
    $query_delete = "DELETE FROM `comments` WHERE `comment_id` ='$comment_id'";
    // echo $query_delete;
    $run_delete = mysqli_query($connection,$query_delete);
    header('Location:comments.php');
}
?>
<?php
if(isset($_GET['unapprove'])){
    $comment_id = $_GET['unapprove'];
    $query_delete = "UPDATE `comments` SET `comment_status` ='unapprove' WHERE `comment_id` = $comment_id";
    $run_unapprove = mysqli_query($connection,$query_delete);
    // header('Location:comments.php');
    if($run_unapprove){
        ?><script>alert("comments unapprove")</script><?php
    }
    
}
?>
<?php
if(isset($_GET['approve'])){
    $comment_id = $_GET['approve'];
    $query_delete = "UPDATE `comments` SET `comment_status` ='approve' WHERE `comment_id` = $comment_id";
    $run_approve = mysqli_query($connection,$query_delete);
    // header('Location:comments.php');
    if($run_approve){
        ?><script>alert("comments Approve")</script><?php
    }
}
?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Auther</th>
            <th>comments</th>
            <th>email</th>
            <th>Status </th>
            <th>in response to</th>
            <th>Date</th>
            <th>Approved</th>
            <th>Unapproved</th>
            <th>Delete</th>

        </tr>
    </thead>
    <tbody>

        <?php
        
        $query = "SELECT * FROM `comments`";
        $connection = mysqli_connect('localhost','root','','cms');
        $select_comment = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_comment)){
            $comment_id = $row['comment_id'];
            $comment_author = $row['comment_author'];
            $comment_post_id = $row['comment_post_id'];
            $comment_status = $row['comment_status'];
            $comment_email = $row['comment_email'];
            $comment_content = $row['comment_content'];
            $comment_date = $row['comment_date'];

            echo "<tr>";
            echo "<td>$comment_id</td>";
            echo "<td>$comment_author</td>";
            echo "<td>$comment_content</td>";
            echo "<td>$comment_email</td>";
            echo "<td>$comment_status</td>";
            $query = "SELECT * FROM `posts` WHERE`post_id`='$comment_post_id'";
            $select_post_id_query = mysqli_query($connection,$query);
            
            while($row = mysqli_fetch_assoc($select_post_id_query)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];

                echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            }

            echo "<td>$comment_date</td>";
            echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
            echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
            echo "</tr>";
            



        }
        ?>
    </tbody>
</table>
