<?php

class digilib {
    public function koneksi() {
        //variable
        $host="localhost";
        $user="telkom";
        $pass="*T3lk0m#2023";
        $db="digilib_tk";

        //koneksi
        $koneksi = mysqli_connect($host,$user,$pass,$db);
        if (!$koneksi) return mysqli_connect_error();
        else return $koneksi;
    }

    public function nim_to_nama($nim) {
        $q = mysqli_query($this->koneksi(), "SELECT nama FROM mhs WHERE nim='$nim'");
        $d = mysqli_fetch_row($q);
        return $d[0];
    }

    public function nip_to_nama($nip) {
        $q = mysqli_query($this->koneksi(), "SELECT nama FROM dosen WHERE nip='$nip'");
        $d = mysqli_fetch_row($q);
        if (!empty($d[0])) {
            $nama = strtoupper($d[0]); 
            // $nama = strtolower($d[0]); 
            // $nama_lengkap = ucwords($nama);
            // return $nama_lengkap;
            return $nama;
        }
    }
}

?>