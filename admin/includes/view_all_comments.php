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
        $query = "SELECT * FROM comments";
      
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
          echo "<td>some title here</td>";
          echo "<td>{$commentDate}</td>";
      
          echo "<td><a href='posts.php?source=edit_comment&p_id={$commentId}'>Approved</a></td>";
					echo "<td><a href='posts.php?delete={$commentId}'>Unapproved</a></td>";
          echo "<td><a href='posts.php?delete={$commentId}'>Delete</a></td>";
          
          echo "</tr>";

          // $query = "SELECT * FROM categories WHERE cat_id = {$postCategoryId}";
          // $selectCategoriesId = mysqli_query($connection, $query);

          // while($row = mysqli_fetch_assoc($selectCategoriesId)){
          //   $catId = $row['cat_id'];
          //   $catTitle = $row['cat_title'];
          //   echo "<td>{$catTitle}</td>";
          // }
        }      
    
      ?>
  </tbody>
</table>

<?php 

if(isset($_GET['delete'])) {
	$deletePostId = $_GET['delete'];
	$query = "DELETE FROM posts
						WHERE post_id={$deletePostId} ";
	$deletePostQuery = mysqli_query($connection, $query);
	
	if(!$deletePostQuery) {
		die("Query Failed");
	}

	header("Location: posts.php");
}	
?>