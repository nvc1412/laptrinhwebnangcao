<?php
// Include file config.php
require_once "config.php";
 
// Xác định các biến và khởi tạo với các giá trị trống
$hoten = $ngaysinh = $diachi = $gioitinh = $anh = "";
$hoten_err = $ngaysinh_err = $diachi_err = $gioitinh_err = $anh_err = "";
 
// Xử lý dữ liệu biểu mẫu khi biểu mẫu được gửi
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Lấy dữ liệu đầu vào
    $id = $_POST["id"];

    
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
        $anh = $_POST["anh"];     
    } else{
        $anh = $input_anh;
    }
    
    // Kiểm tra lỗi đầu vào trước khi chèn vào cơ sở dữ liệu
    if(empty($hoten_err) && empty($ngaysinh_err) && empty($diachi_err) && empty($gioitinh_err) && empty($anh_err) ){

        $target_dir = "../img/nhanvien/";
        $target_file = $target_dir . basename($_FILES["anh"]["name"]);

        // Chuẩn bị câu lệnh Update
        $sql = "UPDATE nhanvien SET tennv=?, ngaysinh=?, diachi=?, gioitinh=?, anh=? WHERE id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Liên kết các biến với câu lệnh đã chuẩn bị
            mysqli_stmt_bind_param($stmt, "sssssi", $param_hoten, $param_ngaysinh, $param_diachi, $param_gioitinh, $param_anh, $param_id);
            
            // Thiết lập tham số
            $param_hoten = $hoten;
            $param_ngaysinh = $ngaysinh;
            $param_diachi = $diachi;
            $param_gioitinh = $gioitinh;
            $param_anh = $anh;
            $param_id = $id;
            
            // Cố gắng thực thi câu lệnh đã chuẩn bị
            if(mysqli_stmt_execute($stmt)){
                move_uploaded_file($_FILES["anh"]["tmp_name"], $target_file);
                // Update thành công. Chuyển hướng đến trang đích
                echo "<script> location.href = 'quantri.php?page_layout=danhsachNV'; </script>";
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
        

        $sql = "SELECT * FROM nhanvien WHERE id = $id";
        if($result = mysqli_query($conn, $sql)){
            //Đổ dữ liệu sản phẩm
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $hoten = $row["tennv"];
                    $ngaysinh = $row["ngaysinh"];
                    $diachi = $row["diachi"];
                    $gioitinh = $row["gioitinh"];
                    $anh = $row["anh"]; 
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
        // $sql = "SELECT * FROM nhanvien WHERE id = ?";
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
        //             $hoten = $row["tennv"];
        //             $ngaysinh = $row["ngaysinh"];
        //             $diachi = $row["diachi"];
        //             $gioitinh = $row["gioitinh"];
        //             $anh = $row["anh"];
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
}
?>

<div style="width: 500px; margin: 0 auto;" class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Cập nhật thông tin nhân viên</h2>
                </div>
                <p>Điền thông tin nhân viên để sửa trong CSDL.</p>
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
                            <option value="Nam" <?php if($row["gioitinh"]=="Nam"){echo "selected";}?> >Nam</option>
                            <option value="Nữ" <?php if($row["gioitinh"]=="Nữ"){echo "selected";}?> >Nữ</option>
                            <option value="Khác" <?php if($row["gioitinh"]=="Khác"){echo "selected";}?> >Khác</option>
                        </select>
                        <span class="help-block text-danger"><?php echo $gioitinh_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($anh_err)) ? 'has-error' : ''; ?>">
                        <label>Ảnh 3x4</label><br>
                        <input type="file" name="anh">
                        <input type="hidden" name="anh" value="<?php echo $anh; ?>">
                        <br><span class="help-block text-danger"><?php echo $anh_err;?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="submit" class="btn btn-success px-4" value="Cập nhật">
                    <a href="quantri.php?page_layout=danhsachNV" class="btn btn-primary">Cancel</a>
                </form>
            </div>
        </div>        
    </div>
</div>