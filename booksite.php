<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Favorite Books</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="booksite.css">
</head>

<body>
    <div id="container">
        <header>
            <h1>Your Favorite Books</h1>
        </header>
        <nav id="main-navi">
            <ul>
                <li><a href="booksite.php">Home</a></li>
                <li><a href="booksite.php?genre=Adventure">Adventure</a></li>
                <li><a href="booksite.php?genre=Classic+Literature">Classic Literature</a></li>
                <li><a href="booksite.php?genre=Coming-of-age">Coming-of-age</a></li>
                <li><a href="booksite.php?genre=Fantasy">Fantasy</a></li>
                <li><a href="booksite.php?genre=Historical">Historical Fiction</a></li>
                <li><a href="booksite.php?genre=Horror">Horror</a></li>
                <li><a href="booksite.php?genre=Mystery">Mystery</a></li>
                <li><a href="booksite.php?genre=Romance">Romance</a></li>
                <li><a href="booksite.php?genre=Science+Fiction">Science Fiction</a></li>
            </ul>
        </nav>
        <main>
            <?php
            // Here you should display the books of the given genre (GET parameter "genre"). Check the links above for parameter values.
            // If the parameter is not set, display all books.
            // Use the HTML template below and a loop (+ conditional if the genre was given) to go through the books in file  
            
            // You also need to check the cookies to figure out if the book is favorite or not and display correct symbol.
            // If the book is in the favorite list, add the class "fa-star" to the a tag with "bookmark" class.
            // If not, add the class "fa-star-o". These are Font Awesome classes that add a filled star and a star outline respectively.
            // Also, make sure to set the id parameter for each book, so the setfavorite.php page gets the information which book to favorite/unfavorite.
            
            // Read the file into array variable $books:
            $json = file_get_contents("books.json");
            $books = json_decode($json, true);
            ?>

            <!--
            <section class="book">
                <a class="bookmark fa fa-star-o" href="setfavorite.php?id=1"></a>
                <h3>To Kill a Mockingbird</h3>
                <p class="publishing-info">
                    <span class="author">Harper Lee</span>,
                    <span class="year">1960</span>
                </p>
                <p class="description">
                    Harper Lee's masterpiece explores racial injustice and moral growth through the eyes of a young girl
                    in the American South.
                </p>
            </section>
            -->

            <?php
            /*
            foreach ($books as $key => $book) {
                $isFavorited = false;  // Add smth to check if the book is favorited
            
                if (isset($_GET['genre']) && $_GET['genre'] === $book['genre']) {
                    echo '<h2>' . $book['genre'] . '</h2>';
                    echo '<section class="book">';
                    echo '<a class="bookmark fa ' . ($isFavorited ? 'fa-star' : 'fa-star-o') . '" href="setfavorite.php?id=' . $book['id'] . '"></a>';
                    echo '<h3>' . $book['title'] . '</h3>';
                    echo '<p class="publishing-info">';
                    echo '<span class="author">' . $book['author'] . '</span>,';
                    echo '<span class="year">' . $book['publishing_year'] . '</span>';
                    echo '</p>';
                    echo '<p class="description">';
                    echo $book['description'];
                    echo '</p>';
                    echo '</section>';
                } elseif (!isset($_GET['genre'])) {
                    echo '<h2>' . $book['genre'] . '</h2>';
                    echo '<section class="book">';
                    echo '<a class="bookmark fa ' . ($isFavorited ? 'fa-star' : 'fa-star-o') . '" href="setfavorite.php?id=' . $book['id'] . '"></a>';
                    echo '<h3>' . $book['title'] . '</h3>';
                    echo '<p class="publishing-info">';
                    echo '<span class="author">' . $book['author'] . '</span>,';
                    echo '<span class="year">' . $book['publishing_year'] . '</span>';
                    echo '</p>';
                    echo '<p class="description">';
                    echo $book['description'];
                    echo '</p>';
                    echo '</section>';
                }
            }
    */
            // Check if the genre is set and display appropriate heading
            
            $genreName = isset($_GET['genre']) ? $_GET['genre'] : "All Books";
            echo '<h2>' . $genreName . '</h2>';

            foreach ($books as $book) {
                $favorites = isset($_COOKIE['favorites']) ? explode(",", $_COOKIE['favorites']) : [];
                $isFavorited = in_array($book['id'], $favorites); // the logic to check if the book is favorited
            
                // Check if the genre is set and matches the book's genre or if the genre is not set (display all books)
                if ((!isset($_GET['genre']) || $_GET['genre'] === $book['genre'])) {
                    echo '<section class="book">';
                    echo '<a class="bookmark fa ' . ($isFavorited ? 'fa-star' : 'fa-star-o') . '" href="setfavorite.php?id=' . $book['id'] . '"></a>';
                    echo '<h3>' . $book['title'] . '</h3>';
                    echo '<p class="publishing-info">';
                    echo '<span class="author">' . $book['author'] . '</span>,';
                    echo '<span class="year">' . $book['publishing_year'] . '</span>';
                    echo '</p>';
                    echo '<p class="description">';
                    echo $book['description'];
                    echo '</p>';
                    echo '</section>';
                }
            }

            ?>
        </main>
    </div>
</body>

</html>