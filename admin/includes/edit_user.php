<?php


  if(isset($_GET['edit_user'])) {
    $editUserId = $_GET['edit_user'];

    $query = "SELECT * FROM users WHERE user_id = $editUserId";
        // $query .= "ORDER BY comment_date DESC";
      
        $selectUsersQuery = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($selectUsersQuery)) {
          $userId = $row['user_id'];
          $userRole = $row['user_role'];
          $username =  $row['username'];
          $userPassword = $row['user_password']; 
          $userFirstName = $row['user_firstname'];
          $userLastName = $row['user_lastname'];
          $userEmail = $row['user_email'];
          $userImage= $row['user_image'];
          $salt = $row['user_randSalt'];
        }
  }

  if(isset($_POST['edit_user'])) {

    $userFirstname = mysqli_real_escape_string($connection,$_POST['user_firstname']);
    $userLastname = mysqli_real_escape_string($connection,$_POST['user_lastname']);
    $userRole = mysqli_real_escape_string($connection,$_POST['user_role']);

    // $postImage = $_FILES['image']['name'];
    // $postImageTemp = $_FILES['image']['tmp_name'];

    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $userEmail = mysqli_real_escape_string($connection,$_POST['user_email']);
    $userPassword = mysqli_real_escape_string($connection,$_POST['user_password']);
    $hashPassword = crypt($userPassword, $salt);


    // $postDate = date('d-m-y');
  
    // move_uploaded_file($postImageTemp, "../images/$postImage");

    $query = "UPDATE users SET ";
    $query .= "username = '{$username}', ";
    $query .= "user_role = '{$userRole}', ";
    $query .= "user_firstname = '{$userFirstname}', ";
    $query .= "user_lastname = '{$userLastname}',";
    $query .= "user_email = '{$userEmail}', ";
    $query .= "user_password = '{$hashPassword}' ";
    $query .= "WHERE user_id = $editUserId";

    $editUserQuery = mysqli_query($connection, $query);

    if(confirmQuery($editUserQuery)) {
      echo "Edit User Query Failed";
    };

    header("Location: users.php");

  }
?>

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
      <option value='<?php echo $userRole ?>'><?php echo ucfirst($userRole) ?></option>
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
    <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
  </div>

</form>