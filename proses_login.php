<?php
session_start();
include 'config.php';
$no = $_POST['no_peserta'];
$nisn = $_POST['nisn'];
$q = $conn->prepare("SELECT * FROM data_kelulusan WHERE no_peserta = ? AND nisn = ?");
$q->bind_param("ss", $no, $nisn);
$q->execute();
$r = $q->get_result();
if ($r->num_rows > 0) {
  $_SESSION['login'] = true;
  $_SESSION['user'] = $no;
  setcookie('token', bin2hex(random_bytes(16)), time() + 30, '/');
  header('Location: kelulusan.php');
} else {
  header('Location: login.php?error=1');
}
?>