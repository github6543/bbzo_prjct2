<?php
function upload(){
  include_once("libs/functions.php");
  move_uploaded_file($_FILES['datei']['tmp_name'], 'uploads/'.$_FILES['datei']['name']);
  echo "test";
  insertUntistoDB();
  header('Location: index.php'); //weiterleiten zur Kaschuso upload seite
  exit;
}
?>
