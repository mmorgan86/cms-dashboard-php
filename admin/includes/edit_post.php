<?php 

  if(isset($_GET['p_id'])) {
    
    $getPostId = $_GET['p_id'];

  }
      
  
  $query = "SELECT * FROM posts WHERE post_id=$getPostId ";
  $selectPostById = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($selectPostById)) {

    $postId = $row['post_id'];
    $postAuthor = $row['post_author'];
    $postTitle = $row['post_title'];
    $postCategoryId = $row['post_category_id'];
    $postStatus = $row['post_status'];
    $postImage = $row['post_image'];
    $postTags = $row['post_tags'];
    $postCommentCount = $row['post_comment_count'];
    $postDate = $row['post_date'];
    $postContent = $row['post_content'];
  }

// Get dynamic category
  $query = "SELECT cat_title FROM categories WHERE cat_id=$postCategoryId";
  $getCatQuery = mysqli_query($connection, $query);
  if(!$getCatQuery) {
    die("Get Category Query Failed " .  myslqi_error($connection));
  }
  $row = mysqli_fetch_assoc($getCatQuery);
  $category = $row['cat_title'];

  if(isset($_POST['update_post'])) {
    
    $postTitle = mysqli_real_escape_string($connection,$_POST['title']);
    $postAuthor = mysqli_real_escape_string($connection,$_POST['post_author']);
    $postCategoryId = mysqli_real_escape_string($connection,$_POST['post_category']);
    $postStatus = mysqli_real_escape_string($connection,$_POST['post_status']);

    $postImage = $_FILES['image']['name'];
    $postImageTemp = $_FILES['image']['tmp_name'];

    $postTags= mysqli_real_escape_string($connection,$_POST['post_tags']);
    $postContent = mysqli_real_escape_string($connection,$_POST['post_content']);

    move_uploaded_file($postImageTemp, "../images/$postImage");

    if(empty($postImage)) {
    $query = "SELECT * FROM posts WHERE post_id=$getPostId ";
    $selectImage = mysqli_query($connection, $query);

      while($row = mysqli_fetch_array($selectImage)) {
        $postImage = $row['post_image'];
      }

    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$postTitle}', ";
    $query .= "post_category_id = {$postCategoryId}, ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$postAuthor}', ";
    $query .= "post_status = '{$postStatus}', ";
    $query .= "post_tags = '{$postTags}', ";
    $query .= "post_content = '{$postContent}', ";
    $query .= "post_image = '{$postImage}' ";
    $query .= "WHERE post_id = $getPostId";

    $updatePostQuery = mysqli_query($connection, $query);

    if(!$updatePostQuery) {
      die('Update Post Query Failed ' . mysqli_error($connection));
    }

    echo "<p class='bg-success'>Post Updated: ". " " . "<a href='../post.php?p_id={$getPostId}'>View Post</a> or <a href='posts.php'>Edit More Post</a></p>";

  }
?>  


<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title" value="<?php echo $postTitle ?>">
  </div>

  <div class="form-group">
    <select name="post_category" id="post_category" required>

      <?php

        $query = "SELECT * FROM categories";
        $selectCategories = mysqli_query($connection, $query);

        confirmQuery($selectCategories);
        echo "<option value='$postCategoryId'>{$category}</option>";
        while($row = mysqli_fetch_assoc($selectCategories)){
          $catId = $row['cat_id'];
          $catTitle = $row['cat_title'];

          if ($postCategoryId == $catId) {
            echo "<option style='display: none' value='{$catId}'>{$catTitle}</option>";
          } else {
            echo "<option value='{$catId}'>{$catTitle}</option>";
          }
          // SET A REFRESH POINT HERE IN THE FUTURE
        }
      ?>
  
    </select>
  </div>

  <div class="form-group">
    <label for="post_author">Post Author</label>
    <input type="text" class="form-control" name="post_author" value="<?php echo $postAuthor ?>">
  </div>

  <div class="form-group">
    <select name="post_status" id="" required>
      <option value='<?php echo $postStatus ?>'><?php echo ucfirst($postStatus) ?></option>
      <?php
        if($postStatus == 'published') {
          echo "<option value='draft'>Draft</option>";
        }else {
          echo "<option value='published'>Publish</option>";
        } 
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="image">Post Image</label>
    <img src="../images/<?php echo $postImage ?>" alt="" width="100">
    <input type="file" name="image">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags" value="<?php echo $postTags ?>">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="content" cols="30" rows="10"><?php echo $postContent ?> 
    </textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Edit Post">
  </div>

</form>

