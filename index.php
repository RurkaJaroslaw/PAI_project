<?php include('database.php');

    //gdy user nie jest zalogowany, nie widzi tej strony
    if (empty($_SESSION['username'])){
        header('location: login.php');
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>User registration </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header2">
    <h1>Internetowa Wypożyczalnia Książek</h1>
</div>

    <div class="content">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="error success">
                <h3>
                    <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

        <?php if (isset($_SESSION["username"])): ?>
            <p>Welcome <strong> <?php echo $_SESSION['username']; ?> </strong> </p>
        <?php endif ?>
        <div class="wrapper">
            <div class="books">
                <input type="text" id="search" placeholder="Szukaj książki">
                <button onclick="search()">Go</button>

                <ul id="book_list"></ul>

            </div>

            <div class="book">
                <h3 id="book_text"></h3>
                <p id="opis"></p>

                <hr>

                <h3>Streszczenie:</h3>
                <li id="streszczenie"></li>

            </div>

        </div>

        <?php if (isset($_SESSION["username"])): ?>
            <p> <a href="index.php?logout='1'" style="color: red;"> Wyloguj </a> </p>
        <?php endif ?>
</div>

</body>
</html>



<script type="text/javascript">
    var book_table = [
        {
            book:"Potop",
            opis:"Lektura Henryka Sienkiewicza",
            streszczenie:"Historia potopu szwedów na naród polski.. "
        },

        {
            book:"Latarnik",
            opis:"Nudna lektura szkolna",
            streszczenie:"Smutna historia człowieka, który..  "
        },

        {
            book:"Winnetou",
            opis:"autor: Karol May ",
            streszczenie:"Młody Indiani Winnetou staje do walki z... "
        },

        {
            book:"Harry Potter",
            opis:"Dziadostwo",
            streszczenie:"O takim co na miotle latał... "
        },

        {
            book:"Programowanie w Javie",
            opis:"autor: doc. Rogowski Amadeusz",
            streszczenie:"'Naucz się jedynego słusznego języka programowania w 2 dni i zarabiaj wielkie pieniądze w świecie informatyki, tak jak ja' - twierdzi auor"
        },

        {
            book:"Podręcznik dziennikarstwa",
            opis:"kategoria: dziennikarstwo",
            streszczenie:"Kuba Wojewódzki o swojej historii"
        }
    ];



    init = function(){
        for (var i = 0; i < book_table.length; i++)
        {
            document.getElementById('book_list').innerHTML += "<li onclick='show(" + i + ")'>" + book_table[i].book + "</li>";
        }
    }

    init();

    show = function(i) {
        document.getElementById('book_text').innerHTML = book_table[i].book;
        document.getElementById('opis').innerHTML = book_table[i].opis;
        document.getElementById('streszczenie').innerHTML = book_table[i].streszczenie

        var list = "";

    }

    show(0);

    //search
    search = function () {
        query = document.getElementById('search').value;

        if (query == "") {
            return;
        }

        found = -1;

        for (var i = 0; i < book_table.length; i++) {
            if (query == book_table[i].book) {
                found = i;
                break;
            } else {
                document.getElementById('book_text').innerHTML = "Nie ma takiej książki";
                document.getElementById('opis').innerHTML = "Nie ma ksiazki zgodnej z opisem";
                document.getElementById('book_text').innerHTML = "Brak streszczenia";
            }
        }

        if (found >= 0) {
            show(found);
        }
    }

</script>