<?php
require_once "header.php";
require_once "../PHP/session.php";
?>
<title>Admin User Dashboard</title>
<div class="d-flex justify-content-between align-items-center">
    <h3>User</h3>
    <input class="form-control w-25" type="text" id="search_text" onkeyup="myFunction()" placeholder="Search users..." title="Type in a name">
    <a href="signup_form.php" class="btn" style="background-color: #e83e8c; color: white">Add User</a>
</div>
<main>

    <?php
    require_once "../PHP/connect.php";

    $select_users = "SELECT * FROM `user`";
    $result = $conn->prepare($select_users);
    $result->execute();
    $result = $result->get_result();

    echo "<table class='table table-bordered table-hover' id='table_data'>";

    // Start the table header row
    echo "<thead>";
    echo "<tr style='background-color:pink;'>";
    echo "<th>S/N</th>";            // Serial Number
    echo "<th>Email</th>";
    echo "<th>User Name</th>";
    echo "<th>Date Joined</th>";
    echo "<th>Role</th>";
    echo "<th>Action</th>";
    echo "</tr>";
    echo "</thead>";

    // Start the table body
    echo "<tbody>";

    // Serial number counter
    $sn = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";

        echo "<td>" . $sn . "</td>";                  // S/N
        echo "<td>" . $row['Email'] . "</td>";        // Email
        echo "<td>" . $row['Name'] . "</td>";         // User Name
        echo "<td>" . $row['date_joined'] . "</td>";  // Date Joined

        // Role
        $role = $row['IsAdmin'] == 1 ? "Admin" : "User";
        echo "<td>" . $role . "</td>";

        // Actions
        echo "<td>
                <a href='#' onclick='confirmEdit(\"" . $row['Email'] . "\", " . $row['UserID'] . ")'>Edit</a> / 
                <a href='#' onclick='confirmDelete(\"" . $row['Email'] . "\", " . $row['UserID'] . ")'>Delete</a>
              </td>";

        echo "</tr>";

        $sn++; // Increment serial number
    }

    echo "</tbody>";
    echo "</table>";

    ?>
</main>

<?php
require_once "footer.html";
?>