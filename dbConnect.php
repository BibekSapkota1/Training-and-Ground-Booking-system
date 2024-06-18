<?php
$conn = mysqli_connect('localhost', 'root', '', '23189618');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>