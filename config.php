<?php

//offline
// $host = 'localhost';
// $user = 'root';
// $pass = '';
// $db = 'lulusan';

//online
$host = 'localhost';
$user = 'u1583982_lulusan';
$pass = 'i7fc%6ufwe87tEeiyu2wtbw9';
$db = 'u1583982_lulusan';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) { die('Koneksi gagal: ' . $conn->connect_error); }
?>