<?php include "db.php"; ?>
<?php session_start(); ?>

<?php

  if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // prevent SQL injection
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $selectUserQuery =  mysqli_query($connection, $query);

    if(!$selectUserQuery) {
      die("Login Query Failed " . mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($selectUserQuery)) {
      $db_User_id = $row['user_id'];
      $db_username = $row['username'];
      $db_user_password = $row['user_password'];
      $db_user_firstname = $row['user_firstname'];
      $db_User_lastname = $row['user_lastname'];
      $db_user_role = $row['user_role']; 

    }

    if($username === $db_username && $password === $db_user_password) {
      header("Location: ../admin");

      $_SESSION['username'] = $db_username;
      $_SESSION['firstname'] = $db_user_firstname;
      $_SESSION['lastname'] = $db_user_lastname;
      $_SESSION['user_role'] = $db_user_role;


    } else {
      header("Location: ../index.php");
    }
  
  }


?>