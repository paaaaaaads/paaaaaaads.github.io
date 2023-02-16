<?php

include 'dbConfig.php';



if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    $file_name = $_POST["file_name"];

    $query = $db->query("DELETE FROM images WHERE id = '".$id."'");

    if ($query) {
        $file_path = 'uploads/'.$file_name;

        if (unlink($file_path)) {
            header('Location: Home.php');
        } else {
            echo "Error deleting file.";
        }
    } else {
        echo "Error deleting record from database.";
    }
}

?>