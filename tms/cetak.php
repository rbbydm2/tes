<?php
// Langkah 1: Koneksi ke Database
$servername = "localhost"; // Ganti dengan nama server Anda
$username = "root"; // Ganti dengan nama pengguna database Anda
$password = ""; // Ganti dengan kata sandi database Anda
$database = "pci"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
   die("Koneksi gagal: " . $conn->connect_error);
}

$riwayat_id = $_GET["riwayat_id"]; // Ambil ID riwayat dari URL


// Query untuk mengambil detail riwayat pengecekan berdasarkan ID
$sql_riwayat = "SELECT * FROM jawaban_pengecekan WHERE id = $riwayat_id";
$result_riwayat = $conn->query($sql_riwayat);

$sql = "SELECT foto FROM jawaban_pengecekan WHERE id = $riwayat_id"; // Sesuaikan dengan struktur tabel Anda
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
   $row = mysqli_fetch_assoc($result);
   $nama_file_foto = $row["foto"];
} else {
   echo "Data riwayat tidak ditemukan.";
}

if ($result_riwayat->num_rows > 0) {
   // Riwayat pengecekan ditemukan, ambil data detail
   $row_riwayat = $result_riwayat->fetch_assoc();
   $item_id = $row_riwayat["item_id"];
   $tanggal_pengecekan = $row_riwayat["tanggal_pengecekan"];
   $jawaban1 = $row_riwayat["jawaban_1"];
   $jawaban2 = $row_riwayat["jawaban_2"];
   $jawaban3 = $row_riwayat["jawaban_3"];
   $jawaban4 = $row_riwayat["jawaban_4"];
   $jawaban5 = $row_riwayat["jawaban_5"];
   $jawaban6 = $row_riwayat["jawaban_6"];
   $jawaban7 = $row_riwayat["jawaban_7"];
   $jawaban8 = $row_riwayat["jawaban_8"];
   $jawaban9 = $row_riwayat["jawaban_9"];
   $jawaban10 = $row_riwayat["jawaban_10"];
   $jawaban11 = $row_riwayat["jawaban_11"];
   $jawaban12 = $row_riwayat["jawaban_12"];
   $jawaban13 = $row_riwayat["jawaban_13"];
   $jawaban14 = $row_riwayat["jawaban_14"];
   $jawaban15 = $row_riwayat["jawaban_15"];
   // tambahkan kolom pertanyaan lain yang diperlukan
   $performed = $row_riwayat["check_performed"];
   $verified = $row_riwayat["check_verified"];
   $status = $row_riwayat["status"];
   $item_id = $row_riwayat["item_id"];
}

// Query untuk mengambil detail item berdasarkan ID item
$sql_item = "SELECT * FROM tms WHERE id = $item_id";
$result_item = $conn->query($sql_item);

if ($result_item->num_rows > 0) {
   // Item ditemukan, ambil data detail
   $row_item = $result_item->fetch_assoc();
   $customer = $row_item["customer"];
   $model = $row_item["model"];
   $serial_number = $row_item["sn"];
   $item_classification = $row_item["itemclassi"];
   $item_description = $row_item["itemdesc"];
   $date_commissioned = $row_item["dcommiss"];
   $durasi = $row_item["durasi"];
   // tambahkan kolom lain yang diperlukan
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>CHECKING RECORD
   </title>

   <style>
      /* Tambahkan CSS sesuai dengan desain Anda */
      body {
         background-color: #fff;
         margin: 0;
         font-family: 'Arial', sans-serif;
         padding: 10px;
      }

      table {
         width: 100%;
         border-collapse: collapse;
         margin: 0;
         border-bottom: #fff;
      }

      table .tabel-foto {
         width: 100%;
         border-collapse: collapse;
         margin: 0;
         border-bottom: none;
      }

      th {

         font-size: 11px;
         font-weight: 700;
         color: #000;
         border: 1px solid #000;
         padding: 5px;
         text-align: center;
      }

      td {

         font-size: 10px;
         font-weight: 400;
         border: 1px solid #000;
         background-color: #fff;
         padding: 5px;
         text-align: left;
         table-layout: fixed;
      }

      thead {
         background-color: #fff;
      }

      h4 {
         text-align: center;

         font-weight: 600;
         color: #000;
         margin-top: 0;
         margin-bottom: 0;
      }

      img {
         display: flex;
         margin-left: 0;
         margin-right: auto;
         width: 8%;

      }

      .logo img {
         display: flex;
         margin-left: 0;
         margin-right: auto;
         width: 13%;

      }

      h5 {

         text-align: center;
         font-weight: 700;
         color: #000;
      }

      .center-checkbox {
         justify-content: center;
         text-align: center;
      }

      button {
         align-items: center;
         background-color: #fff;
         width: 100px;
      }

      .header {
         margin-top: 5px;
         margin-bottom: 0;
         border-bottom: none;
      }

      .header th {
         background-color: #fff;
         text-align: left;
      }

      .header td {
         color: #000;
         text-align: left;
      }

      .nomor {
         text-align: center;
      }

      .nama {
         font-weight: 600;
      }

      .jawaban {
         text-align: center;
      }

      p {
         font-size: 11px;

         text-align: left;
         font-weight: 500;
         color: #000;
         margin: 4px auto;
      }

      .judul {
         font-size: 10px;

         font-weight: 600;
         border: none;
      }

      .border {
         border: none;
      }

      .print {
         margin: 10px auto;
         width: 10%;
         padding: 5px;
      }






      @media print {

         .cetak,
         .print {
            display: none;
         }

      }
   </style>


</head>

<body>
   <div class="logo">
      <img src="img/PCI.png" alt="">
   </div>
   <input class="print" type="button" value="EXPORT PDF" onclick="cetakDetailRiwayat()">
   <input class="print" type="button" value="BACK" onclick="kembali()">

   <h4>[JIG] / [FIXTURE] CHECKING RECORD</h4>

   <table class="header">
      <tr>
         <th>Customer</th>
         <th>Model</th>
         <th>Item S/N</th>
         <th>Item Classification</th>
         <th>Item Description</th>
         <th>Date Commissioned</th>
         <th>Status Item</th>
      </tr>
      <tr>

         <td><?php echo $customer; ?></td>
         <td><?php echo $model; ?></td>
         <td><?php echo $serial_number; ?></td>
         <td><?php echo $item_classification; ?></td>
         <td><?php echo $item_description; ?></td>
         <td><?php echo $date_commissioned; ?></td>
         <td><?php echo $status; ?></td>
      </tr>
   </table>
   <table border="1" class="tabel-item">
      <thead>

         <tr>
            <th class="nomor">NO.</th>
            <th>CHECK ITEMS</th>
            <th><?php echo $tanggal_pengecekan; ?></th>

         </tr>
         <tr class="border">
            <td class="tabel-judul"></td>
            <th class="judul">FUNCTIONALITY</th>
            <td></td>


         </tr>
      </thead>
      <tr>
         <td class="nomor">1</td>
         <td>Check kelengkapan spring, pusher, look pada jig</td>
         <td class="jawaban"><?php echo $jawaban1; ?></td>

      </tr>
      <tr>
         <td class="nomor">2</td>
         <td>Check apakah jig sewaktu menekan komponent tidak menyebabkan kerusakan seperti damage, crack, gap, dan
            aligment pada komponent</td>
         <td class="jawaban"><?php echo $jawaban2; ?></td>

      </tr>
      <tr>
         <td class="nomor">3</td>
         <td>Check apakah bagian yang terbuka pada base jig hanya untuk lokasi yang di touch up</td>
         <td class="jawaban"><?php echo $jawaban3; ?></td>

      </tr>
      <tr>
         <td class="nomor">4</td>
         <td>Check apakah jig bisa untuk digunakan secara berulang-ulang</td>
         <td class="jawaban"><?php echo $jawaban4; ?></td>

      </tr>
      <tr>
         <td class="nomor">5</td>
         <td>Check apakah jig tersebut mudah untuk digunakan</td>
         <td class="jawaban"><?php echo $jawaban5; ?></td>

      </tr>
      <tr>
         <td class="nomor">6</td>
         <td>Check kebersihan jig, bersih dari fluxs, Solder Splash</td>
         <td class="jawaban"><?php echo $jawaban6; ?></td>

      </tr>
      <tr>
         <td class="nomor">7</td>
         <td>Apakah jig tersebut membutuhkan improvement dan modification untuk kedepannya</td>
         <td class="jawaban"><?php echo $jawaban7; ?></td>

      </tr>
      <tr>
         <td></td>
         <th class="judul">SAFETY</th>
         <td></td>


      </tr>
      <tr>
         <td class="nomor">1</td>
         <td>Apakah item terdapat kaki untuk memastikan kedudukannya bagus waktu ditempat kerja?</td>
         <td class="jawaban"><?php echo $jawaban8; ?></td>

      </tr>
      <tr>
         <td class="nomor">2</td>
         <td>Apakah ada tabung penyuplai udara jika ada,telah diatur untuk mencegah terhalangnya operator selama
            memakai?</td>
         <td class="jawaban"><?php echo $jawaban9; ?></td>

      </tr>
      <tr>
         <td class="nomor">3</td>
         <td>Untuk mekanik electro yang aktif dari item jika ada, apakah ada ketentuan untuk menghentikan jika keadaan
            darurat ketika operator ingin untuk menghentikan pengoperasian setiap saat.</td>
         <td class="jawaban"><?php echo $jawaban10; ?></td>

      </tr>
      <tr>
         <td class="nomor">4</td>
         <td>Apakah ada pengontrol mekanik elektro pada item, ada keistimewaan seperti mengunakan kedua tangan untuk
            mengaktifkan untuk mencegah kecelakaan?</td>
         <td class="jawaban"><?php echo $jawaban11; ?></td>

      </tr>
      <tr>
         <td class="nomor">5</td>
         <td>Jika tajam, panas atau penggerakan bagian item,sudahkah terlindungi dengan penutup atau pelindung untuk
            mencegah operator terhindar dari kecelakaan.</td>
         <td class="jawaban"><?php echo $jawaban12; ?></td>

      </tr>
      <tr>
         <td class="nomor">6</td>
         <td>Apakah ada label atau peringatan pada item seperti power line, tekanan maksimal yang dibolehkan atau yang
            lain yang bisa dipakai untuk kesalahan penggunaan.</td>
         <td class="jawaban"><?php echo $jawaban13; ?></td>

      </tr>
      <tr>
         <td class="nomor">7</td>
         <td>Apakah ada bagian yang bisa dipindah atau digerakan, adakah pelatihan cara memegang tombol atau yang lain
            untuk memudahkan operator untuk memegang dengan benar dan mencegah pengunaan yang salah.</td>
         <td class="jawaban"><?php echo $jawaban14; ?></td>

      </tr>
      <tr>
         <td class="nomor">8</td>
         <td>Untuk item yang berat, adakah pemegang atau penyokong untuk memudahkan dalam mengangkat, memasang dan
            memindahkan.</td>
         <td class="jawaban"><?php echo $jawaban15; ?></td>

      </tr>
   </table>



   <div class="tabel-foto">
      <table border="1">
         <tr>
            <td>
               <p>DETAILS OF JIG, FIXTURE IMPROVEMENT OR MODIFICATION DONE</p>
               <?php
               // Langkah 3: Tampilkan Foto
               if (isset($nama_file_foto)) {
                  echo '<img src="uploads/' . $nama_file_foto . '" alt="Foto Pengecekan" align="center">';
               } else {
                  echo 'Foto tidak tersedia.';
               }

               // Langkah 4: Tampilkan data riwayat lainnya
               // ...
               ?>
            </td>
         </tr>
      </table>

   </div>
   <table border="1">
      <tr>
         <td class="nama">Check Performed by: <?php echo $performed; ?></td>
      </tr>
      <tr>
         <td class="nama">Check Verified by: <?php echo $verified; ?></td>
      </tr>
   </table>

   <script>
      function cetakDetailRiwayat() {
         window.print(); // Fungsi ini akan memicu pencetakan halaman saat tombol "Cetak" ditekan
      }
   </script>
   <script>
      function kembali() {
         window.open("detail.php?riwayat_id=<?php echo $riwayat_id; ?>",
            "_blank"); // Membuka halaman "cetak.php" dalam jendela baru
      }
   </script>
</body>

</html>