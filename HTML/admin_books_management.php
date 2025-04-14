<?php
require_once "header.php";
require_once "../PHP/session.php";
?>

<title>Admin View All Books</title>

<main>
  <div>
    <div class="d-flex justify-content-between align-items-center">
      <h3>Books</h3>
      <input class="form-control w-25" type="text" id="search_text" onkeyup="myFunction()" placeholder="Search books..." title="Type in a name">
      <a href="upload_form.php" class="btn" style="background-color: #e83e8c; color: white">Add Book</a>
    </div>
    <?php
    include_once(__DIR__ . '/../PHP/display_books_admin.php');
    ?>
  </div>
</main>


<?php
require_once "footer.html";
?>