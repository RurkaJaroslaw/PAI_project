<?php
    include('database.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>User registration </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Register</h2>
    </div>

    <form method="post" action="register.php">
        <!--Wyswietlanie errorow  -->
        <?php include ('errors.php'); ?>

        <div class="input_group">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo $username; ?>" >
        </div>

        <div class="input_group">
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo $email; ?>" >
        </div>

        <div class="input_group">
            <label>Password:</label>
            <input type="password" name="password_1" />
        </div>

        <div class="input_group">
            <label>Confirm Password:</label>
            <input type="password" name="password_2" />
        </div>

        <div class="input_group">
            <button type="submit" name="register" class="btn">Register</button>
        </div>

        <p>
            Masz już konto? <a href="login.php">Zaloguj się</a>
        </p>

    </form>



</body>
</html>



