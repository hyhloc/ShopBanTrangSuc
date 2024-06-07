<?php
    // Khởi tạo hoặc khôi phục session
    session_start();
    include("../database/ketnoi.php");

    // Kiểm tra xem có dữ liệu được gửi từ form không
    if(isset($_SESSION['taikhoan'])){
        if (isset($_GET['TenSP'])) {
            $tensp = $_GET['TenSP'];
            // $sohangtronggio = $_GET['SoLuong'];
            $sohangtronggio = 1;

            $sql =  "SELECT * FROM SanPham WHERE TenSanPham = '$tensp'";
            $bang_sp = mysqli_query($kn, $sql);
            if($bang_sp -> num_rows > 0){
                while($tam_sp = $bang_sp -> fetch_assoc()){
                    // if (!isset($_SESSION['giohang'])) {
                    //     $_SESSION['giohang'] = [];
                    // }

                    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
                    if (!isset($_SESSION['giohang'][$tensp])) {
                        // Nếu chưa tồn tại, thêm sản phẩm vào giỏ hàng
                        $_SESSION['giohang'][$tensp] = [
                            'giohang_soluong' => $sohangtronggio,
                            'giohang_tensp' => $tam_sp['TenSanPham'],
                            'giohang_hinhanh' => $tam_sp['Anh'],
                            'giohang_gia' => $tam_sp['GiaBan'],
                        ];
                        echo"<script language = javascript>
                                alert('Sản phẩm đã được thêm vào giỏ hàng');
                                window.location = '../index.php';
                            </script>";
                    } else {
                        // Nếu sản phẩm đã tồn tại, tăng số lượng lên
                        $_SESSION['giohang'][$tensp]['giohang_soluong'] += $sohangtronggio;

                        echo"<script language = javascript>
                                alert('Số lượng sản phẩm đã được cập nhật trong giỏ hàng');
                                window.location = '../index.php';
                            </script>";
                    }
                }
            }
            
        }
    } else {
        echo '<script language = javascript>
            alert("Bạn cần đăng nhập để thực hiện thao tác này");
            window.location = "../index.php";
        </script>';
    }
?>