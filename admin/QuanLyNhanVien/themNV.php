<?php

if(isset($_SESSION["logged"]) && $_SESSION["logged"] == 1){

    // Include file config.php
    require_once "config.php";
    
    // Xác định các biến và khởi tạo các giá trị trống
    $hoten = $ngaysinh = $diachi = $gioitinh = $anh = "";
    $hoten_err = $ngaysinh_err = $diachi_err = $gioitinh_err = $anh_err = "";
    
    // Xử lý dữ liệu biểu mẫu khi biểu mẫu được gửi
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Xác thực tên
        $input_hoten = trim($_POST["hoten"]);
        if(empty($input_hoten)){
            $hoten_err = "* Vui lòng điền họ tên.";
        } else{
            $hoten = $input_hoten;
        }

        // Xác thực ngày sinh
        $input_ngaysinh = trim($_POST["ngaysinh"]);
        if(empty($input_ngaysinh)){
            $ngaysinh_err = "* Vui lòng điền ngày sinh.";     
        } else{
            $ngaysinh = $input_ngaysinh;
        }
        
        // Xác thực địa chỉ
        $input_diachi = trim($_POST["diachi"]);
        if(empty($input_diachi)){
            $diachi_err = "* Vui lòng điền địa chỉ.";     
        } else{
            $diachi = $input_diachi;
        }

        // Xác thực giới tính
        $input_gioitinh = trim($_POST["gioitinh"]);
        if(empty($input_gioitinh)){
            $gioitinh_err = "* Vui lòng chọn giới tính.";
            echo $input_gioitinh;
        } else{
            $gioitinh = $input_gioitinh;
        }

        // Xác thực ảnh
        $input_anh = trim($_FILES["anh"]["name"]);
        if(empty($input_anh)){
            $anh_err = "* Vui lòng chọn file ảnh.";     
        } else{
            $anh = $input_anh;
        }
        
        
        // Kiểm tra lỗi đầu vào trước khi chèn vào cơ sở dữ liệu
        if(empty($hoten_err) && empty($ngaysinh_err) && empty($diachi_err) && empty($gioitinh_err) && empty($anh_err) ){
            $target_dir = "../img/nhanvien/";
            $target_file = $target_dir . basename($_FILES["anh"]["name"]);
            // Chuẩn bị một câu lệnh insert
            $sql = "INSERT INTO nhanvien(`tennv`, `ngaysinh`, `diachi`, `gioitinh`, `anh`) VALUES (?, ?, ?, ?, ?)";
            
            if($stmt = mysqli_prepare($conn, $sql)){
                // Liên kết các biến với câu lệnh đã chuẩn bị
                mysqli_stmt_bind_param($stmt, "sssss", $param_hoten, $param_ngaysinh, $param_diachi, $param_gioitinh, $param_anh);
                
                // Thiết lập tham số
                $param_hoten = $hoten;
                $param_ngaysinh = $ngaysinh;
                $param_diachi = $diachi;
                $param_gioitinh = $gioitinh;
                $param_anh = $anh;
                
                // Cố gắng thực thi câu lệnh đã chuẩn bị
                if(mysqli_stmt_execute($stmt)){
                    // Tạo bản ghi thành công. Chuyển hướng đến trang đích
                    move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file);

                    echo "<script> location.href = 'quantri.php?page_layout=danhsachNV'; </script>";
                    exit();
                } else{
                    echo "Oh, no. Có gì đó sai sai. Vui lòng thử lại.";
                }
            }
            
            // Đóng câu lệnh
            mysqli_stmt_close($stmt);
        }
        
        // Đóng kết nối
        mysqli_close($conn);
    }
    ?>

    <div style="width: 500px; margin: 0 auto;" class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Thêm nhân viên</h2>
                    </div>
                    <p>Điền thông tin nhân viên</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" enctype="multipart/form-data" >
                        <div class="form-group <?php echo (!empty($ten_err)) ? 'has-error' : ''; ?>">
                            <label>Họ tên</label>
                            <input type="text" name="hoten" class="form-control" value="<?php echo $hoten; ?>">
                            <span class="help-block text-danger"><?php echo $hoten_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($ngaysinh_err)) ? 'has-error' : ''; ?>">
                            <label>Ngày sinh</label>
                            <input type="date" name="ngaysinh" class="form-control" value="<?php echo $ngaysinh; ?>">
                            <span class="help-block text-danger"><?php echo $ngaysinh_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($diachi_err)) ? 'has-error' : ''; ?>">
                            <label>Địa chỉ</label>
                            <input type="text" name="diachi" class="form-control" value="<?php echo $diachi; ?>">
                            <span class="help-block text-danger"><?php echo $diachi_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($gioitinh_err)) ? 'has-error' : ''; ?>">
                            <label>Giới tính</label>
                            <select class="form-control" name="gioitinh" id="sex">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Khác">Khác</option>
                            </select>
                            <span class="help-block text-danger"><?php echo $gioitinh_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($anh_err)) ? 'has-error' : ''; ?>">
                            <label>Ảnh 3x4</label><br>
                            <input type="file" name="anh" id="fileupload">
                            <br><span class="help-block text-danger"><?php echo $anh_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-success px-4" value="Gửi">
                        <a href="quantri.php?page_layout=danhsachNV" class="btn btn-primary">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>

<?php 
}else{
    header("Location: login.php");
} 
?>