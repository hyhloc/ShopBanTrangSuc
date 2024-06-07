<?php
    include("header.php");
    include("database/ketnoi.php");
    
?>

<!-- Section-->
        <section class="py-5" style=" background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);">
            <div class="container px-4 px-lg-5 mt-5">           
                        <?php
                            if(isset($_GET['MaDM'])){
                                $madanhmuc = $_GET['MaDM'];
                                
                                $sql1 = "SELECT * FROM SanPham WHERE MaDanhMuc = '$madanhmuc'";
                                $sql2 = "SELECT * FROM DanhMucSanPham WHERE MaDanhMuc = '$madanhmuc'";

                                $bang1 = mysqli_query($kn, $sql1);
                                $bang2 = mysqli_query($kn, $sql2);
                                
                                if ($bang2->num_rows > 0) {
                                    while ($tam2 = $bang2->fetch_assoc()) {
                                        $tensp = mb_strtoupper($tam2['TenDanhMuc']);
                                        echo '   <div class="jumbotron bg-light text-center"  style=" background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);">
                                                    <h2>' . $tensp . '</h2>
                                                </div>';
                                        echo '<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">';
                                        if ($bang1->num_rows > 0) {
                                            while ($tam1 = $bang1->fetch_assoc()) {
                                                // Format giá với dấu chấm sau ba số
                                                $formattedPrice = number_format($tam1['GiaBan'], 0, ',', '.');
                                
                                                echo ('<div class="col mb-5">
                                                            <div class="card h-100 myClass" data-product-id="' . $tam1['TenSanPham'] . '" style="border-radius: 15px;">
                                                                <!-- Product image-->
                                                                <img class="card-img-top" src="' . $tam1['Anh'] . '" alt="..." />
                                                                <!-- Product details-->
                                                                <div class="card-body p-1">	
                                                                </div>
                                                                <!-- Product actions-->
                                                                <div class="card-footer p-1 pt-0 border-top-0 bg-transparent">
                                                                    <div class="text-center">
                                                                        <!-- Product name-->
                                                                        <h5 class="fw-bolder">' . $tam1['TenSanPham'] . '</h5>
                                                                    </div>
                                                                    <div class="text-center">
                                                                        <!-- Product quantity-->
                                                                        Hiện còn: ' . $tam1['SoLuong'] . '
                                                                    </div>
                                                                    <div class="text-center fw-bolder">
                                                                        <!-- Product price-->
                                                                        ' . $formattedPrice . ' VNĐ
                                                                    </div>
                                                                    <hr>
                                                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="xemchitietsp.php?TenSP=' . $tam1["TenSanPham"] . '">Xem chi tiết</a></div>
                                                                </div>
                                                            </div>
                                                    </div>');
                                            }
                                        }
                                        echo '</div>';
                                    }
                                }
                                
                            }
                        ?>                 
                <script>
                    $(document).ready(function () {
                        $(".myClass").on("click", function() {
                            var TenSP = $(this).data("product-id");
                            window.location.href = "xemchitietsp.php?TenSP=" + TenSP;
                        });
                    });
                </script>
            </div>
        </section>

<?php
    include("footer.php");
?>