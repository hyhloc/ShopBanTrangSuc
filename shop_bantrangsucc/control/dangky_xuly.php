<?php          
    include("../database/ketnoi.php");
    $tenDK = $_POST['txtTenDK'];
    $matkhau = md5($_POST['txtMatKhauDK']);
    $tenDD = $_POST['txtTenDD'];
    $email = $_POST['txtEmail'];
    $diachi = $_POST['txtDiaChi'];
    $dienthoai = $_POST['txtDienThoai'];
    $vaitro = 1;
    $trangthai = 'Hoạt động';
            

    //Xác nhận email đăng ký đã tồn tại chưa
    $xacnhan_email = mysqli_query($kn,"SELECT Email FROM NguoiDungWeb WHERE Email='$email'");

    if(mysqli_num_rows($xacnhan_email) !=0 ){
        echo ("<script language = javascript>
                alert('Email đã tồn tại!');
                window.location.assign('../index.php');
            </script>");
    }
    else{
        $sql = "INSERT INTO NguoiDungWeb(Email, TaiKhoan, MatKhau, TenDayDu, DiaChi, DienThoai, VaiTro, TrangThai) 
                VALUES('".$email."', '".$tenDK."', '".$matkhau."', '".$tenDD."', '".$diachi."', '".$dienthoai."', '".$vaitro."', '".$trangthai."')";
        mysqli_query($kn, $sql) or die("Không thể thêm người dùng mới");
        echo ("<script language = javascript>
                alert('Đăng ký thành công');
                window.location.assign('../index.php');
            </script>");
        mysqli_close($kn);

        }
?>
