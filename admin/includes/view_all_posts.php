<?php
  if(isset($_POST['checkBoxArray'])) {
    foreach($_POST['checkBoxArray'] as $checkBoxPostId) {
      $bulkOptions = $_POST['bulkOptions'];

      switch($bulkOptions) {
        case 'published':
          $query = "UPDATE posts SET post_status = '{$bulkOptions}' ";
          $query .= "WHERE post_id = {$checkBoxPostId}";
          $bulkOptionsPublishQuery = mysqli_query($connection, $query);

          if(!$bulkOptionsPublishQuery) {
            die("Bulk Options Query Failed " . mysqli_error($connection));
          }
          
          break;
        case 'draft':
          $query = "UPDATE posts SET post_status = '{$bulkOptions}' ";
          $query .= "WHERE post_id = {$checkBoxPostId}";
          $bulkOptionsDraftQuery = mysqli_query($connection, $query);

          if(!$bulkOptionsDraftQuery) {
            die("Bulk Options Query Failed " . mysqli_error($connection));
          }
          
          break;
        case 'delete':
          $query = "DELETE FROM posts ";
          $query .= "WHERE post_id = {$checkBoxPostId}";
          $bulkOptionsDeleteQuery = mysqli_query($connection, $query);

          if(!$bulkOptionsDeleteQuery) {
            die("Bulk Options Query Failed " . mysqli_error($connection));
          }
          
          break;
      }
    }
  }

?>

<form action="" method="post">
  <table class="table table-bordered table-hover">
    <div class="row">
      <div id="bulkOptionContainer" class="col-xs-4 form-group">
        <select class="form-control" name="bulkOptions" id="">
          <option value="">Select Options</option>
          <option value="published">Publish</option>
          <option value="draft">Draft</option>
          <option value="delete">Delete</option>
        </select>
      </div>
      <div class="col-xs-4 form-group">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
      </div>
    </div>

    


    <thead>
      <tr>
        <th><input id="selectAllBoxes" type="checkbox"></th>
        <th>Id</th>
        <th>Author</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
        <?php 
        
          global $connection;
          $query = "SELECT * FROM posts ORDER BY post_id DESC";
        
          $selectPost = mysqli_query($connection, $query);
          while($row = mysqli_fetch_assoc($selectPost)) {
            $postId = $row['post_id'];
            $postAuthor = $row['post_author'];
            $postTitle = $row['post_title'];
            $postCategoryId = $row['post_category_id'];
            $postStatus = $row['post_status'];
            $postImage = $row['post_image'];
            $postTags = $row['post_tags'];
            $postCommentCount = $row['post_comment_count'];
            $postDate = $row['post_date'];
  
        
            echo "<tr>";
            ?>

            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $postId ?>'></td>

            <?php
            echo "<td>{$postId}</td>";
            echo "<td>{$postAuthor}</td>";
            echo "<td>{$postTitle}</td>";

            $query = "SELECT * FROM categories WHERE cat_id = {$postCategoryId}";
            $selectCategoriesId = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($selectCategoriesId)){
              $catId = $row['cat_id'];
              $catTitle = $row['cat_title'];
              echo "<td>{$catTitle}</td>";
            }

            echo "<td>{$postStatus}</td>";
            echo "<td><img src='../images/$postImage' alt='image' width='100'/></td>";
            echo "<td>{$postTags}</td>";
            echo "<td>{$postCommentCount}</td>";
            echo "<td>{$postDate}</td>";
            echo "<td><a href='../post.php?p_id={$postId}'>View Post</a></td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$postId}'>Edit</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');  \" href='posts.php?delete={$postId}'>Delete</a></td>";
            echo "</tr>";
          }      
      
        ?>
    </tbody>
  </table>
</form>

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
