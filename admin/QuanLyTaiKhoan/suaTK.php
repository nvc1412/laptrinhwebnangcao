<?php
// Include file config.php
require_once "config.php";
 
// Xác định các biến và khởi tạo với các giá trị trống
$name = $password = $is_admin = "";
$name_err = $password_err = $is_admin_err = "";
 
// Xử lý dữ liệu biểu mẫu khi biểu mẫu được gửi
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Lấy dữ liệu đầu vào
    $id = $_POST["id"];
    
    // Xác thực tên
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "* Vui lòng điền tên.";
    } else{
        $name = $input_name;
    }
    
    // Xác thực mật khẩu
    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "* Vui lòng điền mật khẩu.";     
    } else{
        $password = $input_password;
    }
    
    // Xác thực quyền
    $input_is_admin = trim($_POST["is_admin"]);
    if(empty($input_is_admin)  && $input_is_admin != 0){
        $is_admin_err = "* Vui lòng điền is_admin.";     
    } elseif(!ctype_digit($input_is_admin) ){
        $is_admin_err = "* Vui lòng điền is_admin phải là số.";
    } else{
        $is_admin = $input_is_admin;
    }
    
    // Kiểm tra lỗi đầu vào trước khi chèn vào cơ sở dữ liệu
    if(empty($name_err) && empty($password_err) && empty($is_admin_err)){
        // Chuẩn bị câu lệnh Update
        $sql = "UPDATE users SET name=?, password=?, is_admin=? WHERE id=?";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Liên kết các biến với câu lệnh đã chuẩn bị
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_password, $param_is_admin, $param_id);
            
            // Thiết lập tham số
            $param_name = $name;
            $param_password = $password;
            $param_is_admin = $is_admin;
            $param_id = $id;
            
            // Cố gắng thực thi câu lệnh đã chuẩn bị
            if(mysqli_stmt_execute($stmt)){
                // Update thành công. Chuyển hướng đến trang đích
                echo "<script> location.href = 'quantri.php?page_layout=danhsachTK'; </script>";
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
        
        $sql = "SELECT * FROM users WHERE id = $id";
        if($result = mysqli_query($conn, $sql)){
            //Đổ dữ liệu sản phẩm
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $name = $row["name"];
                    $password = $row["password"];
                    $is_admin = $row["is_admin"]; 
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
        // $sql = "SELECT * FROM users WHERE id = ?";
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
        //             $name = $row["name"];
        //             $password = $row["password"];
        //             $is_admin = $row["is_admin"];
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
                    <h2>Cập nhật tài khoản</h2>
                </div>
                <p>Điền thông tin tài khoản để sửa trong CSDL.</p>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block text-danger"><?php echo $name_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label>password</label>
                        <input type="text" name="password" class="form-control" value="<?php echo $password; ?>">
                        <span class="help-block text-danger"><?php echo $password_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($is_admin_err)) ? 'has-error' : ''; ?>">
                        <label>is_admin</label>
                        <input type="text" name="is_admin" class="form-control" value="<?php echo $is_admin; ?>">
                        <span class="help-block text-danger"><?php echo $is_admin_err;?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="submit" class="btn btn-primary" value="Cập Nhật">
                    <a href="quantri.php?page_layout=danhsachTK" class="btn btn-success">Cancel</a>
                </form>
            </div>
        </div>        
    </div>
</div>