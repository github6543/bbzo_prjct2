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
  Auf dieser WebApp kann man die Pläne nachschauen und Dozenten + Schulraum und Zimmer erfassen.</br>
  Die Pläne sollten immer auf dem aktuellsten stand sein.</br>
  Darum Bitte ich sie Hier Täglich einen neuen Import Hochzuladen.</br></br>

  <form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="datei"><br>
    <input type="submit" value="Hochladen">
  </form></br>

  Auf der Seite "Klassen, Lehrer & Zimmer" kann man die bestehenden Daten nachschauen,</br> neue Daten erfassen oder alte daten löschen.
</h4>
</body>

</html>
