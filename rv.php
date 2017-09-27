<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
  <?php
  include "header.php";
  include "libs/dbfunctions.php";
  $dbname = "stundenplanapp";
  ?>
<body>
</br><h1>Raumverwaltung</h1>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
      <tr>
        <th>Status</th>
        <th>Raum</th>
        <th>Datum</th>
        <th>Von</th>
        <th>Bis</th>
        <th>Periodizität</th>
        <th>Bemerkung</th>
        <th>Benutzer</th>
      </tr>
    </thead>
    <tbody>
   <?php
   $button = '<a href="#" class="btn btn-info" role="button">Löschen</a>';
   $link = dbconn();
   mysql_set_charset('utf8',$link);
   selectdb($link, $dbname);
   $sql = "SELECT * From Raumverwaltung";
   $result = mysql_query($sql);

   while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
   echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3]. "</td><td>" . $row[4]. "</td><td>" . $row[5] . "</td><td>" . $row[6] . "</td><td>" . $row[7] . "</td></tr>";
   }
    ?>
  </tbody>
    </table>
  </div>
</body>
