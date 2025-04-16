<?php
require_once "header.php";
require_once "../PHP/connect.php";
require_once "../PHP/session.php";
?>
<title><?php echo $full_name; ?> Books</title>

<main>
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h1><?php echo $full_name; ?> Reserved Books</h1>
        </div>
        <?php

        $sql = "
SELECT 
    br.request_id, 
    b.name, 
    b.author, 
    b.edition,  
    br.issue_date, 
    br.return_date, 
    br.bookId,
    u.Email
FROM book_request br
INNER JOIN book b ON br.bookId = b.bookId
INNER JOIN user u ON br.UserID = u.UserID
WHERE u.Email = ?";


        //check if user has already reserved
        $CheckReservation = $conn->prepare($sql);
        $CheckReservation->bind_param("s", $user_email);
        $CheckReservation->execute();
        $CheckReservation->store_result();

        if ($CheckReservation->num_rows == 0) {
            echo "User has no borrowed books";

            $CheckReservation->close();
            exit;
        } else {

            echo "<table class='table table-bordered table-hover' id='table_data'>";

            // Table Header
            echo "<tr style='background-color:pink;'>";
            echo "<th>S/N</th>";
            echo "<th>Book Name</th>";
            echo "<th>Author Name</th>";
            echo "<th>Book Edition</th>";
            echo "<th>Issue Date</th>";
            echo "<th>Return Date</th>";
            echo "<th>Book Reservation</th>";
            echo "</tr>";

            // Serial number counter
            $sn = 1;
            $CheckReservation->bind_result($request_id, $name, $author, $edition, $issue_date, $return_date, $bookId, $user_email1);

            // Loop through to generate books in the table
            while ($CheckReservation->fetch()) {
                echo "<tr>";
                echo "<td>" . $sn . "</td>";
                echo "<td>" . $name . "</td>";
                echo "<td>" . $author . "</td>";
                echo "<td>" . $edition . "</td>";
                echo "<td>" . $issue_date . "</td>";
                echo "<td>" . $return_date . "</td>";
                echo "<td>
      <a href='../PHP/return_book.php?bookId=" . $bookId . "'>Return</a>
  </td>";
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