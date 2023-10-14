<?php
require 'db/config.php';

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
   <style>
      .search {
         padding: 5px;
         border-radius: 5px;
         border: 1px solid #000;
      }

      .additem {
         padding: 5px;
         width: 100%;
         cursor: pointer;
      }
   </style>
</head>

<body>
   <!-- Sidebar -->

   <div class="sidebar close">
      <a href="index.php" class="logo">
         <i class="bx bx-badge-check"></i>
         <div class="logo-name"><span>PCI</span></div>
      </a>
      <ul class="side-menu">
         <li>
            <a href="index.php"><i class="bx bxs-dashboard"></i>Dashboard</a>
         </li>
         <li class="active">
            <a href="tabel.php"><i class="bx bx-list-ul"></i>Table</a>
         </li>
         <li>
            <a href="#"><i class="bx bx-bar-chart-square"></i>Chart</a>
         </li>
      </ul>
      <ul class="side-menu">
         <li>
            <a href="#" class="logout">
               <i class="bx bx-log-out-circle"></i>
               Logout
            </a>
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

               <button class="search-btn" type="submit">
                  <i class="bx bx-search"></i>
               </button>
            </div>
         </form>
         <input type="checkbox" id="theme-toggle" hidden />
         <label for="theme-toggle" class="theme-toggle"></label>

      </nav>
      <main>
         <div class="header">
            <div class="left">
               <h1>Table</h1>
               <ul class="breadcrumb">
                  <li><a href="tabel.html">Tooling
                        Management
                        System</a>
                  </li>

                  <li><a href="#" class="active">PCI</a>
                  </li>
               </ul>
            </div>
            <a onclick="addItem()" class="report">
               <i class='bx bx-message-square-add'></i>
               <span>Add Item</span>
            </a>
            <script>
               function addItem() {
                  window.open(
                     "tes.php"
                  ); // Membuka halaman "cetak.php" dalam jendela baru
               }
            </script>

         </div>
         <!-- End of Navbar-->


         <!-- Table -->
         <div class="bottom-data">
            <div class="orders">
               <div class="header">
                  <i class="bx bx-list-ul"></i>
                  <h3>Item</h3>
                  <!-- Button to Open the Modal -->
                  <a href="tes.php">
                     <button class="additem" type="button">
                        Add
                        Item
                     </button></a>
                  <!-- The Modal -->
                  <div class="modal fade" id="myModal">
                     <div class="modal-dialog">
                        <div class="modal-content">



                        </div>
                     </div>
                  </div>
                  <input class="search" type="search" id="searchInput" placeholder="Search..." />
                  <i class="bx bx-search"></i>
               </div>
               <table id="myTable">
                  <thead>
                     <tr>
                        <th>Customer
                        </th>
                        <th>Model
                        </th>
                        <th>Item S/N
                        </th>
                        <th>Item Classification
                        </th>
                        <th>Type
                        </th>
                        <th>Item Description
                        </th>
                        <th>Date Commissioned
                        </th>
                        <th>Last Checking
                        </th>
                        <th>Duration
                        </th>
                        <th>Next Checking
                        </th>
                        <th>Deadline Check
                        </th>
                        <th>Status
                        </th>
                        <th>Check Item
                        </th>
                        <th>History Item
                        </th>
                     </tr>
                  </thead>

                  <tbody>



                     <?php

                     $sql = "SELECT * FROM tms LIMIT 25";
                     $result = mysqli_query($conn, $sql);
                     if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                           echo "<tr>";
                           echo "<td>" . $row["customer"] . "</td>";
                           echo "<td>" . $row["model"] . "</td>";
                           echo "<td>" . $row["sn"] . "</td>";
                           echo "<td>" . $row["itemclassi"] . "</td>";
                           echo "<td>" . $row["type"] . "</td>";
                           echo "<td class='desc'>" . $row["itemdesc"] . "</td>";
                           echo "<td>" . $row["dcommiss"] . "</td>";
                           echo "<td>" . $row["lc"] . "</td>";
                           echo "<td>" . $row["durasi"] . "</td>";
                           echo "<td>" . $row["nc"] . "</td>";
                           echo "<td>" . $row["status"] . "</td>";
                           echo "<td>" . $row["status_item"] . "</td>";
                           echo "<td><a href='check.php?item_id=" . $row["id"] . "'>Check</a></td>";
                           echo "<td><a href='riwayat.php?item_id=" . $row["id"] . "'>Check</a></td>";
                           echo "</tr>";
                        }
                     } else {
                        echo "<tr><td colspan='11'>Tidak ada item yang ditemukan</td></tr>";
                     }
                     ?>

                     </td>
                  </tbody>
               </table>
               <!-- End of Table -->
            </div>
         </div>
   </div>
   </main>
   <!-- End of Content -->

   <script src="js/index.js"></script>
   <script>
      function filterTable() {
         var input, filter, table, tr, td, i, j, txtValue;
         input = document.getElementById('searchInput');
         filter = input.value.toUpperCase();
         table = document.getElementById('myTable');
         tr = table.getElementsByTagName('tr');

         for (i = 0; i < tr.length; i++) {
            tr[i].style.display = 'none'; // Sembunyikan semua baris terlebih dahulu
            td = tr[i].getElementsByTagName('td');

            for (j = 0; j < td.length; j++) {
               if (td[j]) {
                  txtValue = td[j].textContent || td[j]
                     .innerText;
                  if (txtValue.toUpperCase().indexOf(filter) >
                     -1) {
                     tr[i].style.display =
                        ''; // Tampilkan baris jika ada kecocokan
                     break; // Hentikan pencarian pada kolom ini jika sudah ditemukan
                  }
               }
            }
         }
      }

      // Tambahkan event listener untuk pemanggilan fungsi filter saat input berubah
      document.getElementById('searchInput').addEventListener('input', filterTable);
   </script>

</body>

</html>