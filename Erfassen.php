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
<form class="form-inline" action="AddToDB.php" method="post">
  <div class="form-group">
    <label for="room.name">room.name:</label></br>
    <input type="text" class="form-control" id="room.name" value="<?php echo htmlspecialchars($_POST['room.name'])?>">
  </div>
  <div class="form-group">
    <label for="room.longname">room.longname:</label></br>
    <input type="text" class="form-control" id="room.longname">
  </div>
</br>
  <div class="form-group">
    <label for="date">date:</label></br>
    <input type="text" class="form-control" id="date">
  </div>
  <div class="form-group">
    <label for="startTime">startTime:</label></br>
    <input type="text" class="form-control" id="startTime">
  </div>
  </br>
  <div class="form-group">
    <label for="endTime">endTime:</label></br>
    <input type="text" class="form-control" id="endTime">
  </div>
  <div class="form-group">
    <label for="bookingid">bookingid:</label></br>
    <input type="text" class="form-control" id="bookingid">
  </div></br>
  <div class="form-group">
    <label for="bookingType">bookingType:</label></br>
    <input type="text" class="form-control" id="bookingType">
  </div>
  <div class="form-group">
    <label for="bookingFlag">bookingFlag:</label></br>
    <input type="text" class="form-control" id="bookingFlag">
  </div>
</br>
  <div class="form-group">
    <label for="user.name">user.name:</label></br>
    <input type="text" class="form-control" id="user.name">
  </div>
  <div class="form-group">
    <label for="replacedRoom.name">replacedRoom.name:</label></br>
    <input type="text" class="form-control" id="replacedRoom.name">
  </div>
  </br>
  <div class="form-group">
    <label for="replacedRoom.longname">replacedRoom.longname:</label></br>
    <input type="text" class="form-control" id="replacedRoom.longname">
  </div>
  <div class="form-group">
    <label for="startDate">startDate:</label></br></br>
    <input type="text" class="form-control" id="startDate">
  </div>
  </br>
  <div class="form-group">
    <label for="endDate">endDate:</label></br>
    <input type="text" class="form-control" id="endDate">
  </div>
  <div class="form-group">
    <label for="occurence">occurence:</label></br>
    <input type="text" class="form-control" id="occurence">
  </div>
  </br>
  <div class="form-group">
    <label for="klassen">klassen:</label></br>
    <input type="text" class="form-control" id="klassen">
  </div>
  <div class="form-group">
    <label for="activityType.name">activityType.name:</label></br>
    <input type="text" class="form-control" id="activityType.name">
  </div>
  </br>
  <div class="form-group">
      <label for="teachers">teachers:</label></br>
      <input type="text" class="form-control" id="teachers">
  </div></br>
  <button type="submit" class="btn btn-default">Hinzufügen</button>
</form>
</body>

</html>
