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
     //______________________________________________DB-Connection________________________________________________________
   $link = dbconn();
   mysql_set_charset('utf8', $link);
   selectdb($link, $dbname);

   //______________________________________________Funktionen________________________________________________________
   function bemerkungsfilter($bemerkungrow)
   {
       if (preg_match('-- e', $bemerkungrow) == "1") {
           $bemerkung = "Raum Öffnen";
           return $bemerkung;
       }
   }

   function gebaude($gebauderow)
   {
       if (preg_match('G', $gebauderow) == "1") {
           $gebaude = "GIBS";
           echo $gebaude;
           return $gebaude;
       } else {
           $gebaude = "KBS";
           return $gebaude;
       }
   }

   //______________________________________________Raumverwaltung________________________________________________________
   //Variabeln
   $raum = "0";
   $date = "0";
   $teacher = "0";
   $written = false;
   $newrow = "";
   $teinhemer = "";
   $bemerkung = "";
   $gebaude = "";

   //Tabelle Schreiben
   $sql = 'SELECT DISTINCT * FROM Raumverwaltung WHERE Bemerkung LIKE "%EBZ%" OR "%ebz%"';
   $result = mysql_query($sql);
   while ($row = mysql_fetch_array($result)) {   //Creates a loop to loop through results
       $newrow = $row;
       if ($raum == "0") {
           $raum =  $row[1];
           $date = $row[2];
           $teacher = $row[7];
           $oldrow = $row;
       } elseif ($raum == $row[1] && $teacher == $row[7] && $date ==$row[2]) {
           $written = false;
           $oldrow[4] = $newrow[4];
       } else {
           $gebauderow = $oldrow[1];
           $bemerkungrow = $oldrow[6];
           $bemerkung = bemerkungsfilter($bemerkungrow);
           $gebaude = gebaude($gebauderow);
           echo "<tr><td>" . "  " . "</td><td>" . $oldrow[2] . "</td><td>" . "Platzhalter Tag" . "</td><td>" . $oldrow[3]. "</td><td>" . $oldrow[4]. "</td><td>" . $oldrow[6] . "</td><td>" . "Platzhalter Referent" .
     "</td><td>" . $gebaude . "</td><td>" . $oldrow[1] ."</td><td>"."</td><td>"."</td><td>".$bemerkung."</td><td>"."</td><td>"."</td><td>"."</td><td>"."Ja"."</td></tr>";  //$row['index'] the index here is a field name
           $written = true;
           $oldrow = $newrow;
       }
   }
   if ($written == false) {
       $gebauderow = $newrow[1];
       $bemerkungrow = $newrow[6];
       $bemerkung = bemerkungsfilter($bemerkungrow);
       $gebaude = gebaude($gebauderow);
       echo "<tr><td>" . "  " . "</td><td>" . $newrow[2] . "</td><td>" . "Platzhalter Tag" . "</td><td>" . $newrow[3]. "</td><td>" . $newrow[4]. "</td><td>" . $newrow[6] . "</td><td>" . "Platzhalter Referent" .
    "</td><td>" . "" . "</td><td>" . $newrow[1] ."</td><td>"."</td><td>"."</td><td>".$bemerkung."</td><td>"."</td><td>"."</td><td>"."</td><td>"."Ja"."</td></tr>";  //$row['index'] the index here is a field name
   }

//______________________________________________StundenPlan________________________________________________________
//Variabeln
$raum = "0";
$date = "0";
$teacher = "0";
$written = false;
$newrow = "";

//Tabelle Schreiben
  $sql = "SELECT DISTINCT * FROM `Stundenplan` LEFT JOIN `EBZ` ON `Stundenplan`.`Klassen` =  `EBZ`.`ebzklasse` WHERE `Stundenplan`.`Klassen` = `EBZ`.`ebzklasse`";
   $result = mysql_query($sql);
   while ($row = mysql_fetch_array($result)) {   //Creates a loop to loop through results
       $newrow = $row;
       if ($raum == "0") {
           $raum =  $row[0];
           $date = $row[2];
           $teacher = $row[16];
           $oldrow = $row;
       } elseif ($raum == $row[0] && $date == $row[2] && $teacher == $row[16]) {
           $written = false;
           $oldrow[4] = $newrow[4];
       } else {
           $raum =  $row[0];
           $date = $row[2];
           $teacher = $row[16];
           echo "<tr><td>" . "  " . "</td><td>" . $oldrow[2] . "</td><td>" . "Platzhalter Tag" . "</td><td>" . $oldrow[3]. "</td><td>" . $oldrow[4]. "</td><td>" . $oldrow[14] . "</td><td>" . $oldrow[16] .
      "</td><td>" . $oldrow[7]. "</td><td>" . $oldrow[0] . "</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."Ja"."</td></tr>";  //$row['index'] the index here is a field name  //$row['index'] the index here is a field name
           $written = true;
           $oldrow = $row;
           $oldrow = $newrow;
       }
   }
if ($written == false) {
    echo "<tr><td>" . "  " . "</td><td>" . $newrow[2] . "</td><td>" . "Platzhalter Tag" . "</td><td>" . $newrow[3]. "</td><td>" . $newrow[4]. "</td><td>" . $newrow[14] . "</td><td>" . $newrow[16] .
"</td><td>" . $newrow[7]. "</td><td>" . $newrow[0] . "</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."Ja"."</td></tr>";  //$row['index'] the index here is a field name  //$row['index'] the index here is a field name
}




    /*   echo "<tr><td>" . "  " . "</td><td>" . $row[2] . "</td><td>" . "Platzhalter Tag" . "</td><td>" . $row[3]. "</td><td>" . $row[4]. "</td><td>" . $row[14] . "</td><td>" . $row[16] .
   "</td><td>" . $row[7]. "</td><td>" . $row[0] . "</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td></tr>";  //$row['index'] the index here is a field name
   }*/
    ?>
  </tbody>
    </table>
  </div>
</body>
