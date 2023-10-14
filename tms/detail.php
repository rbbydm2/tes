<?php
include 'db/config.php';

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

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Box Icons -->
   <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
   <!-- Style Css -->
   <link rel="stylesheet" href="css/style.css" />
   <!-- Chart Js -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <!-- Shortcut Icon -->
   <link rel="shortcut icon" href="img/PCI.png">
   <title>Document</title>
</head>

<body>
   <!-- Sidebar -->

   <div class="sidebar close">
      <a href="index.php" class="logo">
         <i class="bx bx-badge-check"></i>
         <div class="logo-name"><span>PCI</span></div>
      </a>
      <ul class="side-menu">
         <li class="active">
            <a href="riwayat.php?item_id=<?php echo $item_id; ?>"><i class="bx bx-arrow-back"></i>Back</a>
         </li>
      </ul>
   </div>

   <!-- End Sidebar -->
   <div class="content">
      <!-- Navbar -->
      <nav>
         <i class="bx bx-menu"></i>
         <form action="#">
            <div class="form-input">
               <input type="search" placeholder="Search..." />
               <button class="search-btn" type="submit">
                  <i class="bx bx-search"></i>
               </button>
            </div>
         </form>
         <input type="checkbox" id="theme-toggle" hidden />
         <label for="theme-toggle" class="theme-toggle"></label>
         <a href="#" class="notif">
            <i class="bx bx-bell"></i>
            <span class="count">12</span>
         </a>
         <a href="#" class="profile">
            <img src="img/PCI.png" alt="" />
         </a>
      </nav>
      <main>
         <div class="header">
            <div class="left">
               <h1>Table</h1>
               <ul class="breadcrumb">
                  <li><a href="tabel.html">Tooling Management System</a></li>

                  <li><a href="#" class="active">PCI</a></li>
               </ul>
            </div>
            <a onclick="cetakDetailRiwayat()" class="report">
               <i class="bx bx-cloud-download"></i>
               <span>Download PDF</span>
            </a>
            <script>
               function cetakDetailRiwayat() {
                  window.open("cetak.php?riwayat_id=<?php echo $riwayat_id; ?>",
                     "_blank"); // Membuka halaman "cetak.php" dalam jendela baru
               }
            </script>
         </div>
         <!-- Table -->
         <div class="bottom-data">
            <div class="orders">
               <div class="header">
                  <i class="bx bx-list-ul"></i>
                  <h3>Detail History</h3>
               </div>
               <table>
                  <thead>
                     <tr>
                        <th>Customer</th>
                        <th>Model</th>
                        <th>Item S/N</th>
                        <th>Item Classification</th>
                        <th>Item Description</th>
                        <th>Date Commissioned</th>
                        <th>Duration</th>
                        <th>Status Item</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
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
                        $type = $row_item["type"];
                        $item_description = $row_item["itemdesc"];
                        $date_commissioned = $row_item["dcommiss"];
                        $durasi = $row_item["durasi"];
                        // tambahkan kolom lain yang diperlukan
                     }
                     ?>
                     <tr>
                        <td><?php echo $customer; ?></td>
                        <td><?php echo $model; ?></td>
                        <td><?php echo $serial_number; ?></td>
                        <td><?php echo $item_classification; ?></td>
                        <td><?php echo $item_description; ?></td>
                        <td><?php echo $date_commissioned; ?></td>
                        <td><?php echo $durasi; ?></td>
                        <td><?php echo $status; ?></td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>

         <div class="bottom-data">
            <div class="orders">
               <div class="header">
                  <h3>Checking Record</h3>
               </div>
               <table>
                  <thead>
                     <tr>
                        <th>NO.</th>
                        <th>CHECK ITEMS</th>
                        <th><?php echo $tanggal_pengecekan; ?></th>
                     </tr>
                  </thead>
                  <tr>
                     <td class="no">
                        <h3>Functionality</h3>
                     </td>
                  </tr>
                  <tr>
                     <td class="num">1</td>
                     <td class="pertanyaan">Check kelengkapan spring, pusher, look pada jig</td>
                     <td><?php echo $jawaban1; ?></td>
                  </tr>
                  <tr>
                     <td>2</td>
                     <td class="pertanyaan">Check apakah jig sewaktu menekan komponent tidak menyebabkan kerusakan
                        seperti damage, crack,
                        gap,
                        dan
                        aligment pada komponent</td>
                     <td><?php echo $jawaban2; ?></td>
                  </tr>
                  <tr>
                     <td>3</td>
                     <td class="pertanyaan">Check apakah bagian yang terbuka pada base jig hanya untuk lokasi yang di
                        touch up</td>
                     <td><?php echo $jawaban3; ?></td>
                  </tr>
                  <tr>
                     <td>4</td>
                     <td class="pertanyaan">Check apakah jig bisa untuk digunakan secara berulang-ulang</td>
                     <td><?php echo $jawaban4; ?></td>
                  </tr>
                  <tr>
                     <td>5</td>
                     <td class="pertanyaan">Check apakah jig tersebut mudah untuk digunakan</td>
                     <td><?php echo $jawaban5; ?></td>
                  </tr>
                  <tr>
                     <td>6</td>
                     <td class="pertanyaan">Check kebersihan jig, bersih dari fluxs, Solder Splash</td>
                     <td><?php echo $jawaban6; ?></td>
                  </tr>
                  <tr>
                     <td>7</td>
                     <td class="pertanyaan">Apakah jig tersebut membutuhkan improvement dan modification untuk
                        kedepannya</td>
                     <td><?php echo $jawaban7; ?></td>
                  </tr>
                  <tr>
                     <td class="no">
                        <h3>Safety</h3>
                     </td>
                  </tr>
                  <tr>
                     <td class="no">1</td>
                     <td class="pertanyaan">Apakah item terdapat kaki untuk memastikan kedudukannya bagus waktu
                        ditempat kerja?</td>
                     <td><?php echo $jawaban8; ?></td>
                  </tr>
                  <tr>
                     <td>2</td>
                     <td class="pertanyaan">Apakah ada tabung penyuplai udara jika ada,telah diatur untuk mencegah
                        terhalangnya operator
                        selama
                        memakai?</td>
                     <td><?php echo $jawaban9; ?></td>
                  </tr>
                  <tr>
                     <td>3</td>
                     <td class="pertanyaan">Untuk mekanik electro yang aktif dari item jika ada, apakah ada ketentuan
                        untuk menghentikan
                        jika
                        keadaan
                        darurat ketika operator ingin untuk menghentikan pengoperasian setiap saat.</td>
                     <td><?php echo $jawaban10; ?></td>
                  </tr>
                  <tr>
                     <td>4</td>
                     <td class="pertanyaan">Apakah ada pengontrol mekanik elektro pada item, ada keistimewaan seperti
                        mengunakan kedua
                        tangan
                        untuk
                        mengaktifkan untuk mencegah kecelakaan?</td>
                     <td><?php echo $jawaban11; ?></td>
                  </tr>
                  <tr>
                     <td>5</td>
                     <td class="pertanyaan">Jika tajam, panas atau penggerakan bagian item,sudahkah terlindungi
                        dengan penutup atau
                        pelindung
                        untuk
                        mencegah operator terhindar dari kecelakaan.</td>
                     <td><?php echo $jawaban12; ?></td>
                  </tr>
                  <tr>
                     <td>6</td>
                     <td class="pertanyaan">Apakah ada label atau peringatan pada item seperti power line, tekanan
                        maksimal yang
                        dibolehkan
                        atau
                        yang
                        lain yang bisa dipakai untuk kesalahan penggunaan.</td>
                     <td><?php echo $jawaban13; ?></td>
                  </tr>
                  <tr>
                     <td>7</td>
                     <td class="pertanyaan">Apakah ada bagian yang bisa dipindah atau digerakan, adakah pelatihan
                        cara memegang tombol
                        atau
                        yang
                        lain
                        untuk memudahkan operator untuk memegang dengan benar dan mencegah pengunaan yang salah.</td>
                     <td><?php echo $jawaban14; ?></td>
                  </tr>
                  <tr>
                     <td>8</td>
                     <td class="pertanyaan">Untuk item yang berat, adakah pemegang atau penyokong untuk memudahkan
                        dalam mengangkat,
                        memasang
                        dan
                        memindahkan.</td>
                     <td><?php echo $jawaban15; ?></td>
                  </tr>


                  <table>
                     <h4>DETAILS OF JIG, FIXTURE IMPROVEMENT OR MODIFICATION DONE</h4>
                     <tr>
                        <td>
                           <?php
                           // Langkah 3: Tampilkan Foto
                           if (isset($nama_file_foto)) {
                              echo '<img src="uploads/' . $nama_file_foto . '" alt="Foto Pengecekan">';
                           } else {
                              echo 'Foto tidak tersedia.';
                           }

                           // Langkah 4: Tampilkan data riwayat lainnya
                           // ...
                           ?>
                        </td>
                     </tr>
                  </table>
                  <table>
                     <tr>
                        <th class="pertanyaan">Check Performed:</th>
                        <td class="pertanyaan"> <?php echo $performed; ?></td>


                     </tr>
                     <tr>
                        <th class="pertanyaan">Check Verified: </th>
                        <td class="pertanyaan"><?php echo $verified; ?></td>

                     </tr>
                  </table>
               </table>
            </div>
         </div>

      </main>
   </div>


   <script src="js/index.js"></script>
</body>

</html>