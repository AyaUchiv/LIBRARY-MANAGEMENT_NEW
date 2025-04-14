<?php
require_once "header.php";
?>
<title>View Books</title>


<main>
  <!--BROWISING OPTIONS-->
  <h3>Books</h3>
  <input class="form-control w-25" type="text" id="search_text" onkeyup="myFunction()" placeholder="Search books..." title="Type in a name">
  </div>
  <?php
  include_once(__DIR__ . '/../PHP/display_books.php');
  ?>
  </div>
</main>

<?php
require_once "footer.html";
?>