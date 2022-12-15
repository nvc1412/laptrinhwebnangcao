<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Shop Online</title>
    <link rel = "icon" href = "./img/icon/logo.png"  type = "image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<script src="./js/jquery-3.1.1.js" type="text/javascript"></script>
	<script src="./js/jquery.jcarousel.pack.js" type="text/javascript"></script>
	<script src="./js/jquery-func.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .btn-info{
            background-color: rgb(45, 119, 238);
        }
        .badge{
            background-color: rgb(94 239 14);
        }
        .top-header {
            width: 100%;
            padding: 10px 0px;
            margin-bottom: 3px;
            background-color: black;
            color: #ffffff;
        }
        .top-header a{
            color: #ffffff;
        }
        .top-header a:hover{
            color: #bb1919;
        }
        .container-wrapper {
            max-width: 99%;
            margin: 0 auto;
            padding-left: 15px;
            padding-right: 15px;
        }
        .top-bar-flex {
            display: flex;
            align-items: center;
        }
        .top-bar-menu-left{
            flex: 3;
            width: 100%;
            display: flex;
            justify-content: space-evenly;
            list-style: none;
            margin: 0 auto;
        }
        .top-bar-menu-right{
            flex: 1;
            width: 100%;
            display: flex;
            justify-content: start;
            list-style: none;
            margin: 0 auto;
        }
        .top-bar-menu-right li{
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <div class="top-header">
        <div class="container-wrapper">
            <div class="top-bar-flex">
                <ul class="top-bar-menu-left">
                    <li>
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        <span>235 Hoàng Quốc Việt, Cổ Nhuế, Bắc Từ Liêm, Hà Nội</span>
                    </li>
                    <li>
                        <i class="fa fa-phone-square" aria-hidden="true"></i>
                        <a href="tel:+84 365 042 941">+84 365 042 941</a>
                    </li>
                    <li>
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <a href="mailto:nvc14122002@gmail.com">nvc14122002@gmail.com</a>
                    </li>
                </ul>
                <ul class="top-bar-menu-right">
                    <li><a href="https://www.facebook.com/profile.php?id=100027148500368"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://www.youtube.com/channel/UCu_KokLnFiSEMNJntWUu7jg"><i class="fa fa-youtube"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                    <li><a href="https://github.com/nvc1412/laptrinhwebnangcao"><i class="fa fa-github"></i></a></li>
                </ul>
            </div>
        </div>
    </div>


    <div style="padding: 0 100px;">
        <div class="row">
            <nav class="navbar navbar-info re-navbar" >
                <div class="container-fluid re-container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">--- Menu ---</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse re-navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="index.php?page_layout=Home" style="pointer-events: none"><img src="./img/icon/logo1.png" alt="" class="img-responsive"></a></li>
                            <li id="Home"><a href="index.php?page_layout=Home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> HOME<span class="sr-only">(current)</span></a></li>
                            <li id="CuaHang"><a href="index.php?page_layout=CuaHang">Cửa hàng</a></li>
                            <li id="TroGiup"><a href="index.php?page_layout=TroGiup">Trợ giúp</a></li>
                            <li id="LienHe"><a href="index.php?page_layout=LienHe">Liên hệ</a></li>
                            <li style="padding-top: 7px;margin-left: 10px">
                                <form method="post" action="index.php?page_layout=DanhSachTimKiem">
                                    <button class="btn-search_info" type="submit"><i class="fa fa-search"></i></button>
                                    <input required id="seach_info" type="text" name="search" placeholder="Tìm kiếm...">
                                </form>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <!-- <li id="GioHang" class="dropdown">
                                <a href="index.php?page_layout=GioHang" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-shopping-cart"><span class="badge">0</span></span> Giỏ Hàng<span class="caret"></span></a>
                                <ul class="dropdown-menu" style="min-width: 300px;">
                                    <p style="color:red;font-weight: bold;float: right;padding-right: 30px">Không có sản phẩm trong giỏ hàng</p>
                                </ul>
                            </li> -->
                            <li id="GioHang"><a href="index.php?page_layout=GioHang">
                                <span class="glyphicon glyphicon-shopping-cart">
                                    <span class="badge">
                                        <?php 
                                            if(isset($_SESSION['giohang'])) {
                                                echo count($_SESSION['giohang']);
                                            } else {
                                                echo 0;
                                            }
                                        ?>
                                    </span>
                                </span> Giỏ Hàng</a>
                            </li>
                            <li id="DangNhap"><a href="index.php?page_layout=DangNhap">Đăng nhập</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </div>
    </div>