<?php
$connect = mysqli_connect('localhost', 'root', 'root', 'school');
if(!$connect){
    die("Connection Failed: " . mysqli_connect_error());
}