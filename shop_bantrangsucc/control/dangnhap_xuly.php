<?php 
    session_start();
    include("../database/ketnoi.php");
    if(isset($_POST['txtTenDN']) && isset($_POST['txtMatKhau'])){
        $tenDN = $_POST['txtTenDN'];
        $matkhau = md5($_POST['txtMatKhau']);

        $sql1 = "SELECT * FROM NguoiDungWeb WHERE TaiKhoan='$tenDN' AND MatKhau='$matkhau' AND VaiTro=1";
        $sql2 = "SELECT * FROM NguoiDungWeb WHERE TaiKhoan='$tenDN' AND MatKhau='$matkhau' AND VaiTro=0";
        $kq1 = mysqli_query($kn, $sql1) or die("Không thể truy vấn");
        $kq2 = mysqli_query($kn, $sql2) or die("Không thể truy vấn");

        $row1 = mysqli_fetch_array($kq1);
        $row2 = mysqli_fetch_array($kq2);

        if($row1){
            $_SESSION['taikhoan'] = $tenDN;
            echo"<script language = javascript>
                alert('Đăng nhập thành công');
                window.location = '../index.php';
            </script>";
        } elseif($row2){
            $_SESSION['admin'] = $tenDN;
            echo"<script language = javascript>
                    window.location = '../admin/index_ad.php';
                </script>";
        } else{
            echo"<script language = javascript>
                    alert('Tên đăng nhập hoặc mật khẩu chưa chính xác');
                    window.location = '../index.php';
                </script>";
        }
    }
    
?>
