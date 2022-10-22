<?php
//require_once("config.php");
require_once("functions/functions.php");
require_once("classes/dbConnection.php");

$message = "";
$error = "";

$action = getValue("action", "POST", "str", "");
if ($action != "") {
    // Lay POST Value
    $inputID = getValue("inputID", "POST", "int", 0);
    $inputEmail = getValue("inputEmail", "POST", "str", "");
    $inputPassword = getValue("inputPassword", "POST", "str", "");

    if ($inputID > 0 && $inputEmail != "" && $inputPassword != "") {
        // Insert SQL
        $dbConnection = new dbConnection();
        $conn = $dbConnection->getConnection();

        $sql = 'INSERT INTO users (id, name, password) 
                VALUES (' . $inputID . ', "' . $inputEmail . '", "' . $inputPassword . '")';

        if ($conn->query($sql) === true) {
            $message = "New record created successfully";
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        $error = "Thông tin nhập không đủ !";
    }
}
?>
            
                    <h1>Thêm mới người dùng</h1>
                    <div class="bs-example">
                        <div class="message">
                            <?php
                            if ($message != "") {
                                echo '<div class="alert alert-success" role="alert">' . $message . '</div>';
                            }
                            if ($error != "") {
                                echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                            }

                            ?>
                        </div>
                        <form id="frmThemMoi" action="" method="POST">
                            <div class="form-group">
                                <label for="inputIDC">ID</label>
                                <input type="id" class="form-control" id="inputID" name="inputID" placeholder="ID" required>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" required>
                            </div>
                            <input type="hidden" name="action" value="submit" />
                            <button id="btnThemMoi" type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>