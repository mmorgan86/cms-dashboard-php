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

      <!-- row -->

      <?php
        $query = "SELECT * FROM posts WHERE post_status = 'published' ";
        $selectAllPublishedPost = mysqli_query($connection, $query);
        $postPublishedCount = mysqli_num_rows($selectAllPublishedPost);

        $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
        $selectAllDraftPost = mysqli_query($connection, $query);
        $postDraftCount = mysqli_num_rows($selectAllDraftPost);

        $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
        $unapprovedCommentsQuery = mysqli_query($connection, $query);
        $unapprovedCommentCount = mysqli_num_rows($unapprovedCommentsQuery);

        $query = "SELECT * FROM users WHERE user_role = 'user' ";
        $selectAllUsers = mysqli_query($connection, $query);
        $userRightsCount = mysqli_num_rows($selectAllUsers);


      ?>

      <div class="row">
        <script type="text/javascript">
          google.charts.load('current', {'packages':['bar']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Data', 'Count'],

                <?php
                  $elementText = ['All Post','Active Post','Draft Post', 'Comments','Pending Comments','User Rights','All Users', 'Categories'];
                  $elementCount = [$postCount, $postPublishedCount, $postDraftCount, $commentCount, $unapprovedCommentCount, $userRightsCount, $userCount, $categoryCount];

                  for($i = 0; $i < 8; $i++){
                      echo "['{$elementText[$i]}'" . "," . "{$elementCount[$i]}],";
                  }

                  
                ?>
              // ['Post', 1000],
            ]);

            var options = {
              chart: {
                title: 'Site Stats',
                subtitle: '',
              }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
          }
        </script>

        <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include "includes/adminFooter.php" ?>