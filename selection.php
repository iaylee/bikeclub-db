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
      <a class="nav-item nav-link active" href="facility.php">Facilities</a>
      <a class="nav-item nav-link" href="#students.php">Students</a>
      <a class="nav-item nav-link" href="volunteer.php">Volunteers</a>
    </nav>
    <!-- End of Navbar -->

    <br>
    <h3>Facility Statistics - Selection Query</h3>
    <p>Find facilities that can hold a certain capacity</p>
	

  </div>
  
    <?php
    require 'functions.php';
    $success = True;
    $db_conn = NULL;
    $show_debug_alert_messages = False;


    function printResult($result, $type)
    {   
        echo "<table class='table root'>";
        echo "<thead><tr><th>UnitNumber</th>
            <th>PostalCode</th>
            <th>City</th>
            <th>StreetName</th>
            <th>CapacityOfPeople</th>
            <th>NumberOfBikes</th>
            </tr></thead><tbody>";

        echo"</tr></thead><tbody>";

        while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
         echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td></tr>";
        } 

        echo "</tbody></table>";
    }

    
    if (connectToDB()) {
        if (array_key_exists('twenty', $_POST)) {
          $sqlcommand = "SELECT * FROM Facility WHERE CapacityOfPeople > 20";
          echo "<div class='root'><b>Selection Query: Facilities with capacity over 20</b><br>" .$sqlcommand."</div>";
          $result = executePlainSQL($sqlcommand);
          printResult($result, "twenty");
        } 
        else if (array_key_exists('fifty', $_POST)) {
          $sqlcommand = "SELECT * FROM Facility WHERE CapacityOfPeople > 50";
          echo "<div class='root'><b>Selection Query: Facilities with capacity over 50</b><br>" .$sqlcommand."</div>";
          $result = executePlainSQL($sqlcommand);
          printResult($result, "fifty");
        }
        else if (array_key_exists('eighty', $_POST)) {
         $sqlcommand = "SELECT * FROM Facility WHERE CapacityOfPeople > 80";
         echo "<div class='root'><b>Selection Query: Facilities with capacity over 80</b><br>" .$sqlcommand."</div>";
         $result = executePlainSQL($sqlcommand);
         printResult($result, "eighty");
       }
        disconnectFromDB();
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>