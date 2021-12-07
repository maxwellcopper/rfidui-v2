<?php

    require "koneksidb.php";

    if ($_POST['Submit'] == "Submit") {
        $username            = $_POST['username'];
        $password            = $_POST['password'];
    
        //Masukan data ke Table
        $input = "INSERT INTO tb_user (username,password) VALUES ('" . $username . "', '" . $password . "')";
        $koneksi->query($input);

        header("Location: register.php?pesan=berhasil");
    }

?>