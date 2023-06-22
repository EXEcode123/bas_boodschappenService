<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Homepage</title>
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}

.center {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  height: 100vh;
}

.center h1 {
  text-align: center;
}
</style>
</head>
<body>

<div class="topnav">
  <a class="active" href="klanten/klanten.php">klanten</a>
  <a class="" href="artikelen/artikelen.php">Artikelen</a>
  <a class="" href="inkooporders/inkooporders.php">Inkooporder</a>
  <a class="" href="verkooporders/verkooporders.php">Verkooporders</a>
  <a class="" href="leveranciers/leveranciers.php">Leveranciers</a>
</div>

<div class="center">
    <img src="img/bas_logo.png" alt="Bas logo">
    <h1>Boodschappen service</h1>
    <h1><a href="https://github.com/EXEcode123/bas_boodschappenService.git">GitHub link:</a></h1>
</div>

</body>
</html>
