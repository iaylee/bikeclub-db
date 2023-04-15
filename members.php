<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Members - Bike Club</title>

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
      <a class="nav-item nav-link active" href="members.php">Members</a>
      <a class="nav-item nav-link" href="bike.php">Bikes</a>
      <a class="nav-item nav-link" href="facility.php">Facilities</a>
      <a class="nav-item nav-link" href="students.php">Students</a>
      <a class="nav-item nav-link" href="volunteer.php">Volunteers</a>
    </nav>
    <!-- End of Navbar -->
    <br>
    <div class="flex-container">
      <form action="members.php" method="post">
        <input type="hidden" id="readMemberRequest" name="readMemberRequest">
        <p><input class="btn btn-primary" type="submit" value="View All Members" name="readTuples" /></p>
      </form>

      <form action="members.php" method="get">
        <input type="hidden" id="countTupleRequest" name="countTupleRequest">
        <p><input class="btn btn-secondary" type="submit" value="Count All Members" name="countTuples" /></p>
      </form>

      <form action="members.php" method="post">
        <input type="hidden" id="generateDataRequest" name="generateDataRequest">
        <p><input class="btn btn-info" type="submit" value="Generate Data" name="generateData" /></p>
      </form>

      <form action="members.php" method="post">
        <input type="hidden" id="resetTablesRequest" name="resetTablesRequest" />
        <p><input class="btn btn-danger" type="submit" value="Reset Database" name="reset" /></p>
      </form>
    </div>

    <h3>Members Dashboard</h3>
    <p>Manage members in the Bike Club</p>

    <h3>Create a new member</h3>
    <form action="members.php" method="post">
      <input type="hidden" id="createMemberRequest" name='createMemberRequest' />
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="studentId">Student ID:</label>
          <input class="form-control" type="number" name="studentId" placeholder="Student ID" required />
        </div>
        <div class="form-group col-md-4">
          <label for="memberName">Member Name:</label>
          <input class="form-control" type="text" name="memberName" placeholder="Member Name" />
        </div>
        <div class="form-group col-md-4">
          <label for="dateRegistered">Date Registered:</label>
          <input class="form-control" type="date" name="dateRegistered" placeholder="Date Registered" />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="phoneNumber">Phone Number:</label>
          <input class="form-control" type="number" name="phoneNumber" placeholder="Phone Number" required />
        </div>
        <div class="form-group col-md-4">
          <label for="bankingInfo">Banking Number:</label>
          <input class="form-control" type="number" name="bankingInfo" placeholder="Banking Number" />
        </div>
        <div class="form-group col-md-4">
          <label for="membershipStatus">Membership Type:</label>
          <select name="membershipStatus" class="form-control">
            <option value="Gold">Gold</option>
            <option value="Silver">Silver</option>
            <option value="Bronze">Bronze</option>
          </select>
        </div>
      </div>
      <p>
        <input class="btn btn-primary" type="submit" value="Create" name="insertSubmit" />
      </p>
    </form>

    <h3>Update an existing member</h3>
    <form action="members.php" method="post">
      <input type="hidden" id="updateMemberRequest" name='updateMemberRequest' />
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="studentId">Student ID:</label>
          <input class="form-control" type="number" name="studentId" placeholder="Student ID" required />
        </div>
        <div class="form-group col-md-4">
          <label for="newMemberName">Member Name:</label>
          <input class="form-control" type="text" name="newMemberName" placeholder="Member Name" />
        </div>
        <div class="form-group col-md-4">
          <label for="newDateRegistered">Date Registered:</label>
          <input class="form-control" type="date" name="newDateRegistered" placeholder="Date Registered" />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="newPhoneNumber">Phone Number:</label>
          <input class="form-control" type="number" name="newPhoneNumber" placeholder="Phone Number" />
        </div>
        <div class="form-group col-md-4">
          <label for="newBankingInfo">Banking Number:</label>
          <input class="form-control" type="number" name="newBankingInfo" placeholder="Banking Number" />
        </div>
        <div class="form-group col-md-4">
          <label for="newMembershipStatus">Membership Type:</label>
          <select name="newMembershipStatus" class="form-control">
            <option value="Gold">Gold</option>
            <option value="Silver">Silver</option>
            <option value="Bronze">Bronze</option>
          </select>
        </div>
      </div>
      <p>
        <input class="btn btn-primary" type="submit" value="Update" name="updateSubmit" />
      </p>
    </form>

    <h3>Delete an existing member</h3>
    <form action="members.php" method="post">
      <input type="hidden" id="deleteStudentRequest" name="deleteStudentRequest" />
      <label for="studentId">Student ID:</label>
      <div class="form-row" style="gap:10px">
        <div class="form-group col-md-4">
          <input class="form-control" type="number" name="deleteStudentId" placeholder="Student ID" required />
        </div>
      </div>
      <input class="btn btn-primary" type="submit" value="Delete" name="deleteStudent" />
    </form>

    <br />
    <h3>View Members by Membership Type</h3>
    <form action="members.php" method="post">
      <input type="hidden" id="readByMembershipStatusRequest" name='readByMembershipStatusRequest' />
      <label for="selectReadMembership">Membership Type:</label>
      <div class="form-row" style="gap:10px">
        <div class="form-group col-md-4">
          <input name="selectReadMembership" class="form-control" placeholder='ex) Gold' />
        </div>
      </div>
      <input class="btn btn-primary mb-4" type="submit" value="View" name="readByMembershipType" />

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
    <th>Membership Status</th>
    <th>Banking Number</th>
    </tr></thead><tbody>";

    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
      echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td><td>" . $row[5] . "</td></tr>";
    }

    echo "</tbody></table>
    <div style='height: 32px;'></div>";
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
    echo "<div class='notification bg-primary'>Successfully reseted and new tables have been created.</div>";
  }

  function handleInsertRequest()
  {
    global $db_conn;

    $new_date = date('d-M-Y', strtotime($_POST['dateRegistered'])); // convert date to Oracle format
  
    $isMemberIdLengthValid = strlen($_POST['studentId']) < 9;
    $isNameValid = strlen($_POST['memberName']) < 21;
    $isPhoneNoLengthValid = strlen($_POST['phoneNumber']) < 13; // check for unique
    $isBankingInfoValid = strlen($_POST['bankingInfo']) < 20;

    if (!$isMemberIdLengthValid) {
      echo "<div class='notification bg-danger'>Max member id length is 8.</div>";
    }
    if (!$isNameValid) {
      echo "<div class='notification bg-danger'>Max member name length is 20.</div>";
    }
    if (!$isPhoneNoLengthValid) {
      echo "<div class='notification bg-danger'>Max phone number length is 12.</div>";
    }
    if (!$isBankingInfoValid) {
      echo "<div class='notification bg-danger'>Max banking info length is 19.</div>";
    }

    if ($isMemberIdLengthValid && $isNameValid && $isPhoneNoLengthValid && $isBankingInfoValid) {

      $tuple = array(
        ":bind1" => $_POST['studentId'],
        ":bind2" => $_POST['memberName'],
        ":bind3" => $new_date,
        ":bind4" => $_POST['phoneNumber'],
        ":bind5" => $_POST['membershipStatus'],
        ":bind6" => $_POST['bankingInfo'],
      );
      $student_id = $_POST['studentId'];

      $alltuples = array(
        $tuple
      );

      $successMemberInsert = "<div class='notification bg-primary'>Member has been successsfully created.</div>";
      $errorDuplicateId = "<div class='notification bg-danger'>Duplicate member id exists.</div>";

      $duplicateIdExistsQuery = "SELECT COUNT(*) FROM STUDENT WHERE StudentID=$student_id";
      $duplicateIdExistsRes = executePlainSQL($duplicateIdExistsQuery);

      if (($row = oci_fetch_row($duplicateIdExistsRes)) != false) {
        $rowsWithIdenticalId = $row[0];

        if ($rowsWithIdenticalId > 0) {
          echo $errorDuplicateId;
        } else {
          executeBoundSQL("INSERT INTO Student VALUES (:bind1, :bind2, :bind3, :bind4)", $alltuples);
          executeBoundSQL("INSERT INTO Member VALUES (:bind1, :bind2, :bind3, :bind4, :bind5, :bind6)", $alltuples);
          OCICommit($db_conn);
          echo $successMemberInsert;
        }
      }


    }
  }

  function handleUpdateRequest()
  {
    global $db_conn;

    $old_id = $_POST['studentId'];
    $new_name = $_POST['newMemberName'];
    $new_date = "TO_DATE('" . $_POST['newDateRegistered'] . "', 'YYYY-MM-DD')";
    $new_phoneno = $_POST['newPhoneNumber'];
    $new_membership = $_POST['newMembershipStatus'];
    $new_banking = $_POST['newBankingInfo'];

    $successUpdateUI = "<div class='notification bg-primary'>Member has been successfully updated.</div>";
    $errorUpdateUI = "<div class='notification bg-danger'>Update unsuccessful. Member does not exist.</div>";

    $numRowsUpdatedQuery = "SELECT COUNT(*) FROM STUDENT WHERE StudentID=$old_id";
    $numRowsUpdatedRes = executePlainSQL($numRowsUpdatedQuery);

    if (($row = oci_fetch_row($numRowsUpdatedRes)) != false) {
      $numRowsUpdated = $row[0];

      if ($numRowsUpdated == 0) {
        echo $errorUpdateUI;
      } else {
        $studentUpdateQuery = "UPDATE Student SET DateRegistered=" . $new_date . ", StudentName='" . $new_name . "', StudentPhoneNo='" . $new_phoneno . "' WHERE StudentID=$old_id";
        $memberUpdateQuery = "UPDATE Member SET DateRegistered=" . $new_date . ", StudentName='" . $new_name . "', StudentPhoneNo='" . $new_phoneno . "', MembershipStatus='" . $new_membership . "', BankingInfo='" . $new_banking . "' WHERE StudentID=$old_id";
        executePlainSQL($studentUpdateQuery);
        executePlainSQL($memberUpdateQuery);
        OCICommit($db_conn);
        echo $successUpdateUI;
      }
    }
  }

  function handleReadByMembershipType()
  {
    $selected_membership = $_POST['selectReadMembership'];

    $successSelectMembershipTypeUI = "<div class='notification bg-primary'>Table has been populated to show only members with the status $selected_membership.</div>";
    $errorSelectMembershipTypeUI = "<div class='notification bg-danger'>$selected_membership is not a membership type.</div>";

    $validMembershipType = strtolower($selected_membership) == 'gold' || strtolower($selected_membership) == 'silver' || strtolower($selected_membership) == 'bronze';
    if ($validMembershipType == 1) {

      $modifiedMembershipInput = ucfirst(strtolower($selected_membership));
      $member_query = "SELECT * FROM Member WHERE MembershipStatus='$modifiedMembershipInput'";
      $result = executePlainSQL($member_query);

      printResult($result);

      echo $successSelectMembershipTypeUI;
    } else {
      echo $errorSelectMembershipTypeUI;
    }

  }


  function handleReadRequest()
  {
    global $db_conn;

    $result = executePlainSQL("SELECT * FROM Member");
    printResult($result);
  }

  function handleCountRequest()
  {
    global $db_conn;

    $studentCount = executePlainSQL("SELECT Count(*) FROM Student");
    $memberCount = executePlainSQL("SELECT Count(*) FROM Member");

    if (($row = oci_fetch_row($studentCount)) != false) {
      echo "<div class='notification bg-primary'> The number of tuples in Student: " . $row[0] . "</div>";
    }
    if (($row = oci_fetch_row($memberCount)) != false) {
      echo "<div class='notification bg-primary'> The number of tuples in Member: " . $row[0] . "</div>";
    }
  }

  function handleDeleteStudentRequest()
  {
    global $db_conn;
    $student_id = $_POST['deleteStudentId'];

    $successDeleteUI = "<div class='notification bg-primary'>Member has been successfully deleted.</div>";
    $errorDeleteUI = "<div class='notification bg-danger'>Delete unsuccessful. This member does not exist.</div>";

    $numRowsDeletedQuery = "SELECT COUNT(*) FROM STUDENT WHERE StudentID=$student_id";
    $numRowsDeletedRes = executePlainSQL($numRowsDeletedQuery);

    if (($row = oci_fetch_row($numRowsDeletedRes)) != false) {
      $numRowsDeleted = $row[0];
      if ($numRowsDeleted == 0) {
        echo $errorDeleteUI;
      } else {
        executePlainSQL("DELETE FROM Member WHERE StudentID = '" . $student_id . "'");
        executePlainSQL("DELETE FROM Student WHERE StudentID = '" . $student_id . "'");
        OCICommit($db_conn);
        echo $successDeleteUI;
      }
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
    echo "<div class='notification bg-primary'>Tables have been populated.</div>";
  }

  // HANDLE ALL POST ROUTES
  // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
  function handlePOSTRequest()
  {
    if (connectToDB()) {
      if (array_key_exists('resetTablesRequest', $_POST)) {
        handleResetRequest();
      } else if (array_key_exists('readMemberRequest', $_POST)) {
        handleReadRequest();
      } else if (array_key_exists('updateMemberRequest', $_POST)) {
        handleUpdateRequest();
      } else if (array_key_exists('generateDataRequest', $_POST)) {
        handleGenerateData();
      } else if (array_key_exists('deleteStudent', $_POST)) {
        handleDeleteStudentRequest();
      } else if (array_key_exists('createMemberRequest', $_POST)) {
        handleInsertRequest();
      } else if (array_key_exists('readByMembershipType', $_POST)) {
        handleReadByMembershipType();
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
    isset($_POST['reset']) || isset($_POST['readMemberRequest']) || isset($_POST['generateDataRequest'])
    || isset($_POST['deleteStudentRequest']) || isset($_POST['insertSubmit']) || isset($_POST['updateSubmit']) || isset($_POST['readByMembershipStatusRequest'])
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