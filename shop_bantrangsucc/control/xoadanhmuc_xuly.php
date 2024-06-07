<?php
    include("../database/ketnoi.php");
    $mdm=$_REQUEST["madm"];
    $sql="DELETE FROM DanhMucSanPham WHERE MaDanhMuc='".$mdm."'";
    $kq=mysqli_query($kn, $sql) or die ("Không thể xóa");
    echo ("<script language = javascript>
            alert('Xóa danh mục thành công');
            window.location.assign('../admin/quanly_danhmuc.php');
        </script>");
?>