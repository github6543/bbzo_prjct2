<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BBZ Olten Buchungen</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.js"></script>

  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">BBZO Planungen</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="../index.php">Home</a></li>
        <li><a href="../buchungen.php">Buchungen</a></li>
        <li><a href="../ebztabelle.php">EBZ</a></li>
        <li><a href="../wp.php">Stundenplanung</a></li>
        <li><a href="../rv.php">Raumverwaltung</a></li>
        <li><a href="../about.php">About</a></li>
      </ul>
    </div>
  </div>
</nav>
</head>

  <?php
    include "dbfunctions.php";
    $dbname = "stundenplanapp";
  ?>
<?php
$ressource = $_POST['ressource'];
echo $ressource;
$link = dbconn();
selectdb($link, $dbname);
$sql = 'INSERT INTO ressourcen VALUES ("'.$ressource.'")';
$result = mysql_query($sql);
echo '<h1>Die Ressource wurde Erfolgreich hinzugefügt</h1>';
?>
</br>
<h1>
  Ressourcen Hinzufügen
</h1>
<form method="post" action="addresource.php">
   <p>Ressourcenbezeichnung: <input type="text" name="ressource" /></p>
   <input type="submit" name="submit" value="Submit" />
</form>
