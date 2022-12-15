
<?php
$ten = $hang = $danhmuc = $anh =  $anhphu1 = $anhphu2 = $gia = $thongtin = "";
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Lấy tham số URL
    $id =  trim($_GET["id"]);
    
    $sql = "SELECT * FROM sanpham WHERE id = $id";
    if($result = mysqli_query($conn, $sql)){
        //Đổ dữ liệu sản phẩm
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $ten = $row["TenSP"];
                $hang = $row["HangSP"];
                $danhmuc = $row["DanhMucSP"];
                $anh = $row["AnhSP"];
                $anhphu1 = $row["AnhPhu1"];
                $anhphu2 = $row["AnhPhu2"];
                $gia = $row["GiaSP"];
                $thongtin = $row["ThongtinSP"]; 
            }
    
            // Giải phóng bộ nhớ
            mysqli_free_result($result);
        } else{
            echo "<p class='lead'><em>Không tìm thấy bản ghi.</em></p>";
        }
    } else{
        echo "ERROR: Không thể thực thi $sql. " . mysqli_error($conn);
    }

    // Đóng kết nối
    mysqli_close($conn);


    // PHAN NAY BI LOI CHO $result = mysqli_stmt_get_result($stmt); KHONG THUC HIEN DUOC!!!
    // // Chuẩn bị câu lệnh select
    // $sql = "SELECT * FROM sanpham WHERE id = ?";
    // if($stmt = mysqli_prepare($conn, $sql)){
    //     // Liên kết các biến với câu lệnh đã chuẩn bị
    //     mysqli_stmt_bind_param($stmt, "i", $param_id);
        
    //     // Thiết lập tham số
    //     $param_id = $id;
        
    //     // Cố gắng thực thi câu lệnh đã chuẩn bị
    //     if(mysqli_stmt_execute($stmt)){
    //         $result = mysqli_stmt_get_result($stmt);

    //         if(mysqli_num_rows($result) == 1){
    //             /* Lấy hàng kết quả dưới dạng một mảng kết hợp. Vì tập kết quả chỉ chứa một hàng, chúng ta không cần sử dụng vòng lặp while */
    //             $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
    //             // Lấy giá trị trường riêng lẻ
    //             $ten = $row["TenSP"];
    //             $hang = $row["HangSP"];
    //             $danhmuc = $row["DanhMucSP"];
    //             $anh = $row["AnhSP"];
    //             $anhphu1 = $row["AnhPhu1"];
    //             $anhphu2 = $row["AnhPhu2"];
    //             $gia = $row["GiaSP"];
    //             $thongtin = $row["ThongtinSP"];
    //         } else{
    //             // URL không có id hợp lệ. Chuyển hướng đến trang error
    //             header("location: error.php");
    //             exit();
    //         }
            
    //     } else{
    //         echo "Oh, no. Có gì đó sai sai. Vui lòng thử lại.";
    //     }
    // }
    
    // // Đóng câu lệnh
    // mysqli_stmt_close($stmt);
    
    // // Đóng kết nối
    // mysqli_close($conn);
}  else{
    // URL không chứa tham số id. Chuyển hướng đến trang error
    header("location: error.php");
    exit();
}
?>


<style type="text/css">
   .cus-color{
        background: #2d77ee !important;
   }
</style>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearpadding" style="margin-top: 15px;">
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 clearpaddingl">
                <div class="panel panel-info" style="margin-bottom: 5px;">
                    <div class="panel-heading" style="background-color: #f2f2f2;color: #111">
                        <h3 class="panel-title">TÌM KIẾM</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal text-center" method="post" action="#">
                            <div class="form-group form-group-sm">
                                <label class="col-sm-5 clearpaddingl control-label" for="formGroupInputSmall">Hãng</label>
                                <div class="col-sm-7" style="padding-left: 0px">
                                    <select class="form-control" name="catalog_id">
                                        <option value="7" style="font-weight: bold" selected="">KANGAROO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="col-sm-5 control-label" for="formGroupInputSmall">Giá từ:</label>
                                <div class="col-sm-7" style="padding-left: 0px">
                                    <select class="form-control" name="price_from">
                                        <option value="0" selected="">0 VNĐ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-group-sm">
                                <label class="col-sm-5 control-label" for="formGroupInputSmall">đến:</label>
                                <div class="col-sm-7" style="padding-left: 0px">
                                    <select class="form-control" name="price_to">
                                        <option value="100000" selected>100,000 VNĐ</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-info" type="submit" name="submit"><i class="fa fa-search"></i> Tìm kiếm</button>
                        </form>
                    </div>
                </div>
                <div class="panel panel-info">
                    <div class="panel-body" style="padding:0px">
                        <div class="list-group">
                            <div class="list-group">
                                <button class="list-group-item dropdown-btn">
                                <a href="#" class="">Danh mục sản phẩm</a>
                                <i class="fa fa-caret-down"></i>
                                </button>
                                <div class="dropdown-container" style="display: none;">
                                    <a href="#" class="list-group-item">Nồi cơm điện</a>
                                    <a href="#" class="list-group-item">Bếp gas</a>
                                    <a href="#" class="list-group-item">Bếp từ</a>
                                    <a href="#" class="list-group-item">Xoong</a>
                                    <a href="#" class="list-group-item">Chảo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
                var dropdown = document.getElementsByClassName("dropdown-btn");
                var i;
                
                for (i = 0; i < dropdown.length; i++) {
                    dropdown[i].addEventListener("click", function () {
                        this.classList.toggle("active");
                        var dropdownContent = this.nextElementSibling;
                        if (dropdownContent.style.display === "block") {
                            dropdownContent.style.display = "none";
                        } else {
                            dropdownContent.style.display = "block";
                        }
                    });
                }
            </script>                    
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 clearpaddingr">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearpadding">
                    <ol class="breadcrumb">
                        <li>
                            <a href="#">
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                                Cửa hàng
                            </a>
                        </li>
                        <li class="active">Chi tiết sản phẩm</li>
                    </ol>


                    <!-- zoom image -->
                    <script src="./js/jqzoom_ev/js/jquery.jqzoom-core.js" type="text/javascript"></script>
                    <link rel="stylesheet" href="./js/jqzoom_ev/css/jquery.jqzoom.css" type="text/css">
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.jqzoom').jqzoom({
                                zoomType: 'standard',
                            });
                        });
                    </script>
                    <!--         end zoom image -->
                    <script type="text/javascript">
                        $(document).ready(function () {
                            //raty
                            $('.raty_detailt').raty({
                                score: function () {
                                    return $(this).attr('data-score');
                                },
                                half: true,
                                click: function (score, evt) {
                                }
                            });
                        });
                    </script>
                    <!--        End Raty -->

                    <div class="panel panel-info " style="margin-top: 20px;margin-bottom: 15px;background-color: #ffffff">
                        


                        <div class="panel panel-info ">
                            <div class="panel-heading cus-color">
                                <h3 class="panel-title">Xem chi tiết sản phẩm</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <div class="text-center">
                                        <a href="<?php echo './img/sanpham/'.$anh ?>" class="jqzoom" rel="gal1" title="triumph">
                                        <img  src="<?php echo './img/sanpham/'.$anh ?>" alt="" style="max-width:380px;max-height: 500px">
                                        </a>
                                        <div class="clearfix"></div>
                                        <ul id="thumblist" style="margin-top: 20px;">
                                            <li >
                                                <a class="zoomThumbActive" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo './img/sanpham/'.$anh ?>',largeimage: '<?php echo './img/sanpham/'.$anh ?>'}">
                                                <img src='<?php echo './img/sanpham/'.$anh ?>'>
                                                </a>
                                            </li>
                                            <li>
                                                <a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo './img/sanpham/'.$anhphu1 ?>',largeimage: '<?php echo './img/sanpham/'.$anhphu1 ?>'}">
                                                <img src='<?php echo './img/sanpham/'.$anhphu1 ?>'>
                                                </a>
                                            </li>
                                            <li>
                                                <a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo './img/sanpham/'.$anhphu2 ?>',largeimage: '<?php echo './img/sanpham/'.$anhphu2 ?>'}">
                                                <img src='<?php echo './img/sanpham/'.$anhphu2 ?>'>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" style="padding: 10px">
                                    <h1 style="font-size: 22px;text-transform:uppercase;color: #111111;font-weight:bold;"><?php echo $ten?></h1>
                                    <p>&nbsp;Mô tả ngắn sản phẩm:</p>
                                    <p><?php echo $thongtin ?></p>
                                    <p>Hãng: <span style="font-weight: bold;color: green"><?php echo $hang ?></span></p>
                                    <p>Danh mục: <span style="font-weight: bold;color: blue"><?php echo $danhmuc ?></span></p>
                                    <h4 style="margin-top: 15px">Giá: <span style="font-weight: bold;color: red"><?php echo number_format($gia) ?> VNĐ</span></h4>
                                    <p>Số lượt xem: 32</p>
                                    <p> Đánh giá: &nbsp;
                                        <span> 4 / </span><b class="rate_count">5</b>
                                        <i class="fa fa-star" style="color: gold"></i>
                                        <i class="fa fa-star" style="color: gold"></i>
                                        <i class="fa fa-star" style="color: gold"></i>
                                        <i class="fa fa-star" style="color: gold"></i>
                                        <i class="fa fa-star-o" style="color: gold"></i>
                                    </p>
                                    <a href="ThemVaoGioHang.php?id=<?php echo $id ?>" class="btn btn-info"> Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </div>


                    </div>



                </div>
            </div>
        </div>
    </div>
</div>