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

				$query = "SELECT * FROM posts";
				$selctAllPostQuery = mysqli_query($connection, $query);

				while($row = mysqli_fetch_assoc($selctAllPostQuery)){
					$postId= $row['post_id'];
					$postTitle = $row['post_title'];
					$postAuthor = $row['post_author'];
					$postDate = $row['post_date'];
					$postImage = $row['post_image'];
					$postContent = substr($row['post_content'],0,150) . "..";
					$postStatus = $row['post_status'];

					if($postStatus === 'published') {

      ?>
			<!-- First Blog Post -->
			<h2>
				<a href="post.php?p_id=<?php echo $postId; ?>">
					<?php echo $postTitle ?>
				</a>
			</h2>
			<p class="lead">
				by <a href="authorPost.php?author=<?php echo $postAuthor ?>&p_id=<?php echo $postId; ?>">
					<?php echo $postAuthor ?></a>
			</p>
			<p><span class="glyphicon glyphicon-time"></span> Posted on
				<?php echo $postDate ?>
			</p>
			<hr>
			<a href="post.php?p_id=<?php echo $postId; ?>">
				<img class="img-responsive" src="images/<?php echo $postImage ?>" alt="">
			</a>
			<hr>
			<p>
				<?php echo $postContent;?>
			</p>
			<a class="btn btn-primary" href="post.php?p_id=<?php echo $postId; ?>">Read More<span class="glyphicon glyphicon-chevron-right"></span></a>

			<hr>


			<?php } }?>
		</div>

		<!-- Blog Sidebar Widgets Column -->
		<?php include "includes/sidebar.php" ?>

	</div>
	<!-- /.row -->

	<hr>

	<?php include "includes/footer.php" ?>