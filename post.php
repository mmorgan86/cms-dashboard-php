<?php include "includes/header.php" ?>
<?php include "includes/db.php" ?>

<!-- Navigation -->
<?php include "includes/nav.php" ?>

<!-- Page Content -->
<div class="container">

	<div class="row">

		<!-- Blog Entries Column -->
		<div class="col-md-8">

			<?php

				if(isset($_GET['p_id'])) {
					$getPostId = $_GET['p_id'];
				
				$viewQuery = "UPDATE posts SET post_views = post_views + 1 WHERE post_id= $getPostId";
				$sendQuery = mysqli_query($connection, $viewQuery);
				
				if(!$sendQuery) {
					die("Send Query Failed " . mysqli_error($connection));
				}

				$query = "SELECT * FROM posts WHERE post_id = $getPostId ";
				$selectPostQuery = mysqli_query($connection, $query);

				while($row = mysqli_fetch_assoc($selectPostQuery)){
						$postTitle = $row['post_title'];
						$postAuthor = $row['post_author'];
						$postDate = $row['post_date'];
						$postImage = $row['post_image'];
						$postContent = $row['post_content'];

      ?>

			<!-- First Blog Post -->
			<h2>
				<a href="#">
					<?php echo $postTitle ?></a>
			</h2>
			<p class="lead">
				by <a href="index.php">
					<?php echo $postAuthor ?></a>
			</p>
			<p><span class="glyphicon glyphicon-time"></span> Posted on
				<?php echo $postDate ?>
			</p>
			<hr>
			<img class="img-responsive" src="images/<?php echo $postImage ?>" alt="">
			<hr>
			<p>
				<?php echo $postContent ?>
			</p>
			

			<hr>


			<?php } 
		
			} else  {
				header("Location: index.php");
			}
			?>

			<!-- Blog Comments -->

			<?php

				if(isset($_POST['create_comment'])) {

					$getPostId = $_GET['p_id'];
					$postCommentAuthor = $_POST['comment_author'];
					$postCommentEmail = $_POST['comment_email'];
					$postCommentContent = $_POST['comment_content'];

					if(!empty($postCommentAuthor) && !empty($postCommentEmail) && !empty($postCommentContent)) {

						$query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";

						$query .= "VALUES($getPostId, '{$postCommentAuthor}', '{$postCommentEmail}', '{$postCommentContent}', 'UNAPPROVED', now())";

						$createCommentQuery = mysqli_query($connection, $query);
						
						if(!$createCommentQuery) {
							die("QUERY FAILED " . mysqli_error($connection));
						}


						$query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
						$query .= "WHERE post_id = $getPostId";
						$updateCommentCount = mysqli_query($connection, $query);
						
						$message = "<h6 class='text-center bg-success'>Your comment has been submitted</h6>";
					} else {
						$message = "<h6 class='text-center bg-danger'>Fields cannot be left empty</h6>";
					}
				} else {
					$message = "";
				}
					

					

			?>

			<!-- Comments Form -->
			<div class="well">
				<h4>Leave a Comment:</h4>
				<form role="form" action="" method="post">
					<?php echo $message ?>
					<div class="form-group">
						<label for="Author">Author</label>
						<input class="form-control" type="text" name="comment_author">
					</div>

					<div class="form-group">
						<label for="email">Email</label>
						<input class="form-control" type="email" name="comment_email">
					</div>

					<div class="form-group">
						<label for="comment">Your Comment</label>
						<textarea name="comment_content" class="form-control" rows="3"></textarea>
					</div>
					<button type="submit" name="create_comment" class="btn btn-primary">Send</button>
				</form>
			</div>

			<hr>

			<!-- Posted Comments -->

			<?php
			
			$query = "SELECT * FROM comments WHERE comment_post_id = $getPostId ";
			$query .= "AND comment_status = 'Approved' ";
			$query .= "ORDER BY comment_id DESC ";

			$selectCommentQuery = mysqli_query($connection, $query);
			
			if(!$selectCommentQuery) {
				die("selectCommentQuery Failed ". mysqli_error($connection));
			}

			while($row = mysqli_fetch_assoc($selectCommentQuery)) {
				$commentDate = $row['comment_date'];
				$commentContent = $row['comment_content'];
				$commentAuthor = $row['comment_author'];
			?>

			<div class="media">
				<a class="pull-left" href="#">
					<img class="media-object" src="http://placehold.it/64x64" alt="">
				</a>
				<div class="media-body">
					<h4 class="media-heading"><?php echo $commentAuthor; ?>
						<small><?php echo $commentDate; ?></small>
					</h4>
					<?php echo $commentContent; ?>
				</div>
			</div>


			<?php } ?>

		</div>

		<!-- Blog Sidebar Widgets Column -->
		<?php include "includes/sidebar.php" ?>

	</div>
	<!-- /.row -->

	<hr>

	<?php include "includes/footer.php" ?>