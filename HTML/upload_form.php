<?php
//assisted with AI
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bookCount'])) {
    $bookCount = (int)$_POST['bookCount'];
} else {
    $bookCount = 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <h3>Upload Books</h3>

    <!-- Step 1: Ask user how many books they want to upload -->
    <?php if ($bookCount == 0): ?>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="bookCount" class="form-label">How many books do you want to upload?</label>
                <input type="number" name="bookCount" class="form-control" min="1" required>
            </div>
            <button type="submit" class="btn btn-primary">Next</button>
        </form>
    <?php else: ?>
        <!-- Step 2: Display the form fields based on user input -->
        <form action="../PHP/add_books.php" method="POST" enctype="multipart/form-data">
            <?php for ($i = 1; $i <= $bookCount; $i++): ?>
                <h4>Book <?php echo $i; ?></h4>

                <div class="mb-3">
                    <label for="book_title<?php echo $i; ?>" class="form-label">Book Title:</label>
                    <input type="text" name="book_title[]" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="book_author<?php echo $i; ?>" class="form-label">Book Author:</label>
                    <input type="text" name="book_author[]" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="book_edition<?php echo $i; ?>" class="form-label">Book Edition:</label>
                    <input type="text" name="book_edition[]" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="book_status<?php echo $i; ?>" class="form-label">Book Status:</label>
                    <select name="book_status[]" class="form-control" required>
                        <option value="" selected disabled>Choose Status</option>
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="book_quantity<?php echo $i; ?>" class="form-label">Book Quantity:</label>
                    <select name="book_quantity[]" class="form-control" required>
                        <option value="" selected disabled>Choose Quantity</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="book_genre<?php echo $i; ?>" class="form-label">Book Genre:</label>
                    <select name="book_genre[]" class="form-control" required>
                        <option value="" selected disabled>Choose Genre</option>
                        <option value="Fiction">Fiction</option>
                        <option value="Non-Fiction">Non-Fiction</option>
                        <option value="Education">Education</option>
                    </select>
                </div>


            <?php endfor; ?>

            <button type="submit" class="btn btn-primary" onclick="return confirmUpload()">Upload Books</button>
        </form>
    <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        // JavaScript confirmation for uploading book
        function confirmUpload() {
            var confirmation = confirm("Are you sure you want to upload this book?");
            if (confirmation) {
                return true;
            } else {
                return false;
            }
        }
    </script>

</body>

</html>