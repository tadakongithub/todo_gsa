<?php

if($_POST['submit']){
  $username = $password = '';
  $username_err = $password_err = '';

  if(!empty($_POST['username'])){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
  } else {
    $username_err = 'Please provide username';
  }

  if(!empty($_POST['password'])){
    $password = $_POST['password'];
  } else {
    $password_err = 'Please provide password';
  }

  if(empty($username_err) && empty($password_err)){
    //store data in database
    // redirect user to home page
    echo 'valid inputs';
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
</body>
</html>