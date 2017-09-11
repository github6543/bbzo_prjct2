<?php
function dbconn(){
  $link = mysql_connect('localhost', 'root' , ''); // Host , DB Benutzernamen , PW definieren
  if (!$link) { //Fehlermeldung fals connection nicht geht
    die('Not connected : ' . mysql_error());
  }
 return $link;
}

function selectdb($link, $dbname){
  $db_selected = mysql_select_db($dbname, $link);// Datenbank auswählen
    if (!$db_selected) { //Fehlermeldung fals Datenbank nicht zugreifbar ist.
      die ('Can\'t use db : ' . mysql_error());
    }
}

function createdb()
{
    $sql    = 'CREATE DATABASE stundenplanapp';
    $result = mysql_query($sql); //sql übergeben (Wichtig sonst funzt SQL nicht)
}
?>
