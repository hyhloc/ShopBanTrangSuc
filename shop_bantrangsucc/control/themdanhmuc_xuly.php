<?php
    session_start();
    include("../database/ketnoi.php");

    if(isset($_POST['txtMaDM']) && isset($_POST['txtTenDM'])){
        $madm = $_POST['txtMaDM'];
        $tendm = $_POST['txtTenDM'];

        $xacnhan_madm = mysqli_query($kn,"SELECT MaDanhMuc FROM DanhMucSanPham WHERE MaDanhMuc='$madm'");
        $xacnhan_tendm = mysqli_query($kn,"SELECT TenDanhMuc FROM DanhMucSanPham WHERE TenDanhMuc='$tendm'");

        if(mysqli_num_rows($xacnhan_madm)!=0 && mysqli_num_rows($xacnhan_tendm)!=0) {
            echo"<script language = javascript>
                    alert('Mã hoặc tên danh mục đã tồn tại!');
                </script>";
        } else{
            $sql = "INSERT INTO DanhMucSanPham VALUES ('".$madm."', '".$tendm."')";
            mysqli_query($kn, $sql);
            echo("<script language = javascript>
                    alert('Đã thêm một danh mục mới');
                    window.location = '../admin/quanly_danhmuc.php';
                </script>");
        }
    }
?>