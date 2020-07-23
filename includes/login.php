<?php include('database.php');?>
<?php  include "includes/header.php"; ?>
<?php

if(isset($_POST['login'])){
   $username = $_POST['username'];
   $password = $_POST['password'];
    $username = mysqli_real_escape_string($connection,$username);
    $password = mysqli_real_escape_string($connection,$password);
    $query = "SELECT * FROM `users` WHERE `username` = '{$username}'";
    $login_query = mysqli_query($connection,$query);
    if(!$login_query){
        die("query failed".mysqli_error($connection));
    }
    while($row = mysqli_fetch_array($login_query)){
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];

    }

    if($username === $db_user_firstname && $password ===$db_user_password){
        $_SESSION['username'] = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;
        header("Location: ../admin");
    }else{
        ?><script>alert("user doen't match")</script><?php
        header("Location: ../index.php");
    }
}



?>