<?php
    include("../database/ketnoi.php");
    $ncc=$_REQUEST["ncc"];
    $sql="DELETE FROM NhaCungCap WHERE MaNhaCungCap='".$ncc."'";
    $kq=mysqli_query($kn, $sql) or die ("Không thể xóa");
    echo ("<script language = javascript>
            alert('Đã xóa nhà cung cấp');
            window.location.assign('../admin/quanly_nhacungcap.php');
        </script>");
?>