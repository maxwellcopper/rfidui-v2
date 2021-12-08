<?php 
   
   require "koneksidb.php";

   $ambilrfid	 = $_GET["rfid"];
   $tol        = $_GET["tol"];
   date_default_timezone_set('Asia/Jakarta');
   $tgl=date("Y-m-d G:i:s");

   	  	// $data = query("SELECT * FROM tabel_monitoring")[0];

		//UPDATE DATA REALTIME PADA TABEL tb_monitoring
		$sql      = "UPDATE tb_monitoring SET tanggal	= '$tgl', rfid	= '$ambilrfid'";
		$koneksi->query($sql);
			
      
    //bisa juga make ini 
    /*
     $sqlsaldo = query("SELECT * FROM `tb_daftarrfid` WHERE rfid = '$ambilrfid'")[0];
     $saldoawal = $sqlsaldo['saldo'];
     
     $sqlharga = query("SELECT * FROM 'tb_tol' WHERE tol = '$tol'");
     $harga = $sqlharga['harga'];
    */
      
		//INSERT DATA REALTIME PADA TABEL tb_save  	
	  $sqlstring = "SELECT * FROM `tb_tol` WHERE tol LIKE '".$tol."'";
    $rows = query($sqlstring);
    $row = $rows[0];
    $harga = $row['harga'];
   // var_dump(json_encode($rows)); //untuk ngeprint respond ny 

    //yg dibutuhin tb simpan rfid, saldoawal, harga, saldoakhir, tol
    $sqlstring = "SELECT * FROM `tb_daftarrfid` WHERE rfid = '$ambilrfid'";
    $rows = query($sqlstring);
    $saldoawal = 0;
    $saldoakhir = 0;
    $response = [];
    
    if(count($rows) > 0) {
       $row = $rows[0];
       $saldoawal = $row['saldo'];
      $saldoakhir = $saldoawal - $harga;
      
      
      $sql      = "UPDATE `tb_daftarrfid` SET `saldo`='$saldoakhir' WHERE rfid = '$ambilrfid'";
  		$koneksi->query($sql);
  		$response = query("SELECT * FROM tb_daftarrfid,tb_monitoring WHERE tb_daftarrfid.rfid='$ambilrfid'" );
    }
      
      
      
  		$sqlsave = "INSERT INTO `tb_simpan`(`tanggal`, `rfid`, `saldoawal`, `harga`, `saldoakhir`, `tol`) VALUES ('$tgl','$ambilrfid','$saldoawal','$harga','        $saldoakhir','$tol')";
     var_dump($sqlsave);
  		$koneksi->query($sqlsave);
    
  //    $sqlcek = "SELECT COUNT(1) FROM tb_daftarrfid WHERE rfid = '$ambilrfid'";
  //     echo $sqlcek;
     
  		//MENJADIKAN JSON DATA
  		//$response = query("SELECT * FROM tb_monitoring")[0];
      $response ['saldoawal'] = $saldoawal;
      $response['tol'] = $tol;
      $response['harga'] = $harga;
//      $response['nama'] = $nama;
//      $response['telepon'] = $telepon;
      
      $result = json_encode($response);
       	echo $result;
    

 ?>