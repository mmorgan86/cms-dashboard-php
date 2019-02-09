<?php
  $user = $_SESSION['username'];

  if(isset($_POST['create_post'])) {

    $postTitle = mysqli_real_escape_string($connection,$_POST['title']);
    $postAuthor = mysqli_real_escape_string($connection,$_POST['author']);
    $postCategoryId = mysqli_real_escape_string($connection,$_POST['post_category']);
    $postStatus = mysqli_real_escape_string($connection,$_POST['post_status']);

    $postImage = $_FILES['image']['name'];
    $postImageTemp = $_FILES['image']['tmp_name'];

    $postTags= mysqli_real_escape_string($connection,$_POST['post_tags']);
    $postContent = mysqli_real_escape_string($connection,$_POST['post_content']);
    $postDate = date('d-m-y');

    
  
    move_uploaded_file($postImageTemp, "../images/$postImage");

    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";

    $query .= "VALUES({$postCategoryId},'{$postTitle}','{$postAuthor}',now(),'{$postImage}','{$postContent}','{$postTags}','{$postStatus}') ";
    
    $createPostQuery = mysqli_query($connection, $query);
    
    confirmQuery($createPostQuery);

    $getPostId = mysqli_insert_id($connection);

    // PRINTS OUT GREEN HIGHLIGHT IF SUCCESSFUL POST
    echo "<p class='bg-success'>Post Added: ". " " . "<a href='../post.php?p_id={$getPostId}'>View Your Post</a> or <a href='posts.php'>View All Post</a></p>";

  }
?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" class="form-control" name="title" required>
  </div>

  <div class="form-group">
    <select name="post_category" id="post_category" required>
      <option value=''>Select Category</option>
      <?php
        $query = "SELECT * FROM categories";
        $selectCategories = mysqli_query($connection, $query);

        confirmQuery($selectCategories);

        while($row = mysqli_fetch_assoc($selectCategories)){
          $catId = $row['cat_id'];
          $catTitle = $row['cat_title'];

          echo "<option value='{$catId}'>{$catTitle}</option>";

        }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="author">Post Author</label>
    <input type="text" class="form-control" name="author" value="<?php echo $user ?>" readonly>
  </div>

  <div class="form-group">
    <select name="post_status" id="" required>
      <option name='post_status' value=''>Select Status</option>
      <option name='post_status' value='draft'>Draft</option>
      <option name='post_status' value='published'>Publish</option>
    </select>
  </div>

  <div class="form-group">
    <label for="image">Post Image</label>
    <input type="file" class="form-control" name="image">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="content" cols="30" rows="10" required>
    </textarea>
  </div>

  <div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
  </div>

</form>