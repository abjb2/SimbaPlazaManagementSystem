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
        <a class="active" href="adminDashboard.php">Dashboard</a>
        <a href="rooms.php">Rooms Status</a>
        <a href="addRooms.php">Manage Rooms</a>
        <a href="payment.php">Payments</a>
        <a href="profit.php">Profit</a>
        <br><br><br><br><br><br>
        <hr class="mb-n1" color="gold">
        <a class="text-center ml-n4" href="logout.php">Logout</a>
    </div>

    <!-- Page content -->
    <div class="content overflow-auto">
        <?php
            require ('../db_connection.php');
            $db_connection = mysqli_connect("localhost", "root", "", "simbaplaza");

            $currentDate=date("Y/m/d");
            $view_id = $_GET['view_id'];

            $selectBooking ="SELECT * FROM `booking` WHERE `booking_id`='$view_id'";
            $result = mysqli_query($db_connection, $selectBooking);
            while($Row = mysqli_fetch_assoc($result))
            {
                extract($Row);

                $booking_id = $Row['booking_id'];
                $title = $Row['title'];
                $firstname = $Row['firstname'];
                $lastname = $Row['lastname'];
                $email = $Row['email'];
                $phone = $Row['phone'];
                $roomtype = $Row['roomtype'];
                $floor = $Row['floor'];
                $checkin = $Row['checkin'];
                $checkout = $Row['checkout'];
                $nodays  = $Row['nodays'];
                $booking_status = $Row['booking_status'];
            }

        ?>
        <div id="divToPrint" class="col-11 bg-light p-4 rounded ml-auto mr-auto">
            <div class="bg-info text-white p-2 mb-4 rounded">
                <h4 align="center" class="font-weight-bolder">GUEST INFORMATION</h4>
            </div>
            <div class="text-monospace">
                <p>SIMBA PLAZA<br>
                    Beach Road,<br>
                    Off Nyali Lane,<br>
                    Mombasa, Kenya. <br>
                    (+254) 722 410 175</p>
            </div>
            <div class="row ml-1">
                <h3 class="mt-4 text-monospace text-uppercase font-weight-bold"><?php echo "$title $firstname $lastname"; ?></h3>

                <table class="table-sm table-bordered text-monospace ml-auto mr-4">
                    <tr>
                        <th>CLIENT ID</th>
                        <td><?php echo $booking_id; ?></td>

                    </tr>
                    <tr>
                        <th>CHECK-IN</th>
                        <td><?php echo $checkin; ?></td>

                    </tr>
                    <tr>
                        <th>CHECK-OUT</th>
                        <td><?php echo $checkout; ?></td>

                    </tr>
                </table>
            </div>
            <div class="table text-monospace mt-5">
                <table class="table-borderless mb-5">
                    <tr>
                        <th class="text-uppercase">Personal Details : </th>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td><?php echo $phone; ?></td>

                    </tr>
                    <tr>
                        <th>Email Address</th>
                        <td><?php echo $email; ?></td>

                    </tr>
                </table>
                <table class="table-borderless mb-5">
                    <tr>
                        <th class="text-uppercase">Booking Details : </th>
                    </tr>
                    <tr>
                        <th>Room Type</th>
                        <td><?php echo $roomtype; ?></td>

                    </tr>
                    <tr>
                        <th>Floor Level</th>
                        <td><?php echo $floor; ?></td>

                    </tr>
                    <tr>
                        <th>Stay Duration</th>
                        <td><?php echo $nodays." days"; ?></td>

                    </tr>
                </table>
            </div>
            <div align="center" class="text-monospace mb-auto">
                <hr>
                <h4 class="font-weight-bold text-uppercase">Contact us</h4>
                <p>Email :- info@simbaplaza.com || Web :- www.simbaplaza.com || Phone :- +254 722 410 175 </p>
            </div>
        </div>
    </div>
</div>



<script src="../bootstrap/js/jquery-3.4.0.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>