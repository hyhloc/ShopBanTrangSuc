<?php
    session_start();

    if(isset($_GET['TenSP'])) {
    $tensanpham = $_GET['TenSP'];

    // Xóa sản phẩm khỏi giỏ hàng
    unset($_SESSION['giohang'][$tensanpham]);

    echo"<script language = javascript>
            alert('Sản phẩm đã được xóa khỏi giỏ hàng');
            window.location = '../hienthigiohang.php';
        </script>";
    }    
?>
