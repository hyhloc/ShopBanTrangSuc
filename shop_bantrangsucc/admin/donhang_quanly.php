<?php
    session_start();
    include("header_ad.php");
?>

<body>    
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title fw-bolder">
                        <h2>QUẢN LÝ ĐƠN HÀNG</h2>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>MÃ ĐƠN HÀNG</th>
                                        <th>NGÀY LẬP</th>
                                        <th>EMAIL</th>
                                        <th>TỔNG TIỀN</th>
                                        <th>TRẠNG THÁI</th>
                                        <th style="text-align:center">XEM CHI TIẾT</th>
                                        <th style="text-align:center">DUYỆT ĐƠN HÀNG</th>
                                        <th style="text-align:center">XÓA ĐƠN HÀNG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include("../database/ketnoi.php");
                                    $sql = "SELECT * FROM DonHang";
                                    $kq = mysqli_query($kn, $sql);
                                    while ($row = mysqli_fetch_array($kq)) {
                                        $madh = $row["MaDonHang"];
                                        echo ("<tr>");
                                            echo ("<td>" . $row["MaDonHang"] . "</td>");
                                            echo ("<td>" . $row["NgayLap"] . "</td>");
                                            echo ("<td>" . $row["Email"] . "</td>");
                                            echo ("<td>" . $row["TongTien"] . "</td>");
                                            echo ("<td>" . $row["TrangThai"] . "</td>");
                                            echo ("<td><a class='btn btn-info btn-block' href='../control/xemchitiet.php?dh=$madh'>Xem chi tiết</a></td>");
                                            echo ("<td><a class='btn btn-info btn-block' href='../control/duyetdonhang_xuly.php?dh=$madh'>Duyệt đơn hàng</a></td>");
                                            echo ("<td><a class='btn btn-danger btn-block' href='../control/xoadonhang_xuly.php?dh=$madh'>Xóa đơn hàng</a></td>");
                                        echo ("</tr>");
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php
    include("footer_ad.php");
?>
