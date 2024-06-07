<?php
    session_start();
    include("../admin/header_ad.php")
?>
<?php
    include("../database/ketnoi.php");
    $mdh=$_REQUEST["dh"];
    $donhang = (mysqli_query($kn, "SELECT * FROM DonHang WHERE MaDonHang = '$mdh'")) -> fetch_array();

    echo'<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title fw-bolder">
                        <h2>CHI TIẾT ĐƠN HÀNG SỐ '.$mdh.'</h2>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Mã đơn hàng</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Ngày lập</th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                    $chitiet = mysqli_query($kn, "SELECT * FROM ChiTietDonHang WHERE MaDonHang = '$mdh'");
                                    $tien=0;
                                    while($chitietdh = mysqli_fetch_array($chitiet)){
                                        $tien+= $chitietdh['ThanhTien'];
                                        $tensanpham_tam =  $chitietdh['MaSanPham'];
                                        $sp_tam = (mysqli_query($kn, "SELECT * FROM SanPham WHERE MaSanPham = '$tensanpham_tam'") -> fetch_assoc());
                                        echo'<tr>
                                                <td class="align-middle">
                                                    <p class="mb-0" style="font-weight: 500;">'.$chitietdh['MaDonHang'].'</p>
                                                </td>
                                                <td class="align-middle">
                                                    <p class="mb-0" style="font-weight: 500;">'.$donhang['Email'].'</p>
                                                </td>
                                                <td class="align-middle">
                                                    <p class="mb-0" style="font-weight: 500;">'.$donhang['NgayLap'].'</p>
                                                </td>
                                                <td class="align-middle">
                                                    <p class="mb-0" style="font-weight: 500;">'.$sp_tam['TenSanPham'].'</p>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex flex-row">
                                                        <p class="mb-0">'.$chitietdh['DonGia'].'</p>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    <p class="mb-0" style="font-weight: 500;">'.$chitietdh['TongSoLuong'].'</p>
                                                </td>
                                                <td class="align-middle">
                                                    <p class="mb-0" style="font-weight: 500;">'.$chitietdh['ThanhTien'].'</p>
                                                </td>
                                            </tr>';
                                    }
                                    echo'<tr>
                                            <th class="" colspan="5" scope="row"></th>
                                            <th class="" scope="row">Tổng đơn hàng</th>
                                            <th>
                                                <div class="d-flex flex-row">
                                                    <p class="mb-0">'.$tien.'</p>
                                                </div>
                                            </th>
                                        </tr>';      
                                        
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
    include("../admin/footer_ad.php")
?>