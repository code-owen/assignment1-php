<?php

include('includes/connect.php');

$studentfname = "";
$studentlname = "";
$studentnumber = "";
$enroldate = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentfname = $_POST['studentfname'];
    $studentlname = $_POST['studentlname'];
    $studentnumber = $_POST['studentnumber'];
    $enroldate = $_POST['enroldate'];

    $errorMessage = "";

    do {
        if (empty($studentfname) || empty($studentlname) || empty($studentnumber) || empty($enroldate)) {
            $errorMessage = "All the fields are required";
            break;
        }
        $query = "INSERT INTO students (studentfname, studentlname, studentnumber, enroldate)
        VALUES ('$studentfname', '$studentlname', '$studentnumber', '$enroldate')";
        $result = mysqli_query($connect, $query);
        if (!$result) {
            $errorMessage = "Invalid query: " . mysqli_error($connect);
            break;
        }

        $studentfname = "";
        $studentlname = "";
        $studentnumber = "";
        $enroldate = "";


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
    <title>Add New Student</title>
</head>
<body>
    <div class="container my-5">
        <h2>Add New Student</h2>

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
                    <input type="text" class="form-control" name="studentnumber" placeholder="N1234" value="<?php echo $studentnumber; ?>">
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