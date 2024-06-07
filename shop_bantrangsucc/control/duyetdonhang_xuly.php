<?php
session_start();
include("../database/ketnoi.php");

// Kiểm tra xem dh đã được gửi từ trang quản lý đơn hàng hay không
if (isset($_GET['dh'])) {
    // Lấy mã đơn hàng từ tham số truyền vào
    $madonhang = mysqli_real_escape_string($kn, $_GET['dh']);

    // Thực hiện truy vấn SQL để cập nhật trạng thái của đơn hàng thành "Đã xử lý"
    $sql = "UPDATE DonHang SET TrangThai = 'Đã xử lý' WHERE MaDonHang = '$madonhang'";
    if (mysqli_query($kn, $sql)) {
        // Nếu cập nhật thành công, chuyển hướng người dùng trở lại trang quản lý đơn hàng
        header("Location: ../admin/donhang_quanly.php");
        exit;
    } else {
        // Nếu có lỗi xảy ra trong quá trình cập nhật, bạn có thể xử lý nó ở đây
        echo "Có lỗi xảy ra khi cập nhật trạng thái đơn hàng: " . mysqli_error($kn);
    }
} else {
    // Nếu không có dh được gửi, chuyển hướng người dùng trở lại trang quản lý đơn hàng
    header("Location: ../donhang_quanly.php");
    exit;
}
?>
