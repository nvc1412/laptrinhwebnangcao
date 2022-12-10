<?php

    if(isset($_POST['submit'])){

        $arrID = array();
        foreach($_SESSION['giohang'] as $id=>$soluong){
            $arrID[] = $id;
        }
        $strID = implode(',', $arrID);
        $sql = "SELECT * FROM sanpham WHERE id IN($strID) ORDER BY id DESC";
        $query = mysqli_query($conn, $sql);

        $ten = $_POST['ten'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $dc = $_POST['dc'];

        if(isset($ten) && isset($sdt) && isset($email) && isset($dc)){
            // Chuẩn bị một câu lệnh insert
            $sql1 = "INSERT INTO hoadon(`masp`, `tensp`, `soluong`, `tenkh`, `sdt`, `trangthai`) VALUES (?, ?, ?, ?, ?, 'chờ xác nhận')";
            
            if($stmt = mysqli_prepare($conn, $sql1)){
                // Liên kết các biến với câu lệnh đã chuẩn bị
                mysqli_stmt_bind_param($stmt, "sssss", $param_masp, $param_tensp, $param_soluong, $param_tenkh, $param_sdt);
                
                // Thiết lập tham số
                $param_tenkh = $ten;
                $param_sdt = $sdt;


                foreach($_SESSION['giohang'] as $id=>$soluong){
                    while($row = mysqli_fetch_array($query)){
                        $param_masp = $row['id'];
                        $param_tensp = $row['TenSP'];
                        $param_soluong = $_SESSION['giohang'][$row['id']];

                        // Cố gắng thực thi câu lệnh đã chuẩn bị
                        mysqli_stmt_execute($stmt);
                    }
                }
                unset($_SESSION["giohang"]);
                echo "<script> alert('Tạo hóa đơn thành công!'); location.href = 'index.php?page_layout=GioHang'; </script>";
                
            }
            
            // Đóng câu lệnh
            mysqli_stmt_close($stmt);
        }
        // Đóng kết nối
        mysqli_close($conn);
    }

?>


<style type="text/css">
   .pagination{
      width: 100%;
      display: flex;
      justify-content: flex-end;
   }
   /* thiết lập style cho thẻ a */
   .pagination a {
      color: black;
      margin: 0 1px;
      border: 1px solid;
      float: left;
      padding: 8px 16px;
      text-decoration: none;
      transition: background-color .3s;
   }
   /* thiết lập style cho class active */
   .pagination a.active {
      background-color: dodgerblue;
      color: white;
   }
   /* thêm màu nền khi người dùng hover vào class không active */
   .pagination a:hover:not(.active) {
      background-color: #ddd;
   }

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
                            <a href="index.php?page_layout=GioHang">
                                <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                                Giỏ hàng
                            </a>
                        </li>
                        <li class="active">Chi tiết giỏ hàng</li>
                    </ol>




                    <div class="panel panel-info " style="margin-top: 20px;margin-bottom: 15px;background-color: #ffffff">
                        <div class="panel-heading cus-color">
                            <h3 class="panel-title">Xác nhận thanh toán</h3>
                        </div>

                        <?php
                        if(isset($_SESSION['giohang'])){ 
                            if(isset($_POST['sl'])){
                                foreach ($_POST['sl'] as $id=>$sl){
                                    if($sl<=0){
                                        $_SESSION['giohang'][$id] = 1;
                                    }
                                    else if($sl>0){
                                        $_SESSION['giohang'][$id] = $sl;
                                    }
                                }
                            }


                            $arrID = array();
                            foreach($_SESSION['giohang'] as $id=>$soluong){
                                $arrID[] = $id;
                            }
                            $strID = implode(',', $arrID);
                            $sql = "SELECT * FROM sanpham WHERE id IN($strID) ORDER BY id DESC";
                            $query = mysqli_query($conn, $sql);


                        ?>

                        <!-- Nếu có sản phẩm -->
                        <div class="panel-body" style="background-color: #ffffff">
                            <form id="giohang" method="post">
                                <table class="table table-hover">
                                    <thead style="background-color: rgb(15 155 104);color: #fff;font-size: 14px">
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Hình ảnh</th>
                                            <th style="text-align: center">Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    
                                    <?php
                                        $stt = 1;
                                        $tongtien = 0;
                                        while($row = mysqli_fetch_array($query)){
                                            $thanhtien = $row['GiaSP']*$_SESSION['giohang'][$row['id']];
                                            $tongtien+=$thanhtien;
                                        
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $stt; $stt+=1; ?></td>
                                            <td><?php echo $row['TenSP'] ?></td>
                                            <td><img src="./img/sanpham/<?php echo $row['AnhSP'] ?>" class="img-thumbnail" alt="" style="width: 50px;"></td>
                                            <td style="min-width: 150px;text-align: center">
                                                <input readonly name="sl[<?php echo $row['id']; ?>]" type="text" value="<?php echo $_SESSION['giohang'][$row['id']] ?>" style="width: 30px;text-align: center;">
                                            </td>
                                            <td><?php echo number_format($thanhtien) ?> VNĐ</td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="4">Tổng tiền</td>
                                            <td style="font-weight: bold;color:green"><?php echo number_format($tongtien) ?> VNĐ</td>
                                        </tr>
                                    </tbody>
                                    
                                </table>
                            </form>
                        </div>


                        <form method="post" >
                            <table class="table" id="order_info">
                                <tbody>
                                    <tr>
                                        <td style="width: 100px">Họ và tên</td>
                                        <td><input required style="min-width: 200px" type="text" value="<?php ?>" name="ten" ><?php ?></td>
                                    </tr>
                                    <tr>
                                        <td>Số điện thoại</td>
                                        <td><input required style="min-width: 200px" name="sdt" type="text" value="<?php ?>"><?php  ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><input required style="min-width: 200px" name="email" type="text" value="<?php ?>"><?php  ?></td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ</td>
                                        <td><input required style="min-width: 200px" name="dc" type="text" value="<?php ?>"><?php ?></td>
                                    </tr>

                                    <tr>
                                        <td >Tổng tiền hàng</td>
                                        <td>
                                            <span class="money" ><?php echo number_format($tongtien) ?></span>
                                        </td>
                                        <td>VNĐ</td>
                                    </tr>

                                    <tr>
                                        <td>Phí ship</td>
                                        <td>
                                            <span id="ship_label"> 0</span>

                                        </td>
                                        <td>VNĐ<input style="max-width: 100px" type="hidden" name="ship_money" id="ship_money" value="0" ></td>
                                    </tr>

                                    <tr>
                                        <td>THANH TOÁN</td>
                                        <td style="font-size: 23px; color: red;max-width: 50px">
                                            <span id="total_amount" ><?php echo number_format($tongtien) ?></span>
                                        </td>
                                        <td>VNĐ</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                </tbody>
                            </table>
                            <div class="col-lg-8">
                                <div class="col-lg-5"><image style="width: 100%; height: 100%" src="./img/icon/vanchuyen.png" /></div>
                                <div class="col-lg-5">Đơn vị vận chuyển<p>GHN - Giao hàng nhanh toàn quốc</p></div>
                            </div>
                            <button name="submit" style="min-width: 100px;float: right;margin-top: 50px" type="submit" class="btn btn-success">Xác nhận</button>
                        </form>


                        <?php } else { ?>

                        <!-- Nếu không có sản phẩm -->
                        <div class="panel-body">
                            <div class="text-center">
                                <img src="./img/icon/giohangrong.png" alt="">
                                <h4 style="color:red">Không có sản phẩm để thanh toán</h4>
                                <a href="index.php?page_layout=CuaHang" class="btn btn-info">Mua sắm</a>
                            </div>
                        </div>

                        <?php } ?>

                    </div>



                </div>
            </div>
        </div>
    </div>
</div>