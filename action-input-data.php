<?php

    require "koneksidb.php";

    if ($_POST['Submit'] == "Submit") {
        $rfid            = $_POST['rfid'];
        $nama            = $_POST['nama'];
        $alamat          = $_POST['alamat'];
        $telepon         = $_POST['telepon'];
        $saldo      = $_POST['saldo'];
        
        //Masukan data ke Table
        $input = "INSERT INTO tb_daftarrfid (rfid, nama, alamat, telepon, saldo) VALUES ('" . $rfid . "', '" . $nama . "', '" . $alamat . "', '" . $telepon . "', '        " . $saldo . "')";
        $koneksi->query($input);

        header("Location: inputdata.php?pesan=berhasil");
    }

?>