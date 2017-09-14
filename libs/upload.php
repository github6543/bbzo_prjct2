<?php
function upload(){
  include_once("libs/functions.php");
  move_uploaded_file($_FILES['datei']['tmp_name'], 'uploads/'.$_FILES['datei']['name']);
  //echo "test";
  $table = $_POST['upl'];
  echo $table;
  insertUntistoDB($table);
  header('Location: index.php'); 
  exit;
}
?>
