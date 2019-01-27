<?php include "includes/adminHeader.php" ?>

<div id="wrapper">

  <!-- Navigation -->
  <?php include "includes/adminNav.php" ?>


  <div id="page-wrapper">

    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="row">
        <div class="col-lg-12">


          <h1 class="page-header">
            Welcome to Admin
            <small>
              <?php echo $_SESSION['username']; ?></small>
          </h1>


        </div>
      </div>
      <!-- /.row -->

      <!-- row -->
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-file-text fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">

                <?php
                  $query = "SELECT * FROM posts";
                  $selectAllPost = mysqli_query($connection, $query);

                  $postCount = mysqli_num_rows($selectAllPost);
                  echo "<div class='huge'>{$postCount}</div>";

                ?>

                  <div>Posts</div>
                </div>
              </div>
            </div>
            <a href="posts.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-green">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-comments fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">
                  <?php 
                    $query = "SELECT * FROM comments";
                    $selectAllComments = mysqli_query($connection, $query);
                    $commentCount = mysqli_num_rows($selectAllComments);
                    echo "<div class='huge'>{$commentCount}</div>";
                  ?>
                  
                  <div>Comments</div>
                </div>
              </div>
            </div>
            <a href="comments.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-yellow">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-user fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">

                  <?php 
                    $query = "SELECT * FROM users ";
                    $selectAllUsers = mysqli_query($connection, $query);
                    $userCount = mysqli_num_rows($selectAllUsers);
                    echo "<div class='huge'>{$userCount}</div>";

                  ?>

                  <div> Users</div>
                </div>
              </div>
            </div>
            <a href="users.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="panel panel-red">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-3">
                  <i class="fa fa-list fa-5x"></i>
                </div>
                <div class="col-xs-9 text-right">

                  <?php
                    $query = "SELECT * FROM categories ";
                    $selectAllCategories = mysqli_query($connection, $query);
                    $categoryCount = mysqli_num_rows($selectAllCategories);
                    echo "<div class='huge'>{$categoryCount}</div>";
                  ?>

                  <div>Categories</div>
                </div>
              </div>
            </div>
            <a href="categories.php">
              <div class="panel-footer">
                <span class="pull-left">View Details</span>
                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                <div class="clearfix"></div>
              </div>
            </a>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include "includes/adminFooter.php" ?>