<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservation | Simba Plaza</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/custom.css">

</head>
<body>
    <nav class="navbar navbar-dark bg-dark position-sticky">
        <div class="navbar-nav navbar-brand position-fixed">
            <a class="nav-item nav-link ml-3" href="index.html"><< back</a>
        </div>
        <div class="navbar-nav navbar-brand ml-auto mr-auto">
            <a class="navbar-brand" href="reservation.php"><h2>SIMBA PLAZA RESERVATION</h2></a>
        </div>
    </nav>


    <div class="background">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-3 bg-light rounded p-4 mr-5">
                    <div class="form-group bg-info text-white rounded p-lg-2">
                        <h6>BOOKING INFORMATION</h6>
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
                        <label for="">Check-In</label>
                        <input name="checkin" type ="date" class="form-control form-control-sm">

                    </div>
                    <div class="form-group">
                        <label for="">Check-Out</label>
                        <input name="checkout" type ="date" class="form-control form-control-sm">
                    </div>
                </div>

                <div class="col-md-8 bg-light rounded ml-5 p-4 row">
                    <div class="col-5 mr-5">
                        <div class="form-group bg-info text-white rounded p-lg-2">
                            <h6>PERSONAL INFORMATION</h6>
                        </div>
                        <div class="form-group">
                            <label for="">Title*</label>
                            <select name="title" class="form-control form-control-sm" required>
                                <option value="" disabled selected></option>
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Miss">Miss</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" name="firstname" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" name="lastname" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="col-5 ml-5">
                        <div class="form-group bg-light text-light p-lg-2">
                            <h6>space</h6>
                        </div>
                        <div class="form-group">
                            <label for="">Phone No.</label>
                            <input type="tel" name="phone" class="form-control form-control-sm" required>
                        </div>
                        <div class="form-group bg-light text-light">
                            <h6>space</h6>
                        </div>
                        <div class="form-group bg-info text-white rounded p-lg-2">
                            <h6>HUMAN VERIFICATION</h6>
                        </div>
                        <div class="form-group">
                            <h6 class="text-center"><?php $Random_code=rand(); echo$Random_code; ?></h6><br>
                            <p>Enter the code here: <br></p>
                            <input  type="text" name="code1" title="random code" />
                            <input type="hidden" name="code" value="<?php echo $Random_code; ?>" />
                            <input type="submit" name="btn_submit" class="btn-sm btn-info ml-lg-4" value="Save">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php
        require ('db_connection.php');
        $db_connection = mysqli_connect("localhost", "root", "", "simbaplaza");
        if(isset($_POST['btn_submit']))
        {
            $code1=$_POST['code1'];
            $code=$_POST['code'];
            $current_date = date("Y-m-d");
            $checkin=$_POST['checkin'];
            $checkout=$_POST['checkout'];
            if($code1!="$code")
            {
                echo "<script type='text/javascript'> alert('Verification Code Error!')</script>" . mysqli_error($db_connection);
            }
            else if ($checkin < $current_date)
            {
                echo "<script type='text/javascript'> alert('Invalid Check-In Date!')</script>" .mysqli_error($db_connection);
            }
            else if ($checkout < $checkin)
            {
                echo "<script type='text/javascript'> alert('Invalid Check-Out Date!')</script>" . mysqli_error($db_connection);
            }
            else {
                $checkAvailability = "SELECT * FROM `rooms` WHERE `room_type`='$_POST[roomtype]' and `room_floor`='$_POST[floor]'";
                $availQuery = mysqli_query($db_connection, $checkAvailability);
                while ($Row = mysqli_fetch_array($availQuery)){
                    $availability = $Row['room_availability'];
                }

                $check = "SELECT * FROM booking WHERE email = '$_POST[email]'";
                $query = mysqli_query($db_connection, $check);
                $data = mysqli_fetch_array($query, MYSQLI_NUM);
                if($data > 1) {
                    echo "<script type='text/javascript'> alert('User Already in Exists!')</script>" . mysqli_error($db_connection);

                }
                else if ($availability == "Occupied")
                {
                    echo "<script type='text/javascript'> alert('Room Selected Is Already Occupied!')</script>" . mysqli_error($db_connection);
                }
                else {
                    $status ="Pending Approval";
                    $newUser = "INSERT INTO `booking`(`title`, `firstname`, `lastname`, `email`, `phone`, `roomtype`, `floor`, `checkin`, `checkout`,`nodays`,`booking_status`)
                                VALUES ('$_POST[title]','$_POST[firstname]','$_POST[lastname]','$_POST[email]','$_POST[phone]','$_POST[roomtype]','$_POST[floor]','$_POST[checkin]','$_POST[checkout]',datediff('$_POST[checkout]','$_POST[checkin]'),'$status')";

                    if (mysqli_query($db_connection, $newUser))
                    {
                        echo "<script type='text/javascript'> alert('Your Booking application has been sent')</script>";

                    }
                    else {
                        echo "<script type='text/javascript'> alert('Error adding user in database!')</script>" . mysqli_error($db_connection);

                    }

                }
            }
        }
    ?>

</body>
</html>