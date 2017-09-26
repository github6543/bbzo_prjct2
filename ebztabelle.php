<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">

  <?php
  include "header.php";
  include "libs/dbfunctions.php";
  $dbname = "stundenplanapp";
  ?>

<body>
  <div class="btn-group btn-group-justified">
    <a href="ebztabelledownload.php" class="btn btn-primary">Tabelle Herunterladen</a>
    <a href="ebz.php" class="btn btn-primary">EBZ Kursbezeichnung Erfassen</a>
  </div></br></br>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
      <tr>
        <th>KW</th>
        <th>Datum</th>
        <th>Tag</th>
        <th>Von</th>
        <th>Bis</th>
        <th>Kurs</th>
        <th>Referent</th>
        <th>Gebäude</th>
        <th>Zimmer</th>
        <th>Stock</th>
        <th>Anz.T.</th>
        <th>Bemerkung</th>
        <th>Sonstiges</th>
        <th>Schlüssel</th>
        <th>AuftragsNr.</th>
        <th>Infoscreen</th>
      </tr>
    </thead>
    <tbody>
   <?php
   $button = '<a href="#" class="btn btn-info" role="button">Löschen</a>';
   $link = dbconn();
   mysql_set_charset('utf8', $link);
   selectdb($link, $dbname);
   //______________________________________________Raumverwaltung________________________________________________________
   $sql = 'SELECT DISTINCT * FROM Raumverwaltung WHERE Bemerkung LIKE "%EBZ%" OR "%ebz%"';
   $result = mysql_query($sql);
   while ($row = mysql_fetch_array($result)) {   //Creates a loop to loop through results
       echo "<tr><td>" . "  " . "</td><td>" . $row[2] . "</td><td>" . "Platzhalter Tag" . "</td><td>" . $row[3]. "</td><td>" . $row[4]. "</td><td>" . $row[6] . "</td><td>" . "Platzhalter Referent" .
   "</td><td>" . $row[7]. "</td><td>" . $row[1] ."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>". "</td></tr>";  //$row['index'] the index here is a field name
   }
//______________________________________________StundenPlan________________________________________________________
  $sql = "SELECT DISTINCT * FROM `Stundenplan` LEFT JOIN `EBZ` ON `Stundenplan`.`Klassen` =  `EBZ`.`ebzklasse` WHERE `Stundenplan`.`Klassen` = `EBZ`.`ebzklasse`";
   $result = mysql_query($sql);
   while ($row = mysql_fetch_array($result)) {   //Creates a loop to loop through results
       echo "<tr><td>" . "  " . "</td><td>" . $row[2] . "</td><td>" . "Platzhalter Tag" . "</td><td>" . $row[3]. "</td><td>" . $row[4]. "</td><td>" . $row[14] . "</td><td>" . $row[16] .
   "</td><td>" . $row[7]. "</td><td>" . $row[0] . "</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td></tr>";  //$row['index'] the index here is a field name
   }
    ?>
  </tbody>
    </table>
  </div>
</body>
