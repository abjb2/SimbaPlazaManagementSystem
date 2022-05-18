<?php
session_start();
if(isset($_SESSION["admin_username"]))
{
    header("location: adminDashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Simba Plaza</title>

    <link rel="stylesheet" href="adminstyle.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">

</head>
<body>
    <div class="container mw-100">
        <div class="login">
            <form action="" method="post">
                <input class="form-control form-control-lg col-lg-12 bg-dark" type="text" name="admin_username" placeholder="Username" required><br>
                <input class="form-control form-control-lg col-lg-12 bg-dark" type="password" name="admin_password" placeholder="Password" required><br>
                <button class="btn btn-info form-control-lg col-lg-12" type="submit">Login</button>
            </form>
        </div>
    </div>
    <div class="mt-n5 d-flex justify-content-center">
        <a class="text-info font-weight-bold" href="../index.html">SIMBA PLAZA HOMEPAGE</a>
    </div>
</body>
</html>

<?php
// connect to database
require ('../db_connection.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $myusername = mysqli_real_escape_string($db_connection,$_POST['admin_username']);
    $mypassword = mysqli_real_escape_string($db_connection,$_POST['admin_password']);

    $sql = "SELECT * FROM adminlogin WHERE admin_username = '$myusername' and admin_password = '$mypassword'";
    $result = mysqli_query($db_connection,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 1) {

        $_SESSION['admin_username'] = $myusername;

        header("location: adminDashboard.php");
    }else {
        echo '<script>alert("Your Login Name or Password is invalid") </script>' ;
    }
}
?>
