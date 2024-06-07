<?php
    include("header.php");
    include("database/ketnoi.php");
   
?>
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <?php
            if (isset($_GET['TenSP'])) {
                $tensanpham = $_GET['TenSP'];

                $sql = "SELECT * FROM SanPham WHERE TenSanPham = '$tensanpham'";
                $bang = mysqli_query($kn, $sql);

                if ($bang->num_rows > 0) {
                    while ($tam = $bang->fetch_assoc()) {
                        // Format giá với dấu chấm sau ba số
                        $formattedPrice = number_format($tam['GiaBan'], 0, ',', '.');
                        $resultNguyenLieu = mysqli_query($kn, "SELECT TenNguyenLieu FROM NguyenLieu WHERE MaNguyenLieu = '" . $tam['MaNguyenLieu'] . "'");
                        $nguyenLieu = mysqli_fetch_assoc($resultNguyenLieu);
                        $tenNguyenLieu = $nguyenLieu['TenNguyenLieu'];

                        echo '<div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="' . $tam['Anh'] . '" alt="..." /></div>
                            <div class="col-md-6">
                            
                            <h1 class="display-5 fw-bolder">' . $tam['TenSanPham'] . '</h1>

                            <div class="fs-3 mb-5 fw-bolder" style="text-align: justify;">
                                <span style="font-size:22px; font-weight: normal; font-style: italic;">' . $tam['Mota'] . '</span>
                            </div>
                            <div class="fs-5"><i style="font-size:22px" >Nguyên liệu: ' . $tenNguyenLieu . '</i></div>
                            <br>
                            <div class="fs-3 mb-5 fw-bolder">
                                <span>Giá: ' . $formattedPrice . ' VNĐ</span>
                            </div>
                            
                            <div class="fs-5">Hiện còn: ' . $tam['SoLuong'] . '</div>';
                            

                        echo '<div class="d-flex">
                                <form action="giohang.php" method="POST">
                                    <input class="btn btn-outline-dark flex-shrink-0" name="soluong" type="number" min="1" max="10" value="1" id=""><br>                       
                                    <input class="btn btn-outline-dark flex-shrink-0" name="themGH" type="submit" value="Thêm vào giỏ hàng"/>
                                    <input name="tensp" type="hidden" value="' . $tam['TenSanPham'] . '"/>
                                    <input name="giasp" type="hidden" value="' . $tam['GiaBan'] . '"/>
                                    <input name="anhsp" type="hidden" value="' . $tam['Anh'] . '"/>
                                </form>
                            </div>';
                    }
                }
            }
            ?>
        </div>
    </div>
</section>

<?php
    include("footer.php");
?>