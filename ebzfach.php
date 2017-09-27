<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
  <?php
  include "header.php";
    include "libs/dbfunctions.php";
    $dbname = "stundenplanapp";
  ?>
<?php
$Fachbezeichnung = $_POST['Fachbezeichnung'];
$Fachkuerzel = $_POST['Fachkuerzel'];
$link = dbconn();
selectdb($link, $dbname);
$sql = 'INSERT INTO EBZ VALUES (' .'"'.$Fachbezeichnung.'")';
$result = mysql_query($sql); 
echo '<h1>Die Klassenbezeichnung wurde Erfolgreich hinzugefügt</h1>';
?>
<body>
  <div class="btn-group btn-group-justified">
    <a href="erfassen.php" class="btn btn-primary">Erfassen</a>
    <!--  <a href="löschen.php" class="btn btn-primary">Löschen</a> -->
  </div></br></br>

  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
      <tr>
        <th>EBZ Klassenbezeichnung</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
   <?php
   $button = '<a href="#" class="btn btn-info" role="button">Löschen</a>';
   $link = dbconn();
   mysql_set_charset('utf8',$link);
   selectdb($link, $dbname);
   $sql = "SELECT * FROM EBZ";
   $result = mysql_query($sql);
   while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
   echo "<tr><td>" . $row[0] . "</td></tr>";  //$row['index'] the index here is a field name
   }
    ?>
  </tbody>
    </table>
  </div>
</body>
