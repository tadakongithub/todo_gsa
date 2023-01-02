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

//data restructuring for display
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
          <li><?php echo $todo; ?> | <button class="edit" data-todo-id="<?php echo $key; ?>" data-todo="<?php echo $todo;?>">edit</button></li>
        <?php endforeach;?>
      </ul>
    <?php endforeach; ?>

    <?php require './inc/modal_edit.php'; ?>
  </main>


  <script>
    $(".edit").click(function() {
      $('#edit_todo_id').val($(this).data('todo-id'));
      $('#edit_todo').val($(this).data('todo'));
      $('#edit_modal').modal('show');
    });
  </script>
</body>
</html>