//password toggle function
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    } else {
        input.type = "password";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    }
}

document.getElementById("togglePassword").addEventListener("click", function () {
    togglePassword("user_password", "togglePassword");
});

document.getElementById("togglePassword1").addEventListener("click", function () {
    togglePassword("user_password1", "togglePassword1");
});

document.getElementById("togglePassword2").addEventListener("click", function () {
    togglePassword("user_password2", "togglePassword2");
});

//search function
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

//pop to delete a user
function confirmDelete(Email) {
    var confirmation = confirm("Are you sure you want to delete this user?");

    if (confirmation) {
        window.location.href = "../PHP/delete_user.php?Email=" + Email;
    } else {
        return false;
    }
}