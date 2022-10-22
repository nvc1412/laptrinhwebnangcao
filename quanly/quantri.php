<?php
session_start();
if(isset($_SESSION["logged"]) && $_SESSION["logged"] == 1){
    include_once 'header.php';
    
        if(isset($_GET["page_layout"])){
            $active="";
            switch ($_GET["page_layout"]) {
                case 'danhsach':
                    include_once 'danhsach.php';
                    $active="#danhsach{color: #fff;}";
                    break;
    
                case 'themmoi':
                    include_once 'themmoi.php';
                    $active="#themmoi{color: #fff;}";
                    break;
                
                case 'themanh':
                    include_once 'Themanh.php';
                    $active="#themanh{color: #fff;}";
                    break;
            }
        }else {
            include_once 'danhsach.php';
            $active="#danhsach{color: #fff;}";
        }
        
    
    include_once 'footer.php';
}else{
    header("Location: login.php");
}
?>


                