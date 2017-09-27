<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
  <?php
  include "header.php";
    include "libs/dbfunctions.php";
    $dbname = "stundenplanapp";
  ?>
<?php
$roomname = $_POST['roomname'];
$roomlongname = $_POST['roomlongName'];
$date = $_POST['date'];
$starttime = $_POST['startTime'];
$endtime = $_POST['endTime'];
$bookingid = $_POST['bookingid'];
$bookingtype = $_POST['bookingType'];
$bookingFlag = $_POST['bookingFlag'];
$username = $_POST['username'];
$replacedroomname = $_POST['RRN'];
$replacedRoomlongname = $_POST['replacedRoomlongname'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$occurence = $_POST['occurence'];
$klassen = $_POST['klassen'];
$activityTypename = $_POST['activityTypename'];
$teachers = $_POST['teachers'];
$link = dbconn();
selectdb($link, $dbname);
$sql = 'INSERT INTO Stundenplan VALUES (' .'"'.$roomname.'"'.','.'"'.$roomlongname.'"'.','.'"'.$date.'"'.','.'"'.$starttime.'"'.','.'"'.$endtime.'"'.','.'"'.$bookingid.'"'.','.'"'.$bookingtype.'"'.','.'"'.$bookingFlag.'"'.','.'"'.$username.'"'.','.'"'.$replacedroomname.'"'.','.'"'.$replacedRoomlongname.'"'.','.'"'.$startDate.'"'.','.'"'.$endDate.'"'.','.'"'.$occurence.'"'.','.'"'.$klassen.'"'.','.'"'.$activityTypename.'"'.','.'"'.$teachers.'"'.')';
$result = mysql_query($sql);
?>
