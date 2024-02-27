<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>School Directory</title>
</head>
<body>
    <?php include('includes/connect.php'); ?>
    <div class="container my-5">
        <h2>List of Students</h2>
        <a href="add.php" class="btn btn-primary" role="button">New Student</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Student Number</th>
                    <th>Enrollment Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $query = "SELECT * FROM students";

            $students = mysqli_query($connect, $query);
            if (mysqli_connect_error()) {
                die("Connection error: " . mysqli_connect_error());
            }
            
            
            while($result = $students->fetch_assoc()) {
                echo "
                <tr>
                    <td>$result[studentid]</td>
                    <td>$result[studentfname]</td>
                    <td>$result[studentlname]</td>
                    <td>$result[studentnumber]</td>
                    <td>$result[enroldate]</td>
                    <td>
                        <a href='/classes.php?id=$result[studentid]' class='btn btn-sm btn-primary'>Classes</a>
                        <a href='/edit.php?id=$result[studentid]' class='btn btn-sm btn-warning'>Edit</a>
                        <a href='/delete.php?id=$result[studentid]' class='btn btn-sm btn-danger'>Delete</a>
                    </td>
                </tr>
                ";
            }
            ?>
                
            </tbody>
        </table>
    </div>
    
</body>
</html>