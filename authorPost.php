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
          $getPostAuthor = $_GET['author'];
				}

				$query = "SELECT * FROM posts WHERE post_author = '{$getPostAuthor}' ";
				$selectPostQuery = mysqli_query($connection, $query);

				while($row = mysqli_fetch_assoc($selectPostQuery)){
            $postId = $row['post_id'];
						$postTitle = $row['post_title'];
						$postAuthor = $row['post_author'];
						$postDate = $row['post_date'];
						$postImage = $row['post_image'];
						$postContent = $row['post_content'];

      ?>

			<!-- Blog Post -->
			<h2>
				<a href="post.php?p_id=<?php echo $postId; ?>">
					<?php echo $postTitle ?>
				</a>
			</h2>
			<p class="lead"> 
        All post by <?php echo $postAuthor ?>
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


			<?php } ?>


		</div>

		<!-- Blog Sidebar Widgets Column -->
		<?php include "includes/sidebar.php" ?>

	</div>
	<!-- /.row -->

	<hr>

	<?php include "includes/footer.php" ?>