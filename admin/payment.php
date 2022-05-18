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
        <a href="rooms.php">Rooms Status</a>
        <a href="addRooms.php">Manage Rooms</a>
        <a class="active" href="payment.php">Payments</a>
        <a href="profit.php">Profit</a>
        <br><br><br><br><br><br>
        <hr class="mb-n1" color="gold">
        <a class="text-center ml-n4" href="">Logout</a>
    </div>

    <!-- Page content -->
    <div class="content overflow-auto">
        <div class="col-12 bg-light rounded p-3 mb-4">
            <div class="col-12 bg-info rounded p-2 text-white">
                <h4 class="ml-2">PAYMENT DETAILS</h4>
            </div>
        </div>
        <div class="col-12 bg-light rounded p-3">
            <div class="table table-sm table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Room type</th>
                            <th>Floor</th>
                            <th>Room Rent</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Stay</th>
                            <th>Total</th>
                            <th>More</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        include ('../db_connection.php');
                        $db_connection = mysqli_connect("localhost", "root", "", "simbaplaza");

                        $check = "SELECT * FROM payment";
                        $payment = mysqli_query($db_connection ,$check);

                        while($Row = mysqli_fetch_assoc($payment))
                        {
                            extract($Row);
                            $id = $Row['payment_id'];

                            echo"<tr>
                                <td>".$Row['title']." ".$Row['firstname']." ".$Row['lastname']."</td>
                                <td>".$Row['roomtype']."</td>
                                <td>".$Row['floor']."</td>
                                <td>".$Row['roomprice']."</td>
                                <td>".$Row['checkin']."</td>
                                <td>".$Row['checkout']."</td>
                                <td>".$Row['nodays']."</td>
                                <td>".$Row['booking_total']."</td>
                                
                                <td>
                                    <a href='print.php?print_id= ".$id."'>
                                        <button class='btn-sm btn-primary'>Invoice</button>
                                    </a>
                                </td>
                                </tr>"
                            ;
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script src="../bootstrap/js/jquery-3.4.0.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>