<?php
    include("database/ketnoi.php");
    include("header.php");
    
?>

<section class="py-5" style=" background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="jumbotron bg-light text-center" style=" background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);">
        <h2 style="font-family: Arial, sans-serif;">KẾT QUẢ TÌM KIẾM</h2>
        </div>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <?php
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $query = "SELECT * FROM SanPham WHERE TenSanPham LIKE '%$searchTerm%'";
    $result = $kn->query($query);

    if ($result->num_rows > 0) {
        while ($tam = $result->fetch_assoc()) {
            // Format giá với dấu chấm sau ba số
            $formattedPrice = number_format($tam['GiaBan'], 0, ',', '.');

            echo ('<div class="col mb-5">
                        <div class="card h-100 myClass" data-product-id="' . $tam['TenSanPham'] . '" style="border-radius: 15px;">
                            <img class="card-img-top" src="' . $tam['Anh'] . '" alt="..." />
                            <div class="card-body p-1">	
                            </div>
                            <div class="card-footer p-1 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <h5 class="fw-bolder">' . $tam['TenSanPham'] . '</h5>
                                </div>
                                <div class="text-center">
                                    Hiện còn: ' . $tam['SoLuong'] . '
                                </div>
                                <div class="text-center fw-bolder">
                                    ' . $formattedPrice . 'VNĐ
                                </div>
                                <hr>
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="xemchitietsp.php?TenSP=' . $tam["TenSanPham"] . '">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>');
        }
    } else {
        echo '<div class="col text-center">Không tìm thấy sản phẩm.</div>';
    }
} else {
    echo '<div class="col text-center">Vui lòng nhập từ khóa tìm kiếm.</div>';
}
?>

        </div>
    </div>
</section>

<?php
    include("footer.php");
?>
