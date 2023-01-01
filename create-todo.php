<?php

require './inc/header.php';

$sql = "SELECT * FROM categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
$categories_arr = $stmt->fetchAll();

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
  <form action="./" method="POST">
    <div>
      <label for="category">Category</label>
      <select name="category" id="category">
        <?php foreach($categories_arr as $category): ?>
          <option value="<?php echo $category['id'] ;?>"><?php echo $category['name']; ?></option>
        <?php endforeach ;?>
      </select>
    </div>
    <div>
      <label for="todo">Todo</label>
      <input type="text" id="todo" name="todo" />
    </div>
    <input type="submit" name="submit" value="Submit" />
  </form>
</body>
</html>