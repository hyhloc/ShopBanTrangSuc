<?php
    include("../database/ketnoi.php");
    $email=$_REQUEST["email"];
    $sql="DELETE FROM NguoiDungWeb WHERE Email ='".$email."'";
    $kq=mysqli_query($kn, $sql) or die ("Không thể xóa");
    echo ("<script language = javascript>
            alert('Người dùng đã bị xóa');
            window.location.assign('../admin/quanly_nguoidung.php');
        </script>");
?>