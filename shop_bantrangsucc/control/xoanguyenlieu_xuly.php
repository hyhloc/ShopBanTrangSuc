<?php
    include("../database/ketnoi.php");
    $nl=$_REQUEST["manl"];
    $sql="DELETE FROM NguyenLieu WHERE MaNguyenLieu='".$nl."'";
    $kq=mysqli_query($kn, $sql) or die ("Không thể xóa");
    echo ("<script language = javascript>
            alert('Xóa nguyên liệu thành công');
            window.location.assign('../admin/nguyenlieu_quanly.php');
        </script>");
?>