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
              txtValue = td[j].textContent || td[j].innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                  tr[i].style.display = ''; // Tampilkan baris jika ada kecocokan
                  break; // Hentikan pencarian pada kolom ini jika sudah ditemukan
              }
          }
      }
  }
}
