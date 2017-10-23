<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
  <?php
  include "header.php";
  include "libs/dbfunctions.php";
  $dbname = "stundenplanapp";
  ?>
<body>

  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
      <tr>
        <th>Raumname</th>
        <th>Langer Raumname </th>
        <th>Datum</th>
        <th>Start Zeit</th>
        <th>End Zeit</th>
        <th>Booking ID</th>
        <th>Username</th>
        <th>Start Datum</th>
        <th>End Datum</th>
        <th>Klassen</th>
        <th>Aktivitäten Typ</th>
        <th>Lehrer</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
   <?php
   $button = '<a href="#" class="btn btn-info" role="button">Löschen</a>';
   $link = dbconn();
   mysql_set_charset('utf8', $link);
   selectdb($link, $dbname);
   $sql = "SELECT * FROM `Stundenplan` LEFT JOIN `Raumverwaltung` ON `Stundenplan`.`room.name` = `Raumverwaltung`.`Raum` WHERE `Stundenplan`.`room.name` LIKE `Raumverwaltung`.`Raum` AND `Stundenplan`.`startTime` = `Raumverwaltung`.`Von` AND `Stundenplan`.`date` = `Raumverwaltung`.`Datum` AND `Stundenplan`.`user.name` != `Raumverwaltung`.`Benutzer`";
   $result = mysql_query($sql);

   while ($row = mysql_fetch_array($result)) {   //Creates a loop to loop through results
       echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3]. "</td><td>" . $row[4]. "</td><td>" . $row[5] . "</td><td>" . $row[8] .
   "</td><td>" . $row[11] . "</td><td>" . $row[12] . "</td><td>" . $row[14] . "</td><td>" . $row[15] . "</td><td>" . $row[16]. "</td><td>" . $row[17]. "</td><td>" . $row[18]. "</td><td>" . $row[19]. "</td><td>" . $row[20]. "</td><td>" . $row[21]. "</td><td>" . $row[22]. "</td><td>" . $row[23]. "</td><td>" . $row[24 ]. "</td></tr>";  //$row['index'] the index here is a field name
   }
    ?>
  </tbody>
    </table>
  </div>
</body>
