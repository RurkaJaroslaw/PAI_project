<?php include('database.php');

//gdy osoba nie jest zalogowana, nie widzi tej strony
if (empty($_SESSION['username'])){
    header('location: login.php');
}

?>

<?php

$minimum_range = 0;
$maximum_range = 10;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="header2">
    <h1>Panel Administratora</h1>
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

            <hr>

            <h3>Ilość:</h3>
            <p id="ilosc"></p>
        </div>

    </div>

    <?php if (isset($_SESSION["username"])): ?>
        <p> <a href="index.php?logout='1'" style="color: red;"> Wyloguj </a> </p>
    <?php endif ?>
</div>

<div class="container">
    <br />
    <br />
    <br />
    <h3 align="center">Książek na stanie</a></h3><br />
    <br />
    <div class="row">
        <div class="col-md-2">
            <input type="text" name="minimum_range" id="minimum_range" class="form-control" value="<?php echo $minimum_range; ?>" />
        </div>
        <div class="col-md-8" style="padding-top:12px">
            <div id="price_range"></div>
        </div>
        <div class="col-md-2">
            <input type="text" name="maximum_range" id="maximum_range" class="form-control" value="<?php echo $maximum_range; ?>" />
        </div>
    </div>
    <br />
    <div id="load_product"></div>
    <br />
</div>

</body>
</html>



<script type="text/javascript">
    var book_table = [
        {
            book:"Potop",
            opis:"Lektura Henryka Sienkiewicza",
            streszczenie:"Historia potopu szwedów na naród polski.. ",
            ilosc: 4
        },

        {
            book:"Latarnik",
            opis:"Nudna lektura szkolna",
            streszczenie:"Smutna historia człowieka, który..  ",
            ilosc: 2
        },

        {
            book:"W pustyni i w puszczy",
            opis:"autor:Henryk Sienkiewicz",
            streszczenie:"Staś i Nel wyruszają w podróż życia..",
            ilosc: 2
        },

        {
            book:"Winnetou",
            opis:"autor: Karol May ",
            streszczenie:"Młody Indiani Winnetou staje do walki z... ",
            ilosc: 3
        },

        {
            book:"Harry Potter",
            opis:"Dziadostwo",
            streszczenie:"O takim co na miotle latał... ",
            ilosc: 1
        },

        {
            book:"Programowanie w Javie",
            opis:"autor: doc. Rogowski Amadeusz",
            streszczenie:"'Naucz się jedynego słusznego języka programowania w 2 dni i zarabiaj wielkie pieniądze w świecie informatyki, tak jak ja' - twierdzi autor",
            ilosc: 3
        },

        {
            book:"Podręcznik dziennikarstwa",
            opis:"kategoria: dziennikarstwo",
            streszczenie:"Kuba Wojewódzki o swojej historii",
            ilosc: 2
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
        document.getElementById('ilosc').innerHTML = book_table[i].ilosc


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
                document.getElementById('streszczenie').innerHTML = "Brak streszczenia";
                document.getElementById('ilosc').innerHTML = "Brak ksiazki na stanie";
            }
        }

        if (found >= 0) {
            show(found);
        }
    }

</script>

<script>
    $(document).ready(function(){

        $('#price_range').slider({
            range:true,
            min:0,
            max:10,
            values:[<?php echo $minimum_range; ?>, <?php echo $maximum_range; ?>],
            slide:function(event, ui){
                $("#minimum_range").val(ui.values[0]);
                $('#maximum_range').val(ui.values[1]);
                load_product(ui.values[0], ui.values[1]);
            }
        });

        load_product(<?php echo $minimum_range; ?>, <?php echo $maximum_range; ?>)  ;

        function load_product(minimum_range, maximum_range)
        {
            $.ajax({
                url:"fetch.php",
                method:"POST",
                data:{minimum_range:minimum_range, maximum_range:maximum_range},
                success:function(data)
                {
                    $('#load_product').html(data);
                }
            });
        }


    });
</script>