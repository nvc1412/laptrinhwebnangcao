<?php
session_start();
require_once("./admin/config.php");
require_once("header.php");

if(isset($_GET["page_layout"])){
    $active="";
    switch ($_GET["page_layout"]) {

        case 'Home':
            include_once './Home.php';
            $active="#Home, #Home > a{color: #ffffff; background-color: rgb(45, 119, 238);}";
            break;

        case 'CuaHang':
            include_once './CuaHang.php';
            $active="#CuaHang, #CuaHang > a{color: #ffffff; background-color: rgb(45, 119, 238);}";
            break;

        case 'TroGiup':
            include_once './TroGiup.php';
            $active="#TroGiup, #TroGiup > a{color: #ffffff; background-color: rgb(45, 119, 238);}";
            break;

        case 'LienHe':
            include_once './LienHe.php';
            $active="#LienHe, #LienHe > a{color: #ffffff; background-color: rgb(45, 119, 238);}";
            break;
            
        case 'GioHang':
            include_once './GioHang.php';
            $active="#GioHang, #GioHang > a{color: #ffffff; background-color: rgb(45, 119, 238);}";
            break;

        case 'DangNhap':
            include_once './DangNhap.php';
            $active="#DangNhap, #DangNhap > a{color: #ffffff; background-color: rgb(45, 119, 238);}";
            break;

        case 'DangKy':
            include_once './DangKy.php';
            $active="#DangNhap, #DangNhap > a{color: #ffffff; background-color: rgb(45, 119, 238);}";
            break;

        case 'ChiTietSanPham':
            include_once './ChiTietSanPham.php';
            $active="#CuaHang, #CuaHang > a{color: #ffffff; background-color: rgb(45, 119, 238);}";
            break;

        case 'TimKiem':
            include_once './TimKiem.php';
            $active="#CuaHang, #CuaHang > a{color: #ffffff; background-color: rgb(45, 119, 238);}";
            break;

        case 'ThanhToan':
            include_once './ThanhToan.php';
            $active="#GioHang, #GioHang > a{color: #ffffff; background-color: rgb(45, 119, 238);}";
            break;

        case 'TimKiemDanhMuc':
            include_once './TimKiemDanhMuc.php';
            $active="#CuaHang, #CuaHang > a{color: #ffffff; background-color: rgb(45, 119, 238);}";
            break;

        case 'DanhSachTimKiem':
            include_once './DanhSachTimKiem.php';
            $active="#CuaHang, #CuaHang > a{color: #ffffff; background-color: rgb(45, 119, 238);}";
            break;
    }
}else {
    include_once './Home.php';
    $active="#Home, #Home > a{color: #ffffff; background-color: rgb(45, 119, 238);}";
}

require_once("footer.php") 
?>

    