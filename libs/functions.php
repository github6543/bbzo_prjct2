<?php
function insertStundenplantoDB($table)
{
    include_once("dbfunctions.php");
    $link = dbconn();
    //  echo $_FILES['datei']['tmp_name'] . "</br>";
    $dataname   = $_FILES['datei']['name'];
    //echo $dataname;
    $fieldnames = 1;
    $tableexists = 1;
    ini_set("auto_detect_line_endings", true);
    if (($handle = fopen("uploads/" . $dataname, "r")) !== false) { //Datei mit entsprechend ausgewähltem dateinamen auswähläen
    while (($data = fgetcsv($handle, 0, ";")) !== false) { //csv auslesen mit ; trennung
        $num = count($data); //Datensätze zählen
        if ($fieldnames !== 0) {
            $fieldnames = 0;
            createdb();
            selectdb($link, 'stundenplanapp');
            $sql ="TRUNCATE ".$table;
            mysql_query($sql);

            $sql = 'CREATE TABLE '.$table . '(';
            for ($c = 0; $c < $num; $c++) {
                $sql .= '`' . $data[$c] . '` varchar(1500)';
                if ($c < $num - 1) {
                    $sql .= ', ';
                }
            } //sql-> Tabelle erstellen
            $sql .= ')';
            //echo $sql . "</br>";
            $result = mysql_query($sql); //sql übergeben (Wichtig sonst funzt SQL nicht)
        } else {
            $sql = 'INSERT INTO '.$table.' VALUES (';
            for ($c = 0; $c < $num; $c++) { //für jeden Datensat
                $sql .= '"' . $data[$c] . '"';
                if ($c < $num - 1) {
                    $sql .= ', ';
                }
                if ($c < 0) {
                    $sql .= ', ';
                } //den text ausgeben ($data = Array)
            }
            $sql .= ');';
            //  echo $sql;
            $result = mysql_query($sql); //sql übergeben (Wichtig sonst funzt SQL nicht)
        }
    }
    }
}
