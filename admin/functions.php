<?php

function usersOnline() {
  
  global $connection;

  $session = session_id();
  $time = time();
  $time_out_in_seconds = 60;
  $time_out = $time - $time_out_in_seconds;

  $query = "SELECT * FROM users_online WHERE session ='$session'";
  $sendQuery = mysqli_query($connection, $query);
  $count = mysqli_num_rows($sendQuery);

  if(!$sendQuery) {
    die("Send Query Failed " . mysqli_error($connection));
  }

  if($count == NULL) {
    mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");
  } else {
    mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");
  } 

  $usersOnlineQuery = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
  return $countUser = mysqli_num_rows($usersOnlineQuery);

}

function confirmQuery($result) {
  global $connection;

  if(!$result) {
    die(" Query Failed " . mysqli_error($connection));
  }
}

function insertCategories() {

  global $connection;

  if(isset($_POST['submit'])) {
    $catTitle = mysqli_real_escape_string($connection,$_POST['cat_title']);
    
    if($catTitle === "" || empty($catTitle)) {
      echo "This field should not be empty!";
    } else {
      $query = "INSERT INTO categories(cat_title) ";
      $query .= "VALUES('$catTitle')";

      $createCategoryQuery =  mysqli_query($connection, $query);

      if(!$createCategoryQuery) {
        die('Create Category Query Failed '. mysqli_error($connection));
      }
    }
  }
}

function updateQuery() {
  global $connection;

  if(isset($_GET['edit'])) {
    $catId = $_GET['edit'];

    include "includes/update_categories.php";
  }
}

function findAllCategories() {
  global $connection;

  $query = "SELECT * FROM categories";
  $selectCategories = mysqli_query($connection, $query);

  while($row = mysqli_fetch_assoc($selectCategories)){
  $catId = $row['cat_id'];
  $catTitle = $row['cat_title'];

    echo "<tr>";
    echo "<td>{$catId}</td>";
    echo "<td>{$catTitle}</td>";
    echo "<td><a href='categories.php?delete={$catId}'> Delete</a></td>";
    echo "<td><a href='categories.php?edit={$catId}'> Edit</a></td>";
    echo "</tr>";
  }
}

function deleteCategories() {
  global $connection;
  
  if(isset($_GET["delete"])) {
    $getCatId= $_GET["delete"];
    
    $query = "DELETE FROM categories WHERE cat_id = {$getCatId} ";
    $deleteQuery = mysqli_query($connection, $query);
    header("Location: categories.php");
  }
}



?>

