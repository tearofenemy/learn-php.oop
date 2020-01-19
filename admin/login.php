<?php require_once("includes/init.php"); ?>
<?php

if ($session->signedIn()) {
  redirect('index.php');
}

if (isset($_POST['submit'])) {

  $login = trim($_POST['login']);
  $pass = trim($_POST['pass']);
  $user = User::verify_user($login, $pass);

  if ($user) {
    $session->login($user);
    redirect('index.php');
  } else {
    $error_message = 'Your login or password incorrect';
  }

} else {
  $error_message = null;
  $login = null;
  $pass = null;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/login-form.css">
  <title>Login</title>
</head>
<body>


<div class="container">

    <span class="error-block"><?php echo $error_message; ?></span>
    <form action="" class="big" method="post">
      <input type="text" name="login" placeholder="Login" value="<?php echo htmlentities($username); ?>">
      <input type="password" name="pass" placeholder="Password" value="<?php echo htmlentities($password); ?>">
      <button type="submit" name="submit">Sign In</button>
    </form>

</div>

</body>
</html>