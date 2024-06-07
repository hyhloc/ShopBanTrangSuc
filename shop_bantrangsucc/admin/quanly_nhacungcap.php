<?php
    session_start();
    include("header_ad.php")
?>


<body>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title fw-bolder">
                        <h2>QUẢN LÝ NHÀ CUNG CẤP</h2>
                    </div>
                    <div class="ibox-content">  
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th>MÃ NHÀ CUNG CẤP</th>
                                        <th>TÊN NHÀ CUNG CẤP</th>
                                        <th>SỐ ĐIỆN THOẠI</th>
                                        <th>ĐỊA CHỈ</th>
                                        <th colspan="2"></th>
                                    </tr>
                                </thead>

                                <?php
                                    include ("../database/ketnoi.php");
                                    $sql = "SELECT * FROM NhaCungCap";
                                    $kq = mysqli_query($kn,$sql);
                                    while($row=mysqli_fetch_array($kq))
                                    {
                                        echo ("<tbody>");
                                            echo ("<tr>"); $mancc=$row["MaNhaCungCap"];
                                                echo ("<td>".$row["MaNhaCungCap"]."</td>");
                                                echo ("<td>".$row["TenNhaCungCap"]."</td>");
                                                echo ("<td>".$row["DienThoai"]."</td>");
                                                echo ("<td>".$row["DiaChi"]."</td>");
                                                echo ("<td><a class='btn btn-warning btn-block' href='CSDL_suamon.php? m=$mancc'>Sửa nhà cung cấp</a></td>");
                                                echo ("<td><a class='btn btn-danger btn-block' href='../control/xoanhacungcap_xuly.php?ncc=$mancc'>Xóa nhà cung cấp</a></td>");
                                            echo ("</tr>");
                                        echo ("</tbody>");
                                    }
                                ?>
                                <tr>
                                    <td colspan="4"></td>
                                    <td colspan="2">
                                        <button class="btn btn-primary btn-block" href='' data-toggle="modal" data-target="#modalThemNCC">Thêm nhà cung cấp</button>
                                    </td>
                                </tr>
                            </table>
                            
                            <div class="modal" id="modalThemNCC">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h2 class="modal-title text-success font-weight-bolder text-center">THÊM NHÀ CUNG CẤP</h2>
                                        </div>
                                                        
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="../control/themncc_xuly.php" method="post">
                                                <div class="form-group">
                                                    <label for="txtMaNCC">Mã nhà cung cấp: </label>
                                                    <input type="text" class="form-control" name="txtMaNCC" id="txtMaNCC" autocomplete="off" placeholder="Nhập mã nhà cung cấp" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtTenNCC">Tên nhà cung cấp: </label>
                                                    <input type="text" class="form-control" name="txtTenNCC" id="txtTenNCC" autocomplete="off" placeholder="Nhập tên nhà cung cấp" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtDiaChi">Địa chỉ: </label>
                                                    <input type="text" class="form-control" name="txtDiaChi" id="txtDiaChi" autocomplete="off" placeholder="Nhập địa chỉ nhà cung cấp">
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtDienThoai">Điện thoại: </label>
                                                    <input type="text" class="form-control" name="txtDienThoai" id="txtDienThoai" autocomplete="off" placeholder="Nhập điện thoại nhà cung cấp">
                                                </div>
                        
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <input type="submit" class="btn btn-success" name="btnThemNCC" value="Thêm" required>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                                                </div>
                                            </form>
                                        </div>		
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<?php
    include("footer_ad.php")
?>