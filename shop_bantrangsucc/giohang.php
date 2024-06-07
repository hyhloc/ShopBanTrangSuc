<?php
include("header.php");
include("database/ketnoi.php");


// Khởi tạo giỏ hàng
if (!isset($_SESSION['giohang'])) {
    $_SESSION['giohang'] = [];
}

// Xóa sp trong giỏ hàng
if (isset($_GET['xoaGH']) && ($_GET['xoaGH']) >= 0) {
    array_splice($_SESSION['giohang'], $_GET['xoaGH'], 1);
}

?>

<style>
    @media (min-width: 1025px) {
        .h-custom {
            height: 100vh !important;
        }
    }
</style>

<section class="h-100 h-custom" style=" background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);">
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center h-100 bg-light" style="border-radius: 15px;">
            <div class="col">
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 mt-3 text-black">Giỏ hàng</h1>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="h5">Sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Thành tiền</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION['taikhoan'])) {
                                if (isset($_POST['themGH']) && ($_POST['themGH'])) {
                                    $hinhsp = $_POST['anhsp'];
                                    $tensp = $_POST['tensp'];
                                    $giasp = $_POST['giasp'];
                                    $sluongsp = $_POST['soluong'];

                                    // Kiểm tra số lượng tồn kho
                                    $sql = "SELECT `SoLuong` FROM `sanpham` WHERE `TenSanPham` = '$tensp'";
                                    $result = mysqli_query($kn, $sql);

                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        $soLuongTonKho = $row['SoLuong'];

                                        if ($soLuongTonKho >= $sluongsp) {
                                            // Số lượng tồn kho đủ
                                            $dem = 0; // Kiểm tra sp có trùng với giỏ hàng không?
                                            // Kiểm tra sp đã tồn tại chưa
                                            for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
                                                if ($_SESSION['giohang'][$i][1] == $tensp) {
                                                    $dem++;
                                                    $sluongsp_moi = $sluongsp + $_SESSION['giohang'][$i][3];
                                                    $_SESSION['giohang'][$i][3] = $sluongsp_moi;
                                                    break;
                                                }
                                            }

                                            // Thêm mới sp vào giỏ hàng
                                            if ($dem == 0) {
                                                $sanpham = [$hinhsp, $tensp, $giasp, $sluongsp];
                                                $_SESSION['giohang'][] = $sanpham;

                                                // Giảm số lượng tồn kho trong CSDL
                                                $sql_giam_tonkho = "UPDATE `sanpham` SET `SoLuong` = `SoLuong` - $sluongsp WHERE `TenSanPham` = '$tensp'";
                                                mysqli_query($kn, $sql_giam_tonkho);
                                            }
                                        } else {
                                            // Số lượng tồn kho không đủ
                                            echo '<script language = "javascript">
                                                    alert("Không đủ số lượng tồn kho để thêm vào giỏ hàng.");
                                                    window.location = "index.php";
                                                </script>';
                                            exit; // Ngăn chặn việc thực hiện tiếp theo nếu số lượng không đủ
                                        }
                                    } else {
                                        // Xử lý lỗi truy vấn
                                        echo "Lỗi truy vấn: " . mysqli_error($kn);
                                    }
                                }
                            } else {
                                echo '<script language = javascript>
                                        alert("Bạn cần đăng nhập để thực hiện thao tác này");
                                        window.location = "index.php";
                                    </script>';
                            }

                            if (isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))) {
                                $tong = 0;
                                for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
                                    $thanhtien = $_SESSION['giohang'][$i][2] * $_SESSION['giohang'][$i][3];
                                    $tong += intval($thanhtien);
                                    $formattedPrice = number_format($_SESSION['giohang'][$i][2], 0, ',', '.');
                                    $formattedThanhTien = number_format($thanhtien, 0, ',', '.');
                            
                                    echo '<tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center">
                                                        <img src="' . $_SESSION['giohang'][$i][0] . '" class="img-fluid rounded-3"
                                                            style="width: 120px;" alt="Book">
                                                        <div class="flex-column ms-4">
                                                            <p class="mb-2">' . $_SESSION['giohang'][$i][1] . '</p>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td class="align-middle">
                                                    <p class="mb-0" style="font-weight: 500;">' . $formattedPrice . 'VNĐ</p>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex flex-row">
                                                        <p class="mb-0">' . $_SESSION['giohang'][$i][3] . '</p>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <p class="mb-0" style="font-weight: 500;">' . $formattedThanhTien . 'VNĐ</p>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="giohang.php?xoaGH=' . $i . '" class="text-muted"><i class="fas fa-times"></i></a>
                                                </td>
                                            </tr>';
                                }
                                echo '<tr>
                                            <th class="" colspan="2" scope="row"></th>
                                            <th class="" scope="row">Tổng đơn hàng</th>
                                            <th>
                                                <div class="d-flex flex-row">
                                                    <p class="mb-0">' . number_format($tong, 0, ',', '.') . 'VNĐ</p>
                                                </div>
                                            </th>
                                        </tr>';
                            
                                if ($tong == 0) {
                                    echo '<tr></tr>';
                                } else {
                                    echo '<tr>
                                            <th class="" colspan="3" scope="row"></th>
                                            <th>
                                                <form action="donhang.php" method="POST">
                                                    <div class="d-flex flex-row">
                                                        <input type="submit" name="dathang" class="btn btn-outline-primary btn-block" value="Đặt hàng">
                                                    </div>
                                                </form>
                                            </th>          
                                        </tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div>
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