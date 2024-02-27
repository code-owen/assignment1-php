<?php
include('includes/connect.php');
if(isset($_GET['studentid'])) {
    $id = $_GET['studentid'];
    $sql = "DELETE FROM students WHERE studentid = $id";
    $result = mysqli_query($connect, $sql);
    if($result) {
        header("location: index.php");
        exit;
    }
}