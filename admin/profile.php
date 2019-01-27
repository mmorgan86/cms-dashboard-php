<?php include "includes/adminHeader.php" ?>
<?php
  if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $selectUserProfileQuery = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($selectUserProfileQuery)) {
      $userId = $row['user_id'];
      $userRole = $row['user_role'];
      $username =  $row['username'];
      $userPassword = $row['user_password'];
      $userFirstName = $row['user_firstname'];
      $userLastName = $row['user_lastname'];
      $userEmail = $row['user_email'];
      $userImage= $row['user_image'];
    }
  }

?>


<?php 
  if(isset($_POST['edit_profile'])) {
   
    $userFirstname = $_POST['user_firstname'];
    $userLastname = $_POST['user_lastname'];
    $userRole = $_POST['user_role'];

    // $postImage = $_FILES['image']['name'];
    // $postImageTemp = $_FILES['image']['tmp_name'];

    $username = $_POST['username'];
    $userEmail = $_POST['user_email'];
    $userPassword = $_POST['user_password'];

    // $postDate = date('d-m-y');
  
    // move_uploaded_file($postImageTemp, "../images/$postImage");

    $query = "UPDATE users SET ";
    $query .= "username = '{$username}', ";
    $query .= "user_role = '{$userRole}', ";
    $query .= "user_firstname = '{$userFirstname}', ";
    $query .= "user_lastname = '{$userLastname}', ";
    $query .= "user_email = '{$userEmail}', ";
    $query .= "user_password = '{$userPassword}' ";
    $query .= "WHERE username = '{$username}' ";

    $editUserQuery = mysqli_query($connection, $query);

    if(!$editUserQuery) {
      die("Edit User Query Failed " . mysqli_error($connection));
    };

    header("Location: profile.php");
  }

?> 


<div id="wrapper">

  <!-- Navigation -->
  <?php include "includes/adminNav.php" ?>


  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">

          <h1 class="page-header">
            Welcome to Admin
            <small>Author</small>
          </h1>
          
          <form action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label for="author">First Name</label>
              <input type="text" class="form-control" value="<?php echo $userFirstName ?>" name="user_firstname">
            </div>

            <div class="form-group">
              <label for="post_status">Last Name</label>
              <input type="text" class="form-control" name="user_lastname" value="<?php echo $userLastName ?>">
            </div>
            
            <div class="form-group">
              <select name="user_role" id="">
                <option value='user'><?php echo ucfirst($userRole) ?></option>
                <?php
                  if($userRole == 'admin') {
                    echo "<option value='user'>User</option>";
                  }else {
                    echo "<option value='admin'>Admin</option>";
                  } 
                ?>
              </select>
            </div>

          <!--             ADD USER IMAGE              -->
            <!-- <div class="form-group">
              <label for="image">User Image</label>
              <input type="file" class="form-control" name="image">
            </div> -->

            <div class="form-group">
              <label for="post_tags">Username</label>
              <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
            </div>

            <div class="form-group">
              <label for="post_content">Email</label>
              <input type="email" class="form-control" name="user_email" value="<?php echo $userEmail ?>">
            </div>

            <div class="form-group">
              <label for="post_content">Password</label>
              <input type="password" class="form-control" name="user_password" value="<?php echo $userPassword ?>">
            </div>

            <div class="form-group">
              <input class="btn btn-primary" type="submit" name="edit_profile" value="Update Profile">
            </div>

          </form>


        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include "includes/adminFooter.php" ?>