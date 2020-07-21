    <form action="" method="post">
        <label for="cat-title">Edit Category</label>


        <?php

if(isset($_GET['edit'])){
$edit_cat = $_GET['edit'];
// print_r($edit_cat);
// die;
$e_qury = "SELECT * FROM `catagory` WHERE `cat_id` = '$edit_cat '";
$select_cat_id = mysqli_query($connection,$e_qury);
while($row = mysqli_fetch_assoc($select_cat_id)){
$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];
?>
        <input type="text" value="<?php if(isset($cat_title)){
echo $cat_title;
} ?>" class="form-control" name="cat_title">
        <?php

}

}

?>
        <?php
if(isset($_POST['update_cat'])){
$the_cat_title = $_POST['cat_title'];
// $query = "UPDATE `catagory` SET `cat_title`='$cat_title' WHERE `cat_id` ='$edit_cat'";
$query = "UPDATE `catagory` SET `cat_title`='$the_cat_title' WHERE `cat_id` = '$edit_cat'";
$run = mysqli_query($connection,$query);
if(!$run){
die("query failed ".mysqli_error($connection));
}else{
?>
        <script>
        alert("Successfully updated")
        </script>
        <?php
                        }
                        }
                        ?>

        <div class="form-group">

        </div>
        <div class="form-group">
            <input type="submit" name="update_cat" class="btn btn-primary" value="Update Category">
        </div>
    </form>
