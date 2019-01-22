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
        
          
      
          echo "<td><a href='comments.php?approve='>Approve</a></td>";
					echo "<td><a href='comments.php?unapprove='>Unapprove</a></td>";
          echo "<td><a href='comments.php?delete='>Delete</a></td>";
          
          echo "</tr>";

        }      
    
      ?>
  </tbody>
</table>

<?php 

  if(isset($_GET['unapprove'])) {

    $getUnapproveCommentId = $_GET['unapprove'];
    $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id= $getUnapproveCommentId";
    $unapproveCommentQuery = mysqli_query($connection, $query);

    if(!$unapproveCommentQuery) {
      die("Unapproved Query Failed" . mysqli_error($connection));
    }

    header("Location: comments.php");
  }
  
  if(isset($_GET['approve'])) {
    $getApproveCommentId = $_GET['approve'];
	  $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id= $getApproveCommentId ";
	  $approveCommentQuery = mysqli_query($connection, $query);
	
	  if(!$approveCommentQuery) {
		  die("Approve Query Failed" . mysqli_error($connection));
    }
    
    header("Location: comments.php");
  }
		
?>



<?php

if(isset($_GET['delete'])) {
	$deleteCommentId = $_GET['delete'];
	$query = "DELETE FROM comments
						WHERE comment_id={$deleteCommentId}";
	$deletePostQuery = mysqli_query($connection, $query);
	
	if(!$deleteCommentId) {
		die("Query Failed" . mysqli_error($connection));
	}

  $query = "UPDATE posts SET post_comment_count = post_comment_count - 1 ";
  $query .= "WHERE post_id = $postId";
  $updateCommentCount = mysqli_query($connection, $query);

  header("Location: comments.php");
}	
?>

