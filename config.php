<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "travel_db.sql";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("ket noi that bai!: " . mysqli_connect_error());
}
if ($conn) {
    echo "ketnoithanhcong" ;
}

?>
