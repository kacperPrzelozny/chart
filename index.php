<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja wykresu - TypeScript</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body{
            flex-direction:column;
            display: inline-flex;
        }

        a{
            margin-left: 15px;
        }
        img{
            margin-left:10px;
        }
        #overlay {
            position: fixed;
            /* Sit on top of the page content */
            display: none;
            /* Hidden by default */
            width: 100%;
            /* Full width (cover the whole page) */
            height: 100%;
            /* Full height (cover the whole page) */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            /* Black background with opacity */
            z-index: 2;
            /* Specify a stack order in case you're using a different order for other elements */
            cursor: pointer;
            /* Add a pointer on hover */
        }

        .menu {
            width: 250px;
            background-color: #aaf0d1;
            position: absolute;
            top: 20%;
            left: 50%;
            font-size: 50px;
            color: white;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            border: 1px solid black;
        }

        .container {
            display: inline-flex;
            flex-direction: column;
            margin-left: 35px;
        }

        .container:last-child {
            margin-bottom: 20px;
        }
        input,
        button {
            width: 180px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php
    $width = 800;
    $height = 300;
    if (isset($_GET["w"])) {
        $width = $_GET["w"];
    }
    if (isset($_GET["h"])) {
        $height = $_GET["h"];
    }
    $query = "?w=$width&h=$height";
    $id = "$width" . "x" . "$height";
    echo '<img src="wykres.php' . $query . '" alt="Wykres" usemap="#wykres" id="' . $id . '">';
    ?>
    <map name="wykres" id="wykresMap"></map>
    <a href="wykresPDF.php">Pobierz plik PDF</a>
    <div id="overlay">
        <div class="menu">
            <div class="container">
                <input type="number" min="36.0" max="37.2" value="36" id="number">
                <button id="save">Zapisz temperaturę</button>
                <button id="ill">Choroba</button>
                <button id="none">Brak pomiaru</button>
                <button id="cancel">Anuluj</button>
            </div>

        </div>
    </div>
    <script src="./wykres.js"></script>
</body>

</html>