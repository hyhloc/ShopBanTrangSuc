<?php
    session_start();
    include("../database/ketnoi.php");

    if(isset($_POST['txtMaNCC']) && isset($_POST['txtTenNCC'])){
        $mancc = $_POST['txtMaNCC'];
        $tenncc = $_POST['txtTenNCC'];
        $diachi = $_POST['txtDiaChi'];
        $dienthoai = $_POST['txtDienThoai'];

        $xacnhan_mancc = mysqli_query($kn,"SELECT MaNhaCungCap FROM NhaCungCap WHERE MaNhaCungCap='$mancc'");
        $xacnhan_tenncc = mysqli_query($kn,"SELECT TenNhaCungCap FROM NhaCungCap WHERE TenNhaCungCap='$tenncc'");

        if(mysqli_num_rows($xacnhan_mancc)!=0 && mysqli_num_rows($xacnhan_tenncc)!=0) {
            echo"<script language = javascript>
                    alert('Mã hoặc tên nhà cung cấp đã tồn tại!');
                </script>";
        } else{
            $sql = "INSERT INTO NhaCungCap VALUES ('".$mancc."', '".$tenncc."', '".$diachi."', '".$dienthoai."')";
            mysqli_query($kn, $sql);
            echo("<script language = javascript>
                    alert('Thêm nhà cung cấp mới thành công');
                    window.location = '../admin/quanly_nhacungcap.php';
                </script>");
        }
    }
?>