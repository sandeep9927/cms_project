
<?php include('includes/header.php'); ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('includes/navigation.php'); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome Admon
                            <small>Subheading</small>
                        </h1>
                        <?php 
                    if(isset($_POST['submit'])){
                        $cat_title = $_POST['cat_title'];
                        if($cat_title == "" || empty($cat_title)){
                            echo ("the field should not be empty");
                        }else{
                            $query = "INSERT INTO `catagory`(cat_title) VALUES ('{$cat_title}')";
                            $create_cat_query = mysqli_query($connection,$query);
                            if(!$create_cat_query){
                                die("Query failed". mysqli_error($connection));
                            }
                        }
                    }
                    
                    
                    
                    ?>
                       
                    <div class="col-xs-6">
              
                        <form action="" method="post">
                            <label for="cat-title">Add Category</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="cat_title">

                            </div>
                            <div  class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
                            </div>
                        </form>

                    <?php
                    
                    if(isset($_GET['edit'])){
                        $cat_id = $_GET['edit'];
                        include("includes/update_catagory.php");
                    }
                    ?>

                    </div>
                    <div class="col-xs-6" >

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>category title</th>
                                    <th>Delete</th>
                                    <th>Edit</th>
                                </tr>
                        
                        </thead>
                        <tbody>
                                                
                        <?php 
                        
                $query = "SELECT * FROM `catagory`";
                $cat_query = mysqli_query($connection,$query);
                    
               
               while($row = mysqli_fetch_assoc($cat_query)){
                   $cat_id = $row['cat_id'];
                   $cat_title = $row['cat_title'];
                   echo "<tr>";
                   echo "<td>{$cat_id}</td>";
                   echo "<td>{$cat_title}</td>";
                   echo "<td><a href='catagory.php?delete={$cat_id}'>Delete</a></td>";
                   echo "<td><a href='catagory.php?edit={$cat_id}'>Edit</a></td>";
                   echo "</tr>";
               }
              ?><?php
              if(isset($_GET['delete'])){
                  $delete_cat_id = $_GET['delete'];
                $query = "DELETE FROM `catagory` WHERE `cat_id` = {$delete_cat_id}";
                  $run = mysqli_query($connection,$query);
                //   header('Location: catagory.php');
                  if($run == true){
                      ?>
                      <script>
                      alert("successfully deleted")
                      window.open('catagory.php','_self')
                      </script>
                      <?php
                  }
              }
              ?>
                        </tbody>
                        </table>
                    </div>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include('includes/footer.php'); ?>