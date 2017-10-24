<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
  <?php
  include "header.php";
  ?>

<body>
<h1>
  Anleitung
</h1>

<h4>
  Mit dieser WebApp kann man die manuell Erfassten Buchungen Anzeigen Lassen.</br>
<a href="https://spdoc.bbzolten.ch/itbbzo/usan/Webapp_Buchungen/Anleitung_bbzo_buchungen_webapp.pdf?Web=1">Hier können sie die Schritt für Schritt Anleitung Herunterladen</a>
</br>
  Bitte nicht vergessen die aktuellen Exportdateien Hochzuladen!
</br>
</br>
</br>
  Bitte Hier den Stundenplan export Hochladen.</br>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="datei"><br>
    Bitte nach dem Auswählen Hier Klicken: <input type="submit" value="Stundenplan" name="upl">
  </form></br>
</br>
</br>
</br>
  Bitte Hier den Buchungs export Hochladen.</br>
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <input type="file" name="datei"><br>
      Bitte nach dem Auswählen Hier Klicken: <input type="submit" value="Raumverwaltung" name="upl">
    </form></br>

</h4>
</body>
<?php
include "footer.php";
?>
</html>
