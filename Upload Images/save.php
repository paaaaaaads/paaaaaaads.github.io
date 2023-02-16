<?php


include 'dbConfig.php';

if (isset($_POST["unsave"])) {
    $id = $_POST["id"];

    $query = $db->query("UPDATE images SET favorites = '0' WHERE id = '".$id."'");

    header('Location: Favorites.php');
        
}

if (isset($_POST["save"])) {
    $id = $_POST["id"];

    $query = $db->query("UPDATE images SET favorites = '1'WHERE id = '".$id."'");

    header('Location: Favorites.php');
        
}
?>