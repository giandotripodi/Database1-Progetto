<?php


    $conn = mysqli_connect('localhost', 'root', '', 'my_tripodibasi1');
    if(!$conn) {
        echo mysqli_connect_error();
    }
    return $conn;
?>
