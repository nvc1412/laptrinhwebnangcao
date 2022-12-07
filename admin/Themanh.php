
                    <h1>Thêm mới ảnh</h1>
                    <!-- <form action="uploadanh.php" method="post" enctype="multipart/form-data">
                        Chọn file để upload:
                        <input type="file" name="fileupload" id="fileupload">
                        <input type="submit" value="Đăng ảnh" name="submit">
                    </form> -->

                    <img src="" alt="" id="imagepreview" width="200" height="200">
                    <form action='uploadanh.php' method="post" enctype="multipart/form-data">
                        <p>Chọn file để upload:
                        (Cỡ lớn nhất mà PHP đang cấu hình cho phép upload là
                        <?=ini_get('upload_max_filesize')?>)</p>

                        <input name="fileupload[]" type="file" multiple="multiple" onchange="chooseFile(this)" />
                        <input type="submit" value="Đăng ảnh" name="submit">
                    </form>
                  