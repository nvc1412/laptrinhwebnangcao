<?php if(isset($_SESSION["logged"]) && $_SESSION["logged"] == 1){ ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
<style type="text/css">
    .wrapper{
        width: 100%;
        margin: 0 auto;
    }
    .page-header h2{
        margin-top: 0;
    }
    table tr td:last-child a{
        margin-right: 15px;
    }
    .btn-sua{
        color: white;
        background-color: blue;
        border-radius: 10px;
        padding: 5px 15px;
    }
    .btn-sua:hover{
        color: black;
        opacity: 0.5;
    }
    .btn-xoa{
        color: white;
        border-radius: 10px;
        background-color: red;
        padding: 5px 15px;
    }
    .btn-xoa:hover{
        color: black;
        opacity: 0.5;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();   
    });
</script>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Danh sách nhân viên</h2>
                    <a href="quantri.php?page_layout=themNV" class="btn btn-success pull-right mb-4">Thêm mới nhân viên</a>
                </div>
                <?php
                // Include file config.php
                require_once("config.php");

                // Cố gắng thực thi truy vấn
                $sql = "SELECT * FROM nhanvien";
                if($result = mysqli_query($conn, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>#</th>";
                                    echo "<th>Tên nhân viên</th>";
                                    echo "<th>Ngày sinh</th>";
                                    echo "<th>Địa chỉ</th>";
                                    echo "<th>Giới tính</th>";
                                    echo "<th>Ảnh</th>";
                                    echo "<th>Action</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['tennv'] . "</td>";
                                    echo "<td>" . $row['ngaysinh'] . "</td>";
                                    echo "<td>" . $row['diachi'] . "</td>";
                                    echo "<td>" . $row['gioitinh'] . "</td>";
                                    echo '<td> <img src="../img/nhanvien/'.$row['anh'].'" width="60" height="80"> </td>';
                                    echo "<td>";
                                        echo "<a class='btn-sua' href='quantri.php?page_layout=suaNV&id=". $row['id'] ."' title='Sửa nhân viên' data-toggle='tooltip'>Sửa</a>";
                                        echo "<a class='btn-xoa' href='quantri.php?page_layout=xoaNV&id=". $row['id'] ."' title='Xóa nhân viên' data-toggle='tooltip'>Xóa</a>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";
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
                ?>
            </div>
        </div>        
    </div>
</div>

<?php 
}else{
    header("Location: login.php");
}
?>