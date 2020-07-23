<?php
if(isset($_GET['delete_user'])){
    $delete_id = $_GET['delete_user'];
    $query_delete = "DELETE FROM `users` WHERE `user_id` ='$delete_id'";
    $run_delete = mysqli_query($connection,$query_delete);
    // header('Location:users.php');
    if($run_delete){
        ?><script>alert("User delete successfully")</script><?php
    }
}
?>
<?php
if(isset($_GET['chang_to_admin'])){
    $chage_user_id = $_GET['chang_to_admin'];
    $query_delete = "UPDATE `users` SET `user_role` ='Admin' WHERE `user_id` = $chage_user_id";
    $run_unapprove = mysqli_query($connection,$query_delete);
    // header('Location:comments.php');
    if($run_unapprove){
        ?><script>alert("done!")</script><?php
    }
    
}
?>
<?php
if(isset($_GET['sub'])){
    $user_id = $_GET['sub'];
    $query_delete = "UPDATE `users` SET `user_role` ='subscriber' WHERE `user_id` = $user_id";
    $run_approve = mysqli_query($connection,$query_delete);
    // header('Location:comments.php');
    if($run_approve){
        ?><script>alert("Done !")</script><?php
    }
}
?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email </th>
            <!-- <th>Image </th> -->
            <th>Role</th>
            <th>Admin</th>
            <th>Subscriber</th>
            <th>Edit user</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php
        
        $query = "SELECT * FROM `users`";
        $connection = mysqli_connect('localhost','root','','cms');
        $select_user = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_user)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_password = $row['user_password'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];

            echo "<tr>";
            echo "<td>$user_id</td>";
            echo "<td>$username</td>";
            echo "<td>$user_firstname</td>";
            echo "<td>$user_lastname</td>";
            echo "<td>$user_email</td>";
            $query = "SELECT * FROM `users` WHERE`user_id`='$user_id'";
            $select_post_id_query = mysqli_query($connection,$query);
            
            while($row = mysqli_fetch_assoc($select_post_id_query)){
                $user_id = $row['user_id'];
                $user_role = $row['user_role'];

                echo "<td><a href='../post.php?p_id=$user_id'>$user_role</a></td>";
            }

            //echo "<td>$user_role</td>";
            echo "<td><a href='users.php?chang_to_admin=$user_id'>Admin</a></td>";
            echo "<td><a href='users.php?sub=$user_id'>subscriber</a></td>";
            echo "<td><a href='users.php?source=edit_user&edit_user=$user_id'>Edit</a></td>";
            echo "<td><a href='users.php?delete_user=$user_id'>Delete</a></td>";
            echo "</tr>";
            



        }
        ?>
    </tbody>
</table>
