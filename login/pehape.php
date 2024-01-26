<?php

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