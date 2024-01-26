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
        $id = $_POST['id'];
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
        if (mysqli_affected_rows($koneksi) > 0) echo "<script>alert('Data berhasil masuk!');
        document.location.href = 'pustb.php';</script>";
        
        else echo "<script>alert('Data gagal masuk!')</script>";
    
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
        $q = mysqli_query($koneksi, "SELECT judul,tipe,tahun,pembimbing_1,pembimbing_2,ketua_penguji,penguji_1,penguji_2,penguji_3,sekretaris,nama_file FROM pustaka1 WHILE id='$id'");
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

        if (mysqli_affected_rows($koneksi) > 0) {
            echo "<script>alert('Data berhasil diubah!');
            document.location.href = 'pustb.php';</script>";
        }
        else {
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
            $tombol_val = "simpan";
            echo "<script>alert('Data gagal diubah!')</script>";
        }
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <title>Digilib - Tabel Pustaka</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                </div>

                <!-- Modal footer -->
                <div class="modal-footer">


                </div>

            </div>
        </div>
    </div>

    <!-- jquery -->
    <script>
    $(document).ready(function() {
        $("a:nth-child(2)").click(function() {
            console.log("diklik lho...");
            id_judul = $(this).attr("href");
            judul = $(this).attr("data-judul");
            $(".modal-title").text("Konfirmasi Hapus");
            $(".modal-body").text("Apakah Anda yakin ingin menghapus " + judul + " ?");
            form1 = "<form method=post>";
            form2 = "<input type=hidden name=id_judul value=" + id_judul + ">";
            form3 =
                "<button type=submit class=\"btn btn-danger me-2\" name=tombol value=hapus>Ya</button>";
            form4 =
                "<button type=button class=\"btn btn-secondary\" data-bs-dismiss=modal>Tidak</button>";
            form5 = "</form>";
            form = form1 + form2 + form3 + form4 + form5;

            $(".modal-footer").empty().append(form);
        })
    })
    </script>

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
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Forms</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Form:</h6>
                        <a class="collapse-item" href="mhsform.php">Mahasiswa</a>
                        <a class="collapse-item" href="dosform.php">Dosen</a>
                        <a class="collapse-item" href="pusform.php">Pustaka</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Tables</span>
                </a>
                <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Table:</h6>
                        <a class="collapse-item" href="mhstb.php">Mahasiswa</a>
                        <a class="collapse-item" href="dostb.php">Dosen</a>
                        <a class="collapse-item active" href="pustb.php">Pustaka</a>
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
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tabel Pustaka</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pustaka</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Judul</th>
                                            <th scope="col">Tipe</th>
                                            <th scope="col">Tahun</th>
                                            <th scope="col">Mahasiswa</th>
                                            <th scope="col">Pembimbing</th>
                                            <!-- <th scope="col">Pembimbing 2</th> -->
                                            <th scope="col">Ketua Penguji</th>
                                            <th scope="col">Penguji</th>
                                            <!-- <th scope="col">Penguji 2</th>
                                            <th scope="col">Penguji 3</th> -->
                                            <th scope="col">Sekretaris</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $q=mysqli_query($koneksi, "SELECT * FROM pustaka1 ORDER BY tipe ASC, tahun ASC");
                                            while($d=mysqli_fetch_row($q)) {
                                            $id=$d[0];
                                            $judul=$d[1];
                                            $tipe=$d[2];
                                            $tahun=$d[3];
                                            $pembimbing_1=$digi->nip_to_nama($d[4]);
                                            $pembimbing_2=$digi->nip_to_nama($d[5]);
                                            $ketua_penguji=$digi->nip_to_nama($d[6]);
                                            $penguji_1=$digi->nip_to_nama($d[7]);;
                                            $penguji_2=$digi->nip_to_nama($d[8]);;
                                            $penguji_3=$digi->nip_to_nama($d[9]);;;
                                            $sekretaris=$digi->nip_to_nama($d[10]);;
                                            $nama_file=$d[11];
                                            
                                            echo "<tr>
                                            <td>$id</td>
                                            <td>$judul</td>
                                            <td>$tipe</td>
                                            <td>$tahun</td>
                                            <td>";

                                            //data mahasiswa
                                            $n = 0;
                                            $q2 = mysqli_query($koneksi, "SELECT nim FROM pustaka2 WHERE id_judul='$id'");
                                            while ($d2 = mysqli_fetch_row($q2)) {
                                                $n++;
                                                echo "$n. " . $digi->nim_to_nama($d2[0]); echo"<br>";
                                            }

                                            echo "</td>
                                            <td>1. $pembimbing_1<BR>2. $pembimbing_2</td>
                                            <td>$ketua_penguji</td>
                                            <td>1. $penguji_1<BR>2. $penguji_2<BR>3. $penguji_3</td>
                                            <td>$sekretaris</td>
                                            <td>
                                            <a href='./laporan/$nama_file' target=_blank><i class=\"bi bi-file-pdf\"></i></a>
                                            </td>
                                            <td>
                                            <a href='pusform.php?t=edit&id=$id'<i class=\"bi bi-file-earmark-text text-primary\"></i></a>
                                            <a href='$id' data-judul='$judul' data-bs-toggle=modal data-bs-target=#myModal><i class=\"bi bi-trash-fill text-primary\"></i></a>
                                            </td>
                                            </tr>";
                                            }
                                        
                                            ?>
                                        <!-- <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            </tr> -->
                                    </tbody>
                                </table>
                                <a href="pusform.php"><button type="button"
                                        class="btn btn-primary mb-3 mt-1 d-flex ms-auto">Tambah
                                        Data</button></a>
                            </div>
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

</body>

</html>