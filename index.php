<?php

require('./inc/header.php');

if(!isset($_SESSION['username'])){
  header('Location: ./register.php');
}

// get user id
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION['username']]);
$user_id = $stmt->fetchAll()[0]['id'];

$sql = "SELECT categories.cat_id, categories.cat_name, todos.todo_id, todos.todo FROM categories LEFT JOIN todos ON todos.category_id = categories.cat_id WHERE todos.user_id = ? ORDER BY categories.cat_id ASC";
$stmt = $conn->prepare($sql);
$stmt->execute([$user_id]);
$todos = $stmt->fetchAll();

//counter
$display_arr = array();
foreach($todos as $todo){
  if(array_key_exists($todo['cat_id'], $display_arr)){
    $display_arr[$todo['cat_id']]["todos"][$todo['todo_id']] = $todo['todo'];
  } else {
    $display_arr[$todo['cat_id']]["cat_name"] = $todo['cat_name'];
    $display_arr[$todo['cat_id']]["todos"] = array();
    $display_arr[$todo['cat_id']]["todos"][$todo['todo_id']] = $todo['todo'];
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
  <header>
    <a href="./logout.php">Logout</a>
  </header>
  <main>
    <a href="./create-todo.php">create a new todo</a>
    <a href="./create-category.php">create a new category</a>
    <h1>To Do List</h1>
    <?php foreach($display_arr as $category) :?>
      <h2><?php echo $category['cat_name']; ?></h2>
      <ul>
        <?php foreach($category['todos'] as $key => $todo):?>
          <li><?php echo $todo; ?></li>
        <?php endforeach;?>
      </ul>
    <?php endforeach; ?>
  </main>
</body>
</html>