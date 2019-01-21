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

			<h1 class="page-header">
				Page Heading
				<small>Secondary Text</small>
			</h1>

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
			<a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

			<hr>


			<?php } ?>

			<!-- Blog Comments -->

			<?php

				if(isset($_POST['create_comment'])) {
					$getPostId = $_GET['p_id'];
					$postCommentAuthor = $_POST['comment_author'];
					$postCommentEmail = $_POST['comment_email'];
					$postCommentContent = $_POST['comment_content'];

					$query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";

					$query .= "VALUES($getPostId, '{$postCommentAuthor}', '{$postCommentEmail}', '{$postCommentContent}', 'UNAPPROVED', now())";

					$createCommentQuery = mysqli_query($connection, $query);
					
					if(!$createCommentQuery) {
						die("QUERY FAILED " . mysqli_error($connection));
					}
				}

			?>

			<!-- Comments Form -->
			<div class="well">
				<h4>Leave a Comment:</h4>
				<form role="form" action="" method="post">

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

			<!-- Comment -->
			<div class="media">
				<a class="pull-left" href="#">
					<img class="media-object" src="http://placehold.it/64x64" alt="">
				</a>
				<div class="media-body">
					<h4 class="media-heading">Start Bootstrap
						<small>August 25, 2014 at 9:30 PM</small>
					</h4>
					Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus
					odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec
					lacinia congue felis in faucibus.
				</div>
			</div>

			<!-- Comment -->
			<div class="media">
				<a class="pull-left" href="#">
					<img class="media-object" src="http://placehold.it/64x64" alt="">
				</a>
				<div class="media-body">
					<h4 class="media-heading">Start Bootstrap
						<small>August 25, 2014 at 9:30 PM</small>
					</h4>
					Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus
					odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec
					lacinia congue felis in faucibus.
					<!-- Nested Comment -->
					<div class="media">
						<a class="pull-left" href="#">
							<img class="media-object" src="http://placehold.it/64x64" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Nested Start Bootstrap
								<small>August 25, 2014 at 9:30 PM</small>
							</h4>
							Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus
							odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
							Donec lacinia congue felis in faucibus.
						</div>
					</div>
					<!-- End Nested Comment -->
				</div>
			</div>

		</div>

		<!-- Blog Sidebar Widgets Column -->
		<?php include "includes/sidebar.php" ?>

	</div>
	<!-- /.row -->

	<hr>

	<?php include "includes/footer.php" ?>