<?php
session_start();
if(empty($_SESSION['user']) && empty($_SESSION['pass'])){
    echo "<script>window.location.replace('../index.php')</script>";
}

include('koneksi.php');
include('function.php');
$digi = new digilib;
$koneksi = $digi->koneksi();

$nama_form = "form_pustaka";
$nama_file = "";
//ambil value dan variable dari payload
if(isset($_POST['tombol'])) {
    if ($_POST['tombol'] == 'edit'){
        $id_judul = $_POST['id_judul'];
        // $id = $_POST['id'];
        $judul = $_POST['judul'];
        $tipe = $_POST['tipe'];
        $tahun = $_POST['tahun'];
        $pembimbing_1 = $_POST['pembimbing_1'];
        $pembimbing_2 = $_POST['pembimbing_2'];
        $ketua_penguji = $_POST['ketua_penguji'];
        $penguji_1 = $_POST['penguji_1'];
        $penguji_2 = $_POST['penguji_2'];
        $penguji_3 = $_POST['penguji_3'];
        $sekretaris = $_POST['sekretaris'];
        $mhs = $_POST['mhs'];

        $nama_form = "form_pustaka";
        $tombol_val = "simpan";
        
        //upload file 
        $target_dir = "laporan/";
        $nama_file = basename($_FILES["laporan"]["name"]);
        $target_file = $target_dir . $nama_file;

        //jika nama file diisi
        if (!empty($nama_file)) move_uploaded_file($_FILES["laporan"]["tmp_name"], $target_file);

        //update tabel pustaka1
        if (!empty($nama_file)) {
            mysqli_query($koneksi, "UPDATE pustaka1 SET judul=\"$judul\",tahun='$tahun',tipe='$tipe',pembimbing_1='$pembimbing_1',pembimbing_2='$pembimbing_2',ketua_penguji='$ketua_penguji',penguji_1='$penguji_1',penguji_2='$penguji_2',penguji_3='$penguji_3',sekretaris='$sekretaris',nama_file=\"$nama_file\" WHERE id='$id_judul'");
        }
        else {
            mysqli_query($koneksi, "UPDATE pustaka1 SET judul=\"$judul\",tahun='$tahun',tipe='$tipe',pembimbing_1='$pembimbing_1',pembimbing_2='$pembimbing_2',ketua_penguji='$ketua_penguji',penguji_1='$penguji_1',penguji_2='$penguji_2',penguji_3='$penguji_3',sekretaris='$sekretaris' WHERE id='$id_judul'");
        }

        //update tabel pustaka2
        mysqli_query($koneksi, "DELETE FROM pustaka2 WHERE id_judul='$id_judul'");

        for ($i = 0; $i < count($mhs); $i++) {
            $e = explode(' ', $mhs[$i]);
            mysqli_query($koneksi, "INSERT INTO pustaka2 (id_judul,nim) VALUES ('$id_judul','$e[0]')");
        }
    
        // cek data masuk
        if (mysqli_affected_rows($koneksi) > 0) echo "<script>alert('Data berhasil diubah!');
        document.location.href = 'pustb.php';</script>";
        
        else echo "<script>alert('Data gagal diubah!')</script>";
    
            $judul = "";
            $tipe = "";
            $tahun = "";
            $pembimbing_1 = "";
            $pembimbing_2 = "";
            $ketua_penguji = "";
            $penguji_1 = "";
            $penguji_2 = "";
            $penguji_3 = "";
            $sekretaris = "";
            $mhs = "";
    }
    elseif ($_POST['tombol'] == "hapus") {
        $id_judul = $_POST['id_judul'];
        
        $q = mysqli_query($koneksi, "SELECT nama_file FROM pustaka1 WHERE id='$id_judul'");
        $d = mysqli_fetch_row($q);

        //hapus file
        if (!empty($d[0])) {
            $laporan = "./laporan/$d[0]";
            unlink($laporan);
        }

        //hapus data dari pustaka1
        mysqli_query($koneksi, "DELETE FROM pustaka1 WHERE id='$id_judul'");
        //hapus data dari pustaka2
        mysqli_query($koneksi, "DELETE FROM pustaka2 WHERE id_judul='$id_judul'");
        $judul = "";
        $nama_file = "";
        $nama_form = "form_pustaka";
    }
}

elseif (!empty($_GET['t'])) {
    if ($_GET['t'] == 'edit') {
        $id = $_GET['id'];

        //sql tampilkan data
        $q = mysqli_query($koneksi, "SELECT judul,tipe,tahun,pembimbing_1,pembimbing_2,ketua_penguji,penguji_1,penguji_2,penguji_3,sekretaris,nama_file FROM pustaka1 WHERE id='$id'");
        $d = mysqli_fetch_row($q);
        $judul=$d[0];
        $tipe=$d[1];
        $tahun=$d[2];
        $pembimbing_1=$d[3];
        $pembimbing_2=$d[4];
        $ketua_penguji=$d[5];
        $penguji_1=$d[6];
        $penguji_2=$d[7];
        $penguji_3=$d[8];
        $sekretaris=$d[9];
        $nama_file=$d[10];

        $nama_form = "form_pustaka_edit";
        $tombol_val = "edit";

        // if (mysqli_affected_rows($koneksi) > 0) {
        //     echo "<script>alert('Data berhasil diubah!');
        //     document.location.href = 'pustb.php';</script>";
        // }
        // else {
        //     $judul = "";
        //     $tipe = "";
        //     $tahun = "";
        //     $pembimbing_1 = "";
        //     $pembimbing_2 = "";
        //     $ketua_penguji = "";
        //     $penguji_1 = "";
        //     $penguji_2 = "";
        //     $penguji_3 = "";
        //     $sekretaris = "";
        //     $mhs = "";
        //     $tombol_val = "simpan";
        //     echo "<script>alert('Data gagal diubah!')</script>";
        // }
    }
}

else {
    $judul = "";
    $nim = "";
    $nama = "";
    $kelas = "";
    $jurusan = "";
    $prodi = "";
    $pembimbing_1 = "";
    $pembimbing_2 = "";
    $tipe = "";
    $tahun = "";
    $tombol_val = "simpan";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./vendor/jquery-ui/jquery-ui.css">
    <link rel="stylesheet" href="./vendor/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="./vendor/jquery-ui/jquery-ui.structure.css">
    <link rel="stylesheet" href="./vendor/jquery-ui/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="./vendor/jquery-ui/jquery-ui.theme.css">
    <link rel="stylesheet" href="./vendor/jquery-ui/jquery-ui.theme.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <title>Digilib - Form Pustaka</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Digilib <sup>TK</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Forms</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Form:</h6>
                        <a class="collapse-item" href="mhsform.php">Mahasiswa</a>
                        <a class="collapse-item" href="dosform.php">Dosen</a>
                        <a class="collapse-item active" href="pusform.php">Pustaka</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Tables</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Table:</h6>
                        <a class="collapse-item" href="mhstb.php">Mahasiswa</a>
                        <a class="collapse-item" href="dostb.php">Dosen</a>
                        <a class="collapse-item" href="pustb.php">Pustaka</a>
                        <!-- <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a> -->
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="../index.php">Login</a>
                        <a class="collapse-item" href="#">Register</a>
                        <a class="collapse-item" href="#">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="#">404 Page</a>
                        <a class="collapse-item" href="#">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li> -->

            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $user ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800 ms-5">Form Pustaka</h1>
                    <div class="card" style="box-shadow: 0px 0 15px">
                        <div class="card-body ms-4 me-4">
                            <form action="" method="post" id="<?php echo $nama_form ?>" enctype="multipart/form-data">
                                <?php
                                if (isset($_GET['t'])) echo "<input type=hidden name=id_judul value='$_GET[id]'>";
                                else echo "<input type=hidden name=p value=pustaka>";
                                ?>
                                <div class="mb-3">
                                    <label for="judul">Judul:</label>
                                    <textarea class="form-control" rows="3" placeholder="Masukkan Judul"
                                        name="judul"><?php echo $judul ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="tipe" class="form-label">Tipe:</label>
                                        <!-- <select class="form-select" id="select">
                                            <option value="">Tipe</option>
                                            <option value="TA">TA</option>
                                            <option value="Magang">Magang</option>
                                        </select> -->
                                        <select class="form-select" name="tipe">
                                            <option value="">Tipe</option>
                                            <?php
                                            $t = array ('TA', 'Magang');
                                            foreach ($t as $tp) {
                                                if ($tp == $tipe) $sel = "SELECTED";
                                                else $sel = "";
                                                echo "<option value='$tp' $sel>$tp</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="tahun" class="form-label">Tahun:</label>
                                        <select class="form-select" name="tahun">
                                            <option value="">Tahun</option>
                                            <?php
                                            $y = array ('2017', '2018', '2019', '2020', '2021', '2022', '2023');
                                            foreach ($y as $thn) {
                                                if ($thn == $tahun) $sel = "SELECTED";
                                                else $sel = "";
                                                echo "<option value='$thn' $sel>$thn</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="pembimbing_1" class="form-label">Pembimbing 1:</label>
                                        <select type="text" class="form-select" name="pembimbing_1">
                                            <option>Pilih</option>
                                            <?php 
                            
                                                        $q = mysqli_query($koneksi,"SELECT nip,nama FROM dosen ORDER BY nama ASC");
                                                        while($d = mysqli_fetch_row($q)) {
                                                            if ($d[0] == $pembimbing_1) $sel = "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$d[0]' $sel>$d[1]</option>";
                                                        }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col mb-3" id="hide_1">
                                        <label for="pembimbing_2" class="form-label">Pembimbing 2:</label>
                                        <select type="text" class="form-select" name="pembimbing_2">
                                            <option>Pilih</option>
                                            <?php 
                            
                                                        $q = mysqli_query($koneksi,"SELECT nip,nama FROM dosen ORDER BY nama ASC");
                                                        while($d=mysqli_fetch_row($q)){
                                                            if ($d[0] == $pembimbing_2) $sel = "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$d[0]' $sel>$d[1]</option>";
                                                        }

                                            ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col mb-3" id="hide_2">
                                        <label for="penguji_1" class="form-label">Penguji 1:</label>
                                        <select type="text" class="form-select" name="penguji_1">
                                            <option>Pilih</option>
                                            <?php 
                            
                                                        $q = mysqli_query($koneksi,"SELECT nip,nama FROM dosen ORDER BY nama ASC");
                                                        while($d=mysqli_fetch_row($q)){
                                                            if ($d[0] == $penguji_1) $sel = "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$d[0]' $sel>$d[1]</option>";
                                                        }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col mb-3" id="hide_3">
                                        <label for="penguji_2" class="form-label">Penguji 2:</label>
                                        <select type="text" class="form-select" name="penguji_2">
                                            <option>Pilih</option>
                                            <?php 
                            
                                                        $q = mysqli_query($koneksi,"SELECT nip,nama FROM dosen ORDER BY nama ASC");
                                                        while($d=mysqli_fetch_row($q)){
                                                            if ($d[0] == $penguji_2) $sel = "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$d[0]' $sel>$d[1]</option>";
                                                        }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col mb-3" id="hide_4">
                                        <label for="penguji_3" class="form-label">Penguji 3:</label>
                                        <select type="text" class="form-select" name="penguji_3">
                                            <option>Pilih</option>
                                            <?php 
                            
                                                        $q = mysqli_query($koneksi,"SELECT nip,nama FROM dosen ORDER BY nama ASC");
                                                        while($d=mysqli_fetch_row($q)){
                                                            if ($d[0] == $penguji_3) $sel = "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$d[0]' $sel>$d[1]</option>";
                                                        }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3" id="hide_5">
                                        <label for="ketua_penguji" class="form-label">Ketua Penguji:</label>
                                        <select type="text" class="form-select" name="ketua_penguji">
                                            <option>Pilih</option>
                                            <?php 
                            
                                                        $q = mysqli_query($koneksi,"SELECT nip,nama FROM dosen ORDER BY nama ASC");
                                                        while($d=mysqli_fetch_row($q)){
                                                            if ($d[0] == $ketua_penguji) $sel = "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$d[0]' $sel>$d[1]</option>";
                                                        }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col mb-3" id="hide_6">
                                        <label for="sekretaris" class="form-label">Sekretaris:</label>
                                        <select type="text" class="form-select" name="sekretaris">
                                            <option>Pilih</option>
                                            <?php 
                            
                                                        $q = mysqli_query($koneksi,"SELECT nip,nama FROM dosen ORDER BY nama ASC");
                                                        while($d=mysqli_fetch_row($q)){
                                                            if ($d[0] == $sekretaris) $sel = "SELECTED";
                                                            else $sel = "";
                                                            echo "<option value='$d[0]' $sel>$d[1]</option>";
                                                        }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <?php
                                        $nm = 0;
                                        if(isset($_GET['t'])) {
                                            $id_judul = $_GET['id'];
                                            $q = mysqli_query($koneksi, "SELECT nim FROM pustaka2 WHERE id_judul='$id_judul'");
                                            while ($d = mysqli_fetch_row($q)) {
                                                $nm++;
                                                $nim = $d[0];
                                                $nama_mhs = $digi->nim_to_nama($nim);

                                                if ($nm == 1) {
                                                    $id_mhs = "mhs";
                                                    $button_class = "button_plus";
                                                    $button_ket = "+";
                                                }
                                                else {
                                                    $id_mhs = "mhs_del";
                                                    $button_class = "button_minus";
                                                    $button_ket = "-";
                                                }
                                    ?>
                                <div class="row" id="<?php echo $id_mhs ?>">
                                    <div class="col mb-3">
                                        <label for="nama" class="form-label">Nama Mahasiswa:</label>
                                        <input type="text" class="form-control" value="<?php echo "$nim $nama_mhs"; ?>"
                                            placeholder="Masukkan Nama" name="mhs[]" />
                                    </div>
                                    <div class="col mb-3 my-auto">
                                        <!-- <button class="button_nim"><i id="myIcon" class="bi bi-plus-square-fill add_button"></i></button> -->
                                        <button type="button" name="tambahkan" id="tambahkan"
                                            class="btn add_button <?php echo $button_class ?>"><i
                                                class="bi bi-plus-square-fill text-primary"></i></button>
                                    </div>
                                </div>
                                <?php
                                    }
                                } else {
                                    ?>
                                <div class="row" id="mhs">
                                    <div class="col mb-3">
                                        <label for="nama" class="form-label">Nama Mahasiswa:</label>
                                        <input type="text" class="form-control" value="" placeholder="Masukkan Nama"
                                            name="mhs[]" />
                                    </div>
                                    <div class="col mb-3 my-auto">
                                        <!-- <button class="button_nim"><i id="myIcon" class="bi bi-plus-square-fill add_button"></i></button> -->
                                        <button type="button" name="tambahkan" id="tambahkan" class="btn add_button"><i
                                                class="bi bi-plus-square-fill text-primary"></i></button>
                                    </div>
                                </div>
                                <?php
                                }
                                    ?>
                                <div class="mb-3" id="input_file">
                                    <label for="formFile" class="form-label">Upload File Laporan:</label>
                                    <input class="form-control" type="file" id="formFile" name="laporan">
                                    <p><?php echo "<a href=\"./laporan/$nama_file\" target=_blank>$nama_file</a>";?></p>
                                </div>
                                <button type="submit" class="btn btn-primary mb-3" name="tombol"
                                    value="<?php echo $tombol_val ?>">Simpan</button>

                                <!-- <div class="row">
                                    <div class="col mb-3">
                                        <label for="kelas" class="form-label">Kelas:</label>
                                        <select class="form-select" name="kelas">
                                            <option value="">Kelas</option>
                                            <?php
                                            $k = array ('TK-3A', 'TK-3B', 'TE-4A', 'TE-4B');
                                            foreach ($k as $kls) {
                                                if ($kls == $kelas) $sel = "SELECTED";
                                                else $sel = "";
                                                echo "<option value='$kls' $sel>$kls</option>";
                                            }
                                            ?>
                                            <!-- <option>TE-4A</option>
                                        <option>TE-4B</option>
                                        <option>TE-4C</option>
                                        <option>TE-4D</option>
                                        <option>TK-3A</option>
                                        <option>TK-3B</option>
                                        <option>TK-3C</option>
                                        <option>TK-3D</option> -->
                                <!-- </select>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="jurusan" class="form-label">Jurusan:</label>
                                        <select class="form-select" name="jurusan">
                                            <option value="">Jurusan</option>
                                            <?php
                                            $j = array ('Teknik Elektro','Teknik Mesin','Teknik Sipil','Administrasi Bisnis','Akuntansi',);
                                            foreach ($j as $jrs) {
                                                if ($jrs == $jurusan) $sel = "SELECTED";
                                                else $sel = "";
                                                echo "<option value='$jrs' $sel>$jrs</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="prodi" class="form-label">Prodi:</label>
                                        <select class="form-select" name="prodi">
                                            <option value="">Prodi</option>
                                            <?php
                                            $p = array ('D4 - Teknik Telekomunikasi', 'D3 - Teknik Telekomunikasi');
                                            foreach ($p as $prd) {
                                                if ($prd == $prodi) $sel = "SELECTED";
                                                else $sel = "";
                                                echo "<option value='$prd' $sel>$prd</option>";
                                            }
                                            ?>
                                        </select>
                                    </div> -->

                                <!-- </div> -->
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Hanif A (15) & M Farhan (18)</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- <script src="script.js"></script> -->

    <script>
    $(document).ready(function() {

        // hide div when option selected
        $("select[name='tipe']").on("change", function() {

            tipe = $(this).find(":selected").val();
            console.log("ke select " + tipe);
            if (tipe == "Magang") {
                $("#hide_1, #hide_2, #hide_3, #hide_4, #hide_5, #hide_6, .add_button").fadeOut(500);
            } else {
                $("#hide_1, #hide_2, #hide_3, #hide_4, #hide_5, #hide_6, .add_button").fadeIn(500);
            }
        })

        $(".add_button").click(function() {
            mhs1 = '<div class="row" id="mhs_del">';
            mhs2 = '<div class="col-sm-6 mb-3">';
            mhs3 = '<label for="nama" class="form-label">Nama Mahasiswa:</label>';
            mhs4 = '<input type="text" class="form-control" placeholder="Masukkan nama" name="mhs[]">';
            mhs5 = '</div>';
            mhs6 = '<div class="col mb-3 my-auto remove_button">';
            mhs7 =
                '<button type="button" name="tambahkan" id="tambahkan"class="btn"><i class="bi bi-x-square-fill text-danger"></i></button>';
            mhs8 = '</div>';
            mhs9 = '</div>';
            mhs_add = mhs1 + mhs2 + mhs3 + mhs4 + mhs5 + mhs6 + mhs7 + mhs8 + mhs9;

            $("#input_file").before(mhs_add);

            $(".remove_button").click(function() {
                console.log("remove button");
                $("#mhs_del").remove();
            })

            // syntax mencari nama dengan ajax
            $("input[name='mhs[]']").keyup(function() {
                mhs_nama = $(this).val();
                console.log("nama:" + mhs_nama);

                $.ajax({
                        method: "POST",
                        url: "data-ajax.php",
                        data: {
                            p: "mhs",
                            nama: mhs_nama,
                        },
                        dataType: "json",
                    })

                    .done(function(data) {
                        panjang = data.length;
                        $("input[name='mhs[]']").autocomplete({
                            source: data
                        });
                        console.log("data" + panjang);
                    })
                    .fail(function(msg) {
                        console.log("error" + msg);
                    })
            })
        })

        $("select[name='pembimbing_1']").on('change', function() {
            pembimbing_1 = $(this).find(":selected").val();
            $("select[name='ketua_penguji']").val(pembimbing_1);
        })
        $("select[name='ketua_penguji']").on('change', function() {
            ketua_penguji = $(this).find(":selected").val();
            $("select[name='pembimbing_1']").val(ketua_penguji);
        })

        // syntax mencari nama dengan ajax
        $("input[name='mhs[]']").keyup(function() {
            mhs_nama = $(this).val();
            console.log("nama:" + mhs_nama);

            $.ajax({
                    method: "POST",
                    url: "data-ajax.php",
                    data: {
                        p: "mhs",
                        nama: mhs_nama,
                    },
                    dataType: "json",
                })

                .done(function(data) {
                    panjang = data.length;
                    $("input[name='mhs[]']").autocomplete({
                        source: data
                    });
                    console.log("data" + panjang);
                })
                .fail(function(msg) {
                    console.log("error" + msg);
                })
        })

        $('#form_pustaka').submit(function(e) {
            e.preventDefault(); // prevent default form submission

            // Get the form data
            var formData = new FormData(this);

            //Make an Ajax Request
            $.ajax({
                    url: 'data-ajax.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false
                })
                .done(function() {
                    console.log("oke");
                })
                .fail(function(msg) {
                    console.log("error: " + msg);
                });
        });
    });
    </script>

    <script src="./vendor/jquery-ui/jquery-ui.js">
    </script>
    <script src="./vendor/jquery-ui/jquery-ui.min.js"></script>
</body>

</html>