<?php
require_once "header.php";
?>
<title>Browse Books</title>

<main>
    <!--BROWISING OPTIONS-->
    <h2>Welcome to Library for Books</h2>

    <div class="position-relative text-white">
        <!-- Image -->
        <img src="assets/images/download.jpg" alt="image of books" class="img-fluid w-100">

        <!--semi-transparent overlay for better contrast -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.4);"></div>


        <div class="position-absolute top-50 start-50 translate-middle text-center px-4 py-3" style="max-width: 800px;">
            <h2 class="fw-bold display-5 mb-3">Instructions</h2>
            <p class="lead">
                Please note, once a book has been borrowed by you, it is essentially your duty to work on collecting the book.
            </p>
            <p class="lead">
                The return date is 7 days after the book has been borrowed, and failure to return the book incurs serious penalty as each day passes.
            </p>
            <p class="lead">
                We have fictional books (the likes of Sarah J. Maas), non-fictional books (Mel Robbins), and educational books (HTML, CSS, and PHP Beginner Basics by Janaka Senanayake).
            </p>
            <p class="lead">
                Enjoy a wonderful reading experience.
            </p>
        </div>
    </div>


</main>

<?php
require_once "footer.html";
?>