<?php
include 'db/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   <link href='//stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css' rel='stylesheet'>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
</head>

<body>

   <table id="example" class="table table-bordered" width="100%">
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
            <th>Next Checking</th>
            <th>Deadline Check</th>
            <th>Status</th>
            <th>Check Item</th>
            <th>History Item</th>
         </tr>
      </thead>
      <tbody>
         <?php

         $sql = "SELECT * FROM tms";
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
      </tbody>
   </table>




   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
   <script>
      $(document).ready(function() {
         $('#example').DataTable({

         })
      });
   </script>
</body>

</html>