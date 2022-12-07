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
                    <h2 class="pull-left">Danh sách sản phẩm</h2>
                    <a href="quantri.php?page_layout=themSP" class="btn btn-success pull-right mb-4">Thêm mới sản phẩm</a>
                </div>
                <?php
                // Include file config.php
                require_once("config.php");

                // Cố gắng thực thi truy vấn
                $sql = "SELECT * FROM sanpham";
                if($result = mysqli_query($conn, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>#</th>";
                                    echo "<th>Tên</th>";
                                    echo "<th>Hãng</th>";
                                    echo "<th>Ảnh</th>";
                                    echo "<th>Giá</th>";
                                    echo "<th>Thông tin</th>";
                                    echo "<th>Action</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['TenSP'] . "</td>";
                                    echo "<td>" . $row['HangSP'] . "</td>";
                                    echo '<td> <img src="../img/sanpham/'.$row['AnhSP'].'" width="100" height="100"> </td>';
                                    echo "<td>" . number_format( $row['GiaSP']). " VNĐ" . "</td>";
                                    echo "<td>" . $row['ThongtinSP'] . "</td>";
                                    echo "<td>";
                                        echo "<a class='btn-sua' href='quantri.php?page_layout=suaSP&id=". $row['id'] ."' title='Sửa sản phẩm' data-toggle='tooltip'>Sửa</a>";
                                        echo "<a class='btn-xoa' href='quantri.php?page_layout=xoaSP&id=". $row['id'] ."' title='Xóa sản phẩm' data-toggle='tooltip'>Xóa</a>";
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