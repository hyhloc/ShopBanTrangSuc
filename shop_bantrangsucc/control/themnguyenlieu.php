<?php
    session_start();
    include("../database/ketnoi.php");

    if(isset($_POST['txtMaNguyenLieu']) && isset($_POST['txtTenNguyenLieu'])){
        $nl = $_POST['txtMaNguyenLieu'];
        $tennl = $_POST['txtTenNguyenLieu'];

        $xacnhan_nl = mysqli_query($kn,"SELECT MaNguyenLieu FROM NguyenLieu WHERE MaNguyenLieu='$nl'");
        $xacnhan_tennl = mysqli_query($kn,"SELECT TenNguyenLieu FROM NguyenLieu WHERE TenNguyenLieu='$tennl'");

        if(mysqli_num_rows($xacnhan_nl)!=0 && mysqli_num_rows($xacnhan_tennl)!=0) {
            echo"<script language = javascript>
                    alert('Mã hoặc tên nguyên liệu đã tồn tại!');
                </script>";
        } else{
            $sql = "INSERT INTO NguyenLieu (MaNguyenLieu, TenNguyenLieu) VALUES ('$nl', '$tennl')";
            mysqli_query($kn, $sql);
            echo("<script language = javascript>
                    alert('Thêm nguyên liệu mới thành công');
                    window.location = '../admin/nguyenlieu_quanly.php';
                </script>");
        }
    }
?>