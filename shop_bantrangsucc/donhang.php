<?php
    include("header.php");
    include("database/ketnoi.php");
    
?>

<?php 
    if(isset($_POST['dathang']) && ($_POST['dathang'])){

        //Tính tiền giỏ hàng
        $tong = 0;
        if(isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))){    
            for($i = 0; $i < sizeof($_SESSION['giohang']); $i++){
                $thanhtien = $_SESSION['giohang'][$i][2] * $_SESSION['giohang'][$i][3];
                $tong+=$thanhtien;
            }
        }
        $tongdonhang = $tong;

        //--------------------------TẠO ĐƠN HÀNG------------------------------------------------------
        $sql1 = mysqli_query($kn, "SELECT * FROM NguoiDungWeb");
        $thongtin = $sql1->fetch_assoc();
        
        // Lấy thông tin khách hàng
        if (isset($_SESSION['taikhoan']) && $_SESSION['taikhoan'] == $thongtin['TaiKhoan']) {
            $taikhoan = $thongtin['Email'];
        
            // Tạo đơn hàng
            $taodonhang = "INSERT INTO DONHANG(Email, TongTien, TrangThai) VALUES('$taikhoan', '$tongdonhang','Đang xử lý')";
            if (mysqli_query($kn, $taodonhang)) {
                $madh_moi = mysqli_insert_id($kn); // Lấy mã đơn hàng mới
        
                // Cập nhật trạng thái của đơn hàng
                $capnhat_trangthai = "UPDATE DONHANG SET TrangThai = 'Đang xử lý' WHERE MaDonHang = '$madh_moi'";
                mysqli_query($kn, $capnhat_trangthai);
            }
        }

        
        for($i=0; $i < sizeof($_SESSION['giohang']); $i++){
            $tensp_tam = $_SESSION['giohang'][$i][1];
            $giasp = $_SESSION['giohang'][$i][2];
            $slsp = $_SESSION['giohang'][$i][3];
            $tt = $giasp*$slsp;

            $sql2 = mysqli_query($kn, "SELECT * FROM SanPham WHERE TenSanPham = '$tensp_tam'");
            $sanpham = $sql2 -> fetch_assoc();
            $masp = $sanpham['MaSanPham'];

            $taodonhangchitiet = mysqli_query($kn, "INSERT INTO CHITIETDONHANG(MaDonHang, MaSanPham, TongSoLuong, DonGia, ThanhTien) VALUES('$madh_moi', '$masp', '$slsp','$giasp', '$tt')");
        }

        echo '<script language = javascript>
                alert("Bạn đã đặt hàng thành công");
                window.location = "index.php";
            </script>';

        //----------------XÓA GIỎ HÀNG SAU KHI ĐẶT HÀNG THÀNH CÔNG---------------
        unset($_SESSION['giohang']);
    }
    
?>

<section class="h-100 h-custom" style=" background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);">
    <div class="container  py-5">
        <div class="row d-flex justify-content-center align-items-center h-100 bg-light" style="border-radius: 15px;">
            <div class="col">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 mt-3 text-black">Đơn hàng của bạn</h1>    
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="h5">Mã đơn hàng</th>
                                <th scope="col">Sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
if (isset($_GET['MaDH'])) {
    $madonhang = $_GET['MaDH'];
    $chitiet = mysqli_query($kn, "SELECT * FROM ChiTietDonHang WHERE MaDonHang = '$madonhang'");
    $tien = 0;

    while ($chitietdh = mysqli_fetch_array($chitiet)) {
        $tien += $chitietdh['ThanhTien'];
        $tensanpham_tam =  $chitietdh['MaSanPham'];
        $sp_tam = (mysqli_query($kn, "SELECT * FROM SanPham WHERE MaSanPham = '$tensanpham_tam'")->fetch_assoc());

        // Format giá và thành tiền với dấu chấm sau ba số
        $formattedDonGia = number_format($chitietdh['DonGia'], 0, ',', '.') . ' VNĐ';
        $formattedThanhTien = number_format($chitietdh['ThanhTien'], 0, ',', '.') . ' VNĐ';

        echo '<tr>
                    <td class="align-middle">
                        <p class="mb-0" style="font-weight: 500;">' . $chitietdh['MaDonHang'] . '</p>
                    </td>
                    <td class="align-middle">
                        <p class="mb-0" style="font-weight: 500;">' . $sp_tam['TenSanPham'] . '</p>
                    </td>
                    <td class="align-middle">
                        <div class="d-flex flex-row">
                            <p class="mb-0">' . $formattedDonGia . '</p>
                        </div>
                    </td>
                    <td class="align-middle">
                        <p class="mb-0" style="font-weight: 500;">' . $chitietdh['TongSoLuong'] . '</p>
                    </td>
                    <td class="align-middle">
                        <p class="mb-0" style="font-weight: 500;">' . $formattedThanhTien . '</p>
                    </td>
                </tr>';
    }

    // Format tổng đơn hàng với dấu chấm sau ba số
    $formattedTien = number_format($tien, 0, ',', '.') . ' VNĐ';

    echo '<tr>
            <th class="" colspan="3" scope="row"></th>
            <th class="" scope="row">Tổng đơn hàng</th>
            <th>
                <div class="d-flex flex-row">
                    <p class="mb-0">' . $formattedTien . '</p>
                </div>
            </th>
        </tr>';
}
?>
                        </tbody>
                    </table>
                </div>
                <div class="pt-3">
                    <h6 class="mb-4"><a href="index.php" class="text-body">
                        <i class="fas fa-long-arrow-alt-left me-2"></i>
                        Trở lại trang chủ
                    </a></h6>
                </div>                       
            </div>
        </div>
    </div>
</section>

<?php
    include("footer.php");
?>