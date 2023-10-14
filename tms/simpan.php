<!DOCTYPE html>
<html>

<head>
   <!-- Box Icons -->
   <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
   <!-- Style Css -->
   <link rel="stylesheet" href="css/style.css" />
   <!-- Chart Js -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <!-- Shortcut Icon -->
   <link rel="shortcut icon" href="img/PCI.png">
   <title>Simpan Pengecekan</title>
</head>

<body>
   <!-- Sidebar -->

   <div class="sidebar">
      <a href="index.php" class="logo">
         <i class="bx bx-badge-check"></i>
         <div class="logo-name"><span>PCI</span></div>
      </a>
      <ul class="side-menu">
         <li class="active">
            <a href="index.php"><i class="bx bxs-home"></i>Home</a>
         </li>

      </ul>
   </div>

   <!-- End Sidebar -->

   <!-- Main Content -->
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

         <!-- End of Navbar-->

         <?php
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

         // Langkah 2: Tangkap Data yang Di-Submit dari Form
         $item_id = $_POST["item_id"];
         $jawaban1 = $_POST["jawaban_1"];
         $jawaban2 = $_POST["jawaban_2"];
         $jawaban3 = $_POST["jawaban_3"];
         $jawaban4 = $_POST["jawaban_4"];
         $jawaban5 = $_POST["jawaban_5"];
         $jawaban6 = $_POST["jawaban_6"];
         $jawaban7 = $_POST["jawaban_7"];
         $jawaban8 = $_POST["jawaban_8"];
         $jawaban9 = $_POST["jawaban_9"];
         $jawaban10 = $_POST["jawaban_10"];
         $jawaban11 = $_POST["jawaban_11"];
         $jawaban12 = $_POST["jawaban_12"];
         $jawaban13 = $_POST["jawaban_13"];
         $jawaban14 = $_POST["jawaban_14"];
         $jawaban15 = $_POST["jawaban_15"];
         $jawaban16 = $_POST["jawaban_16"];
         $performed = $_POST["check_performed"];
         $verified = $_POST["check_verified"];
         // tambahkan tangkapan untuk pertanyaan lain sesuai kebutuhan
         $upload_dir = "uploads/";

         // Langkah 4: Ambil informasi file foto
         $nama_file_foto = $_FILES["foto"]["name"];
         $lokasi_file_sementara = $_FILES["foto"]["tmp_name"];

         // Langkah 5: Pindahkan file fisik ke folder "uploads"
         if (move_uploaded_file($lokasi_file_sementara, $upload_dir . $nama_file_foto)) {
            // Langkah 6: Simpan referensi nama file foto ke dalam database


            if (!$conn) {
               die("Koneksi gagal: " . mysqli_connect_error());
            }

            // Langkah 3: Hitung Tanggal "Last Check" dan "Next Check"
            $tanggal_pengecekan_terakhir = date("Y-m-d"); // Tanggal hari pengecekan

            // Ambil durasi dari item (misalnya dari tabel item)
            $sql_durasi = "SELECT durasi FROM tms WHERE id = $item_id";
            $result_durasi = $conn->query($sql_durasi);

            if ($result_durasi->num_rows > 0) {
               $row_durasi = $result_durasi->fetch_assoc();
               $durasi = $row_durasi["durasi"];

               // Hitung tanggal "Next Check" dengan menambahkan durasi
               $tanggal_next_check = date("Y-m-d", strtotime("+{$durasi} days", strtotime($tanggal_pengecekan_terakhir)));

               // Langkah 4: Simpan Hasil Pengecekan ke Database

               // Inisialisasi status item
               $status = 'OKE';

               // Periksa jawaban pertanyaan 1 hingga 15
               for ($i = 1; $i <= 15; $i++) {
                  $jawaban_pertanyaan = $_POST["jawaban_{$i}"];

                  // Jika ada jawaban yang "NOT OKE," ubah status_item dan hentikan pengulangan
                  if ($jawaban_pertanyaan === 'NOT OKE') {
                     $status = 'ITEM NOT OKE';
                     break;
                  }
               }

               // Query untuk menyimpan data pengecekan ke dalam tabel riwayat_pengecekan
               $nama_file_foto = basename($_FILES["foto"]["name"]);
               $sql = "INSERT INTO jawaban_pengecekan (item_id, tanggal_pengecekan, jawaban_1, jawaban_2, jawaban_3, jawaban_4, jawaban_5, jawaban_6, jawaban_7, jawaban_8, jawaban_9, jawaban_10, jawaban_11, jawaban_12, jawaban_13, jawaban_14, jawaban_15, jawaban_16, status, foto, check_performed, check_verified) VALUES ('$item_id', NOW(), '$jawaban1', '$jawaban2', '$jawaban3', '$jawaban4', '$jawaban5', '$jawaban6', '$jawaban7', '$jawaban8', '$jawaban9', '$jawaban10', '$jawaban11', '$jawaban12', '$jawaban13', '$jawaban14', '$jawaban15', '$jawaban16', '$status', '$nama_file_foto', '$performed', '$verified')";
               // tambahkan kolom pertanyaan lain ke dalam VALUES

               if ($conn->query($sql) === TRUE) {
                  echo "<p>Data berhasil disimpan.</p>";

                  // Cek apakah ada salah satu jawaban yang "NOT OKE"
                  if ($jawaban1 === 'NOT OKE' || $jawaban2 === 'NOT OKE' || $jawaban3 === 'NOT OKE' || $jawaban4 === 'NOT OKE' || $jawaban5 === 'NOT OKE' || $jawaban6 === 'NOT OKE' || $jawaban7 === 'NOT OKE' || $jawaban8 === 'NOT OKE' || $jawaban9 === 'NOT OKE' || $jawaban10 === 'NOT OKE' || $jawaban11 === 'NOT OKE' || $jawaban12 === 'NOT OKE' || $jawaban13 === 'NOT OKE' || $jawaban14 === 'NOT OKE' || $jawaban15 === 'NOT OKE') {
                     $status_item = 'NOT OKE';
                  } else {
                     $status_item = 'OKE';
                  }

                  // Query untuk mengubah status item dan tanggal "Last Check" dan "Next Check"
                  $sql_update_status = "UPDATE tms SET status_item = '$status_item', lc = '$tanggal_pengecekan_terakhir', nc = '$tanggal_next_check' WHERE id = $item_id";


                  if ($conn->query($sql_update_status) === TRUE) {
                     echo "<h3>Status item diubah menjadi $status_item.</h3>";
                     echo "<h3>Tanggal Pengecekan $tanggal_pengecekan_terakhir.</h3>";
                     echo "<h3>Tanggal Pengecekan berikutnya $tanggal_next_check.</h3>";
                  } else {

                     echo "<p>Error saat mengubah status item: " . $conn->error . "</p>";
                  }
               } else {
                  echo "<p>Error saat menyimpan data: " . $conn->error . "</p>";
               }
            } else {
               echo "<p>Error saat mengambil durasi item.</p>";
            }
         }






         // Langkah 5: Menutup Koneksi Database
         $conn->close();
         ?>

   </div>
   </main>

   <script src="js/index.js"></script>
</body>

</html>