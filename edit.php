<?php

include('includes/connect.php');

$studentid = "";
$studentfname = "";
$studentlname = "";
$studentnumber = "";
$enroldate = "";

$errorMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['studentid'])) {
        header("location: index.php");
        exit;
    }

    $studentid = $_GET['studentid'];

    $sql = "SELECT * FROM students WHERE studentid = $studentid";
    $result = $connect->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: index.php");
        exit;
    }

    $studentfname = $row['studentfname'];
    $studentlname = $row['studentlname'];
    $studentnumber = $row['studentnumber'];
    $enroldate = $row['enroldate'];
}
else {
    $studentid = $_POST['studentid'];
    $studentfname = $_POST['studentfname'];
    $studentlname = $_POST['studentlname'];
    $studentnumber = $_POST['studentnumber'];
    $enroldate = $_POST['enroldate'];

    do {
        if (empty($studentfname) || empty($studentlname) || empty($studentnumber) || empty($enroldate)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE students 
                SET studentfname = '$studentfname', studentlname = '$studentlname', studentnumber = '$studentnumber', enroldate = '$enroldate' 
                WHERE studentid = $studentid";
        $result = $connect->query($sql);
        if (!$result) {
            $errorMessage = "Invalid query: " . $connect->error;
            break;
        }

        header("location: index.php");
        exit;

    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Edit Student</title>
</head>
<body>
    <div class="container my-5">
        <h2>Edit Student</h2>

        <?php 
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <input type="hidden" name="studentid" value="<?php echo $id; ?>">
            <div class=" row mb-3">
                <label class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="studentfname" value="<?php echo $studentfname; ?>">
                </div>
            </div>
            <div class=" row mb-3">
                <label class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="studentlname" value="<?php echo $studentlname; ?>">
                </div>
            </div>
            <div class=" row mb-3">
                <label class="col-sm-3 col-form-label">Student Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="studentnumber" value="<?php echo $studentnumber; ?>">
                </div>
            </div>
            <div class=" row mb-3">
                <label class="col-sm-3 col-form-label">Enrollment Date</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="enroldate" value="<?php echo $enroldate; ?>">
                </div>
            </div>
            <div class=" row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="index.php">Cancel</a>
                </div>
            </div>

        </form>
    </div>
</body>
</html>