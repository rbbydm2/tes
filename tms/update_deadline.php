<?php
// Koneksi ke database (gantilah dengan informasi koneksi Anda)
$servername = "localhost";
$username = "root";
$password = "";
$database = "pci";

$conn = mysqli_connect($servername, $username, $password, $database);

// Periksa koneksi
if (!$conn) {
   die("Koneksi gagal: " . mysqli_connect_error());
}

// Fungsi untuk menghitung status deadline
function calculateDeadline($lastCheckDate, $durasi, $nextCheckDate)
{
   // Ubah tanggal ke dalam objek DateTime
   $lastCheck = new DateTime($lastCheckDate);
   $nextCheck = new DateTime($nextCheckDate);

   // Hitung selisih hari antara last check dan next check
   $selisihHari = $lastCheck->diff($nextCheck)->days;

   // Tentukan status berdasarkan selisih hari
   if ($selisihHari < 0) {
      return "Expired";
   } elseif ($selisihHari <= 7) {
      return "Going to Expire";
   } else {
      return "Verified";
   }
}

// Ambil data item dari database (gantilah dengan query sesuai struktur tabel Anda)
$sql = "SELECT * FROM tms";
$result = mysqli_query($conn, $sql);

// Perbarui status "deadline" untuk setiap item
while ($row = mysqli_fetch_assoc($result)) {
   $statusDeadline = calculateDeadline($row['lc'], $row['durasi'], $row['nc']);

   // Perbarui status "deadline" dalam database
   $updateSql = "UPDATE tms SET status = '$statusDeadline' WHERE id = {$row['id']}";
   mysqli_query($conn, $updateSql);
}

// Tutup koneksi ke database
mysqli_close($conn);
