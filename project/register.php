<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f0f0;
    }

    .goback-button {
      text-decoration: none;
      color: #333;
      font-size: 16px;
      margin: 20px;
      display: inline-block;
    }

    .header {
      background-color: #4CAF50;
      padding: 20px;
      text-align: center;
      color: white;
    }

    form {
      max-width: 400px;
      margin: 40px auto;
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .input-group {
      margin-bottom: 20px;
    }

    label {
      font-size: 14px;
      color: #555;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
      color: #555;
    }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      width: 100%;
    }

    p {
      text-align: center;
      font-size: 14px;
      color: #555;
    }

    a {
      color: #4CAF50;
    }
  </style>
</head>
<body>
  <a href="http://localhost/project/Hotel_2.0/index.html" 
     class="goback-button">
    Home
  </a>

  <div class="header">
    <h2>Register</h2>
  </div>

  <form method="post" action="register.php">
    <?php include('errors.php'); ?>
    
    <div class="input-group">
      <label for="username">Username</label>
      <input type="text" name="username" value="<?php echo $username; ?>" place>
    </div>
    
    <div class="input-group">
      <label for="email">Email</label>
      <input type="email" name="email" value="<?php echo $email; ?>">
    </div>

    <div class="input-group">
      <label for="password_1">Password</label>
      <input type="password" name="password_1">
    </div>

    <div class="input-group">
      <label for="password_2">Confirm password</label>
      <input type="password" name="password_2">
    </div>

    <div class="input-group">
      <button type="submit" name="reg_user">Register</button>
    </div>

    <p>
      Already a member? <a href="login.php">Sign in</a>
    </p>
  </form>
</body>
</html>
