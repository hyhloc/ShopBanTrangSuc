<?php
    include("../database/ketnoi.php");
    $dh=$_REQUEST["dh"];
    $sql="DELETE FROM DonHang WHERE MaDonHang='".$dh."'";
    $kq=mysqli_query($kn, $sql) or die ("Không thể xóa");
    echo ("<script language = javascript>
            alert('Đã xóa đơn hàng');
            window.location.assign('../admin/donhang_quanly.php');
        </script>");
?>