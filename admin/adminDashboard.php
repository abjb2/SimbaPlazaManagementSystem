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
            <a class="text-center ml-n4" href="">Logout</a>
        </div>

        <!-- Page content -->
        <div class="content overflow-auto">
            <?php
                include ('../db_connection.php');
                $db_connection = mysqli_connect("localhost", "root", "", "simbaplaza");
                $check = "SELECT * FROM booking";
                $booking = mysqli_query($db_connection ,$check);
                $count = 0;

                while($Row = mysqli_fetch_array($booking))
                {
                    $status = $Row['booking_status'];
                    if($status == "Pending Approval")
                    {
                        $count = $count + 1;

                    }
                }
            ?>

            <div class="col-12 bg-light rounded p-2">
                <div class="col-12 bg-warning rounded p-3">
                    <button class="btn btn-sm btn-info" data-toggle="collapse" data-target="#collapseOne">
                        <h5>New Bookings  <span class="badge badge-pill badge-light"><?php echo $count ; ?></span></h5>
                    </button>
                </div>
                <div id="collapseOne" class="collapse">
                    <div class="table table-sm table-responsive mt-1">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Room</th>
                                    <th>Floor</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Status</th>
                                    <th>More</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $check = "SELECT * FROM booking";
                                    $booking = mysqli_query($db_connection ,$check);

                                    while($Row = mysqli_fetch_assoc($booking))
                                    {
                                        extract($Row);
                                        $status = $Row['booking_status'];
                                        if($status == "Pending Approval")
                                        {
                                            $id = $Row['booking_id'];

                                            echo"<tr>
                                                <td>".$Row['booking_id']."</td>
                                                <td>".$Row['firstname']." ".$Row['lastname']."</td>
                                                <td>".$Row['email']."</td>
                                                <td>".$Row['roomtype']."</td>
                                                <td>".$Row['floor']."</td>
                                                <td>".$Row['checkin']."</td>
                                                <td>".$Row['checkout']."</td>
                                                <td>".$Row['booking_status']."</td>
                                                
                                                <td><a href='booking.php?booking_id= ".$id."' class='btn btn-sm btn-primary'>Action</a></td>
                                                </tr>"
                                            ;
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                <?php
                    $check = "SELECT * FROM `booking`";
                    $booking = mysqli_query($db_connection, $check);
                    $count2 = 0;
                    while($Row = mysqli_fetch_array($booking))
                    {
                        $status = $Row['booking_status'];
                        if($status == "Booking Approved")
                        {
                            $count2 = $count2 + 1;

                        }
                    }
                ?>

                <div class="col-12 bg-light rounded p-2 mt-3">
                    <div class="col-12 bg-warning rounded p-3">
                        <button class="btn btn-sm btn-info" data-toggle="collapse" data-target="#collapseTwo">
                            <h5>Booked Rooms <span class="badge badge-pill badge-light"><?php echo $count2 ; ?></span></h5>
                        </button>
                    </div>
                    <div id="collapseTwo" class="collapse text-white row p-2">
                        <?php
                            $check = "SELECT * FROM `booking`";
                            $booking = mysqli_query($db_connection, $check);

                            while($Row = mysqli_fetch_assoc($booking))
                            {
                                extract($Row);
                                $booking_id = $Row['booking_id'];
                                $status = $Row['booking_status'];
                                $checkout = $Row['checkout'];
                                if ($status == "Booking Approved")
                                {
                                    $id = $Row['booking_id'];

                                    echo"<div class='col-3 p-2'>
                                              <div class='text-center bg-info p-3 rounded'>
                                                    <div>
                                                        <h3>".$Row['firstname']."</h3>
                                                    </div>
                                                    <div>
                                                        <a href=view.php?view_id=".$id.">
                                                            <button class='btn-sm btn-primary'>View</button>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <h6>".$Row['roomtype']."</h6>
                                                        <h6>".$Row['floor']."</h6>
                                                    </div>
                                              </div>
                                          </div>"
                                    ;
                                }
                                $current_date = date("Y-m-d");
                                $availability = "Free";
                                $null = NULL;
                                if ($current_date > $checkout) {
                                    $deleteBooking = "DELETE FROM `booking` WHERE `booking_id`='$booking_id'";
                                    if (mysqli_query($db_connection, $deleteBooking)) {
                                        $vacateRoom = "UPDATE `rooms` SET `room_availability`='$availability',`client_id`='$null' WHERE `client_id`='$booking_id'";
                                        if (mysqli_query($db_connection, $vacateRoom)) {

                                        }
                                    }
                                }

                            }
                        ?>
                    </div>
                </div>

        </div>
    </div>


    <script src="../bootstrap/js/jquery-3.4.0.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>