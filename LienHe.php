<style>
    section {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: #112d42;
    }
    section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 50%;
        height: 100%;
        background: #03a9f4;
    }
    section .container {
        position: relative;
        min-width: 1100px;
        min-height: 550px;
        display: flex;
        z-index: 100;
    }
    section .container .containerinfo {
        position: absolute;
        top: 40px;
        width: 365px;
        height: calc(100% - 80px);
        background: #0f3959;
        z-index: 1;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 20px 20px rgba(0, 0, 0, 0.2);
    }
    section .container .containerinfo h2 {
        color: #fff;
        font-size: 24px;
        margin: 20px 0;
    }
    section .container .containerinfo li {
        position: relative;
        list-style: none;
        display: flex;
        margin: 20px 0;
        cursor: pointer;
        align-items: flex-start;
    }
    section .container .containerinfo li span {
        color: #fff;
        margin-left: 10px;
        font-weight: 300;
        opacity: 0.5;
        font-size: 20px;
    }
    /*Hiệu Ứng Hover Cho Thẻ Li*/
    section .container .containerinfo li:hover span {
        opacity: 1;
    }
    section .container .containerinfo .sci {
        position: relative;
        display: flex;
    }
    section .container .containerinfo .sci li {
        list-style: none;
        margin-right: 15px;
    }
    section .container .containerinfo .sci li a {
        text-decoration: none;
        opacity: 0.5;
        color: #fff;
        font-size: 32px;
    }
    /*Hiệu Ứng Hover Icon*/
    section .container .containerinfo .sci li:hover a {
        opacity: 1;
    }
    section .container .containerForm {
        position: absolute;
        padding: 70px 50px;
        background: #fff;
        margin-left: 150px;
        padding-left: 250px;
        width: calc(100% - 150px);
        height: 100%;
        box-shadow: 0 50px 50px rgba(0, 0, 0, 0.5);
    }
    section .container .containerForm h2 {
        color: #0f3959;
        font-size: 24px;
        font-weight: 500;
    }
    section .container .containerForm .formBox {
        position: relative;
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        padding-top: 30px;
    }
    section .container .containerForm .formBox .inputBox {
        position: relative;
        margin: 0 0 35px 0;
    }
    section .container .containerForm .formBox .inputBox.w50 {
        width: 47%;
    }
    section .container .containerForm .formBox .inputBox.w100 {
        width: 100%;
    }
    section .container .containerForm .formBox .inputBox input,
    section .container .containerForm .formBox .inputBox textarea {
        width: 100%;
        padding: 5px 0;
        resize: none;
        font-size: 18px;
        font-weight: 400;
        color: #333;
        border: none;
        border-bottom: 1px solid #777;
        outline: none;
    }
    section .container .containerForm .formBox .inputBox textarea {
        min-height: 120px;
    }
    section .container .containerForm .formBox .inputBox input[type="submit"] {
        position: relative;
        cursor: pointer;
        background: #0f3959;
        color: #fff;
        border: none;
        max-width: 150px;
        padding: 12px;
    }
    section
        .container
        .containerForm
        .formBox
        .inputBox
        input[type="submit"]:hover {
        background: #ff568c;
    }
    section .container .containerForm .formBox .inputBox span {
        position: absolute;
        left: 0;
        padding: 5px 0;
        font-size: 18px;
        font-weight: 400;
        color: #333;
        transition: 0.5s;
        pointer-events: none;
    }
    section .container .containerForm .formBox .inputBox input:focus ~ span,
    section .container .containerForm .formBox .inputBox textarea:focus ~ span,
    section .container .containerForm .formBox .inputBox input:valid ~ span,
    section .container .containerForm .formBox .inputBox textarea:valid ~ span {
        transform: translateY(-20px);
        font-size: 12px;
        font-weight: 400;
        letter-spacing: 1px;
        color: #ff568c;
    }

</style>


<section>
   <div class="container">
        <div class="containerinfo">
            <div>
                <h2>Thông Tin Liên Hệ</h2>
                <ul class="info">
                <li>
                    <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                    <span>235 Hoàng Quốc Việt<br />
                    Bắc Từ Liêm,<br />
                    Hà Nội
                    </span>
                </li>
                <li>
                    <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                    <span>nvc14122002@gmail.com</span>
                </li>
                <li>
                    <span><i class="fa fa-phone-square" aria-hidden="true"></i></span>
                    <span>0365042941</span>
                </li>
                </ul>
            </div>
            <ul class="sci">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul>
        </div>
        <!-- Bắt đầu đoạn mã mới-->
        <div class="containerForm">
            <h2>Gửi Lời Nhắn</h2>
            <form action="/action_page.php" class="formBox">
            
                <div class="inputBox w50">
                    <input type="text" name="" required>
                    <span>Họ</span>
                </div>
                <div class="inputBox w50">
                    <input type="text" name="" required>
                    <span>Tên</span>
                </div>
                <div class="inputBox w50">
                    <input type="text" name="" required>
                    <span>Email</span>
                </div>
                <div class="inputBox w50">
                    <input type="text" name="" required>
                    <span>Số Điện Thoại</span>
                </div>
                <div class="inputBox w100">
                    <textarea name="" required></textarea>
                    <span>Lời Nhắn Của Bạn</span>
                </div>
                <div class="inputBox w100">
                    <input type="submit" value="Gửi">
                </div>
            </form>
        </div>
        <!-- Kết thúc đoạn mã mới-->
    </div>
</section>
