<?php
session_start();
$id =  trim($_GET["id"]);

if(isset($_SESSION['giohang'][$id])){
    $_SESSION['giohang'][$id] = $_SESSION['giohang'][$id] + 1;
}

header('location: index.php?page_layout=GioHang');

?>