<?php

require('./inc/header.php');

if($_POST['submit']){
  $username = $password = '';
  $username_err = $password_err = '';

  if(!empty($_POST['username'])){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
  } else {
    $username_err = 'Please provide username';
  }

  $sql = "SELECT * from users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->execute([$username]);
  $result = $stmt->fetchAll();
  if(count($result) > 0){
    $username_err = 'username already taken';
  }

  if(!empty($_POST['password'])){
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  } else {
    $password_err = 'Please provide password';
  }

  if(empty($username_err) && empty($password_err)){
    //store data in database
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $password]);

    // redirect user to home page
    $_SESSION['username'] = $username;
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
  <header>
    <a href="./login.php">Login</a>
  </header>
  <main>
    <form action="./register.php" method="POST">
      <div>
        <label for="username">User Name</label>
        <input type="text" id="username" name="username" />
        <p><?php echo $username_err; ?></p>
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" />
        <p><?php echo $password_err; ?></p>
      </div>
      <input type="submit" name="submit" value="Submit" />
    </form>
  </main>
</body>
</html>