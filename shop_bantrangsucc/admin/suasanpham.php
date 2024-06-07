<?php
    session_start();
    include("header_ad.php");
?>
<?php
    include("../database/ketnoi.php");
    $msp=$_REQUEST["msp"];
    $sql="SELECT * FROM SanPham WHERE MaSanPham='".$msp."'";
    $kq=mysqli_query($kn, $sql);
    echo '<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title fw-bolder">
                            <h2>CHỈNH SỬA SẢN PHẨM</h2>
                        </div>
                        <div class="ibox-content">';
        while($row=mysqli_fetch_array($kq)){
            echo '<form action="../control/suasanpham_xuly.php" method="post" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="txtMaSP">Mã sản phẩm: </label>
                <input type="text" class="form-control" name="txtMaSP" id="txtMaSP" autocomplete="off" value="'.$msp.'" readonly="true">
            </div>

            <div class="form-group">
                <label for="ddMaNCC">Tên nhà cung cấp: </label>                           
                <select name="ddMaNCC" id="ddMaNCC" class="form-control" required>';                                          
                        include ("../database/ketnoi.php");
                        $sql2="SELECT * FROM NhaCungCap";
                        $kq2=mysqli_query($kn,$sql2);
                        while ($row2 = mysqli_fetch_assoc($kq2)) {
                            echo "<option value='" . $row2['MaNhaCungCap'] . "'>" . $row2['TenNhaCungCap'] . "</option>";
                        }                                           
                echo'</select>
            </div>

            <div class="form-group">
                <label for="ddMaDM">Tên danh mục: </label>
                <select name="ddMaDM" id="ddMaDM" class="form-control" required>';
                        include ("../database/ketnoi.php");
                        $sql3="SELECT * FROM DanhMucSanPham";
                        $kq3=mysqli_query($kn,$sql3);
                        while ($row3 = mysqli_fetch_assoc($kq3)) {
                        echo "<option value='" . $row3['MaDanhMuc'] . "'>" . $row3['TenDanhMuc'] . "</option>";
                        }
                echo '</select>
            </div>

            <div class="form-group">
                <label for="txtTenSP">Tên sản phẩm: </label>
                <input type="text" class="form-control" name="txtTenSP" id="txtTenSP" autocomplete="off" placeholder="Nhập tên sản phẩm" value="'.$row['TenSanPham'].'">
            </div>

            <div class="form-group">
                <label for="file">Ảnh: </label>
                <div class="form-group">
                    <!-- <label for="file">Chọn file:</label> -->
                    <input type="file" class="form-control" name="file" id="file">
                </div>
                <!-- <input type="txtAnh" class="form-control" name="txtAnh" id="txtAnh" autocomplete="off"  required> -->
            </div>

            <div class="form-group">
                <label for="txtSoLuong">Số lượng: </label>
                <input type="text" class="form-control" name="txtSoLuong" id="txtSoLuong" autocomplete="off" placeholder="Nhập số lượng" value="'.$row['SoLuong'].'" required>
            </div>

            <div class="form-group">
                <label for="txtMoTa">Mô tả: </label>
                <input type="text" class="form-control" name="txtMoTa" id="txtMoTa" autocomplete="off" placeholder="Nhập mô tả" value="'.$row['Mota'].'">
            </div>

            <div class="form-group">
                <label for="txtGiaBan">Giá bán: </label>
                <input type="text" class="form-control" name="txtGiaBan" id="txtGiaBan" autocomplete="off" placeholder="Nhập giá bán" value="'.$row['GiaBan'].'" required>
            </div>
            <div class="form-group">
            <label for="ddMaNl">Tên nguyên liệu: </label>
            <select name="ddMaNl" id="ddMaNl" class="form-control" required>';
                    include ("../database/ketnoi.php");
                    $sql3="SELECT * FROM NguyenLieu";
                    $kq3=mysqli_query($kn,$sql3);
                    while ($row3 = mysqli_fetch_assoc($kq3)) {
                    echo "<option value='" . $row3['MaNguyenLieu'] . "'>" . $row3['TenNguyenLieu'] . "</option>";
                    }
            echo '</select>
        </div>
                                    
            <!-- Modal footer -->
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" name="btnThemSP" value="Sửa" required>
                <a href="sanpham_quanly.php" type="button" class="btn btn-danger">Đóng</a>
            </div>
        </form>';
        }
                echo '</div>
                </div>
            </div>
        </div>
    </div>';
?>

<?php
    include("footer_ad.php")
?>