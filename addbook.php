<?php
// If the user is not logged in, redirect them back to login.php.
// if the form has been sent, add the book to the data file
// In order to protect against cross-site scripting attacks (i.e. basic PHP security), remove HTML tags from all input.
// There's a function for that. E.g.
// $title = strip_tags($_POST["title"]);
// Start the session (assuming you're using sessions for user login)
session_start();

/* If the user is not logged in, redirect them back to login.php.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}*/

// Check if form submitted
if (isset($_POST["add-book"])) {
    // In order to protect against cross-site scripting attacks, remove HTML tags from all input.
    // There's a function for that. E.g.
    $bookid = strip_tags($_POST["bookid"]);
    $title = strip_tags($_POST["title"]);
    $author = strip_tags($_POST["author"]);
    $year = strip_tags($_POST["year"]);
    $genre = strip_tags($_POST["genre"]);
    $description = strip_tags($_POST["description"]);

    // Read the file into array variable $books:
    $json = file_get_contents("books.json");
    $books = json_decode($json, true);

    // Create a new book array
    $newBook = array(
        "id" => $bookid,
        "title" => $title,
        "author" => $author,
        "publishing_year" => $year,
        "genre" => $genre,
        "description" => $description
    );

    // Add the new book to the $books array
    $books[] = $newBook;

    // Once you have added the new book to the variable $books, write it into the file.
    file_put_contents("books.json", json_encode($books));

    // Redirect to admin.php or any other appropriate page after adding the book
    header("Location: admin.php");
    exit();
}

?>
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
                <li><a href="admin.php">Admin Home</a></li>
                <li><a href="addbook.php">Add a New Book</a></li>
                <li><a href="login.php?logout">Log Out</a></li>
            </ul>
        </nav>
        <main>
            <h2>Add a New Book</h2>
            <form action="addbook.php" method="post">
                <p>
                    <label for="bookid">ID:</label>
                    <input type="number" id="bookid" name="bookid">
                </p>
                <p>
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title">
                </p>
                <p>
                    <label for="author">Author:</label>
                    <input type="text" id="author" name="author">
                </p>
                <p>
                    <label for="year">Year:</label>
                    <input type="number" id="year" name="year">
                </p>
                <p>
                    <label for="genre">Genre:</label>
                    <select id="genre" name="genre">
                        <option value="Adventure">Adventure</option>
                        <option value="Classic Literature">Classic Literature</option>
                        <option value="Coming-of-age">Coming-of-age</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Historical Fiction">Historical Fiction</option>
                        <option value="Horror">Horror</option>
                        <option value="Mystery">Mystery</option>
                        <option value="Romance">Romance</option>
                        <option value="Science Fiction">Science Fiction</option>
                    </select>
                </p>
                <p>
                    <label for="description">Description:</label><br>
                    <textarea rows="5" cols="100" id="description" name="description"></textarea>
                </p>
                <p><input type="submit" name="add-book" value="Add Book"></p>
            </form>
        </main>
    </div>
</body>

</html>