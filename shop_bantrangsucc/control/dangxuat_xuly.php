<?php
    session_start();
    if(isset($_SESSION['taikhoan'])){


        
    }

    session_destroy();
    echo"<script language = javascript>
            alert('Đăng xuất thành công');
            window.location = '../index.php';
        </script>";
?>