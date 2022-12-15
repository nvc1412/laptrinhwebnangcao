<?php
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $rowsPerPage = 8;
    $perRow = $page*$rowsPerPage-$rowsPerPage;
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
                           <a href="index.php?page_layout=TimKiemDanhMuc&name=Nồi cơm điện" class="list-group-item">Nồi cơm điện</a>
                           <a href="index.php?page_layout=TimKiemDanhMuc&name=Bếp ga" class="list-group-item">Bếp gas</a>
                           <a href="index.php?page_layout=TimKiemDanhMuc&name=Bếp từ" class="list-group-item">Bếp từ</a>
                           <a href="index.php?page_layout=TimKiemDanhMuc&name=Nồi" class="list-group-item">Xoong, Nồi</a>
                           <a href="index.php?page_layout=TimKiemDanhMuc&name=Chảo" class="list-group-item">Chảo</a>
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
                     <a href="index.php?page_layout=CuaHang">
                        <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                        Cửa hàng
                     </a>
                  </li>
                  <li class="active">Tìm kiếm sản phẩm</li>
               </ol>
               <div class="panel panel-info">
                  <!-- <div class="panel-heading">
                     <h3 class="panel-title">Kết quả tìm kiếm ( 8 sản phẩm)</h3>
                  </div> -->
                  <div class="panel-body">
                     <div style="display: flex;flex-wrap: wrap;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearpadding">
                        <?php 
                           // Cố gắng thực thi truy vấn
                           $sql = "SELECT * FROM sanpham LIMIT $perRow, $rowsPerPage";

                           if($result = mysqli_query($conn, $sql)){

                              //Phân trang
                              $tongsanpham = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM sanpham"));
                              $tongsotrang = ceil($tongsanpham/$rowsPerPage);

                              $listPage="";
                              for($i=1; $i<=$tongsotrang; $i++){
                                    if($page==$i){
                                       $listPage.='<a class="active" href="index.php?page_layout=TimKiem&page='.$i.'">'.$i.'</a>';
                                    }else{
                                       $listPage.='<a href="index.php?page_layout=TimKiem&page='.$i.'">'.$i.'</a>';
                                    }
                              }

                              //Đổ dữ liệu sản phẩm
                              if(mysqli_num_rows($result) > 0){

                                 while($row = mysqli_fetch_array($result)){
                                       echo '<div style="margin-bottom: 30px" class="col-xs-12 col-sm-6 col-md-3 col-lg-3">';
                                          echo '<div class="product_item">';
                                             echo '<div class="product-image">';
                                                   echo '<a href="index.php?page_layout=ChiTietSanPham&id='. $row['id'] .'"><img src="./img/sanpham/'.$row['AnhSP'].'" alt="" class=""></a>';
                                             echo '</div>';
                                             echo '<p><a href="index.php?page_layout=ChiTietSanPham&id='. $row['id'] .'" class="product_name">'.$row['TenSP'].'</a></p>';
                                             echo '<p><span class="price text-right"> '. number_format( $row['GiaSP']). " VNĐ" .'</span></p>';
                                             echo '<a href="index.php?page_layout=GioHang"><button class="btn btn-info"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Thêm giỏ hàng</button></a>';
                                          echo '</div>';
                                       echo '</div>';
                                 }
                                 mysqli_free_result($result);
                              } else{
                                 echo "<p class='lead'><em>Không tìm thấy bản ghi.</em></p>";
                              }
                           } else{
                              echo "ERROR: Không thể thực thi $sql. " . mysqli_error($conn);
                           }
                        ?>
                     </div>
                     </div>
                  </div>
               </div>

               <div class="pagination">
                  <?php echo $listPage ?>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>