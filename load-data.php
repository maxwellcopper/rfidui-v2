<?php 
   require "koneksidb.php";	
  
    $data = query("SELECT * FROM tb_monitoring")[0];

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>	</title>
 </head>
 <body>

   <div class="row">
                           
		<div class="col-xl-6 col-lg-3 col-md-6 col-sm-12 col-12">
			<div class="card border-3 border-top border-top-primary">
				<div class="card-body">
					<h5 class="text-muted">TIME</h5>
					<div class="metric-value d-inline-block">
						<h1 class="mb-1"><?=$data["tanggal"];?></h1>
					</div>
					<div class="metric-label d-inline-block float-right text-success font-weight-bold">
						<span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">update</span>
					</div>
				</div>
			</div>
		</div>
                            
		<div class="col-xl-6 col-lg-3 col-md-6 col-sm-12 col-12">
			<div class="card border-3 border-top border-top-primary">
				<div class="card-body">
					<h5 class="text-muted">RFID</h5>
					<div class="metric-value d-inline-block">
						<h1 class="mb-1"><?=$data["rfid"];?></h1>
					</div>
					<div class="metric-label d-inline-block float-right text-success font-weight-bold">
						<span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">update</span>
					</div>
				</div>
			</div>
		</div>
                         
    </div>
    
    <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">Real Time Data</h2>
                            
                        </div>
                    </div>
                </div>
             
                <div class="row">
                    
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Data Tables - Print, Excel, CSV, PDF Buttons</h5>
                          
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Rfid</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>No Telepon</th>
                                                <th>Saldo Awal</th>
                                                <th>Harga</th>
                                                <th>Saldo Akhir</th>
                                                <th>Nama Tol</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                                $datatampil = mysqli_query($koneksi, "SELECT * FROM `tb_daftarrfid` as a join tb_simpan as b on a.rfid = b.rfid ORDER BY no DESC limit 4");
                                                $no=1;
                                                if (is_array($datatampil) || is_object($datatampil)){
                                                    foreach ($datatampil as $row){
                                                        echo "<tr class= bg-white >
                                                                <td>$no</td>
                                                                <td>".$row['tanggal']."</td>
                                                                <td>".$row['rfid']."</td>
                                                                <td>".$row['nama']."</td>
                                                                <td>".$row['alamat']."</td>
                                                                <td>".$row['telepon']."</td>
                                                                <td>".$row['saldoawal']."</td>
                                                                <td>".$row['harga']."</td>
                                                                <td>".$row['saldoakhir']."</td>
                                                                <td>".$row['tol']."</td>
                                                                
                                                            </tr>";
                                                        $no++;
                                                    }
                                                }

                                                $koneksi->close();
                                            ?>
                                        </tbody>
                                    </table>
	

 </body>
 </html>