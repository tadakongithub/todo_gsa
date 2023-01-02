<?php

require './inc/header.php';

if(!isset($_SESSION['username'])){
  header('Location: ./register.php');
}

$sql = "SELECT * FROM categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
$categories_arr = $stmt->fetchAll();

if($_POST['submit']){
  // get user id
  $sql = "SELECT * FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$_SESSION['username']]);
  $user_id = $stmt->fetchAll()[0]['id'];

  
  $todo = $category = '';
  $todo_err = $category_err = '';

  //check if input was provided for todo
  if(empty($_POST['todo'])){
    $todo_err = 'No value was provided';
  }

  //check if category id exists in categories table
  $sql = "SELECT COUNT(*) from categories WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $count = $stmt->execute([$_POST['category']]);
  if($count < 1){
    $category_err = 'invalid category value';
  }

  if(empty($todo_err) && empty($category_err)){
    $todo = filter_input(INPUT_POST, 'todo', FILTER_SANITIZE_SPECIAL_CHARS);
    $sql = "INSERT INTO todos (todo, category_id, user_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$todo, $_POST['category'], $user_id]);
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
  <form action="./create-todo.php" method="POST">
    <div>
      <label for="category">Category</label>
      <select name="category" id="category">
        <?php foreach($categories_arr as $category): ?>
          <option value="<?php echo $category['id'] ;?>"><?php echo $category['name']; ?></option>
        <?php endforeach ;?>
      </select>
      <p><?php echo $category_err; ?></p>
    </div>
    <div>
      <label for="todo">Todo</label>
      <input type="text" id="todo" name="todo" />
    </div>
    <input type="submit" name="submit" value="Submit" />
  </form>
</body>
</html>