<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Role</th>
      <th>Username</th>
      <th>Firstname</th>
      <th>Lastname</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
      <?php 
      
        global $connection;
        $query = "SELECT * FROM users ";
        // $query .= "ORDER BY comment_date DESC";
      
        $selectUsers = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($selectUsers)) {
          $userId = $row['user_id'];
          $userRole = $row['user_role'];
          $username =  $row['username'];
          $userPassword = $row['user_password'];
          $userFirstName = $row['user_firstname'];
          $userLastName = $row['user_lastname'];
          $userEmail = $row['user_email'];
          $userImage= $row['user_image'];
          
          
      
          echo "<tr>";

          echo "<td>{$userId}</td>";
          echo "<td>{$userRole}</td>";
          echo "<td>{$username}</td>";
          echo "<td>{$userFirstName}</td>";
          echo "<td>{$userLastName}</td>";
          echo "<td>{$userEmail}</td>";

          // $query = "SELECT * FROM posts WHERE post_id = $commentPostId";
          // $selectPostIdQuery = mysqli_query($connection, $query);

          // while($row = mysqli_fetch_assoc($selectPostIdQuery)){
          //   $postId = $row['post_id'];
          //   $postTitle = $row['post_title'];

          //   echo "<td><a href='../post.php?p_id=$postId'>$postTitle</a></td>";

          // }
        
          
      
          echo "<td><a href='users.php?change_to_admin={$userId}'>Admin</a></td>";
					echo "<td><a href='users.php?change_to_user={$userId}'>User</a></td>";
          echo "<td><a href='users.php?delete={$userId}'>Delete</a></td>";
          
          echo "</tr>";

        }      
    
      ?>
  </tbody>
</table>

<?php 

  if(isset($_GET['change_to_admin'])) {

    $changeToAdminId = $_GET['change_to_admin'];
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id= $changeToAdminId";
    $changeToAdminQuery = mysqli_query($connection, $query);

    if(!$changeToAdminQuery) {
      die("Change To Admin Query Failed" . mysqli_error($connection));
    }

    header("Location: users.php");
  }
  
  if(isset($_GET['change_to_user'])) {

    $changeToUserId = $_GET['change_to_user'];
    $query = "UPDATE users SET user_role = 'user' WHERE user_id= $changeToUserId";
    $changeToUserQuery = mysqli_query($connection, $query);

    if(!$changeToUserQuery) {
      die("Change To User Query Failed" . mysqli_error($connection));
    }

    header("Location: users.php");
  }
		
?>



<?php

if(isset($_GET['delete'])) {
	$deleteUserId = $_GET['delete'];
	$query = "DELETE FROM users
						WHERE user_id = {$deleteUserId}";
	$deleteUserQuery = mysqli_query($connection, $query);
	
	if(!$deleteUserQuery) {
		die("Query Failed" . mysqli_error($connection));
	}

  // $query = "UPDATE users SET user_count = user_count - 1 ";
  // $query .= "WHERE user_id = $userId";
  // $updateUserCount = mysqli_query($connection, $query);

  header("Location: users.php");
}	
?>

