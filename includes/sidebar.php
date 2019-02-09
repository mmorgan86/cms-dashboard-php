<div class="col-md-4">
	
	<!-- Blog Search Well -->
	<div class="well">
		<h4>Search</h4>
		<form action="search.php" method="post">
			<div class="input-group">
				<input name="search" type="text" class="form-control">
				<span class="input-group-btn">
					<button name="submit" class="btn btn-default" type="submit">
						<span class="glyphicon glyphicon-search"></span>
					</button>
				</span>
			</div>
		</form> <!-- search form --->
		<!-- /.input-group -->
	</div>

	<!-- Login Form -->
	<?php
		if(isset($_SESSION['username']) == "") {
		
	?>
		<div class="well border border-danger" >
			<h4 style='color: red;'>Login</h4>
			<form action="includes/login.php" method="post">
				<div class="form-group">
					<input name="username" type="text" class="form-control border border-danger" placeholder="Enter Username" required="Please enter a valid username">
				</div>
				<div class="input-group">
					<input name="password" type="password" class="form-control border border-danger" placeholder="Enter Password" required="Please enter a valid username">
					<span class="input-group-btn">
						<button class="btn btn-success" name="login" type="submit">Login</button>
					</span>
				</div>
			</form> <!-- search form --->
			<!-- /.input-group -->
		</div>
		<!-- Blog Categories Well -->


		<!-- Page Content -->

<div class="well">
	<!-- <div class="container">
		<div class="row"> -->
			<!-- <div class="col-xs-6 col-xs-offset-3"> -->
				<!-- <div class="form-wrap"> -->
					<h4>Register</h4>
					<form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
						<h6 class="text-center"><?php echo $message ?></h6>
						<div class="form-group">
							<label for="username" class="sr-only">username</label>
							<input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
						</div>
						<div class="form-group">
							<label for="email" class="sr-only">Email</label>
							<input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
						</div>
						<div class="input-group">
							<label for="password" class="sr-only">Password</label>
							<input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
							<span class="input-group-btn"><button class="btn btn-primary" name="submit" type="submit"> Register</button></span>
						</div>

						<!-- <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register"> -->
					</form>

				<!-- </div> -->
			<!-- </div> --> <!-- /.col-xs-12 -->
	<!-- </div> --> <!-- /.row -->
	<!-- </div> --> <!-- /.container -->
		</div>
		<?php } else {
		?>

			<!-- LOGGED IN REMOVE FORM -->
		<div class="well">
			<h2>You are logged in as <?php echo $_SESSION['username']  ?></h2>
			<a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i><button> Logout</button></a>
		</div>

			<!-- <div class="well" >
			<h4>Login</h4>
			<form action="includes/login.php" method="post">
				<div class="form-group">
					<input name="username" type="text" class="form-control" placeholder="Enter Username" required="Please enter a valid username">
				</div>
				<div class="input-group">
					<input name="password" type="password" class="form-control" placeholder="Enter Password" required="Please enter a valid username">
					<span class="input-group-btn">
						<button class="btn btn-primary" name="login" type="submit">Login</button>
					</span>
				</div> -->
			<!-- </form> search form - -->
			<!-- /.input-group -->
		<!-- </div> -->
		<!-- Blog Categories Well -->
		<?php
		}
	?>


	
<?php 

	$query = "SELECT * FROM categories";
	$selctCategoriesQuerySidebar = mysqli_query($connection, $query);
?>

	<div class="well">
		<h4>Car Groups</h4>
		<div class="row">
			<div class="col-lg-12">
				<ul class="list-unstyled">
					<?php 
						while($row = mysqli_fetch_assoc($selctCategoriesQuerySidebar)){
							$catTitle = $row['cat_title'];
							$catId = $row['cat_id'];

							echo "<li><a href='category.php?category=$catId'>{$catTitle}</a></li>";
						}
					?>
				</ul>
			</div>
		</div>
		<!-- /.row -->
	</div>

	<!-- Side Widget Well -->
	<?php include "widget.php" ?>

</div>