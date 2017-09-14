<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
  <?php
  include "header.php";
  ?>

<body>

  <h1>
    Erfassen
  </h1>
  <form method="post" action="ebzfach.php">
     <p>Fachbezeichnung: <input type="text" name="Fachbezeichnung" /></p>
     <p>Fachkuerzel: <input type="text" name="Fachkuerzel" /></p>
     <input type="submit" name="submit" value="Submit" />
  </form>


</body>

</html>
