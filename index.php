<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<!-- Sweetalert 2 -->
<script src="plugins/sweetalert2/sweetalert2.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-right',
        showConfirmButton: false,
    });
</script>

<?php
include_once '_include/connect.php';
session_start();
error_reporting(0);
if (isset($_POST['btn_signin'])) {

    $useremail = $_POST['txt_email'];
    $password = $_POST['txt_password'];

    $select = $pdo->prepare("select * from tbl_user where useremail='$useremail' AND password='$password'");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if ($row['useremail'] == $useremail and $row['password'] == $password and $row['role'] == "Admin") {
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['useremail'] = $row['useremail'];
        $_SESSION['role'] = $row['role'];
        echo "<script type='text/javascript'> 
          jQuery(function validation() {
            Toast.fire({
                icon: 'success',
                title: 'Login Sucessful. Welcome " . $_SESSION['username'] . "!',
                timer: 2000
              })
            });
          </script>";
        header("refresh:3;dashboard_admin.php");
    } else if ($row['useremail'] == $useremail and $row['password'] == $password and $row['role'] == "User") {
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['useremail'] = $row['useremail'];
        $_SESSION['role'] = $row['role'];
        echo "<script type='text/javascript'> 
        jQuery(function validation() {
          Toast.fire({
              icon: 'success',
              title: ' Login Sucessful. Welcome " . $_SESSION['username'] . "!',
              timer: 2000
            })
          });
        </script>";
        header("refresh:3;dashboard_user.php");
    } else {
        echo "<script type='text/javascript'> 
        jQuery(function validation() {
          Toast.fire({
              icon: 'warning',
              title: 'Login Fail! Please provide with your correct email and password.',
              timer: 8000
            })
          });
        </script>";
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PerPOS | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Sweetalert 2 -->
    <!-- <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.css"> -->
    <!-- <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"> -->
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="wrapper login-box">
        <div class="login-logo my-5">
            <i class="nav-icon fas fa-coffee"></i>
            <span style=" font-family: 'Righteous' , cursive;">
                PerPOS
            </span>
        </div>

        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">

                <p class="login-box-msg my-4">Sign in to start your session</p>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="txt_email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-5">
                        <input type="password" class="form-control" name="txt_password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8 mt-2">
                            <a href="#" onclick="Toast.fire({ icon: 'warning', title: 'Please contact admin or service provider to retrieve your password.', timer: 8000})">
                                I forgot my password
                            </a>
                            <br>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="btn_signin" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>

        </div>
    </div>

</body>

</html>