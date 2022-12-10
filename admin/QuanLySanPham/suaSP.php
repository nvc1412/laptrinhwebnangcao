<?php
// Include file config.php
require_once "config.php";
 
// Xác định các biến và khởi tạo với các giá trị trống
$ten = $hang = $danhmuc = $anh =  $anhphu1 = $anhphu2 = $gia = $thongtin = "";
$ten_err = $hang_err = $danhmuc_err = $anh_err = $anhphu1_err = $anhphu2_err = $gia_err = $thongtin_err = "";
 
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
    
    // Xác thực hãng
    $input_hang = trim($_POST["hang"]);
    if(empty($input_hang)){
        $hang_err = "* Vui lòng điền hãng.";     
    } else{
        $hang = $input_hang;
    }

    // Xác thực danh mục
    $input_danhmuc = trim($_POST["danhmuc"]);
    if(empty($input_danhmuc)){
        $danhmuc_err = "* Vui lòng điền danh mục.";     
    } else{
        $danhmuc = $input_danhmuc;
    }

    // Xác thực ảnh
    $input_anh = trim($_FILES["anh"]["name"]);
    if(empty($input_anh)){
        $anh = $_POST["anh"];     
    } else{
        $anh = $input_anh;
    }

    // Xác thực ảnh phụ 1
    $input_anhphu1 = trim($_FILES["anhphu1"]["name"]);
    if(empty($input_anhphu1)){
        $anhphu1 = $_POST["anhphu1"];     
    } else{
        $anhphu1 = $input_anhphu1;
    }

    // Xác thực ảnh phụ 2
    $input_anhphu2 = trim($_FILES["anhphu2"]["name"]);
    if(empty($input_anhphu2)){
        $anhphu2 = $_POST["anhphu2"];     
    } else{
        $anhphu2 = $input_anhphu2;
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
    if(empty($ten_err) && empty($hang_err) && empty($danhmuc_err) && empty($anh_err) && empty($anhphu1_err) && empty($anhphu2_err) && empty($gia_err) && empty($thongtin_err) ){
        $target_dir = "../img/sanpham/";
        $target_file = $target_dir . basename($_FILES["anh"]["name"]);
        $target_file1 = $target_dir . basename($_FILES["anhphu1"]["name"]);
        $target_file2 = $target_dir . basename($_FILES["anhphu2"]["name"]);

        // Chuẩn bị câu lệnh Update
        $sql = "UPDATE sanpham SET TenSP=?, HangSP=?, DanhMucSP=?, AnhSP=?, AnhPhu1=?, AnhPhu2=?, GiaSP=?, ThongtinSP=? WHERE id=?";

        if($stmt = mysqli_prepare($conn, $sql)){
            // Liên kết các biến với câu lệnh đã chuẩn bị
            mysqli_stmt_bind_param($stmt, "ssssssssi", $param_ten, $param_hang, $param_danhmuc, $param_anh, $param_anhphu1, $param_anhphu2, $param_gia, $param_thongtin, $param_id);
            
            // Thiết lập tham số
            $param_ten = $ten;
            $param_hang = $hang;
            $param_danhmuc = $danhmuc;
            $param_anh = $anh;
            $param_anhphu1 = $anhphu1;
            $param_anhphu2 = $anhphu2;
            $param_gia = $gia;
            $param_thongtin = $thongtin;
            $param_id = $id;
            
            // Cố gắng thực thi câu lệnh đã chuẩn bị
            if(mysqli_stmt_execute($stmt)){
                // Update thành công. Chuyển hướng đến trang đích
                move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file);
                move_uploaded_file($_FILES["anhphu1"]["tmp_name"], $target_file1);
                move_uploaded_file($_FILES["anhphu2"]["tmp_name"], $target_file2);

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
                    $danhmuc = $row["DanhMucSP"];
                    $anh = $row["AnhSP"];
                    $anhphu1 = $row["AnhPhu1"];
                    $anhphu2 = $row["AnhPhu2"];
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
                    <div class="form-group <?php echo (!empty($danhmuc_err)) ? 'has-error' : ''; ?>">
                        <label>Danh mục</label>
                        <input type="text" name="danhmuc" class="form-control" value="<?php echo $danhmuc; ?>">
                        <span class="help-block text-danger"><?php echo $danhmuc_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($anh_err)) ? 'has-error' : ''; ?>">
                        <label>Ảnh sản phẩm</label><br>
                        <input type="file" name="anh">
                        <input type="hidden" name="anh" value="<?php echo $anh; ?>">
                        <br><span class="help-block text-danger"><?php echo $anh_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($anhphu1_err)) ? 'has-error' : ''; ?>">
                        <label>Ảnh phụ 1</label><br>
                        <input type="file" name="anhphu1">
                        <input type="hidden" name="anhphu1" value="<?php echo $anhphu1; ?>">
                        <br><span class="help-block text-danger"><?php echo $anhphu1_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($anhphu2_err)) ? 'has-error' : ''; ?>">
                        <label>Ảnh phụ 2</label><br>
                        <input type="file" name="anhphu2">
                        <input type="hidden" name="anhphu2" value="<?php echo $anhphu2; ?>">
                        <br><span class="help-block text-danger"><?php echo $anhphu2_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($gia_err)) ? 'has-error' : ''; ?>">
                        <label>Giá</label>
                        <input type="text" name="gia" class="form-control" value="<?php echo $gia; ?>">
                        <span class="help-block text-danger"><?php echo $gia_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($thongtin_err)) ? 'has-error' : ''; ?>">
                        <label>Thông Tin</label>
                        <textarea row="5" name="thongtin" class="form-control" value=""><?php echo $thongtin; ?></textarea>
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