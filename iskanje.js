
function isci() {
  var input, filter, table, tr, td, i, vnos, kaj;
  input = document.getElementById("searchbar");
  filter = input.value.toUpperCase();
  table = document.getElementById("izpis");
  tr = table.getElementsByTagName("tr");
  kaj = document.querySelector('input[name="kaj"]:checked').value;




// skrije vrstice kjer ni ujemanja
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[kaj];
    if (td) {
      vnos = td.textContent || td.innerText;
      if (vnos.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
