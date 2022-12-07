<?php
// Include file config.php
require_once "config.php";
 
// Xác định các biến và khởi tạo với các giá trị trống
$ten = $hang = $anh = $gia = $thongtin = "";
$ten_err = $hang_err = $anh_err = $gia_err = $thongtin_err = "";
 
// Xử lý dữ liệu biểu mẫu khi biểu mẫu được gửi
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Lấy dữ liệu đầu vào
    $id = $_POST["id"];
    
    // Xác thực tên
    $input_ten = trim($_POST["ten"]);
    if(empty($input_ten)){
        $ten_err = "* Vui lòng điền tên.";
    } else{
        $ten = $input_ten;
    }
    
    // Xác thực địa chỉ
    $input_hang = trim($_POST["hang"]);
    if(empty($input_hang)){
        $hang_err = "* Vui lòng điền hãng.";     
    } else{
        $hang = $input_hang;
    }

    // Xác thực ảnh
    $input_anh = trim($_FILES["anh"]["name"]);
    if(empty($input_anh)){
        $anh = $_POST["anh"];     
    } else{
        $anh = $input_anh;
    }
    
    // Xác thực giá
    $input_gia = trim($_POST["gia"]);
    if(empty($input_gia) && $input_gia != 0 ){
        $gia_err = "* Vui lòng điền giá.";
        echo $input_gia;     
    } elseif(!ctype_digit($input_gia)){
        $gia_err = "* Vui lòng điền giá phải là số.";
    } else{
        $gia = $input_gia;
    }

    // Xác thực thông tin
    $input_thongtin = trim($_POST["thongtin"]);
    if(empty($input_thongtin)){
        $thongtin_err = "* Vui lòng điền thông tin.";     
    } else{
        $thongtin = $input_thongtin;
    }
    
    // Kiểm tra lỗi đầu vào trước khi chèn vào cơ sở dữ liệu
    if(empty($ten_err) && empty($hang_err) && empty($anh_err) && empty($gia_err) && empty($thongtin_err) ){

        $target_dir = "../img/sanpham/";
        $target_file = $target_dir . basename($_FILES["anh"]["name"]);

        // Chuẩn bị câu lệnh Update
        $sql = "UPDATE sanpham SET TenSP=?, HangSP=?, AnhSP=?, GiaSP=?, ThongtinSP=? WHERE id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Liên kết các biến với câu lệnh đã chuẩn bị
            mysqli_stmt_bind_param($stmt, "sssssi", $param_ten, $param_hang, $param_anh, $param_gia, $param_thongtin, $param_id);
            
            // Thiết lập tham số
            $param_ten = $ten;
            $param_hang = $hang;
            $param_anh = $anh;
            $param_gia = $gia;
            $param_thongtin = $thongtin;
            $param_id = $id;
            
            // Cố gắng thực thi câu lệnh đã chuẩn bị
            if(mysqli_stmt_execute($stmt)){
                // Update thành công. Chuyển hướng đến trang đích
                move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file);

                echo "<script> location.href = 'quantri.php?page_layout=danhsachSP'; </script>";
                exit();
            } else{
                echo "Oh, no. Có gì đó sai sai. Vui lòng thử lại.";
            }
        }
         
        // Đóng câu lệnh
        mysqli_stmt_close($stmt);
    }
    
    // Đóng két nối
    mysqli_close($conn);
} else{
    // Kiểm tra sự tồn tại của tham số id trước khi xử lý thêm
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Lấy tham số URL
        $id =  trim($_GET["id"]);
        
        // Chuẩn bị câu lệnh select
        $sql = "SELECT * FROM sanpham WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            // Liên kết các biến với câu lệnh đã chuẩn bị
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Thiết lập tham số
            $param_id = $id;
            
            // Cố gắng thực thi câu lệnh đã chuẩn bị
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Lấy hàng kết quả dưới dạng một mảng kết hợp. Vì tập kết quả chỉ chứa một hàng, chúng ta không cần sử dụng vòng lặp while */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Lấy giá trị trường riêng lẻ
                    $ten = $row["TenSP"];
                    $hang = $row["HangSP"];
                    $anh = $row["AnhSP"];
                    $gia = $row["GiaSP"];
                    $thongtin = $row["ThongtinSP"];
                } else{
                    // URL không có id hợp lệ. Chuyển hướng đến trang error
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oh, no. Có gì đó sai sai. Vui lòng thử lại.";
            }
        }
        
        // Đóng câu lệnh
        mysqli_stmt_close($stmt);
        
        // Đóng kết nối
        mysqli_close($conn);
    }  else{
        // URL không chứa tham số id. Chuyển hướng đến trang error
        header("location: error.php");
        exit();
    }
}
?>

<div style="width: 500px; margin: 0 auto;" class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Cập nhật tài khoản</h2>
                </div>
                <p>Điền thông tin tài khoản để sửa trong CSDL.</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group <?php echo (!empty($ten_err)) ? 'has-error' : ''; ?>">
                        <label>Tên</label>
                        <input type="text" name="ten" class="form-control" value="<?php echo $ten; ?>">
                        <span class="help-block text-danger"><?php echo $ten_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($hang_err)) ? 'has-error' : ''; ?>">
                        <label>Hãng</label>
                        <input type="text" name="hang" class="form-control" value="<?php echo $hang; ?>">
                        <span class="help-block text-danger"><?php echo $hang_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($anh_err)) ? 'has-error' : ''; ?>">
                        <label>Ảnh sản phẩm</label><br>
                        <input type="file" name="anh">
                        <input type="hidden" name="anh" value="<?php echo $anh; ?>">
                        <br><span class="help-block text-danger"><?php echo $anh_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($gia_err)) ? 'has-error' : ''; ?>">
                        <label>Giá</label>
                        <input type="text" name="gia" class="form-control" value="<?php echo $gia; ?>">
                        <span class="help-block text-danger"><?php echo $gia_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($thongtin_err)) ? 'has-error' : ''; ?>">
                        <label>Thông Tin</label>
                        <input type="text" name="thongtin" class="form-control" value="<?php echo $thongtin; ?>">
                        <span class="help-block text-danger"><?php echo $thongtin_err;?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="submit" class="btn btn-primary" value="Cập Nhật">
                    <a href="quantri.php?page_layout=danhsachSP" class="btn btn-success">Cancel</a>
                </form>
            </div>
        </div>        
    </div>
</div>