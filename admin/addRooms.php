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
            <a class="active" href="addRooms.php">Manage Rooms</a>
            <a href="payment.php">Payments</a>
            <a href="profit.php">Profit</a>
            <br><br><br><br><br><br>
            <hr class="mb-n1" color="gold">
            <a class="text-center ml-n4" href="logout.php">Logout</a>
        </div>

        <!-- Page content -->
        <div class="content overflow-auto">
            <div class="col-11 bg-light rounded p-3 mb-4">
                <div class="p-2 rounded bg-warning d-flex">
                    <button class="btn btn-info ml-2">
                        <a href="addRooms.php" class="text-white text-decoration-none">
                            <h5>ADD ROOMS</h5>
                        </a>
                    </button>
                    <button class="btn btn-warning ml-auto mr-2">
                        <a href="deleteRooms.php" class="text-white text-decoration-none">
                            <h5>DELETE ROOMS</h5>
                        </a>
                    </button>
                </div>
            </div>
            <div class="row ml-4">
                <div class="col-md-4 bg-light rounded p-4 mr-5">
                    <form action="" method="post">
                        <div class="form-group bg-info text-white rounded p-lg-2">
                            <h6>ADD NEW ROOM</h6>
                        </div>
                        <div class="form-group">
                            <label for="">Type of Room*</label>
                            <select name="roomtype" class="form-control form-control-sm" required>
                                <option value="" disabled selected></option>
                                <option value="1 Bedroom">1 Bedroom</option>
                                <option value="2 Bedroom">2 Bedroom</option>
                                <option value="3 Bedroom">3 Bedroom</option>
                                <option value="4 Bedroom">4 Bedroom</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Choose Floor*</label>
                            <select name="floor" class="form-control form-control-sm" required>
                                <option value="" disabled selected></option>
                                <option value="1st Floor">1st</option>
                                <option value="2nd Floor">2nd</option>
                                <option value="3rd Floor">3rd</option>
                                <option value="4th Floor">4th</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btn_add" value="ADD NEW" class="btn-sm btn-info">
                        </div>
                    </form>
                    <?php
                        require ('../db_connection.php');
                        $db_connection = mysqli_connect("localhost", "root", "", "simbaplaza");
                        if(isset($_POST['btn_add']))
                        {
                            $roomtype = $_POST['roomtype'];
                            $floor = $_POST['floor'];
                            $availability = 'Free';

                            $check = "SELECT * FROM rooms WHERE room_type = '$roomtype' AND room_floor = '$floor'";
                            $query = mysqli_query($db_connection, $check);
                            $data = mysqli_fetch_array($query, MYSQLI_NUM);
                            if($data > 1) {
                                echo "<script type='text/javascript'> alert('Room Already in Exists')</script>";

                            }
                            else
                            {
                                $InsertQuery = "INSERT INTO `rooms`(`room_type`, `room_floor`,`room_availability`) 
                                                VALUES ('$roomtype','$floor','$availability')" ;
                                if(mysqli_query($db_connection, $InsertQuery))
                                {
                                    echo '<script>alert("New Room Added") </script>';

                                }else {
                                    echo '<script>alert("Sorry ! Check The System") </script>' ;
                                }
                            }
                        }
                    ?>
                </div>
                <div class="col-md-5 bg-light rounded p-4 ml-5">
                    <div class="form-group bg-info text-white rounded p-lg-2">
                        <h6>ROOMS INFORMATION</h6>
                    </div>
                    <div class="form-group table-responsive">
                        <table class="table table-sm table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Room ID</th>
                                    <th>Room Type</th>
                                    <th>Floor</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php

                                    $SelectQuery = "SELECT * FROM `rooms` WHERE 1";
                                    $rooms = mysqli_query($db_connection,$SelectQuery);

                                    while ($Row = mysqli_fetch_assoc($rooms)){
                                        extract($Row);

                                        echo "<tr>
                                        <td>".$Row['room_id']."</td>
                                        <td>".$Row['room_type']."</td>
                                        <td>".$Row['room_floor']."</td>
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
    </div>
</body>
</html>
