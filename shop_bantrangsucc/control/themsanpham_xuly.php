<?php
    session_start();
    include("../database/ketnoi.php");



    if(isset($_POST['txtTenSP'])){
        $mancc = $_POST['ddMaNCC'];
        $madm = $_POST['ddMaDM'];
        $nl = $_POST['ddMaNl'];
        
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
        $tennl_tam = $tendm["TenNguyenLieu"];



        $tensp = $_POST['txtTenSP'];


        $xacnhan_tensp = mysqli_query($kn,"SELECT TenSanPham FROM SanPham WHERE TenSanPham='$tensp'");

        if(mysqli_num_rows($xacnhan_tensp) !=0 ) {
            echo"<script language = javascript>
                    alert('Tên sản phẩm đã tồn tại!');
                </script>";
        } else{
            $duongdantaptin = substr($duongdantaptin, 3);
            $sql = "INSERT INTO SanPham (TenSanPham, Anh, SoLuong, Mota, MaDanhMuc, MaNhaCungCap, GiaBan,MaNguyenLieu) VALUES ('".$tensp."', '".$duongdantaptin."', '".$soluong."', '".$mota."', '".$madm."', '".$mancc."', '".$gia."','".$nl."')";
            mysqli_query($kn, $sql)or die("Không thể thêm sản phẩm mới");
            echo("<script language = javascript>
                    alert('Thêm sản phẩm mới thành công');
                    window.location = '../admin/sanpham_quanly.php';
                </script>");
        }
    }
?>