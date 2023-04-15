<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title>Facilities - Bike Club</title>

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
         <a class="nav-item nav-link" href="students.php">Students</a>
         <a class="nav-item nav-link active" href="volunteer.php">Volunteers</a>
      </nav>
      <!-- End of Navbar -->
      <div class="flex-container">
         <form action="volunteer.php" method="post">
            <input type="hidden" id="readVolunteerRequest" name="readVolunteerRequest">
            <p><input class="btn btn-primary" type="submit" value="View All Volunteers" name="readTuples" /></p>
         </form>

         <form action="volunteer.php" method="post">
            <input type="hidden" id="shiftDataRequest" name="shiftDataRequest">
            <p><input class="btn btn-secondary" type="submit" value="View All Shifts" name="shiftData" /></p>
         </form>

         <form action="volunteer.php" method="post">
            <input type="hidden" id="generateDataRequest" name="generateDataRequest">
            <p><input class="btn btn-info" type="submit" value="Generate Data" name="generateData" /></p>
         </form>

         <form action="volunteer.php" method="post">
            <input type="hidden" id="resetTablesRequest" name="resetTablesRequest" />
            <p><input class="btn btn-danger" type="submit" value="Reset Database" name="reset" /></p>
         </form>
      </div>

      <h3>Volunteer & Shift Information</h3>
      <p>Manage Volunteers in the Bike Club</p>

      <h3>Join</h3>
      <p>Find the phone number of volunteers who have volunteered for a shift at a location</p>
      <form action="volunteer.php" method="post">
         <select name="joinShiftVolunteers" id="join-select">
            <option value="">--Please choose an option--</option>
            <option value="Hastings Ave">Hastings Ave</option>
            <option value="Bern St">Bern St</option>
            <option value="Honeysuckle Ave">Honeysuckle Ave</option>
            <option value="Henria St">Henria St</option>
         </select>
         <p>
            <input class="btn btn-primary" type="submit" name="joinSubmit">
         </p>
      </form>


   </div>
   </div>

   <?php
  require 'functions.php';
  $success = True;
  $db_conn = NULL;
  $show_debug_alert_messages = False;


  function printResult($result, $toggle)
  {
   if($toggle == 0){
      echo "<table class='table root'>";
      echo "<thead><tr><th>StudentID</th>
      <th>StudentName</th>
      <th>DateRegistered</th>
      <th>StudentPhoneNo</th>
      <th>TotalVolunteerHours</th>
      </tr></thead><tbody>";
    
      while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
         echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td></tr>"; 
      } 
    
      echo "</tbody></table>";
     } else if ($toggle == 1){
      echo "<table class='table root'>";
      echo "<thead><tr><th>StudentName</th>
      <th>StudentPhoneNo</th>
      </tr></thead><tbody>";
    
      while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
         echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td></tr>"; 
      } 
    
      echo "</tbody></table>";
        
     } else if($toggle ==2){
      echo "<table class='table root'>";
      echo "<thead><tr><th>StudentID</th>
      <th>ShiftID</th>
      <th>Duration</th>
      <th>Start Time</th>
      <th>Location</th>
      <th>Shift Date</th>
      </tr></thead><tbody>";
    
      while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
         echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td></tr>"; 
      } 
    
      echo "</tbody></table>";
     }
  } 
     



  
  function handleResetRequest()
  {
    global $db_conn;

    $sql = file_get_contents('./restart.sql');
    $stmts = explode(";", $sql);
    foreach ($stmts as $stmt) {
      if (trim($stmt) != '') {
        $stid = oci_parse($db_conn, $stmt);
        if (!$stid) {
          $e = oci_error($db_conn);
          trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        oci_execute($stid);
      }
    }
    echo "<div class='notification bg-primary'>Reset and new tables have been created.</div>";
  }

  function handleGenerateData()
  {
    global $db_conn;

    $sql = file_get_contents('./db.sql');
    $stmts = explode(";", $sql);
    foreach ($stmts as $stmt) {
      if (trim($stmt) != '') {
        $stid = oci_parse($db_conn, $stmt);
        if (!$stid) {
          $e = oci_error($db_conn);
          trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }
        oci_execute($stid);
      }
    }
    echo "<div class='notification bg-primary'>Successfully reseted and new tables have been created.</div>";
  }

  function handleReadRequest()
  {
    global $db_conn;

    $result = executePlainSQL("SELECT * FROM Volunteer");
    printResult($result, 0);
  }

  function handleJoin(){
      $toJoin = $_POST['joinShiftVolunteers'];
      $sqlcommand = "SELECT DISTINCT v.StudentName, v.StudentPhoneNo FROM Volunteer v, Shift s WHERE v.StudentID = s.StudentID AND s.Location = '$toJoin'";
      $result = executePlainSQL($sqlcommand);

      printResult($result, 1);
      
      $successSelectMembershipTypeUI = "<div class='notification bg-primary'>Table has been populated to show only the volunteers who have worked at '$toJoin' and their phone nos.</div>";
      echo $successSelectMembershipTypeUI;
  }

  function handleShiftTable(){
      $sqlcommand = "SELECT * FROM Shift";
      $result = executePlainSQL($sqlcommand);

      printResult($result, 2);
  }


  // HANDLE ALL POST ROUTES
  // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
  function handlePOSTRequest()
  {
    if (connectToDB()) {
      if (array_key_exists('resetTablesRequest', $_POST)) {
        handleResetRequest();
      } else if (array_key_exists('readVolunteerRequest', $_POST)) {
        handleReadRequest();
      } else if(array_key_exists('shiftDataRequest', $_POST)){
         handleShiftTable();
       }else if (array_key_exists('generateDataRequest', $_POST)) {
        handleGenerateData();
      } else if(array_key_exists('joinSubmit', $_POST)){
         handleJoin();
      }

      disconnectFromDB();
    }
  }
  function handleGETRequest()
  {
    if (connectToDB()) {
      
      disconnectFromDB();
    }
  }

  if (isset($_POST['reset']) || isset($_POST['readVolunteerRequest']) || isset($_POST['shiftDataRequest'])|| isset($_POST['generateDataRequest']) || isset($_POST['joinSubmit'])) {
    handlePOSTRequest();
  } else {
    handleGETRequest();
  }
  ?>

   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
   </script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
   </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
   </script>
</body>

</html>