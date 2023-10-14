<!DOCTYPE html>
<html>

<head>
   <title>History Check</title>
   <style>
      /* Tambahkan CSS sesuai dengan desain Anda */
      body {
         background-color: #fff;
         margin: 20px;
      }

      table {
         width: 100%;
         border-collapse: collapse;
         margin: 5px auto;
      }

      th {
         font-family: 'Poppins', sans-serif;
         font-size: 10px;
         font-weight: 500;
         color: #000;
         border: 1px solid #000;
         padding: 5px;
         text-align: left;
      }

      td {
         font-family: 'Poppins', sans-serif;
         font-size: 10px;
         font-weight: 400;
         border: 1px solid #000;
         background-color: #fff;
         padding: 5px;
         text-align: left;
      }

      thead {
         background-color: #fff;
      }

      h4 {
         text-align: center;
         font-family: 'Poppins', sans-serif;
         font-weight: 600;
         color: #000;
         margin-top: 0;
         margin-bottom: 0;
      }

      img {
         display: flex;
         margin-left: 0;
         margin-right: auto;
         width: 10%;

      }

      .logo img {
         display: flex;
         margin-left: 0;
         margin-right: auto;
         width: 20%;

      }

      h5 {
         font-family: 'Poppins', sans-serif;
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

      .jawaban {
         text-align: center;
      }

      p {
         font-size: 12px;
         font-family: 'Poppins', sans-serif;
         text-align: center;
         font-weight: 500;
         color: #000;
         margin-top: 10px;
      }

      .tabel-foto table td {
         border: none;
      }

      .sn {
         text-align: center;
      }

      .print {
         width: 100%;
      }


      @media print {

         .cetak,
         .print,
         .lihatdetail,
         .back {
            display: none;
         }

      }
   </style>
</head>

<body>
   <table border="1">
      <div class="logo">
         <img src="img/PCI.png" alt="">
      </div>

      <?php
      // Langkah 1: Koneksi ke Database
      $servername = "localhost"; // Ganti dengan nama server Anda
      $username = "root"; // Ganti dengan nama pengguna database Anda
      $password = ""; // Ganti dengan kata sandi database Anda
      $database = "project"; // Ganti dengan nama database Anda

      // Membuat koneksi
      $conn = new mysqli($servername, $username, $password, $database);

      // Memeriksa koneksi
      if ($conn->connect_error) {
         die("Koneksi gagal: " . $conn->connect_error);
      }

      // Langkah 2: Tangkap ID Item yang Diklik
      $item_id = $_GET["item_id"];



      //Ambil detail item
      // Query untuk mengambil detail item berdasarkan ID
      $sql_item = "SELECT * FROM tabel_item WHERE id = $item_id";
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

      <h4>CHECKING RECORD</h4>
      <table>
         <tr>
            <th>Item Classification</th>
            <td><?php echo $item_classification; ?> </td>
            <th>Item Serial Number</th>
            <td><?php echo $serial_number; ?></td>
         </tr>
         <tr>
            <th>Item Description</th>
            <td><?php echo $item_description; ?> </td>
            <th>Date Commissioned for Line use</th>
            <td><?php echo $date_commissioned; ?> </td>
         </tr>
         <tr>

         </tr>
         <tr>
            <th>Product Line </th>
            <td><?php echo $customer; ?> </td>
            <th>Frequency of Checking</th>
            <td><?php echo $durasi; ?> </td>

         </tr>
         <tr>
            <th>Model Used</th>
            <td><?php echo $model; ?> </td>
            <th>Type</th>
            <td><?php echo $type; ?> </td>

         </tr>
      </table>



      <?php
      // Langkah 3: Query untuk Mengambil Data Riwayat Pengecekan
      $sql = "SELECT * FROM tabel_riwayat_pengecekan WHERE item_id = $item_id ORDER BY tanggal_pengecekan DESC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
         echo "<p>History Check</p>";
         echo "<table border='1'>";
         echo "<tr><th>Tanggal Pengecekan</th><th>Status</th><th>Item used for RoHS Procss?</th><th class='lihatdetail'>Check Detail</th></tr>";

         while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["tanggal_pengecekan"] . "</td>";
            echo "<td>" . $row["status"] . "</td>";
            echo "<td>" . $row["jawaban16"] . "</td>";
            echo "<td class='lihatdetail'><a href='detail_riwayat.php?riwayat_id=" . $row["id"] . "'>Lihat Detail</a></td>"; // Tautan ke halaman detail
            // tambahkan kolom pertanyaan lain jika ada
            echo "</tr>";
         }

         echo "</table>";
      } else {
         echo "<p>Tidak ada riwayat pengecekan untuk Item ID: $item_id.</p>";
      }

      // Langkah 4: Menutup Koneksi Database
      $conn->close();
      ?>

      <input class="print" type="button" value="EXPORT PDF" onclick="cetakDetailRiwayat()">

      <script>
         function cetakDetailRiwayat() {
            window.print(); // Fungsi ini akan memicu pencetakan halaman saat tombol "Cetak" ditekan
         }
      </script>

      <br>
      <a class="back" href="tabel.php">Kembali ke Daftar Item</a>
   </table>
</body>

</html>