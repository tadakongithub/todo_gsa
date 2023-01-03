<?php

require './inc/header.php';

if(!isset($_SESSION['username'])){
  header('Location: ./login.php');
}

// get user id
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION['username']]);
$user_id = $stmt->fetchAll()[0]['id'];

if($_POST['submit']){
  $category = '';
  $category_err = '';

  if(empty($_POST['new_category'])){
    $category_err = 'Value was not provided';
  } else {
    $category = filter_input(INPUT_POST, 'new_category', FILTER_SANITIZE_SPECIAL_CHARS);
    //store new category in db and redirect
    $sql = "INSERT INTO categories (cat_name, user_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$category, $user_id]);
    header('Location: ./index.php');
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="./create-category.php" method="POST">
    <div>
      <label for="new_category">Category Name</label>
      <input type="text" id="new_category" name="new_category" />
      <p><?php echo $category_err; ?></p>
    </div>
    <input type="submit" name="submit" value="Submit" />
  </form>
</body>
</html>