<?php
    session_start();
    include("../database/ketnoi.php");



    if(isset($_POST['txtTenSP'])){
        $masp = $_POST['txtMaSP'];
        $mancc = $_POST['ddMaNCC'];
        $madm = $_POST['ddMaDM'];
        
        #Lấy file ảnh
        //$root = getcwd();
        $duongdantep = "../images/";
        $duongdantaptin = $duongdantep . basename($_FILES["file"]["name"]);
        $file_tam = $_FILES["file"]["tmp_name"];
        move_uploaded_file($file_tam, $duongdantaptin);

        $soluong = $_POST['txtSoLuong'];
        $mota = $_POST['txtMoTa'];
        $gia = $_POST['txtGiaBan'];

        $tenncc = mysqli_fetch_assoc(mysqli_query($kn,"SELECT TenNhaCungCap FROM NhaCungCap WHERE MaNhaCungCap='$mancc'"));
        $tendm = mysqli_fetch_assoc(mysqli_query($kn,"SELECT TenDanhMuc FROM DanhMucSanPham WHERE MaDanhMuc='$madm'"));
        $tennl = mysqli_fetch_assoc(mysqli_query($kn,"SELECT TenNguyenLieu FROM NguyenLieu WHERE MaNguyenLieu='$nl'"));
        $tenncc_tam = $tenncc["TenNhaCungCap"];
        $tendm_tam = $tendm["TenDanhMuc"];



        $tensp =$_POST['txtTenSP'];
        $nl = $_POST['ddMaNl'];
        

        $duongdantaptin = substr($duongdantaptin, 3);
        $sql = mysqli_query($kn, "UPDATE SanPham SET TenSanPham = '".$tensp."', Anh = '".$duongdantaptin."', SoLuong ='".$soluong."', Mota = '".$mota."', MaDanhMuc = '".$madm."', MaNhaCungCap = '".$mancc."', GiaBan = '".$gia."', MaNguyenLieu = '".$nl."' WHERE MaSanPham = '".$masp."' ");
        echo("<script language = javascript>
                alert('Cập nhật sản phẩm thành công');
                window.location = '../admin/sanpham_quanly.php';
        </script>");
        
    }
?>