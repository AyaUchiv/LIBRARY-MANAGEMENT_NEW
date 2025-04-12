<?php
require_once "header.php";
require_once "../PHP/session.php";
?>
<title>Admin User Dashboard</title>
<div class="d-flex justify-content-between align-items-center">
    <h3>User</h3>
    <input class="form-control w-25" type="text" id="search_text" onkeyup="myFunction()" placeholder="Search users..." title="Type in a name">
    <a href="signup_form.php" class="btn btn-primary ms-3">Add User</a>
</div>
<main>

    <?php
    require_once "../PHP/connect.php";


    // Build the SQL query to fetch users
    //$select_books = "SELECT * FROM `user` WHERE `User` == "user";

    $select_users = "SELECT * FROM `user`";
    $result = mysqli_query($conn, $select_users);


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
    
    while ($row = mysqli_fetch_assoc($result)) {
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
                <a href='#' onclick='confirmEdit(\"" . $row['Email'] . "\")'>Edit</a> / 
                <a href='#' onclick='confirmDelete(\"" . $row['Email'] . "\")'>Delete</a>
              </td>";
    
        echo "</tr>";
    
        $sn++; // Increment serial number
    }
    
    echo "</tbody>";
    echo "</table>";
    

    //JAVASCRIPT FOR POP UP MESSAGE
    ?>

    <script type="text/javascript">
        //pop to delete a user
        function confirmDelete(Email) {
            var confirmation = confirm("Are you sure you want to delete this user?");

            if (confirmation) {
                window.location.href = "../PHP/delete_user.php?Email=" + Email;
            } else {
                return false;
            }
        }
        //Assisted with AI
        //pop up asking if you want user to become admin or not
        function confirmEdit(Email) {
            const action = prompt("Type 'promote' to make this user an admin, or 'demote' to remove admin rights:");

            if (action === null) return; // User pressed Cancel

            if (action.toLowerCase() === "promote") {
                window.location.href = "../PHP/edit_user.php?Email=" + encodeURIComponent(Email) + "&action=promote";
            } else if (action.toLowerCase() === "demote") {
                window.location.href = "../PHP/edit_user.php?Email=" + encodeURIComponent(Email) + "&action=demote";
            } else {
                alert("Invalid input. Please type 'promote' or 'demote'.");
            }
        }

        //Assisted with AI and W3school
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