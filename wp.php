<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
  <?php
  include "header.php";
  include "libs/dbfunctions.php";
  $dbname = "stundenplanapp";
  ?>
<body>
</br><h1>Stundenplanung</h1>
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
      </tr>
    </thead>
    <tbody>
   <?php
   $button = '<a href="#" class="btn btn-info" role="button">Löschen</a>';
   $link = dbconn();
   mysql_set_charset('utf8',$link);
   selectdb($link, $dbname);
   $sql = "SELECT `Stundenplan`.`room.name`,`Stundenplan`.`room.longName`,`Stundenplan`.`date`,`Stundenplan`.`startTime`,`Stundenplan`.`endTime`,`Stundenplan`.`klassen`,`lehrer`.`Name` FROM `Stundenplan` LEFT JOIN `lehrer` ON `Stundenplan`.`teachers` =  `lehrer`.`kuerzel` ";
   $result = mysql_query($sql);

   while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
   echo "<tr><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[0] . "</td><td>" . $row[2]. "</td><td>" . $row[5]. "</td><td>" . $row[1] . "</td><td>" . $row[6] . "</td></tr>";  //$row['index'] the index here is a field name
   }
    ?>
  </tbody>
    </table>
  </div>
</body>
