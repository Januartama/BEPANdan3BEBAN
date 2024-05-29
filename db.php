<?php
$conn = mysqli_connect("localhost","root","","db_warungonline");

//check koneksi
if (mysqli_connect_errno()){
    echo "Koneksi database : " . mysqli_connect_error();
    }

?>