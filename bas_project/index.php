<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <style>
        .container {
            text-align: center;
            margin-top: 50px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: red;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 10px;
            box-shadow: 3px 3px black;
        }

        .button:hover {
            background-color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="img/bas_logo.png" alt="bas logo">
        <h1>Homepage</h1>
        <a href="insertKlant.php" class="button">Voeg nieuwe klant toe</a><br>
        <a href="selectKlant.php" class="button">Laat alle klanten zien</a><br>
        <a href="insertVerkoop.php" class="button">Voeg nieuwe verkooporders toe</a><br>
        <a href="selectVerkoop.php" class="button">Laat alle verkooporders zien</a><br>
        <a href="insertInkoop.php" class="button">Voeg nieuwe inkooporders toe</a><br>
        <a href="selectArtikel.php" class="button">Laat alle artikelen zien</a><br>
    </div>
</body>
</html>
