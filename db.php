<?php
$conn = new mysqli(
    "sql302.infinityfree.com",
    "if0_42099094",
    "ChocolateisNice",
    "if0_42099094_bookcycle"
);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>