<?php
$db_connection = mysqli_connect("localhost", "root", "", "simbaplaza");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}