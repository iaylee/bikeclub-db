<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Students - Bike Club</title>

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
      <a class="nav-item nav-link active" href="students.php">Students</a>
      <a class="nav-item nav-link" href="volunteer.php">Volunteers</a>
    </nav>
    <!-- End of Navbar -->
    <br>
    <div class="flex-container">
      <form action="students.php" method="post">
        <input type="hidden" id="readStudentRequest" name="readStudentRequest">
        <p><input class="btn btn-primary" type="submit" value="View All Students" name="readTuples" /></p>
      </form>

      <form action="students.php" method="get">
        <input type="hidden" id="countTupleRequest" name="countTupleRequest">
        <p><input class="btn btn-secondary" type="submit" value="Count All Students" name="countTuples" /></p>
      </form>

      <form action="students.php" method="post">
        <input type="hidden" id="generateDataRequest" name="generateDataRequest">
        <p><input class="btn btn-info" type="submit" value="Generate Data" name="generateData" /></p>
      </form>

      <form action="students.php" method="post">
        <input type="hidden" id="resetTablesRequest" name="resetTablesRequest" />
        <p><input class="btn btn-danger" type="submit" value="Reset Database" name="reset" /></p>
      </form>
    </div>

    <h3>Students Dashboard</h3>
    <p>Manage students in the Bike Club</p>

    <br>
    <h3>Division</h3>

    <form action="division.php" method="post">
        <input class="btn btn-outline-dark" type="submit" name="div_num_non_members" value="Find the number of non-members">
        <br>
        <input class="btn btn-outline-dark" type="submit" name="div_num_non_volunteers" value="Find the number of non-volunteers">
    </form>
  </div>

  <?php
  require 'functions.php';
  $success = True;
  $db_conn = NULL;
  $show_debug_alert_messages = False;


  function printResult($result)
  {
    echo "<table class='table root'>";
    echo "<thead><tr><th>Student ID</th>
    <th>Member Name</th>
    <th>Date Registered</th>
    <th>Phone Number</th>
    </tr></thead><tbody>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
      echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td></tr>";
    }

    echo "</tbody></table>";
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
    echo "<div class='root'>Reset and new tables have been created.</div>";
  }

  function handleReadRequest()
  {
    global $db_conn;

    $result = executePlainSQL("SELECT * FROM Student");
    printResult($result);
  }

  function handleCountRequest()
  {
    global $db_conn;

    $studentCount = executePlainSQL("SELECT Count(*) FROM Student");

    if (($row = oci_fetch_row($studentCount)) != false) {
      echo "<div class='root'> The number of tuples in Student: " . $row[0] . "</div>";
    }
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
    echo "<div class='root'>Tables have been populated.</div>";
  }

  // HANDLE ALL POST ROUTES
  // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
  function handlePOSTRequest()
  {
    if (connectToDB()) {
      if (array_key_exists('resetTablesRequest', $_POST)) {
        handleResetRequest();
      } else if (array_key_exists('readStudentRequest', $_POST)) {
        handleReadRequest();
      } else if (array_key_exists('generateDataRequest', $_POST)) {
        handleGenerateData();
      } 
      disconnectFromDB();
    }
  }
  function handleGETRequest()
  {
    if (connectToDB()) {
      if (array_key_exists('countTuples', $_GET)) {
        handleCountRequest();
      }
      disconnectFromDB();
    }
  }

  if (
    isset($_POST['reset']) || isset($_POST['readStudentRequest']) || isset($_POST['generateDataRequest'])
  ) {
    handlePOSTRequest();
  } else if (isset($_GET['countTupleRequest'])) {
    handleGETRequest();
  }
  ?>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</body>

</html>