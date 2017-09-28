<?php
function download(){
    include_once("libs/csvspaltennamen.php");
    include_once("libs/dbfunctions.php");
    $link = dbconn();
    selectdb($link, 'stundenplanapp');
    $sql = 'SELECT DISTINCT * FROM Raumverwaltung WHERE Bemerkung LIKE "%EBZ%" OR "%ebz%"';
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename=EBZTabelle.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, $spaltenname, ";");
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
            $gebaude = gebaudefinder($gebauderow);
        $line = array("",$oldrow[2],"Platzhalter Tag",$oldrow[3],$oldrow[4],$oldrow[6],"",$gebaude,$oldrow[1],"","",$bemerkung,"","","","Ja");
            $written = true;
            $oldrow = $newrow;
            fputcsv($output, $line, ";");
        }
    }
    if ($written == false) {
        $gebauderow = $newrow[1];
        $bemerkungrow = $newrow[6];
        $bemerkung = bemerkungsfilter($bemerkungrow);
        $gebaude = gebaudefinder($gebauderow);
        $line = array("",$newrow[2],"Platzhalter Tag",$newrow[3],$newrow[4],$newrow[6],"",$gebaude,$newrow[1],"","",$bemerkung,"","","","Ja");
     fputcsv($output, $line, ";");
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
            $gebauderow = $oldrow[0];
            $gebaude = gebaudefinder($gebauderow);

            $line = array("",$oldrow[2],"Platzhalter Tag",$oldrow[3],$oldrow[4],$oldrow[14],$oldrow[16],$gebaude,$oldrow[0],"","","","","","","Ja");
            $written = true;
            $oldrow = $row;
            $oldrow = $newrow;
            fputcsv($output, $line, ";");
        }
    }
 if ($written == false) {
     $gebauderow = $newrow[0];
     $gebaude = gebaudefinder($gebauderow);
$line = array("",$newrow[2],"Platzhalter Tag",$newrow[3],$newrow[4],$newrow[14],$newrow[16],$gebaude,$newrow[0],"","","","","","","Ja");
fputcsv($output, $line, ";");
 }

    fclose($output);
    exit;
  }




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
