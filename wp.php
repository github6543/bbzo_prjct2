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
        <th>Von</th>
        <th>Bis</th>
        <th>Raumname</th>
        <th>Datum</th>
        <th>Klasse</th>
        <th>Zimmer</th>
        <th>Referent</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
   <?php
   $button = '<a href="#" class="btn btn-info" role="button">Löschen</a>';
   $link = dbconn();
   selectdb($link, $dbname);
   $sql = "SELECT `Untis`.`room.name`,`Untis`.`room.longName`,`Untis`.`date`,`Untis`.`startTime`,`Untis`.`endTime`,`Untis`.`klassen`,`lehrer`.`Name` FROM `Untis` LEFT JOIN `lehrer` ON `Untis`.`teachers` =  `lehrer`.`kuerzel` ";
   $result = mysql_query($sql);

   while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
   echo "<tr><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[0] . "</td><td>" . $row[2]. "</td><td>" . $row[5]. "</td><td>" . $row[1] . "</td><td>" . $row[6] . "</td></tr>";  //$row['index'] the index here is a field name
   }
    ?>
  </tbody>
    </table>
  </div>
</body>
