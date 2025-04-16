<?php
require_once "../PHP/connect.php";
require_once "../PHP/session.php";
require_once "header.php";
?>
<title>Admin Reserved Books</title>

<main>
  <div>
    <div class="d-flex justify-content-between align-items-center">
      <h3>All Reserved Books</h3>
      <input class="form-control w-25" type="text" id="search_text" onkeyup="myFunction()" placeholder="Search ..." title="Type in a name">
    </div>
    <?php

    $sql = "
 SELECT 
    br.request_id,
    u.Name, 
    u.Email, 
    b.name, 
    b.author, 
    b.edition,  
    br.issue_date, 
    br.return_date,
    br.book_penalty
FROM book_request br
INNER JOIN book b ON br.bookId = b.bookId
INNER JOIN user u ON br.UserID = u.UserID";

    //check if user has already reserved
    $CheckReservation = $conn->prepare($sql);
    $CheckReservation->execute();
    $CheckReservation->store_result();

    if ($CheckReservation->num_rows == 0) {
      echo "No borrowed books";

      $CheckReservation->close();
      exit;
    } else {

      echo "<table class='table table-bordered table-hover' id='table_data'>";

      // Table Header
      echo "<tr style='background-color:pink;'>";
      echo "<th>S/N</th>";
      echo "<th>User Name</th>";
      echo "<th>User Email</th>";
      echo "<th>Book Name</th>";
      echo "<th>Author Name</th>";
      echo "<th>Book Edition</th>";
      echo "<th>Issue Date</th>";
      echo "<th>Return Date</th>";
      echo "<th>Penalty</th>";
      echo "</tr>";


      $CheckReservation->bind_result($request_id,  $Name, $Email, $name, $author, $edition, $issue_date, $return_date, $book_penalty);

      // Serial number counter
      $sn = 1;

      // Loop through to generate books in the table
      while ($CheckReservation->fetch()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($sn) . "</td>";
        echo "<td>" . htmlspecialchars($Name) . "</td>";
        echo "<td>" . htmlspecialchars($Email) . "</td>";
        echo "<td>" . htmlspecialchars($name) . "</td>";
        echo "<td>" . htmlspecialchars($author) . "</td>";
        echo "<td>" . htmlspecialchars($edition) . "</td>";
        echo "<td>" . htmlspecialchars($issue_date) . "</td>";
        echo "<td>" . htmlspecialchars($return_date) . "</td>";
        echo "<td>" . htmlspecialchars($book_penalty) . "</td>";
        echo "</tr>";
        $sn++;
      }
      echo "</table>";
    }
    $CheckReservation->close();
    ?>
  </div>
</main>


<?php
require_once "footer.html";
?>