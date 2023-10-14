<?php
include 'db/config.php';
// Tangkap item_id dari parameter GET

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

         <!-- End of Navbar-->


         <!-- Table -->
         <form method="post" action="db/insert.php" enctype="multipart/form-data">
            <div class="bottom-data">
               <div class="orders">
                  <div class="header">
                     <i class="bx bx-list-ul"></i>
                     <h3>Add Item</h3>
                  </div>
                  <label for="id_customer">Initial</label><br>
                  <input type="text" name="id_customer" placeholder="initial..." required><br>
                  <label for="customer">Customer </label>
                  <br>
                  <input type="text" name="customer" placeholder="customer..." required><br>

                  <label for="model">Model</label><br>
                  <input type="text" name="model" placeholder="model..." required><br>
                  <label for="sn">Item S/N</label><br>
                  <input type="text" name="sn" placeholder="serialnumber..." required><br>
                  <label for="itemclassi">Item Classification</label><br>
                  <input type="text" name="itemclassi" placeholder="item classification..." required><br>
                  <label for="type">Type</label><br>
                  <input type="text" name="type" placeholder="type..." required><br>
                  <label for="itemdesc">Item Description</label><br>
                  <input type="text" name="itemdesc" placeholder="item description..." required><br>
                  <label for="dcommiss">Date Commissoned</label><br>
                  <input type="date" name="dcommiss" placeholder="date commissioned..." required><br>
                  <label for="lc">Last Checking</label><br>
                  <input type="date" name="lc" placeholder="last check..." required><br>
                  <label for="durasi">Duration</label><br>
                  <input type="number" name="durasi" placeholder="duration..." required><br>
         </form><br>
         <input type="submit" value="Simpan" onclick="return validateForm()">
   </div>




   </div>
   </div>
   <!-- End of Table -->

   <!-- Question -->

   <!-- End Question -->
   </div>
   </main>
   <!-- End of Content -->

   <script src="js/index.js"></script>

</body>

</html>