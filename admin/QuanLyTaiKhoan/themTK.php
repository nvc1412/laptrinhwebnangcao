<?php

if(isset($_SESSION["logged"]) && $_SESSION["logged"] == 1){

    // Include file config.php
    require_once "config.php";
    
    // Xác định các biến và khởi tạo các giá trị trống
    $name = $password = $is_admin = "";
    $name_err = $password_err = $is_admin_err = "";
    
    // Xử lý dữ liệu biểu mẫu khi biểu mẫu được gửi
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Xác thực tên
        $input_name = trim($_POST["name"]);
        if(empty($input_name)){
            $name_err = "* Vui lòng điền tên.";
        // } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        //     $name_err = "* Vui lòng điền tên hợp lệ.";
        } else{
            $name = $input_name;
        }
        
        // Xác thực địa chỉ
        $input_password = trim($_POST["password"]);
        if(empty($input_password)){
            $password_err = "* Vui lòng điền mật khẩu.";     
        } else{
            $password = $input_password;
        }
        
        // Xác thực lương
        $input_is_admin = trim($_POST["is_admin"]);
        if(empty($input_is_admin) && $input_is_admin != 0 ){
            $is_admin_err = "* Vui lòng điền is_admin.";
            echo $input_is_admin;     
        } elseif(!ctype_digit($input_is_admin)){
            $is_admin_err = "* Vui lòng điền is_admin phải là số.";
        } else{
            $is_admin = $input_is_admin;
        }
        
        // Kiểm tra lỗi đầu vào trước khi chèn vào cơ sở dữ liệu
        if(empty($name_err) && empty($password_err) && empty($is_admin_err)){
            // Chuẩn bị một câu lệnh insert
            $sql = "INSERT INTO users (name, password, is_admin) VALUES (?, ?, ?)";
            
            if($stmt = mysqli_prepare($conn, $sql)){
                // Liên kết các biến với câu lệnh đã chuẩn bị
                mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_password, $param_is_admin);
                
                // Thiết lập tham số
                $param_name = $name;
                $param_password = $password;
                $param_is_admin = $is_admin;
                
                // Cố gắng thực thi câu lệnh đã chuẩn bị
                if(mysqli_stmt_execute($stmt)){
                    // Tạo bản ghi thành công. Chuyển hướng đến trang đích
                    echo "<script> location.href = 'quantri.php?page_layout=danhsachTK'; </script>";
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
                        <h2>Thêm thành viên</h2>
                    </div>
                    <p>Điền thông tin tài khoản để thêm vào CSDL</p>
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
                        <input type="submit" class="btn btn-primary px-4" value="Gửi">
                        <a href="quantri.php?page_layout=danhsachTK" class="btn btn-success">Cancel</a>
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