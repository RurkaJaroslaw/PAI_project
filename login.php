<?php include('database.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>User registration </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="header">
    <h2>Login</h2>
</div>

<form method="post" action="login.php">
    <!--Wyswietlanie errorow  -->
    <?php include ('errors.php'); ?>
    <div class="input_group">
        <label>Username:</label>
        <input type="text" name="username" />
    </div>

    <div class="input_group">
        <label>Password:</label>
        <input type="password" name="password" />
    </div>

    <div class="input_group">
        <button type="submit" name="login" class="btn">Login</button>
    </div>

    <p>
        Nie masz jeszcze konta? <a href="register.php">Zarejestruj się</a>
    </p>

</form>



</body>
</html>



