<?php

require('./inc/header.php');

if(!isset($_SESSION['username'])){
  header('Location: ./register.php');
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
    <h1>To Do List</h1>
  </main>
</body>
</html>