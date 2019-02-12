<?php
    session_start(); //poczatek sesji

    $username = "";
    $email = "";
    $errors = array();

    //polaczenie z baza danych
    $db = mysqli_connect('localhost','root','','login');

    //gdy wcisne przycisk rejestracji
    if(isset($_POST['register'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
        //sprawdzam czy pola sa wypelnione
        if (empty($username)){
            array_push($errors, "Username wymagany");
        }

        if (empty($email)){
            array_push($errors, "Email wymagany");
        }

        if (empty($password_1)){
            array_push($errors, "Haslo wymagane");
        }

        if ($password_1 != $password_2){
            array_push($errors, "Hasła do siebie nie pasują");
        }


        //jesli powyzsze bledy nie wystapily, dodaj uzytkownika do bazy danych
        if (count($errors) == 0) {
            $password = md5($password_1); //szyfrowanie hasla
            $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', 'user')";
            mysqli_query($db, $sql);
            //log user in
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Zalogowano pomyślnie";
            header('location: index.php');
        }
    }

    //logowanie z okna logowania
    if (isset($_POST['login'])){
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        //sprawdzam czy pola sa wypelnione
        if (empty($username)){
            array_push($errors, "Username wymagany");
        }

        if (empty($password)){
            array_push($errors, "Haslo wymagane");
        }

        if (count($errors) == 0) {
            $password = md5($password); //szyfrowanie hasla
            $query = "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='user'";
            $result = mysqli_query($db, $query);

            $queryAdmin = "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='admin'";
            $resultAdmin = mysqli_query($db, $queryAdmin);

            if (mysqli_num_rows($result) == 1){
                //log user in
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Zalogowano pomyślnie";
                header('location: index.php');
            }
            else if (mysqli_num_rows($resultAdmin) == 1){
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Zalogowano pomyślnie";
                header('location: indexAdmin.php');
            }
            else{
                array_push($errors, "Zły login/hasło");
            }
        }

    }

    //wylogowanie
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }

?>