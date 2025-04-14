<?php
require_once "header.php";
require_once "../PHP/session.php";
?>

<title>admin owing_users</title>

<main>
    <div class="d-flex justify-content-between align-items-center">
      <h3>Owing Users</h3>
      <input class="form-control w-25" type="text" id="search_text" onkeyup="myFunction()" placeholder="Search users..." title="Type in a name">
    </div>
    <div>
    <?php
    include_once(__DIR__ . '/../PHP/owing_users.php');
    ?>
  </div>

  <!--Gotten from AI and W3school-->
  <script>
    function myFunction() {
      var input, filter, table, tr, td, i, j, txtValue;
      input = document.getElementById("search_text");
      filter = input.value.toUpperCase(); // Convert to uppercase for case-insensitive comparison
      table = document.getElementById("table_data");
      tr = table.getElementsByTagName("tr");

      // Loop through all rows, starting from index 1 to skip the header row
      for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td"); // Get all td elements in the row
        let rowMatch = false; // Flag to check if any td matches the search

        // Loop through each td element in the current row
        for (j = 0; j < td.length; j++) {
          if (td[j]) {
            txtValue = td[j].textContent || td[j].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              rowMatch = true; // If a match is found, set flag to true
              break; // No need to check other columns once a match is found
            }
          }
        }

        // If a match was found in any td, show the row; otherwise, hide it
        if (rowMatch) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  </script>
</main>


<?php
require_once "footer.html";
?>