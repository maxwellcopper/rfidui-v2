<?php 
   
   require "koneksidb.php";

   $ambilrfid	 = $_GET["rfid"];
   $tol        = $_GET["tol"];
   $tgl=date("Y-m-d h:i:s");

   	  	// $data = query("SELECT * FROM tabel_monitoring")[0];

		//UPDATE DATA REALTIME PADA TABEL tb_monitoring
		$sql      = "UPDATE tb_monitoring SET tanggal	= '$tgl', rfid	= '$ambilrfid'";
		$koneksi->query($sql);
			
		//INSERT DATA REALTIME PADA TABEL tb_save  	
	  $sqlstring = "SELECT * FROM `tb_tol` WHERE tol LIKE '".$tol."'";
    $rows = query($sqlstring);
    $row = $rows[0];
    $harga = $row['harga'];
   // var_dump(json_encode($rows)); //untuk ngeprint respond ny 

    //yg dibutuhin tb simpan rfid, saldoawal, harga, saldoakhir, tol
    $sqlstring = "SELECT * FROM `tb_daftarrfid` WHERE rfid = '$ambilrfid'";
    $rows = query($sqlstring);
    $row = $rows[0];
    $saldoawal = $row['saldo'];
    $saldoakhir = $saldoawal - $harga;
    $sql      = "UPDATE `tb_daftarrfid` SET `saldo`='$saldoakhir' WHERE rfid = '$ambilrfid'";
		$koneksi->query($sql);
    
		$sqlsave = "INSERT INTO `tb_simpan`(`tanggal`, `rfid`, `saldoawal`, `harga`, `saldoakhir`, `tol`) VALUES ('$tgl','$ambilrfid','$saldoawal','$harga','$saldoakhir','$tol')";
		$koneksi->query($sqlsave);
//
		//MENJADIKAN JSON DATA
		//$response = query("SELECT * FROM tb_monitoring")[0];
		$response = query("SELECT * FROM tb_daftarrfid,tb_monitoring WHERE tb_daftarrfid.rfid='$ambilrfid'" )[0];
    $response['tol'] = $tol;
    $response['harga'] = $harga;
    $result = json_encode($response);
     	echo $result;
    



 ?>