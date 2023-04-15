<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Members - Bike Club</title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="root">
    <h1>Bike Club</h1>
    
    <!-- Edited from Bootstrap Navs Sample Code -->
    <nav class="nav nav-pills nav-justified">
      <a class="nav-item nav-link" href="members.php">Members</a>
      <a class="nav-item nav-link" href="bike.php">Bikes</a>
      <a class="nav-item nav-link" href="facility.php">Facilities</a>
      <a class="nav-item nav-link active" href="students.php">Students</a>
      <a class="nav-item nav-link" href="volunteer.php">Volunteers</a>
    </nav>
    <!-- End of Navbar -->

    <br>
    <h3>Student Statistics - Division Query</h3>
    <p>Number of students in the Bike Club</p>
	

  </div>
  
    <?php
    require 'functions.php';
    $success = True;
    $db_conn = NULL;
    $show_debug_alert_messages = False;


    function printResult($result, $type)
    {
        echo "<table class='table root'>";
        
        if ($type == "num_non_members") {
            echo "<thead><tr><th>Number of Non-Members</th>";
        }
        if ($type == "num_non_volunteers") {
            echo "<thead><tr><th>Number of Non-Volunteers</th>";
        }
        echo"</tr></thead><tbody>";

        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
            echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>"; 
        } 

        echo "</tbody></table>";
    }

    
    if (connectToDB()) {
        if (array_key_exists('div_num_non_members', $_POST)) {
          $sqlcommand = "SELECT COUNT(*) AS num_non_members FROM Student WHERE StudentID NOT IN (SELECT StudentID FROM Member)";
          echo "<div class='root'><b>Division Query: Number of non-members</b><br>" .$sqlcommand."</div>";
          $result = executePlainSQL($sqlcommand);
          printResult($result, "num_non_members");
        } 
        if (array_key_exists('div_num_non_volunteers', $_POST)) {
          $sqlcommand = "SELECT COUNT(*) AS num_non_volunteers FROM Student WHERE StudentID NOT IN (SELECT StudentID FROM Volunteer)";
          echo "<div class='root'><b>Division Query: Number of non-volunteers</b><br>" .$sqlcommand."</div>";
          $result = executePlainSQL($sqlcommand);
          printResult($result, "num_non_volunteers");
        }
        disconnectFromDB();
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>