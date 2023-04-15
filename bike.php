<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title>Bikes - Bike Club</title>

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
         <a class="nav-item nav-link active" href="#">Bikes</a>
         <a class="nav-item nav-link" href="facility.php">Facilities</a>
         <a class="nav-item nav-link" href="students.php">Students</a>
         <a class="nav-item nav-link" href="volunteer.php">Volunteers</a>
      </nav>
      <!-- End of Navbar -->
      <br>
      <div class="flex-container">
         <form action="bike.php" method="post">
            <input type="hidden" id="readBikeRequest" name="readBikeRequest">
            <p><input class="btn btn-primary" type="submit" value="View All Bikes" name="readTuples" /></p>
         </form>

         <form action="bike.php" method="get">
            <input type="hidden" id="countTupleRequest" name="countTupleRequest">
            <p><input class="btn btn-secondary" type="submit" value="Count All Bikes" name="countTuples" /></p>
         </form>

         <form action="bike.php" method="post">
            <input type="hidden" id="generateDataRequest" name="generateDataRequest">
            <p><input class="btn btn-info" type="submit" value="Generate Data" name="generateData" /></p>
         </form>

         <form action="bike.php" method="post">
            <input type="hidden" id="resetTablesRequest" name="resetTablesRequest" />
            <p><input class="btn btn-danger" type="submit" value="Reset Database" name="reset" /></p>
         </form>
      </div>

      <h3>Bikes Inventory</h3>
      <p>Manage bikes in Bike Club</p>

      <h3>Projection</h3>
      <p>Check out all the bikes that we have and at what locations you can find them!</p>
      <form action="bike.php" method="post">
         <div class="form-row">
            <label>
               <input class="btn btn-outline-dark" type="checkbox" name="bikeserialno">
               Bike Serial Number
            </label>
            <label>
               <input class="btn btn-outline-dark" type="checkbox" name="model">
               Model
            </label>
            <label>
               <input class="btn btn-outline-dark" type="checkbox" name="bookedstatus">
               Booked Status
            </label>
            <label>
               <input class="btn btn-outline-dark" type="checkbox" name="condition">
               Condition
            </label>
            <label>
               <input class="btn btn-outline-dark" type="checkbox" name="postalcode">
               Postal Code
            </label>
            <label>
               <input class="btn btn-outline-dark" type="checkbox" name="unitnumber">
               Unit Number
            </label>
         </div>
         <p>
            <input class="btn btn-primary" type="submit" name="projectionSubmit">
         </p>
      </form>

   </div>

   <?php
  require 'functions.php';
  $success = True;
  $db_conn = NULL;
  $show_debug_alert_messages = False;


  function printResult($result, $toggle, $bsn, $model, $booked, $condition, $postal, $unit)
  {
     if($toggle == 0){
      echo "<table class='table root'>";
      echo "<thead><tr><th>Bike Serial Number</th>
      <th>Model</th>
      <th>Booked Status</th>
      <th>Condition</th>
      <th>Postal Code</th>
      <th>Unit Number</th>
      </tr></thead><tbody>";

      while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
         echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td></tr>";
      }

      echo "</tbody></table>";
     }
     else if($toggle == 1){ 
         echo "<table class='table root'>";
         echo "<thead><tr>";
         if ($bsn) {
             echo "<th>Bike Serial Number</th>";
         }
         if ($model) {
             echo "<th>Model</th>";
         }
         if ($booked) {
            echo "<th>Booked Status</th>";
        }
        if ($condition) {
             echo "<th>Condition</th>";
         }
         if ($postal) {
            echo "<th>Postal Code</th>";
        }   
        if ($unit) {
         echo "<th>Unit Number</th>";
         }
         echo "</tr></thead><tbody>";
         while($row = OCI_Fetch_Array($result, OCI_BOTH)) {
             echo "<tr>";
             if ($bsn) {
                 echo "<td>" . $row[0] . "</td>";
             }
             if ($model) {
                 echo "<td>" . $row[1] . "</td>";
             }
             if ($booked) {
               echo "<td>" . $row[2] . "</td>";
           }
           if ($condition) {
            echo "<td>" . $row[3] . "</td>";
            }
            if ($postal) {
               echo "<td>" . $row[4] . "</td>";
            }
            if ($unit) {
               echo "<td>" . $row[5] . "</td>";
            }
             echo "</tr>";
         }
         echo "</tbody></table>";
     } else {
         echo "No results found.";
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
    echo "<div class='root'>Reset and new tables have been created.</div>";
  }

  function handleReadRequest()
  {
    global $db_conn;

    $result = executePlainSQL("SELECT * FROM BikeHas");
    printResult($result, 0, 0,0,0,0,0, 0);
  }

  function handleCountRequest()
  {
    global $db_conn;

    $studentCount = executePlainSQL("SELECT Count(*) FROM BikeHas");

    if (($row = oci_fetch_row($studentCount)) != false) {
      echo "<div class='root'> The number of tuples in Bike: " . $row[0] . "</div>";
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
      } else if (array_key_exists('readBikeRequest', $_POST)) {
        handleReadRequest();
      } else if (array_key_exists('generateDataRequest', $_POST)) {
        handleGenerateData();
      } else if (array_key_exists('projectionSubmit', $_POST)) {
         handleProjectionRequest();
       } 
    }
    disconnectFromDB();
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

  function handleProjectionRequest(){
   $bsn = isset($_POST['bikeserialno']) ? 1 : 0;
   $model = isset($_POST['model']) ? 1 : 0;
   $booked = isset($_POST['bookedstatus']) ? 1 : 0;
   $condition = isset($_POST['condition']) ? 1 : 0;
   $postal = isset($_POST['postalcode']) ? 1 : 0;
   $unit = isset($_POST['unitnumber']) ? 1 : 0;

   if (connectToDB()) {
      $sql = "SELECT ";
      if ($bsn) {
          $sql .= "b.BikeSerialNumber, ";
      }
      if ($model) {
         $sql .= "b.Model, ";
      }
      if ($booked) {
         $sql .= "b.BookedStatus, ";
      }
      if ($condition) {
         $sql .= "b.Condition, ";
      }
      if ($postal) {
         $sql .= "b.PostalCode, ";
      }
      if ($unit) {
         $sql .= "b.UnitNumber ";
      }
      $sql .= "FROM BikeHas b";

      $sqlPrint = "SELECT * FROM BikeHas";
      $passIntoPrint = executePlainSQL($sqlPrint);  
      $result = executePlainSQL($sql);
      printResult($passIntoPrint, 1, $bsn, $model, $booked, $condition, $postal, $unit);
   }
   $successSelectMembershipTypeUI = "<div class='notification bg-primary'>Table has been populated to show only the specified attributes.</div>";
      echo $successSelectMembershipTypeUI;
   disconnectFromDB();
  }

  if (
   isset($_POST['reset']) || isset($_POST['readBikeRequest']) || isset($_POST['generateDataRequest']) || isset($_POST['projectionSubmit'])
 ) {
   handlePOSTRequest();
 } else if (isset($_GET['countTupleRequest'])) {
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