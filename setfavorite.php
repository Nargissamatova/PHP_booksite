<?php
// You will receive a GET parameter "id", which contains the book id.
// Check the cookie (with the name of your choice). It's recommended to save the favorite'd book ids as an array turned into string. E.g.
// $favorites = array(1, 4, 6);
// $favorites_string = implode(",", $favorites); // "1,4,6"
// setcookie("favorites", $favorites_string, time()+86400*30);
// $favorites = explode(",", $_COOKIE["favorites"]);

// If the cookie's not set or this id is not part of the cookie, add this id and send the cookie to the user.
// If it's part of the cookie, remove it and send the new cookie to the user.
// By far the easiest way to remove a specific item (not index) from array is to use array_diff function, e.g.
// $favorites = array_diff($favorites, array($id));
// This takes the items in the first array ($favorites) that are not in the second array (containing only the book id), and puts the result back to $favorites

// Redirect back to booksite.php. If you want to redirect to the exact page user came from, that's header("Location:" . $_SERVER["HTTP_REFERER"]);
// And no, that's not a typo. It is HTTP_REFERER.


// Check if the "id" parameter is set in the GET request
if (isset ($_GET['id'])) {
    $id = $_GET['id'];

    // Check if the "favorites" cookie is set
    $favorites = isset ($_COOKIE['favorites']) ? explode(',', $_COOKIE['favorites']) : [];

    // Check if the book ID is already in the favorites
    $isFavorited = in_array($id, $favorites);

    // If the book is favorited, remove it; otherwise, add it
    if ($isFavorited) {
        $favorites = array_diff($favorites, [$id]);
    } else {
        $favorites[] = $id;
    }

    // Convert the updated favorites array to a string and set the cookie
    $favoritesString = implode(",", $favorites);
    setcookie('favorites', $favoritesString, time() + 86400 * 31, '/');

    // Redirect back to the referring page (in this case, booksite.php)
    header("Location: booksite.php");
    exit();
} else {
    // If "id" parameter is not set, handle the error or redirect to an error page
    echo "Error: Book ID not specified.";
    // Alternatively, redirect to an error page
    // header("Location: error.php");
    // exit();
}