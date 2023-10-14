<?php
include 'db/config.php';
// Tangkap item_id dari parameter GET
$item_id = $_GET["item_id"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <!-- Box Icons -->
   <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
   <!-- Style Css -->
   <link rel="stylesheet" href="css/style.css" />
   <!-- Chart Js -->
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <!-- Shortcut Icon -->
   <link rel="shortcut icon" href="img/PCI.png">
   <title>Table</title>
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
            <a href="tabel.php"><i class="bx bx-arrow-back"></i>Back</a>
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
         <div class="header">
            <div class="left">
               <h1>Table</h1>
               <ul class="breadcrumb">
                  <li><a href="tabel.html">Tooling Management System</a></li>

                  <li><a href="#" class="active">PCI</a></li>
               </ul>
            </div>
            <a onclick="cetakDetailRiwayat()" class="report"">
               <i class=" bx bx-cloud-download"></i>
               <span>Download PDF</span>
            </a>
            <script>
               function cetakDetailRiwayat() {
                  window.open(
                     "print_riwayat.php?item_id=<?php echo $item_id; ?>"); // Membuka halaman "cetak.php" dalam jendela baru
               }
            </script>

            <!-- End of Navbar-->


            <!-- Table -->
            <div class="bottom-data">
               <div class="orders">
                  <div class="header">
                     <i class='bx bx-history'></i>
                     <h3>Check History</h3>
                  </div>
                  <table>
                     <thead>
                        <tr>
                           <th>Customer</th>
                           <th>Model</th>
                           <th>Item S/N</th>
                           <th>Item Classification</th>
                           <th>Type</th>
                           <th>Item Description</th>
                           <th>Date Commissioned</th>
                           <th>Last Checking</th>
                           <th>Duration</th>

                        </tr>
                     </thead>

                     <tbody>
                        <?php
                        // Query untuk mengambil detail item dari database
                        $sql = "SELECT * FROM tms WHERE id = $item_id";
                        $result = $conn->query($sql);
                        if (mysqli_num_rows($result) > 0) {
                           while ($row = mysqli_fetch_assoc($result)) {
                              echo "<tr>";
                              echo "<td>" . $row["customer"] . "</td>";
                              echo "<td>" . $row["model"] . "</td>";
                              echo "<td>" . $row["sn"] . "</td>";
                              echo "<td>" . $row["itemclassi"] . "</td>";
                              echo "<td>" . $row["type"] . "</td>";
                              echo "<td>" . $row["itemdesc"] . "</td>";
                              echo "<td>" . $row["dcommiss"] . "</td>";
                              echo "<td>" . $row["lc"] . "</td>";
                              echo "<td>" . $row["durasi"] . "</td>";
                           }
                        } else {
                           echo "<tr><td colspan='11'>Tidak ada item yang ditemukan</td></tr>";
                        }
                        ?>

                        </tr>
                     </tbody>
                  </table>
                  <table>
                     <?php

                     $sql = "SELECT * FROM jawaban_pengecekan WHERE item_id = $item_id ORDER BY tanggal_pengecekan DESC";
                     $result = $conn->query($sql);

                     if ($result->num_rows > 0) {
                        echo "<table>";
                        echo "<thead>";
                        echo "<tr><th>Tanggal Pengecekan</th><th>Status</th><th>Item used for RoHS Process?</th><th>Check Detail</th></tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        while ($row = $result->fetch_assoc()) {
                           echo "<tr>";
                           echo "<td>" . $row["tanggal_pengecekan"] . "</td>";
                           echo "<td>" . $row["status"] . "</td>";
                           echo "<td>" . $row["jawaban_16"] . "</td>";
                           echo "<td><a href='detail.php?riwayat_id=" . $row["id"] . "'>Lihat Detail</a></td>"; // Tautan ke halaman detail
                           // tambahkan kolom pertanyaan lain jika ada
                           echo "</tr>";
                        }

                        echo "</tbody>";
                     } else {
                        echo "<p>Tidak ada riwayat pengecekan untuk Item ID: $item_id.</p>";
                     }

                     // Langkah 4: Menutup Koneksi Database
                     $conn->close();
                     ?>
                  </table>


               </div>
            </div>
            <!-- End of Table -->


         </div>
      </main>
      <!-- End of Content -->

      <script src="js/index.js"></script>

</body>

</html>