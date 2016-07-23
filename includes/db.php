<?php


// $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// if ($mysqli->connect_errno) {
//     printf("Connect failed: %s\n", $mysqli->connect_error);
//     exit();
// }
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// /* Create table doesn't return a resultset */
// if (mysqli_query($link, "CREATE TEMPORARY TABLE myCity LIKE City") === TRUE) {
//     printf("Table myCity successfully created.\n");
// }