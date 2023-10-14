<?php
// Kode koneksi ke database (ganti dengan informasi koneksi yang sesuai)
$servername = "localhost";
$username = "root";
$password = "";
$database = "pci";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);

// Memeriksa koneksi
if (!$conn) {
   die("Koneksi gagal: " . mysqli_connect_error());
}

if (isset($_POST['additem'])) {
   $initial = $_POST['id_customer'];
   $customer = $_POST['customer'];
   $model = $_POST['model'];
   $itemsn = $_POST['sn'];
   $itemclassi = $_POST['itemclassi'];
   $type = $_POST['type'];
   $itemdesc = $_POST['itemdesc'];
   $dcommiss = $_POST['dcommiss'];
   $lc = $_POST['lc'];
   $duration = $_POST['durasi'];

   $addtotable = mysqli_query($conn, "insert into tms (id_customer, customer, model, sn, itemclassi, type, itemdesc, dcommiss, lc, durasi, nc) values('$initial', '$customer', '$model', '$itemsn', '$itemclassi', '$type', '$itemdesc', '$dcommiss', '$lc', '$duration')");
   if ($addtotable) {
      header('location:tms/tabel.php');
   } else {
      echo 'Gagal!';
      header('location:tabel.php');
   }
}
