<?php
session_start();
if(isset($_SESSION["logged"]) && $_SESSION["logged"] == 1){

    include_once 'header.php';
    
    if(isset($_GET["page_layout"])){
        $active="";
        switch ($_GET["page_layout"]) {

            //---------------Quản lí Nhân viên--------------

            case 'danhsachNV':
                include_once './QuanLyNhanVien/danhsachNV.php';
                $active="#danhsachNV{color: #00FFFF;}";
                break;

            case 'themNV':
                include_once './QuanLyNhanVien/themNV.php';
                $active="#danhsachNV{color: #00FFFF;}";
                break;

            case 'suaNV':
                include_once './QuanLyNhanVien/suaNV.php';
                $active="#danhsachNV{color: #00FFFF;}";
                break;

            case 'xoaNV':
                include_once './QuanLyNhanVien/xoaNV.php';
                $active="#danhsachNV{color: #00FFFF;}";
                break;

            //---------------Quản lí Tài khoản--------------

            case 'danhsachTK':
                include_once './QuanLyTaiKhoan/danhsachTK.php';
                $active="#danhsachTK{color: #00FFFF;}";
                break;
                
            case 'themTK':
                include_once './QuanLyTaiKhoan/themTK.php';
                $active="#danhsachTK{color: #00FFFF;}";
                break;

            case 'suaTK':
                include_once './QuanLyTaiKhoan/suaTK.php';
                $active="#danhsachTK{color: #00FFFF;}";
                break;

            case 'xoaTK':
                include_once './QuanLyTaiKhoan/xoaTK.php';
                $active="#danhsachTK{color: #00FFFF;}";
                break;

            //---------------Quản lí Sản phẩm--------------

            case 'danhsachSP':
                include_once './QuanLySanPham/danhsachSP.php';
                $active="#danhsachSP{color: #00FFFF;}";
                break;

            case 'themSP':
                include_once './QuanLySanPham/themSP.php';
                $active="#danhsachSP{color: #00FFFF;}";
                break;

            case 'suaSP':
                include_once './QuanLySanPham/suaSP.php';
                $active="#danhsachSP{color: #00FFFF;}";
                break;

            case 'xoaSP':
                include_once './QuanLySanPham/xoaSP.php';
                $active="#danhsachSP{color: #00FFFF;}";
                break;

            //---------------Quản lí Hóa đơn--------------

            case 'danhsachHD':
                include_once './QuanLyHoaDon/danhsachHD.php';
                $active="#danhsachHD{color: #00FFFF;}";
                break;

            case 'themHD':
                include_once './QuanLyHoaDon/themHD.php';
                $active="#danhsachHD{color: #00FFFF;}";
                break;

            case 'suaHD':
                include_once './QuanLyHoaDon/suaHD.php';
                $active="#danhsachHD{color: #00FFFF;}";
                break;

            case 'xoaHD':
                include_once './QuanLyHoaDon/xoaHD.php';
                $active="#danhsachHD{color: #00FFFF;}";
                break;
                
            // case 'themanh':
            //     include_once 'Themanh.php';
            //     $active="#themanh{color: #00FFFF;}";
            //     break;
        }
    }else {
        include_once './QuanLyNhanVien/danhsachNV.php';
        $active="#danhsachNV{color: #00FFFF;}";
    }
        
    
    include_once 'footer.php';
    
}else{
    header("Location: login.php");
}
?>


                