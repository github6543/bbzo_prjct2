<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">

  <?php
  include "header.php";
  include "libs/dbfunctions.php";
	include "libs/functions.php";
  $dbname = "stundenplanapp";
  ?>

<body>
  <div class="btn-group btn-group-justified">
    <a href="ebztabelledownload.php" target="_blank" class="btn btn-primary">Tabelle Herunterladen</a>
    <a href="ebz.php" class="btn btn-primary">EBZ Kursbezeichnung Erfassen</a>
  </div></br>
</br>
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

   function gebaudefinder($gebauderow)
   {
       if (preg_match('/^G/', $gebauderow) == "1") {
           $gebaude = "GIBS";
           return $gebaude;
       } else {
           $gebaude = "KBS";
           return $gebaude;
       }
   }


   function getFloor($gebauderow)
   {
       $search = array("K01","K03","K003","K16","K18","K21","K101","K103","K108","K112","K114","K201","K203","K208","K210","K212","K213","K214","K215","K301","K303","K304","K308","K309","K311","K313","K315","K316","CBBZ","Aula KBS","GE01","GE02","GE06","GE07","GE10","GE11","GE14","GE15","GE18","GE20","GE21","GE22","GE23","GE24","GE25","GE26","GE27","GE28","GE29","GE30/32","GE62","G053","G102","G104","G105","G106","G107","G109","G111","G113","G151","G154","G155","G157","G158","G159","G202","G204","G205","G207","G209","G211","G212","G214","G302","G304","G305","G310","G308","G310","G311","G314L","G402","G404","G405","G407","G409","G411","G412","G413","G501","G503","Aula GIBS","Foyer GIBS","TH1","TH2","TH3","TH4");
       $replace = array("UG","UG","EG","EG","EG","EG","1","1","1","1","1","2","2","2","2","2","2","2","2","3","3","3","3","3","3","3","3","3","1","1","EG","EG","EG","EG","EG","EG","EG","EG","EG","EG","EG","EG","EG","EG","EG","EG","EG","EG","EG","EG","EG","EG","1","1","1","1","1","1","1","1","1","1","1","1","1","1","2","2","2","2","2","2","2","2","3","3","3","3","3","3","3","3","4","4","4","4","4","4","4","4","5","5","EG","EG","1","1","1","1");
       return str_replace($search, $replace, $gebauderow);
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
   if(mysql_num_rows($result)!=0){
   while ($row = mysql_fetch_array($result)) {   //Creates a loop to loop through results
	$row[2] = strtotime($row[2]);
	$row[3] = strtotime($row[3]);
	$row[4] = strtotime($row[4]);
       $newrow = $row;
       if ($raum == "0") {
           $raum =  $row[1];
           $date =  $row[2];
           $teacher = $row[7];
           $oldrow = $row;
       } elseif ($raum == $row[1] && $teacher == $row[7] && $date == $oldrow[2]) {
           $written = false;
           $oldrow[4] = $newrow[4];
       } else {
	    $Tag = date('N',$oldrow[2]);
	    $tagesbuchstaben = tagermitteln($Tag);
           $gebauderow = $oldrow[1];
           $bemerkungrow = $oldrow[6];
           $bemerkung = bemerkungsfilter($bemerkungrow);
           $gebaude = gebaudefinder($gebauderow);
           echo "<tr><td>" . date('W',$oldrow[2]) . "</td><td>" . date('d.m.Y',$oldrow[2]) . "</td><td>" . $tagesbuchstaben . "</td><td>" . date('H:i',$oldrow[3]) . "</td><td>" .date('H:i',$oldrow[4]). "</td><td>" . $oldrow[6] . "</td><td>" . "" .
     "</td><td>" . $gebaude . "</td><td>" . $oldrow[1] ."</td><td>".$stock."</td><td>"."</td><td>".$bemerkung."</td><td>"."</td><td>"."</td><td>"."</td><td>".""."</td></tr>";  //$row['index'] the index here is a field name
           $written = true;
           $oldrow = $newrow;
       }
   }
   if ($written == false) {
       $gebauderow = $newrow[1];
       $bemerkungrow = $newrow[6];
       $bemerkung = bemerkungsfilter($bemerkungrow);
       $gebaude = gebaudefinder($gebauderow);
       $stock = getFloor($gebauderow);
       echo "<tr><td>" . date('W',$newrow[2])  . "</td><td>" . date('d.m.Y',$newrow[2])  . "</td><td>" . $tagesbuchstaben . "</td><td>" . date('H:i',$newrow[3]). "</td><td>" . date('H:i',$newrow[4]). "</td><td>" . $newrow[6] . "</td><td>" . "" .
    "</td><td>" . $gebaude  . "</td><td>" . $newrow[1] ."</td><td>".$stock."</td><td>"."</td><td>".$bemerkung."</td><td>"."</td><td>"."</td><td>"."</td><td>".""."</td></tr>";  //$row['index'] the index here is a field name
   }
}

//______________________________________________StundenPlan________________________________________________________
//Variabeln
$raum = "0";
$date = "0";
$teacher = "0";
$written = false;
$newrow = "";

//Tabelle Schreiben
  $sql = "SELECT DISTINCT *
FROM `Stundenplan`
LEFT JOIN `EBZ` ON `Stundenplan`.`Klassen` = `EBZ`.`ebzklasse`
WHERE `Stundenplan`.`Klassen` = `EBZ`.`ebzklasse`
ORDER BY `Stundenplan`.`date` , `Stundenplan`.`room.name` , `Stundenplan`.`startTime` , `Stundenplan`.`teachers` DESC";
   $result = mysql_query($sql);
if(mysql_num_rows($result)!=0){
   while ($row = mysql_fetch_array($result)) {   //Creates a loop to loop through results
	$row[2] = strtotime($row[2]);
	$row[3] = strtotime($row[3]);
	$row[4] = strtotime($row[4]);
       $newrow = $row;
       if ($raum == "0") {
           $raum =  $row[0];
           $date = $row[2];
           $teacher = $row[16];
           $oldrow = $row;
       } elseif ($raum == $row[0] && $date == $oldrow[2] && $teacher == $row[16]) {
           $written = false;
           $oldrow[4] = $newrow[4];
       } else {
	    $Tag = date('N',$oldrow[2]);
	    $tagesbuchstaben = tagermitteln($Tag);
           $raum =  $row[0];
           $date = $row[2];
           $teacher = $row[16];
           $gebauderow = $oldrow[0];
           $gebaude = gebaudefinder($gebauderow);
           $stock = getFloor($gebauderow);
           echo "<tr><td>" . date('W',$oldrow[2]) . "</td><td>" . date('d.m.Y',$oldrow[2]) . "</td><td>" . $tagesbuchstaben . "</td><td>" . date('H:i',$oldrow[3]). "</td><td>" . date('H:i',$oldrow[4]). "</td><td>" . $oldrow[14] . "</td><td>" . $oldrow[16] .
      "</td><td>" . $gebaude . "</td><td>" . $oldrow[0] . "</td><td>".$stock."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."Ja"."</td></tr>";  //$row['index'] the index here is a field name  //$row['index'] the index here is a field name
           $written = true;
           $oldrow = $row;
           $oldrow = $newrow;
       }
   }
if ($written == false) {
    $gebauderow = $newrow[0];
    $gebaude = gebaudefinder($gebauderow);
    $stock = getFloor($gebauderow);
    echo "<tr><td>" . date('W',$newrow[2]) . "</td><td>" . date('d.m.Y',$newrow[2])  . "</td><td>" . $tagesbuchstaben . "</td><td>" . date('H:i',$newrow[3]). "</td><td>" . date('H:i',$newrow[4]). "</td><td>" . $newrow[14] . "</td><td>" . $newrow[16] .
"</td><td>" . $gebaude . "</td><td>" . $newrow[0] . "</td><td>".$stock."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."Ja"."</td></tr>";  //$row['index'] the index here is a field name  //$row['index'] the index here is a field name
}

}


    /*   echo "<tr><td>" . "  " . "</td><td>" . $row[2] . "</td><td>" . "" . "</td><td>" . $row[3]. "</td><td>" . $row[4]. "</td><td>" . $row[14] . "</td><td>" . $row[16] .
   "</td><td>" . $row[7]. "</td><td>" . $row[0] . "</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td><td>"."</td></tr>";  //$row['index'] the index here is a field name
   }*/
    ?>
  </tbody>
    </table>
  </div>
</body>
</html>
