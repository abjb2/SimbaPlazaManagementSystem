<?php
session_start();
if(!isset($_SESSION["admin_username"]))
{
    header("location: adminLogin.php");
}
?>
<?php
    if (isset($_GET["booking_id"])){

        include ('../db_connection.php');
        $db_connection = mysqli_connect("localhost", "root", "", "simbaplaza");
        $current_date =  date("Y-m-d");
        $booking_id = $_GET['booking_id'];

        $select ="SELECT * FROM booking where booking_id = '$booking_id'";
        $booking = mysqli_query($db_connection ,$select);
        while($Row = mysqli_fetch_assoc($booking))
        {
            extract($Row);

            $title     = $Row['title'];
            $firstname = $Row['firstname'];
            $lastname  = $Row['lastname'];
            $email     = $Row['email'];
            $phone     = $Row['phone'];
            $roomtype  = $Row['roomtype'];
            $floor     = $Row['floor'];
            $checkin   = $Row['checkin'];
            $checkout  = $Row['checkout'];
            $nodays    = $Row['nodays'];
            $booking_status = $Row['booking_status'];

        }
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
            <div class="row">
                <div class="col-7 bg-light p-4 rounded mr-5">
                    <div class="bg-info text-white p-lg-2 rounded">
                        <h6>BOOKING CONFIRMATION</h6>
                    </div>
                    <div class="table table-responsive table-sm mt-2">
                        <table class="table">
                            <tr>
                                <th>DESCRIPTION</th>
                                <th>INFORMATION</th>

                            </tr>
                            <tr>
                                <th>Name</th>
                                <th><?php echo $title." ".$firstname." ".$lastname; ?> </th>

                            </tr>
                            <tr>
                                <th>Email</th>
                                <th><?php echo $email ; ?> </th>

                            </tr>
                            <tr>
                                <th>Phone No </th>
                                <th><?php echo $phone; ?></th>

                            </tr>
                            <tr>
                                <th>Type Of the Room </th>
                                <th><?php echo $roomtype; ?></th>

                            </tr>
                            <tr>
                                <th>Floor </th>
                                <th><?php echo $floor; ?></th>

                            </tr>
                            <tr>
                                <th>Check-in Date </th>
                                <th><?php echo $checkin; ?></th>

                            </tr>
                            <tr>
                                <th>Check-out Date</th>
                                <th><?php echo $checkout; ?></th>

                            </tr>
                            <tr>
                                <th>No of days</th>
                                <th><?php echo $nodays; ?></th>

                            </tr>
                            <tr>
                                <th>Status Level</th>
                                <th><?php echo $booking_status; ?></th>

                            </tr>
                        </table>
                    </div>
                    <div class="form-group">
                        <form action="" method="post">
                            <div class="form-group d-flex justify-content-end mr-3 p-2">
                                <select name="confirm" class="form-control" hidden>
                                    <option value="Booking Approved" selected >Booking Approved</option>
                                </select>
                                <input type="submit" name="btn_confirm" value="CONFIRM BOOKING" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                    $selectQuery ="SELECT * FROM `rooms`";
                    $result = mysqli_query($db_connection, $selectQuery);
                    $rooms = 0;
                    $oneBR = 0;
                    $twoBR = 0;
                    $threeBR = 0;
                    $fourBR = 0;

                    while($Row = mysqli_fetch_array($result))
                    {
                        $rooms = $rooms + 1;
                        $room_type = $Row['room_type'];
                        $room_availability = $Row['room_availability'];

                        if($room_type == "1 Bedroom" )
                        {
                            $oneBR = $oneBR + 1;
                        }
                        if($room_type == "2 Bedroom")
                        {
                            $twoBR = $twoBR + 1;
                        }
                        if($room_type == "3 Bedroom")
                        {
                            $threeBR = $threeBR + 1;
                        }
                        if($room_type == "4 Bedroom")
                        {
                            $fourBR = $fourBR + 1;
                        }
                    }
                ?>
                <?php
                    $paymentquery = "SELECT * FROM `payment`";
                    $paymentresult = mysqli_query($db_connection, $paymentquery);
                    $paid_rooms = 0;
                    $paid_oneBR = 0;
                    $paid_twoBR = 0;
                    $paid_threeBR = 0;
                    $paid_fourBR = 0;

                    while($Row = mysqli_fetch_array($paymentresult))
                    {
                        $paid_rooms = $paid_rooms + 1;
                        $paid_roomtype = $Row['roomtype'];

                        if($paid_roomtype == "1 Bedroom")
                        {
                            $paid_oneBR = $paid_oneBR + 1;
                        }
                        if($paid_roomtype == "2 Bedroom" )
                        {
                            $paid_twoBR = $paid_twoBR + 1;
                        }
                        if($paid_roomtype == "3 Bedroom" )
                        {
                            $paid_threeBR = $paid_threeBR + 1;
                        }
                        if($paid_roomtype == "4 Bedroom" )
                        {
                            $paid_fourBR = $paid_fourBR + 1;
                        }
                    }
                ?>
                <div class="col-3 bg-light p-4 rounded ml-5 ">
                    <div class="bg-info text-white p-lg-2 rounded">
                        <h6>ROOM AVAILABILITY</h6>
                    </div>
                    <div class="table table-responsive table-borderless table-sm mt-2">
                        <table class="table">
                            <tr>
                                <th>1 Bedrooms</th>
                                <td>
                                    <button type="button" class="btn btn-primary rounded-pill">
                                        <?php
                                            $avail_oneBR = $oneBR - $paid_oneBR;
                                            if($avail_oneBR <= 0)
                                            {	$avail_oneBR = "FULL";
                                                echo $avail_oneBR;
                                            }
                                            else{
                                                echo $avail_oneBR;
                                            }
                                        ?>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>2 Bedrooms</th>
                                <td>
                                    <button type="button" class="btn btn-primary rounded-pill">
                                        <?php
                                            $avail_twoBR =  $twoBR -$paid_twoBR;
                                            if($avail_twoBR <= 0)
                                            {	$twoBR = "FULL";
                                                echo $avail_twoBR;
                                            }
                                            else{
                                                echo $avail_twoBR;
                                            }
                                        ?>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>3 Bedrooms</th>
                                <td>
                                    <button type="button" class="btn btn-primary rounded-pill">
                                        <?php
                                            $avail_threeBR =$threeBR - $paid_threeBR;
                                            if($avail_threeBR <= 0)
                                            {	$avail_threeBR = "FULL";
                                                echo $avail_threeBR;
                                            }
                                            else{
                                                echo $avail_threeBR;
                                            }
                                        ?>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>4 Bedrooms</th>
                                <td>
                                    <button type="button" class="btn btn-primary rounded-pill">
                                        <?php
                                            $avail_fourBR =$fourBR - $paid_fourBR;
                                            if($avail_fourBR <= 0)
                                            {	$avail_fourBR = "FULL";
                                                echo $avail_fourBR;
                                            }
                                            else{
                                                echo $avail_fourBR;
                                            }
                                        ?>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th>Total Rooms</th>
                                <td>
                                    <button type="button" class="btn btn-info rounded-pill">
                                        <?php
                                            $total_avail = $rooms - $paid_rooms;
                                            if($total_avail <= 0)
                                            {	$total_avail = "FULL";
                                                echo $total_avail;
                                            }
                                            else{
                                                echo $total_avail;
                                            }
                                        ?>
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group">
                        <form action="" method="post">
                            <div class="form-group d-flex justify-content-end mr-3 p-2">
                                <select name="reject" class="form-control-sm" hidden>
                                    <option value="Reject Booking" selected >Reject Booking</option>
                                    <input type="submit" name="btn_reject" value="REJECT" class="btn-sm btn-danger">
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    if (isset($_POST['btn_confirm'])){

        $approval = $_POST['confirm'];

        if($approval == "Booking Approved") {

            $updateBooking = "UPDATE `booking` SET `booking_status`='$approval' WHERE `booking_id`='$booking_id'";

            if ($avail_oneBR == "FULL") {
                echo "<script type='text/javascript'> alert('Sorry! All One Bedroom Apartments Are Occupied')</script>";

            } else if ($avail_twoBR == "FULL") {
                echo "<script type='text/javascript'> alert('Sorry! All Two Bedroom Apartments Are Occupied')</script>";

            } else if ($avail_threeBR == "FULL") {
                echo "<script type='text/javascript'> alert('Sorry! All Three Bedroom Apartments Are Occupied')</script>";

            } else if ($avail_fourBR == "FULL") {
                echo "<script type='text/javascript'> alert('Sorry! All Four Bedroom Apartments Are Occupied')</script>";

            } else if (mysqli_query($db_connection, $updateBooking)){
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
            }


            $roomPrice = $roomRate + $floorRate;
            $deposit = 50;
            $priceTotal = ($roomPrice * $nodays) + $deposit;

            $insertPayment = "INSERT INTO `payment`(`payment_id`,`title`,`firstname`,`lastname`,`email`,`phone`,`roomtype`,`floor`,`checkin`,`checkout`,`nodays`,`roomprice`,`deposit`,`booking_total`)
                                VALUES('$booking_id','$title','$firstname','$lastname','$email','$phone','$roomtype','$floor','$checkin','$checkout','$nodays','$roomPrice','$deposit','$priceTotal') ";

            if (mysqli_query($db_connection, $insertPayment)) {
                $occupied = "Occupied";
                $updateRoom = "UPDATE `rooms` SET `room_availability`='$occupied', `client_id`='$booking_id' WHERE `room_type`='$roomtype' and `room_floor`='$floor'";

                if (mysqli_query($db_connection, $updateRoom)) {
                    echo "<script type='text/javascript'> alert('Booking Confirmed')</script>";
                    echo "<script type='text/javascript'> window.location='adminDashboard.php'</script>";
                }
            }
        }
    }
?>
<?php
    if (isset($_POST['btn_reject'])){
        $reject = $_POST['reject'];

        if ($reject == "Reject Booking") {
            $deleteBooking = "DELETE FROM `booking` WHERE `booking_id`='$booking_id'";
            if (mysqli_query($db_connection, $deleteBooking)) {
                echo "<script type='text/javascript'> alert('Booking Rejected')</script>";
                echo "<script type='text/javascript'> window.location='adminDashboard.php'</script>";
            }
        }
    }
?>
