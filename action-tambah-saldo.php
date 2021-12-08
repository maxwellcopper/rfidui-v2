<?php

    require "koneksidb.php";

    if ($_POST['Submit'] == "Submit") {
        $ambilrfid  = $_POST['rfid'];
        $saldo      = $_POST['saldo'];
        
         
      $sqlstring = "SELECT * FROM `tb_daftarrfid` WHERE rfid = '$ambilrfid'";
      $rows = query($sqlstring);
      $row = $rows[0];
      $saldoawal = $row['saldo'];
      
      $saldoakhir = $saldoawal + $saldo;  
        
        //Masukan data ke Table
        //$sql = "UPDATE `tb_daftarrfid` SET `saldo` = '$saldoakhir' WHERE rfid = '$ambilrfid'";
        //$koneksi->query($sql);
        
        $sql = "UPDATE `tb_daftarrfid` SET `saldo`='$saldoakhir' WHERE rfid = '$ambilrfid'";
		    $koneksi->query($sql);

        header("Location: tambahsaldo.php?pesan=berhasil");
    }

?>