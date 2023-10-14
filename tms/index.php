<?php
include 'db/config.php';
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

   <title>TMS</title>
</head>

<body>
   <!-- Sidebar -->

   <div class="sidebar">
      <a href="#" class="logo">
         <i class="bx bx-badge-check"></i>
         <div class="logo-name"><span>PCI</span></div>
      </a>
      <ul class="side-menu">
         <li class="active">
            <a href="#"><i class="bx bxs-dashboard"></i>Dashboard</a>
         </li>
         <li>
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
               <h1>Dashboard</h1>
               <ul class="breadcrumb">
                  <li><a href="tabel.php">Tooling Management System</a></li>

                  <li><a href="#" class="active">PCI</a></li>
               </ul>
            </div>

         </div>


         <!-- Insights -->
         <!--KONTEN-->
         <?php
         $get1 = mysqli_query($conn, "select * from tms");
         $count1 = mysqli_num_rows($get1);

         //Data Going to Expire
         $get2 = mysqli_query($conn, "select * from tms where status='Going to Expire'");
         $count2 = mysqli_num_rows($get2);

         //Data Expired
         $get3 = mysqli_query($conn, "select * from tms where status='Expired'");
         $count3 = mysqli_num_rows($get3);

         //Data Verified
         $get4 = mysqli_query($conn, "select * from tms where status='Verified'");
         $count4 = mysqli_num_rows($get4);
         ?>
         <ul class="insights">
            <li>
               <a href="tabel.php"><i class="bx bx-package"></i></a>
               <span class="info">
                  <div class="number">
                     <h3><?= $count1; ?></h3>
                  </div>
                  <p>Total Tooling</p>
               </span>

            </li>
            <li>
               <a href="verified.php"><i class='bx bx-checkbox-checked'></i></a>
               <span class="info">
                  <div class="number">
                     <h3><?= $count4; ?></h3>
                  </div>
                  <p>Verified</p>
               </span>
            </li>
            <li>
               <a href="goingtoexpire.php"><i class='bx bx-error'></i></a>
               <span class="info">
                  <div class="number">
                     <h3><?= $count2; ?></h3>
                  </div>
                  <p>Going to Expire</p>
               </span>
            </li>
            <li>
               <a href="expired.php"><i class='bx bx-error-circle'></i></a>
               <span class="info">
                  <div class="number">
                     <h3><?= $count3; ?></h3>
                  </div>
                  <p>Expired</p>
               </span>
            </li>
         </ul>


         <div class="bottom-chart">
            <div class="orders">
               <div class="header">
                  <i class="bx bx-bar-chart-square"></i>
                  <h3>Charts</h3>
               </div>
               <?php
               include('grafik.php');
               ?>

            </div>
         </div>



   </div>
   </main>

   <!-- End of Navbar -->

   <!-- End Of Content-->

   <script src="js/index.js"></script>
   <script src="grafik.php"></script>

</body>

</html>