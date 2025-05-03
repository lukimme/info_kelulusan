<?php session_start(); 

if (isset($_COOKIE['token'])) { header('Location: kelulusan.php'); 
exit(); 
} else { 
    header('Location: login.php'); 
    exit(); 
    } 
    
    ?>