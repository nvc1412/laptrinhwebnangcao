<div style="padding-left: 100px;padding-right: 100px">
    <div class="row">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item ">
                    <a href="#"><img style="width: 100%" src="./img/slide/slide1.png" alt="..."></a>
                    <div class="carousel-caption">
                    </div>
                </div>
                <div class="item ">
                    <a href="#"><img style="width: 100%" src="./img/slide/slide2.png" alt="..."></a>
                    <div class="carousel-caption">
                    </div>
                </div>
                <div class="item active">
                    <a href="#"><img style="width: 100%" src="./img/slide/slide3.png" alt="..."></a>
                    <div class="carousel-caption">
                    </div>
                </div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

<div class="container">

    <div class="row">
        <!-- Sản phẩm mới -->
        <div class="panel panel-info">
            <div style="display: flex; justify-content: center; align-items: center; margin-top: 10px" class="panel-heading">
                <img style="width: 50px; height: 50px" src="./img/icon/new.gif" alt="">
                <h2 ><a href="index.php?page_layout=TimKiem" style="color: red; font-weight: bold;">SẢN PHẨM MỚI</a></h2>
                <img style="width: 50px; height: 50px" src="./img/icon/new.gif" alt="">
            </div>
            <div class="panel-body">
                <div style="display: flex;flex-wrap: wrap;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearpadding">
                    <?php 
                        // Cố gắng thực thi truy vấn
                        $sql = "SELECT * FROM sanpham ORDER BY id DESC LIMIT 8";

                        if($result = mysqli_query($conn, $sql)){
                            //Đổ dữ liệu sản phẩm
                            if(mysqli_num_rows($result) > 0){

                                while($row = mysqli_fetch_array($result)){
                                    echo '<div style="margin-bottom: 30px" class="col-xs-12 col-sm-6 col-md-3 col-lg-3">';
                                        echo '<div class="product_item">';
                                            echo '<div class="product-image">';
                                            echo '<a href="index.php?page_layout=ChiTietSanPham&id='. $row['id'] .'"><img src="./img/sanpham/'.$row['AnhSP'].'" alt="" class=""></a>';
                                            echo '</div>';
                                            echo '<p><a href="index.php?page_layout=ChiTietSanPham&id="'. $row['id'] .'" class="product_name">'.$row['TenSP'].'</a></p>';
                                            echo '<p><span class="price text-right"> '. number_format( $row['GiaSP']). " VNĐ" .'</span></p>';
                                            echo '<a href="ThemVaoGioHang.php?id='. $row['id'] .'"><button class="btn btn-info"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Thêm giỏ hàng</button></a>';
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
    
        <!-- Sản phẩm bán chạy -->
        <div class="panel panel-info">
            <div style="display: flex; justify-content: center; align-items: center; margin-top: 10px" class="panel-heading">
                <img style="width: 50px; height: 50px" src="./img/icon/hot.gif" alt="">
                <h2 ><a href="index.php?page_layout=TimKiem" style="color: green; font-weight: bold;">SẢN PHẨM BÁN CHẠY</a></h2>
                <img style="width: 50px; height: 50px" src="./img/icon/hot.gif" alt="">
            </div>
            <div class="panel-body">
                <div style="display: flex;flex-wrap: wrap;" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 clearpadding">
                    <?php 
                        // Cố gắng thực thi truy vấn
                        $sql = "SELECT * FROM sanpham LIMIT 8";

                        if($result = mysqli_query($conn, $sql)){
                            //Đổ dữ liệu sản phẩm
                            if(mysqli_num_rows($result) > 0){

                                while($row = mysqli_fetch_array($result)){
                                    echo '<div style="margin-bottom: 30px" class="col-xs-12 col-sm-6 col-md-3 col-lg-3">';
                                        echo '<div class="product_item">';
                                            echo '<div class="product-image">';
                                            echo '<a href="index.php?page_layout=ChiTietSanPham&id='. $row['id'] .'"><img src="./img/sanpham/'.$row['AnhSP'].'" alt="" class=""></a>';
                                            echo '</div>';
                                            echo '<p><a href="index.php?page_layout=ChiTietSanPham&id="'. $row['id'] .'" class="product_name">'.$row['TenSP'].'</a></p>';
                                            echo '<p><span class="price text-right"> '. number_format( $row['GiaSP']). " VNĐ" .'</span></p>';
                                            echo '<a href="ThemVaoGioHang.php?id='. $row['id'] .'"><button class="btn btn-info"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Thêm giỏ hàng</button></a>';
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
    </div>
</div>
