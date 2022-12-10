<?php
session_start();
if(isset($_GET["id"])){
    $id =  trim($_GET["id"]);

    if($id == 0){
        unset($_SESSION["giohang"]);
    }
    else{
        unset($_SESSION['giohang'][$id]);
        if($_SESSION["giohang"]==null){
            unset($_SESSION["giohang"]);
        }
    }
}

header('location: index.php?page_layout=GioHang');

?>