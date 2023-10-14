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
   <style>
      select {
         font-size: 13px;
         padding: 5px;
         border-radius: 10px;
         text-align: center;
         background: #f05922;
         color: #fff;
         border: none;
         cursor: pointer;
      }

      input {
         border-radius: 5px;
         padding: 5px;
         border: 1px solid #AAAAAA;
      }

      .submit {
         border-radius: 5px;
         background: #f05922;
         color: #fff;
         border: none;
         padding: 10px;
         cursor: pointer;
      }

      .submit:hover {
         background: #d65120;
      }
   </style>
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
         <div class="bottom-data">
            <div class="orders">
               <div class="header">
                  <i class="bx bx-list-ul"></i>
                  <h3>Item</h3>
                  <i class='bx bx-filter'></i>
                  <i class='bx bx-search'></i>
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
                        <th>Item used for RoHS Process?</th>
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
                     <form method="post" action="simpan.php" enctype="multipart/form-data">
                        <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                        <td for="jawaban16"><select name="jawaban_16">

                              <option value="YES">Yes</option>
                              <option value="NO">No</option>
                           </select></td>
                        </tr>
                  </tbody>
               </table>



            </div>
         </div>
         <!-- End of Table -->

         <!-- Question -->

         <div class="bottom-data">
            <div class="orders">
               <div class="header">
                  <h3>Functionality</h3>
               </div>
               <table>

                  <thead>
                     <tr>
                        <th>NO.</th>
                        <th>CHECK ITEMS</th>
                        <th>CHECK</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>

                        <td>1</td>
                        <td class="pertanyaan">Check kelengkapan spring, pusher, look pada jig</td>
                        <td for="jawaban_1"><select name="jawaban_1">
                              <option value="OKE">Oke</option>
                              <option value="NOT OKE">Not Oke</option>
                           </select></td>
                     </tr>

                     <tr>
                        <td>2</td>
                        <td class="pertanyaan">Check apakah jig sewaktu menekan komponent tidak menyebabkan kerusakan
                           seperti damage,
                           crack, gap,
                           dan aligment pada komponent</td>
                        <td for="jawaban_2"><select name="jawaban_2">
                              <option value="OKE">Oke</option>
                              <option value="NOT OKE">Not Oke</option>
                           </select></td>
                     </tr>

                     <tr>
                        <td>3</td>
                        <td class="pertanyaan">Check apakah bagian yang terbuka pada base jig hanya untuk lokasi yang
                           di touch up</td>
                        <td for="jawaban_3"><select name="jawaban_3">
                              <option value="OKE">Oke</option>
                              <option value="NOT OKE">Not Oke</option>
                           </select></td>
                     </tr>

                     <tr>
                        <td>4</td>
                        <td class="pertanyaan">Check apakah jig bisa untuk digunakan secara berulang-ulang</td>
                        <td for="jawaban_4"><select name="jawaban_4">
                              <option value="OKE">Oke</option>
                              <option value="NOT OKE">Not Oke</option>
                           </select></td>
                     </tr>

                     <tr>
                        <td>5</td>
                        <td class="pertanyaan">Check apakah jig tersebut mudah untuk digunakan</td>
                        <td for="jawaban_5"><select name="jawaban_5">
                              <option value="OKE">Oke</option>
                              <option value="NOT OKE">Not Oke</option>
                           </select></td>
                     </tr>

                     <tr>
                        <td>6</td>
                        <td class="pertanyaan">Check kebersihan jig, bersih dari fluxs, Solder Splash</td>
                        <td for="jawaban_6"><select name="jawaban_6">
                              <option value="OKE">Oke</option>
                              <option value="NOT OKE">Not Oke</option>
                           </select></td>
                     </tr>

                     <tr>
                        <td>7</td>
                        <td class="pertanyaan">Apakah jig tersebut membutuhkan improvement dan modification untuk
                           kedepannya</td>
                        <td for="jawaban_7"><select name="jawaban_7">
                              <option value="OKE">Oke</option>
                              <option value="NOT OKE">Not Oke</option>
                           </select></td>
                     </tr>

                  </tbody>
               </table>
            </div>
         </div>
         <div class="bottom-data">
            <div class="orders">
               <div class="header">
                  <h3>Safety</h3>
               </div>
               <table>
                  <thead>
                     <tr>
                        <th>NO.</th>
                        <th>CHECK ITEMS</th>
                        <th>CHECK</th>
                     </tr>
                  </thead>
                  <tbody>

                     <tr>
                        <td>1</td>
                        <td class="pertanyaan">Apakah item terdapat kaki untuk memastikan kedudukannya bagus waktu
                           ditempat kerja?</td>
                        <td for="jawaban_8"><select name="jawaban_8">

                              <option value="OKE">Oke</option>
                              <option value="NOT OKE">Not Oke</option>
                           </select></td>
                     </tr>

                     <tr>
                        <td>2</td>
                        <td class="pertanyaan">Apakah ada tabung penyuplai udara jika ada,telah diatur untuk mencegah
                           terhalangnya
                           operator
                           selama memakai?</td>
                        <td for="jawaban_9"><select name="jawaban_9">
                              <option value="OKE">Oke</option>
                              <option value="NOT OKE">Not Oke</option>
                           </select></td>
                     </tr>

                     <tr>
                        <td>3</td>
                        <td class="pertanyaan">Untuk mekanik elektro yang aktif dari item jika ada, apakah ada
                           ketentuan untuk
                           menghentikan
                           jika keadaan darurat ketika operator ingin untuk menghentikan pengoperasian setiap saat.
                        </td>
                        <td for="jawaban_10"><select name="jawaban_10">
                              <option value="OKE">Oke</option>
                              <option value="NOT OKE">Not Oke</option>
                           </select></td>
                     </tr>

                     <tr>
                        <td>4</td>
                        <td class="pertanyaan">Apakah ada pengontrol mekanik elektro pada item, ada keistimewaan
                           seperti mengunakan
                           kedua
                           tangan
                           untuk mengaktifkan untuk mencegah kecelakaan?</td>
                        <td for="jawaban_11"><select name="jawaban_11">
                              <option value="OKE">Oke</option>
                              <option value="NOT OKE">Not Oke</option>
                           </select></td>
                     </tr>

                     <tr>
                        <td>5</td>
                        <td class="pertanyaan">Jika tajam, panas atau penggerakan bagian item,sudahkah terlindungi
                           dengan penutup atau
                           pelindung
                           untuk mencegah operator terhindar dari kecelakaan.</td>
                        <td for="jawaban_12"><select name="jawaban_12">
                              <option value="OKE">Oke</option>
                              <option value="NOT OKE">Not Oke</option>
                           </select></td>
                     </tr>

                     <tr>
                        <td>6</td>
                        <td class="pertanyaan">Apakah ada label atau peringatan pada item seperti power line, tekanan
                           maksimal yang
                           dibolehkan
                           atau
                           yang lain yang bisa dipakai untuk kesalahan penggunaan.</td>
                        <td for="jawaban_13"><select name="jawaban_13">
                              <option value="OKE">Oke</option>
                              <option value="NOT OKE">Not Oke</option>
                           </select></td>
                     </tr>

                     <tr>
                        <td>7</td>
                        <td class="pertanyaan">Apakah ada bagian yang bisa dipindah atau digerakan, adakah pelatihan
                           cara memegang
                           tombol
                           atau
                           yang
                           lain untuk memudahkan operator untuk memegang dengan benar dan mencegah pengunaan yang
                           salah.
                        </td>
                        <td for="jawaban_14"><select name="jawaban_14">
                              <option value="OKE">Oke</option>
                              <option value="NOT OKE">Not Oke</option>
                           </select></td>
                     </tr>

                     <tr>
                        <td>8</td>
                        <td class="pertanyaan">Untuk item yang berat, adakah pemegang atau penyokong untuk memudahkan
                           dalam mengangkat,
                           memasang dan memindahkan.</td>
                        <td for="jawaban_15"><select name="jawaban_15">

                              <option value="OKE">Oke</option>
                              <option value="NOT OKE">Not Oke</option>
                           </select></td>
                     </tr>

                  </tbody>

               </table>
               <label for="foto">Upload Foto:</label>
               <input class="submit" type="file" name="foto" id="foto">
               <br>
               <br>
               <label for="check_performed">Check Performed</label><br>
               <input type="text" name="check_performed" placeholder="name performed..." required><br>
               <label for="check_verified">Check Verified </label>
               <br>
               <input type="text" name="check_verified" placeholder="name verified..." required><br>
               <br>
               <input class="submit" type="submit" value="Simpan" onclick="return validateForm()">
               <script>
                  function validateForm() {
                     var checkPerformedBy = document.getElementById("check_performed").value;
                     var checkVerifiedBy = document.getElementById("check_verified").value;

                     if (checkPerformedBy === "" || checkVerifiedBy === "") {
                        alert("Harap isi kedua input 'Check Performed' dan 'Check Verified' sebelum menyimpan data.");
                        return false; // Mencegah pengiriman formulir jika ada yang belum diisi
                     }
                     return true; // Lanjutkan pengiriman formulir jika sudah terisi semua
                  }
               </script>

            </div>
         </div>
         </form>
         <!-- End Question -->
   </div>
   </main>
   <!-- End of Content -->

   <script src="js/index.js"></script>

</body>

</html>