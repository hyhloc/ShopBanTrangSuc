<?php
    include("../database/ketnoi.php");
    $msp=$_REQUEST["msp"];
    $sql="DELETE FROM SanPham WHERE MaSanPham='".$msp."'";
    $kq=mysqli_query($kn, $sql) or die ("Không thể xóa");
    echo ("<script language = javascript>
            alert('Đã xóa sản phẩm thành công');
            window.location.assign('../admin/sanpham_quanly.php');
        </script>");
?>