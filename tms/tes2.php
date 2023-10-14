<!DOCTYPE html>
<html>

<head>
   <title>Document History Check</title>
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
         margin: 5px auto;
      }

      th {
         font-size: 10px;
         font-weight: 600;
         color: #000;
         border: 1px solid #000;
         padding: 5px;
         text-align: left;
      }

      td {
         font-size: 10px;
         font-weight: 300;
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
         margin: 10px auto;
         width: 10%;
         padding: 5px;
      }

      .status {
         text-align: center;
      }

      .foto-tabel {
         height: 50px;
         width: 170px;
         margin-left: 0;
      }

      .fotos {
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
      <input class="print" type="button" value="EXPORT PDF" onclick="cetakDetailRiwayat()">
      <input class="print" type="button" value="BACK" onclick="kembali()">

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

      // Langkah 2: Tangkap ID Item yang Diklik
      $item_id = $_GET["item_id"];

      // Query untuk mengambil detail item berdasarkan ID
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
      }
      ?>

      <h4>[JIG] / [FIXTURE] CHECKING RECORD</h4>
      <!-- DETAIL ITEM -->
      <table>

         <tr>
            <th>ITEM CLASSIFICATION</th>
            <td><?php echo $item_classification; ?> </td>
            <th>ITEM SERIAL NUMBER</th>
            <td><?php echo $serial_number; ?></td>
         </tr>

         <tr>
            <th>ITEM DESCRIPTION</th>
            <td><?php echo $item_description; ?> </td>
            <th>DATE COMMISSIONED FOR LINE USE</th>
            <td><?php echo $date_commissioned; ?> </td>
         </tr>

         <tr>
         </tr>
         <tr>
            <th>PRODUCT LINE </th>
            <td><?php echo $customer; ?> </td>
            <th>FREQUENCY OF CHECKING</th>
            <td><?php echo $durasi; ?> </td>
         </tr>

         <tr>
            <th>MODEL USED</th>
            <td><?php echo $model; ?> </td>
            <th>TYPE</th>
            <td><?php echo $type; ?> </td>
         </tr>

      </table>


      <?php
      // Mengambil data riwayat pengecekan
      $sql = "SELECT * FROM jawaban_pengecekan WHERE item_id = $item_id ORDER BY tanggal_pengecekan DESC";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
         echo "<p>History Check</p>";
         echo "<table border='1'>";
         echo "<tr>
         <th class='status'>DATE CHECK</th>
         <th class='status'>STATUS ITEM</th>
         <th class='status'>Item used for RoHS Procss?</th>
         <th class='status'>CHECK PERFORMED</th>
         <th class='status'>CHECK VERIFIED</th></tr>";

         while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td class='status'>" . $row["tanggal_pengecekan"] . "</td>";
            echo "<td class='status'>" . $row["status"] . "</td>";
            echo "<td class='status'>" . $row["jawaban_16"] . "</td>";
            echo "<td class='status'>" . $row["check_performed"] . "</td>";
            echo "<td class='status'>" . $row["check_verified"] . "</td>";
            echo "</tr>";
         }
         echo "</table>";
      } else {
         echo "<p>Tidak ada riwayat pengecekan untuk Item ID: $item_id.</p>";
      }
      // Tutup koneksi...
      $conn->close();
      ?>

      <!-- Script untuk print -->
      <script>
         function cetakDetailRiwayat() {
            window
               .print();
         }
      </script>

      <script>
         function kembali() {
            window.open("riwayat.php?item_id=<?php echo $item_id; ?>"); // Membuka halaman "cetak.php" dalam jendela baru
         }
      </script>
   </table>
</body>

</html>