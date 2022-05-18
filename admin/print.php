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
        <a class="text-center ml-n4" href="logout.php">Logout</a>
    </div>

    <!-- Page content -->
    <div class="content overflow-auto">
        <?php
            require ('../db_connection.php');
            $db_connection = mysqli_connect("localhost", "root", "", "simbaplaza");

            $currentDate=date("Y/m/d");
            $print_id = $_GET['print_id'];

            $selectPayment ="SELECT * FROM `payment` WHERE `payment_id`='$print_id'";
            $invoice = mysqli_query($db_connection, $selectPayment);
            while($Row = mysqli_fetch_assoc($invoice)) {
                extract($Row);

                $payment_id = $Row['payment_id'];
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
                $roomprice = $Row['roomprice'];
                $deposit = $Row['deposit'];
                $booking_total = $Row['booking_total'];
            }

            $roomRate = 0;
            if ($roomtype == "1 Bedroom") {
                $roomRate = 50;
            } else if ($roomtype == "2 Bedroom") {
                $roomRate = 100;
            } else if ($roomtype == "3 Bedroom") {
                $roomRate = 150;
            } else if ($roomtype == "4 Bedroom") {
                $roomRate = 200;
            }

            if ($floor == "1st Floor") {
                $floorRate = $roomRate * 1 / 100;
            } else if ($floor == "2nd Floor") {
                $floorRate = $roomRate * 2 / 100;
            } else if ($floor == "3rd Floor") {
                $floorRate = $roomRate * 3 / 100;
            } else if ($floor == "4th Floor") {
                $floorRate = $roomRate * 4 / 100;
            }

        ?>
        <div id="divToPrint" class="col-11 bg-light p-4 rounded ml-auto mr-auto">
            <div class="bg-info text-white p-2 mb-4 rounded">
                <h5 align="center" class="font-weight-bolder">INVOICE</h5>
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

                <table class="table-sm table-bordered text-monospace ml-auto mr-4 mb-5">
                    <tr>
                        <th>INVOICE #</th>
                        <td><?php echo $payment_id; ?></td>

                    </tr>
                    <tr>
                        <th>DATE</th>
                        <td><?php echo $currentDate; ?></td>

                    </tr>
                </table>
            </div>
            <div class="table text-monospace mt-4">
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

                        <th>CHECK-IN</th>
                        <td><?php echo $checkin; ?></td>

                    </tr>
                    <tr>
                        <th>Floor Level</th>
                        <td><?php echo $floor; ?></td>

                        <th>CHECK-OUT</th>
                        <td><?php echo $checkout; ?></td>

                    </tr>
                </table>
                <table class="table table-bordered mb-5">
                    <tr>
                        <th class="text-uppercase">Payment Details : </th>
                    </tr>
                    <tr>
                        <th>Room Price</th>
                        <td><?php echo "$".$roomRate; ?></td>

                    </tr>
                    <tr>
                        <th>Floor Rate</th>
                        <td><?php echo "$".$floorRate; ?></td>

                    </tr>
                    <tr>
                        <th>Room Total</th>
                        <td><?php echo "$".$roomprice; ?></td>

                    </tr>
                    <tr>
                        <th>Stay Duration</th>
                        <td><?php echo $nodays." days"; ?></td>

                    </tr>
                    <tr>
                        <th>Refundable Deposit</th>
                        <td><?php echo "$".$deposit; ?></td>

                    </tr>
                    <tr>
                        <th>Balance Due </th>
                        <td><?php echo "$".$booking_total; ?></td>

                    </tr>
                </table>
            </div>
            <div class="text-monospace pt-5">
                <hr>
                <h4 class="font-weight-bold text-uppercase text-center">Contact us</h4>
                <p class="text-center">Email :- info@simbaplaza.com || Web :- www.simbaplaza.com || Phone :- +254 722 410 175 </p>
            </div>
        </div>
        <div class="col-2 ml-auto">
            <button id="PrintButton" class="btn-info" onclick="PrintPage()">Print</button>
        </div>
    </div>

    <script type="text/javascript">
        function PrintPage() {
            var divToPrint = document.getElementById("divToPrint");
            var popupWin = window.open('','','width=1000, height=1000');
            popupWin.document.write('<html>');
            popupWin.document.write('<head><link rel="stylesheet" href="adminstyle.css"><link rel="stylesheet" href="../bootstrap/css/bootstrap.css"></head>');
            popupWin.document.write('<body class="p-4">');
            popupWin.document.write(divToPrint.innerHTML);
            popupWin.document.write('</body></html>');
            popupWin.document.close();
            popupWin.print();
            window.close();
        }
    </script>

    <script src="../bootstrap/js/jquery-3.4.0.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
