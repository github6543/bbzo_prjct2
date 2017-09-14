<?php
  include_once("libs/dbfunctions.php");
  $spaltenname = array("room.name","room.longName","date","startTime","endTime","bookingid","bookingtype","bookingFlag","user.name","replacedroomname","replacedRoomlongname","startDate","endDate","occurence","klassen","activityTypename","teachers");
  $link = dbconn();
  selectdb($link, 'stundenplanapp');
  $sql = "SELECT DISTINCT * FROM `Stundenplan` LEFT JOIN `EBZ` ON `Stundenplan`.`Klassen` =  `EBZ`.`ebzklasse` WHERE `Stundenplan`.`Klassen` = `EBZ`.`ebzklasse`";
    $resu = mysql_query($sql);
    // output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=EBZ_TABELLE.csv');
    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');
/*    $spaltnam = $spaltenname;
    foreach($spaltnam as $splnm){
      echo $splnm.";";
    }*/
    fputcsv($output,$spaltenname, ";");
    while ($row = mysql_fetch_array($resu))
    {
      //$row["benutzerstatus"]
      $line = array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11],$row[12],$row[13],$row[14],$row[16]);
      fputcsv($output, $line, ";");
      }
    fclose($output);
?>
