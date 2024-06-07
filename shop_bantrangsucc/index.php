<?php
    include("header.php");
    include("database/ketnoi.php");
?>

<section class="py-5" style="background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);">
    <div class="container px-4 px-lg-5">
    <div class="jumbotron text-center" style="background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);">
        <h2 style="font-family: Arial, sans-serif;">CÁC SẢN PHẨM Ở CỬA HÀNG</h2>
    </div>
    
    <!-- Bộ lọc -->
    <div class="row mb-3">
    <div class="col-md-12 d-flex ">
        <div style="margin-right: 20px;">
            <select id="sortPrice" class="form-control" style="width: 200px;" onchange="applyFilter()">
                <option value="">Sắp xếp theo giá</option>
                <option value="asc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'asc') echo 'selected'; ?>>Giá từ thấp đến cao</option>
                <option value="desc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'desc') echo 'selected'; ?>>Giá từ cao đến thấp</option>
            </select>
        </div>
        <div style="margin-right: 20px;">
            <select id="filterSupplier" class="form-control" style="width: 200px;" onchange="applyFilter()">
                <option value="">Chọn nhà cung cấp</option>
                <?php
                    include ("../database/ketnoi.php");
                    $sql = "SELECT * FROM NhaCungCap";
                    $result = $kn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $selected = isset($_GET['supplier']) && $_GET['supplier'] == $row['MaNhaCungCap'] ? 'selected' : '';
                        echo '<option value="'.$row['MaNhaCungCap'].'" '.$selected.'>'.$row['TenNhaCungCap'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div>
            <select id="filterMaterial" class="form-control" style="width: 200px;" onchange="applyFilter()">
                <option value="">Chọn nguyên liệu</option>
                <?php
                    $sql = "SELECT * FROM NguyenLieu";
                    $result = $kn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $selected = isset($_GET['material']) && $_GET['material'] == $row['MaNguyenLieu'] ? 'selected' : '';
                        echo '<option value="'.$row['MaNguyenLieu'].'" '.$selected.'>'.$row['TenNguyenLieu'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
</div>

    
<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    <?php
        // Hiển thị số lượng sản phẩm
        $productsPerPage = 8;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($currentPage - 1) * $productsPerPage;

        // Bước 2: Cập nhật câu truy vấn SQL để áp dụng các bộ lọc
        $sapxep = isset($_GET['sort']) ? $_GET['sort'] : '';
        $locncc = isset($_GET['supplier']) ? $_GET['supplier'] : '';
        $locnguyenlieu = isset($_GET['material']) ? $_GET['material'] : '';

        $sql = "SELECT * FROM SanPham";
        $conditions = [];

        if ($locncc != '') {
            $conditions[] = "MaNhaCungCap = '$locncc'";
        }

        if ($locnguyenlieu != '') {
            $conditions[] = "MaNguyenLieu = '$locnguyenlieu'";
        }

        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        if ($sapxep == 'asc') {
            $sql .= " ORDER BY GiaBan ASC";
        } elseif ($sapxep == 'desc') {
            $sql .= " ORDER BY GiaBan DESC";
        }

        $sql .= " LIMIT $offset, $productsPerPage";

        $bang = $kn->query($sql);
        if ($bang->num_rows > 0) {
            while ($tam = $bang->fetch_assoc()) {
                $formattedPrice = number_format($tam['GiaBan'], 0, ',', '.');
                echo ('<div class="col mb-5">
                            <div class="card h-100 myClass" data-product-id="'.$tam['TenSanPham'].'" style="border-radius: 15px;">
                                <img class="card-img-top" src="'.$tam['Anh'].'" alt="..." />
                                <div class="card-body p-1">    
                                </div>
                                <div class="card-footer p-1 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <h5 class="fw-bolder">'.$tam['TenSanPham'].'</h5>
                                    </div>
                                    <div class="text-center">
                                        Hiện còn: 
                                        '.$tam['SoLuong'].'
                                    </div>
                                    <div class="text-center fw-bolder">
                                        '.$formattedPrice.'VNĐ
                                    </div>
                                    <hr>
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="xemchitietsp.php?TenSP='.$tam["TenSanPham"].'">Xem chi tiết</a></div>
                                </div>
                            </div>
                        </div>');
            }
        }

        // Tính tổng số sản phẩm
        $sql_count = "SELECT COUNT(*) AS total FROM SanPham";
        if (!empty($conditions)) {
            $sql_count .= " WHERE " . implode(" AND ", $conditions);
        }
        $result_count = $kn->query($sql_count);
        $row = $result_count->fetch_assoc();
        $totalProducts = $row['total']; 
    ?>
</div>


    <!-- Phân trang -->
    <div class="row justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php
                    $totalPages = ceil($totalProducts / $productsPerPage);
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<li class="page-item"><a class="page-link" href="?page='.$i.'&sort='.$sapxep.'&supplier='.$locncc.'">'.$i.'</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </div>
</div>
<div class="container px-4 px-lg-5 ">
        <div class="jumbotron text-center" style="background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);">
            <h2 style="font-family: Arial, sans-serif;">CÁC SẢN PHẨM Ở NỔI BẬT Ở CỬA HÀNG</h2>
        </div>

        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <!----------------------------- LẤY TOP 4 SẢN PHẨM NỔI BẬT Ở CỬA HÀNG -------------------------------->
            <?php
                $sql_top_products = "SELECT sp.MaSanPham, sp.TenSanPham, sp.Anh, sp.SoLuong, sp.MoTa, sp.MaDanhMuc, sp.MaNhaCungCap, sp.GiaBan, sp.MaNguyenLieu, SUM(ctd.TongSoLuong) AS SoLuongDat
                                    FROM chitietdonhang ctd
                                    INNER JOIN sanpham sp ON ctd.MaSanPham = sp.MaSanPham
                                    GROUP BY sp.MaSanPham
                                    ORDER BY SoLuongDat DESC
                                    LIMIT 4";
                $result_top_products = $kn->query($sql_top_products);

                if ($result_top_products->num_rows > 0) {
                    while ($top_product = $result_top_products->fetch_assoc()) {
                        $formattedPrice = number_format($top_product['GiaBan'], 0, ',', '.');

                        echo '<div class="col mb-5">
                                <div class="card h-100 myClass" data-product-id="'.$top_product['TenSanPham'].'" style="border-radius: 15px;">
                                    <img class="card-img-top" src="'.$top_product['Anh'].'" alt="..." />
                                    <div class="card-body p-1">    
                                    </div>
                                    <div class="card-footer p-1 pt-0 border-top-0 bg-transparent">
                                        <div class="text-center">
                                            <h5 class="fw-bolder">'.$top_product['TenSanPham'].'</h5>
                                        </div>
                                        <div class="text-center">
                                            Đã bán: '.$top_product['SoLuongDat'].' sản phẩm
                                        </div>
                                        <div class="text-center fw-bolder">
                                            '.$formattedPrice.' VNĐ
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <a class="btn btn-outline-dark mt-auto" href="xemchitietsp.php?TenSP='.$top_product["TenSanPham"].'">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                    }
                }
            ?>
        </div>
    </div>
    <script>
    function applyFilter() {
        const sapxep = document.getElementById('sortPrice').value;
        const supplierFilter = document.getElementById('filterSupplier').value;
        const materialFilter = document.getElementById('filterMaterial').value; // Lấy giá trị của bộ lọc nguyên liệu
        let url = '?page=1';
        if (sapxep) {
            url += '&sort=' + sapxep;
        }
        if (supplierFilter) {
            url += '&supplier=' + supplierFilter;
        }
        if (materialFilter) { // Thêm điều kiện để bộ lọc nguyên liệu vào URL
            url += '&material=' + materialFilter;
        }
        window.location.href = url;
    }
</script>

</section>
<?php
    include("footer.php");
?>