<?php
session_start();
if(!isset($_SESSION["admin_username"]))
{
    header("location: adminLogin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administration | Simba Plaza</title>

    <link rel="stylesheet" href="adminstyle.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
</head>
<body>
<div class="admin">
    <!-- The sidebar -->
    <div class="sidebar">
        <hr color="gold">
        <h4 class="font-weight-bolder ml-3" style="color: gold">SIMBA PLAZA</h4>
        <hr color="gold">
        <a href="adminDashboard.php">Dashboard</a>
        <a class="active" href="rooms.php">Rooms Status</a>
        <a href="addRooms.php">Manage Rooms</a>
        <a href="payment.php">Payments</a>
        <a href="profit.php">Profit</a>
        <br><br><br><br><br><br>
        <hr class="mb-n1" color="gold">
        <a class="text-center ml-n4" href="logout.php">Logout</a>
    </div>

    <!-- Page content -->
    <div class="content overflow-auto">
        <div class="col-12 bg-light rounded p-3">
            <div class="col-12 bg-info rounded p-2 text-white">
                <h4 class="ml-2">AVAILABLE ROOMS</h4>
            </div>
        </div>
        <?php
            include ('../db_connection.php');
            $db_connection = mysqli_connect("localhost", "root", "", "simbaplaza");

            $selectRooms = "SELECT * FROM `rooms`";
            $rooms = mysqli_query($db_connection, $selectRooms)
        ?>
        <div class="row p-2">
            <?php
                while($Row = mysqli_fetch_assoc($rooms)) {
                    extract($Row);
                    $floor = $Row['room_floor'];
                    $availability = $Row['room_availability'];
                    if ($availability == "Occupied") {
                        echo "<div class='col-3 p-2'>
                            <div class='text-center p-3 rounded bg-secondary text-white'>
                                <div>
                                    <h3>" . $Row['room_type'] . "</h3>
                                </div>
                                <div>
                                    <h4>" . $Row['room_floor'] . "</h4>
                                </div>
                            </div>
                        </div>";
                    }
                    else if ($floor == "1st Floor") {
                        echo "<div class='col-3 p-2'>
                            <div class='text-center p-3 rounded bg-primary text-white'>
                                <div>
                                    <h3>" . $Row['room_type'] . "</h3>
                                </div>
                                <div>
                                    <h4>" . $Row['room_floor'] . "</h4>
                                </div>
                            </div>
                        </div>";
                    }
                    else if ($floor == "2nd Floor") {
                        echo "<div class='col-3 p-2'>
                            <div class='text-center p-3 rounded bg-success text-white'>
                                <div>
                                    <h3>" . $Row['room_type'] . "</h3>
                                </div>
                                <div>
                                    <h4>" . $Row['room_floor'] . "</h4>
                                </div>
                            </div>
                        </div>";
                    }
                    else if ($floor == "3rd Floor") {
                        echo "<div class='col-3 p-2'>
                            <div class='text-center p-3 rounded bg-warning text-white'>
                                <div>
                                    <h3>" . $Row['room_type'] . "</h3>
                                </div>
                                <div>
                                    <h4>" . $Row['room_floor'] . "</h4>
                                </div>
                            </div>
                        </div>";
                    }
                    else if ($floor == "4th Floor") {
                        echo "<div class='col-3 p-2'>
                            <div class='text-center p-3 rounded bg-danger text-white'>
                                <div>
                                    <h3>" . $Row['room_type'] . "</h3>
                                </div>
                                <div>
                                    <h4>" . $Row['room_floor'] . "</h4>
                                </div>
                            </div>
                        </div>";
                    }
                }
            ?>
        </div>
    </div>
</div>
</body>
</html>
