//password toggle
document.addEventListener("DOMContentLoaded", function () {
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (!input || !icon) return;

        const isPassword = input.type === "password";
        input.type = isPassword ? "text" : "password";
        icon.classList.replace(
            isPassword ? "bi-eye-slash" : "bi-eye",
            isPassword ? "bi-eye" : "bi-eye-slash"
        );
    }

    const toggleConfigs = [
        { input: "user_password1", icon: "togglePassword1" },
        { input: "user_password2", icon: "togglePassword2" },
        // Add more here as needed
    ];

    toggleConfigs.forEach(({ input, icon }) => {
        const iconElement = document.getElementById(icon);
        if (iconElement) {
            iconElement.addEventListener("click", () => togglePassword(input, icon));
        }
    });
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
function confirmEdit(Email, UserID ){
    const action = prompt("Type 'promote' to make this user an admin, or 'demote' to remove admin rights:");

    if (action === null) return; // User pressed Cancel

    if (action.toLowerCase() === "promote") {
        window.location.href = "../PHP/edit_user.php?Email=" + encodeURIComponent(Email) + '&UserID=' + UserID + "&action=promote";
    } else if (action.toLowerCase() === "demote") {
        window.location.href = "../PHP/edit_user.php?Email=" + encodeURIComponent(Email) + '&UserID=' + UserID + "&action=demote";
    } else {
        alert("Invalid input. Please type 'promote' or 'demote'.");
    }
}

//pop to delete a user
function confirmDelete(Email, UserID) {
    var confirmation = confirm("Are you sure you want to delete this user?");

    if (confirmation) {
        window.location.href = '../PHP/delete_user.php?Email=' + encodeURIComponent(Email) + '&UserID=' + UserID;
    } else {
        return false;
    }
}