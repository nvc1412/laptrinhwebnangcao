<?php if(isset($_SESSION["logged"]) && $_SESSION["logged"] == 1){ ?>

<?php
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $rowsPerPage = 5;
    $perRow = $page*$rowsPerPage-$rowsPerPage;
?>

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
    .pagination{
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
                    <h2 class="pull-left">Danh sách tài khoản</h2>
                    <a href="quantri.php?page_layout=themTK" class="btn btn-success pull-right mb-4">Thêm mới tài khoản</a>
                </div>
                <?php
                // Include file config.php
                require_once("config.php");

                // Cố gắng thực thi truy vấn
                $sql = "SELECT * FROM users LIMIT $perRow, $rowsPerPage";
                if($result = mysqli_query($conn, $sql)){

                    //Phân trang
                    $tongtaikhoan = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
                    $tongsotrang = ceil($tongtaikhoan/$rowsPerPage);

                    $listPage="";
                    for($i=1; $i<=$tongsotrang; $i++){
                        if($page==$i){
                            $listPage.='<a class="active" href="quantri.php?page_layout=danhsachTK&page='.$i.'">'.$i.'</a>';
                        }else{
                            $listPage.='<a href="quantri.php?page_layout=danhsachTK&page='.$i.'">'.$i.'</a>';
                        }
                    }

                    //Đổ dữ liệu tài khoản
                    if(mysqli_num_rows($result) > 0){
                        echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>#</th>";
                                    echo "<th>Name</th>";
                                    echo "<th>Password</th>";
                                    echo "<th>Is_admin</th>";
                                    echo "<th>Action</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['password'] . "</td>";
                                    echo "<td>" . $row['is_admin'] . "</td>";
                                    echo "<td>";
                                        echo "<a class='btn-sua' href='quantri.php?page_layout=suaTK&id=". $row['id'] ."' title='Sửa tài khoản' data-toggle='tooltip'>Sửa</a>";
                                        echo "<a class='btn-xoa' href='quantri.php?page_layout=xoaTK&id=". $row['id'] ."' title='Xóa tài khoản' data-toggle='tooltip'>Xóa</a>";
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
        
        <div class="pagination">
            <?php echo $listPage ?>
        </div>
        
    </div>
</div>

<?php 
}else{
    header("Location: login.php");
}
?>