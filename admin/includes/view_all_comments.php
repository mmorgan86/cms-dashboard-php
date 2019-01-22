<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>Id</th>
      <th>Author</th>
      <th>Comment</th>
      <th>Email</th>
      <th>Status</th>
      <th>In Response to</th>
      <th>Date</th>
      <th>Approved</th>
      <th>Unapproved</th>
      <th>Delete</th>
      
      
    </tr>
  </thead>
  <tbody>
      <?php 
      
        global $connection;
        $query = "SELECT * FROM comments ";
        $query .= "ORDER BY comment_date DESC";
      
        $selectComments = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($selectComments)) {
          $commentId = $row['comment_id'];
          $commentPostId =  $row['comment_post_id'];
          $commentAuthor = $row['comment_author'];
          $commentContent = $row['comment_content'];
          $commentEmail = $row['comment_email'];
          $commentDate = $row['comment_date'];
          $commentStatus = $row['comment_status'];
          
      
          echo "<tr>";

          echo "<td>{$commentId}</td>";
          echo "<td>{$commentAuthor}</td>";
          echo "<td>{$commentContent}</td>";
          echo "<td>{$commentEmail}</td>";
          echo "<td>{$commentStatus}</td>";

          $query = "SELECT * FROM posts WHERE post_id = $commentPostId";
          $selectPostIdQuery = mysqli_query($connection, $query);

          while($row = mysqli_fetch_assoc($selectPostIdQuery)){
            $postId = $row['post_id'];
            $postTitle = $row['post_title'];

            echo "<td><a href='../post.php?p_id=$postId'>$postTitle</a></td>";

          }
        
          echo "<td>{$commentDate}</td>";
      
          echo "<td><a href='comments.php?approve={$commentId}'>Approve</a></td>";
					echo "<td><a href='comments.php?unapprove={$commentId}'>Unapprove</a></td>";
          echo "<td><a href='comments.php?delete={$commentId}'>Delete</a></td>";
          
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

