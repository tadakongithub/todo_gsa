<?php

require('./inc/header.php');

header('Content-Type: text/plain');
header('Access-Control-Allow-Methods: *');

if(!empty($_POST['todo_id']) && !empty($_POST['todo'])){
  $todo_id = filter_input(INPUT_POST, 'todo_id', FILTER_SANITIZE_SPECIAL_CHARS);
  $todo = filter_input(INPUT_POST, 'todo', FILTER_SANITIZE_SPECIAL_CHARS);

  $sql = "SELECT * FROM todos WHERE todo_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$todo_id]);
  $rows = $stmt->fetchAll();

  if(count($rows) < 1){
    echo 'fail';
  } else {
    $sql = "UPDATE todos SET todo = ? WHERE todo_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$todo, $todo_id]);
    echo 'success';
  }

}

/*
require('./inc/header.php');


if(empty($_POST['todo'])){
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(array(
    'msg' => 'value not provided'
  ));
}

$sql = "SELECT COUNT(*) FROM todos WHERE todo_id = ?";
$stmt = conn->prepare($sql);
$count = $stmt->execute([$_POST['todo_id']]);
if($count < 1){
  
  echo json_encode(array(
    'msg' => 'invalid id'
  ));
}

$todo = filter_input(INPUT_POST, 'todo', FILTER_SANITIZE_SPECIAL_CHARS);
$sql = "UPDATE todos SET todo = ? WHERE todo_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$todo, $_POST['todo_id']]);
header('Content-Type: application/json; charset=utf-8');
  header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
echo json_encode(array(
  'msg' => 'success'
));*/