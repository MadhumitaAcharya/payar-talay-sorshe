<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            font-size: 36px;
            color: #333;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            font-size: 16px;
            color: #555;
        }

        .input-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 8px;
            box-sizing: border-box;
        }

        .input-group input:focus {
            border-color: #007BFF;
            outline: none;
        }

        .btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 15px 20px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .goback-button {
            text-decoration: none;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            display: inline-block;
            margin: 20px 0;
            transition: background-color 0.3s ease;
        }

        .goback-button:hover {
            background-color: #218838;
        }

        p {
            font-size: 16px;
            text-align: center;
        }

        p a {
            color: #007BFF;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- <a href="index.html" class="goback-button">Home</a> -->
    <div class="form-container">
        <div class="header">
            <h2>Login</h2>
        </div>

        <form method="post" action="login.php">
            <?php if (!empty($errors)) : ?>
                <div class="error">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="input-group">
                <button type="submit" class="btn" name="login_user">Login</button>
            </div>

            <p>Not yet a member? <a href="register.php">Sign up</a></p>
        </form>
    </div>
</body>

</html>
