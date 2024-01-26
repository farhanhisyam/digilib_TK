<?php

include('login/koneksi.php');

//masukkan data login 
// $user="admin";
// $pass="admin";
// $pass_hash = password_hash($pass, PASSWORD_DEFAULT); //hashing password hash

// mysqli_query($koneksi, "INSERT INTO login VALUES ('$user','$pass_hash',NOW(),NOW())");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Digilib - Login</title>

    <!-- Custom fonts for this template-->
    <link href="./login/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="./login/css/sb-admin-2.min.css" rel="stylesheet" />
</head>

<body class="bg-light"
    style="background-image: url(https://media.istockphoto.com/id/1285588443/vector/abstract-green-cube-pattern-on-dark-blue-background-modern-lines-square-mesh-simple-flat.jpg?s=612x612&w=0&k=20&c=3FWkq_fKFriUC8k2Ps65lcDe-ttCD5_01nbBY0JNGaA=)">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6 my-5 mx-auto">
                <div class="card o-hidden border-0 shadow-lg">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-12 bg-light">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="https://visionic.co.id/wp-content/uploads/2022/01/polines_brand-1024x230.png"
                                            alt="logo-polines" class="img-fluid mb-5" style=" max-width: 75%">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <?php
                                    //buat code untuk eksekusi tombol
                                    if (isset($_POST['tombol'])){
                                        $user = $_POST['user'];
                                        $pass = $_POST['pswd'];

                                        //query data di tabel login usernam tsb
                                        $q = mysqli_query($koneksi, "SELECT username,password FROM login WHERE username='$user'");
                                        //ambil data password hash
                                        $d = mysqli_fetch_row($q);
                                        $pass_db = $d[1];
                                        //cek data username tsb ada atau tdk di tabel login
                                        $j = mysqli_num_rows($q);


                                        //verify password
                                        $pass_hash = password_verify($pass, $pass_db);

                                        // echo "test: j:$j == passhash: $pass_hash";

                                        
                                        if ($j==1 && $pass_hash==1) {
                                            // jika login berhasil maka akan membuat sesi baru userbame dan password
                                            session_start();
                                            $_SESSION['user'] = $user;
                                            $_SESSION['pass'] = $pass_db;
                                            //redirect ke halaman /login/index.php
                                            echo "<script>window.location.replace('./login/index.php')</script>";
                                        }
                                        else {
                                            echo "<div class=\"alert alert-danger alert-dismissible fade show\">
                                                <button type=button class=btn-close data-bs-dismiss=alert></button>
                                                <strong>Failed</strong> Gagal login.......
                                            </div>";
                                        }
                                    
                                    }
                                    ?>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username"
                                                placeholder="Enter Username" name="user" />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="pwd"
                                                placeholder="Enter Password" name="pswd" />
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" />
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" name="tombol" value="login"
                                            class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                        <hr />
                                        <!-- <a href="#" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="#" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with
                                            Facebook
                                        </a> -->
                                    </form>
                                    <hr />
                                    <div class="text-center">
                                        <a class="small" href="#">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="#">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="./login/vendor/jquery/jquery.min.js"></script>
    <script src="./login/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./login/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./login/js/sb-admin-2.min.js"></script>
</body>

</html>