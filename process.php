<?php

    //Pobranie wartosci z formularza login.php
    $username = $_POST['user'];
    $password = $_POST['pass'];

    //Polaczenie z baza danych
    /*    mysqli_connect("localhost","root","");
    mysqli_select_db(login);  */
    $mysqli = new mysqli("localhost", "root", "", "login");


//Zabezpieczenie przeciwko SQLinjection
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $username = mysqli_real_escape_string($mysqli, $username);
    $password = mysqli_real_escape_string($mysqli, $password);

    //Pytanie bazy danych o uzytkownika
    $result = mysqli_query($mysqli, "select * from users where username = '$username' and password = '$password'")
                or die ("Nie udało się połączyć z bazą danych. ".mysqli_error($mysqli));
    $row = mysqli_fetch_array($result);
    if ($row['username'] == $username and $row['password'] == $password ){
        echo "Zalogowano pomyślnie. Witaj ".$row['username'];
}
    else{
        echo "Logowanie nie powiodło się";
    }

?>