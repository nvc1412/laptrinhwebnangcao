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
            background-color: rgb(45, 119, 238);
        }
    </style>
</head>
<body>

    <div style="padding-left: 100px;padding-right: 100px">
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
                        <a class="navbar-brand" href="#">--- Menu ---</a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse re-navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="#" style="pointer-events: none"><img src="./img/icon/logo1.png" alt="" class="img-responsive"></a></li>
                            <li class="active"><a href="#"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> HOME<span class="sr-only">(current)</span></a></li>
                            <li><a href="#">Cửa hàng</a></li>
                            <li><a href="#">Tin tức</a></li>
                            <li><a href="#">Liên hệ</a></li>
                            <li style="padding-top: 7px;margin-left: 10px">
                                <form method="post" action="">
                                    <button class="btn-search_info" type="submit"><i class="fa fa-search"></i></button>
                                    <input id="seach_info" type="text" name="search" placeholder="Tìm kiếm..">
                                </form>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-shopping-cart"><span class="badge">0</span></span> Giỏ Hàng<span class="caret"></span></a>
                                <ul class="dropdown-menu" style="min-width: 300px;">
                                    <p style="color:red;font-weight: bold;float: right;padding-right: 30px">Không có sản phẩm trong giỏ hàng</p>
                                </ul>
                            </li>
                            <li><a href="#">Đăng nhập</a></li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </div>
    </div>