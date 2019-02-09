<?php

  if(isset($_POST['create_user'])) {

    $userFirstname = mysqli_real_escape_string($connection,$_POST['user_firstname']);
    $userLastname = mysqli_real_escape_string($connection,$_POST['user_lastname']);
    $userRole = mysqli_real_escape_string($connection,$_POST['user_role']);

    // $postImage = $_FILES['image']['name'];
    // $postImageTemp = $_FILES['image']['tmp_name'];

    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $userEmail = mysqli_real_escape_string($connection,$_POST['user_email']);
    $userPassword = mysqli_real_escape_string($connection,$_POST['user_password']);

    // $postDate = date('d-m-y');
  
    // move_uploaded_file($postImageTemp, "../images/$postImage");

    $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password) ";

    $query .= "VALUES('{$userFirstname}','{$userLastname}','{$userRole}','{$username}','{$userEmail}','{$userPassword}') ";
    
    $createUserQuery = mysqli_query($connection, $query);
    
    confirmQuery($createUserQuery);

    echo "User Created: ". " " . "<a href='users.php'>View Users</a>";
  }
?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="author">First Name</label>
    <input type="text" class="form-control" name="user_firstname">
  </div>

  <div class="form-group">
    <label for="post_status">Last Name</label>
    <input type="text" class="form-control" name="user_lastname">
  </div>
  
  <div class="form-group">
    <select name="user_role" id="">
      <option value="user">Select Role</option>
      <option value="admin">Admin</option>
      <option value="user">User</option>
    </select>
  </div>

<!--             ADD USER IMAGE              -->
  <!-- <div class="form-group">
    <label for="image">User Image</label>
    <input type="file" class="form-control" name="image">
  </div> -->

  <div class="form-group">
    <label for="post_tags">Username</label>
    <input type="text" class="form-control" name="username">
  </div>

  <div class="form-group">
    <label for="post_content">Email</label>
    <input type="email" class="form-control" name="user_email">
  </div>

  <div class="form-group">
    <label for="post_content">Password</label>
    <input type="password" class="form-control" name="user_password">
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
  </div>

</form>