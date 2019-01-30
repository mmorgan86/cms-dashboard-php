<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php

  if(isset($_POST['submit'])) {

    $regUsername = $_POST['username'];
    $regEmail = $_POST['email'];
    $regPassword = $_POST['password'];

    // clean data going into database
    $regUsername = mysqli_real_escape_string($connection, $regUsername);
    $regEmail = mysqli_real_escape_string($connection, $regEmail);
    $regPassword = mysqli_real_escape_string($connection, $regPassword);


    // check if fields are not empty
    if(!empty($regUsername) && !empty($regEmail) && !empty($regPassword)) {

      // password encrypt
      $query = "SELECT user_randSalt FROM users";
      $selectRandSaltQuery = mysqli_query($connection, $query);

      if(!$selectRandSaltQuery) {
        die("RandSalt Query Failed " . mysqli_error($connection));
      }

      $row = mysqli_fetch_array($selectRandSaltQuery);
      $salt = $row['user_randSalt'];

      $query = "INSERT INTO users (username, user_email, user_password, user_role) ";
      $query .= "VALUES ('{$regUsername}', '{$regEmail}', '{$regPassword}', 'user' )";
      $registerQuery = mysqli_query($connection, $query);

      if(!$registerQuery) {
        die("Register Query Failed " . mysqli_error($connection));
      }

      $message = "<h6 class='text-center bg-success'>Your Registration has been submitted</h6>";

    } else {
      $message = "<h6 class='text-center bg-danger'>Fields cannot be empty</h6>";
    }

  } else {
    $message = "";
  }

?>


<!-- Navigation -->

<?php  include "includes/nav.php"; ?>


<!-- Page Content -->
<div class="container">

  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <div class="form-wrap">
            <h1>Register</h1>
            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
              <h6 class="text-center"><?php echo $message ?></h6>
              <div class="form-group">
                <label for="username" class="sr-only">username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
              </div>
              <div class="form-group">
                <label for="email" class="sr-only">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
              </div>
              <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
              </div>

              <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
            </form>

          </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
  </section>


  <hr>



  <?php include "includes/footer.php";?>