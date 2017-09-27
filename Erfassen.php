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
  <form method="post" action="AddToDB.php">
     <p>room.name: <input type="text" name="roomname" /></p>
     <p>room.longName: <input type="text" name="roomlongName" /></p>
     <p>date(TT.MM.YY): <input type="text" name="date" /></p>
     <p>startTime:: <input type="text" name="startTime" /></p>
     <p>endTime: <input type="text" name="endTime" /></p>
     <p>bookingid: <input type="text" name="bookingid" /></p>
     <p>bookingType: <input type="text" name="bookingType" /></p>
     <p>bookingFlag: <input type="text" name="bookingFlag" /></p>
     <p>user.name: <input type="text" name="username" /></p>
     <p>replacedRoom.name: <input type="text" name="RRN" /></p>
     <p>replacedRoom.longname: <input type="text" name="replacedRoomlongname" /></p>
     <p>startDate: <input type="text" name="startDate" /></p>
     <p>endDate: <input type="text" name="endDate" /></p>
     <p>occurence: <input type="text" name="occurence" /></p>
     <p>klassen: <input type="text" name="klassen" /></p>
     <p>activityType.name: <input type="text" name="activityTypename" /></p>
     <p>teachers: <input type="text" name="teachers" /></p>
     <input type="submit" name="submit" value="Submit" />
  </form>


</body>

</html>
