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
                        <h2>QUẢN LÝ NGUYÊN LIỆU</h2>
                    </div>
                    <div class="ibox-content">  
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th>MÃ NGUYÊN LIỆU</th>
                                        <th>TÊN NGUYÊN LIỆU</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <?php
                                    include ("../database/ketnoi.php");
                                    $sql = "SELECT * FROM NguyenLieu";
                                    $kq = mysqli_query($kn,$sql);
                                    while($row=mysqli_fetch_array($kq))
                                    {
                                        echo ("<tbody>");
                                            echo ("<tr>"); $nl=$row["MaNguyenLieu"];
                                                echo ("<td>".$row["MaNguyenLieu"]."</td>");
                                                echo ("<td>".$row["TenNguyenLieu"]."</td>");
                                                echo ("<td><a class='btn btn-danger btn-block' href='../control/xoanguyenlieu_xuly.php?manl=$nl'>Xóa nguyên liệu</a></td>");
                                            echo ("</tr>");
                                        echo ("</tbody>");
                                    }
                                ?>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">
                                        <button class="btn btn-primary btn-block" href='' data-toggle="modal" data-target="#modalThemNCC">Thêm nguyên liệu</button>
                                    </td>
                                </tr>
                            </table>
                            
                            <div class="modal" id="modalThemNCC">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h2 class="modal-title text-success font-weight-bolder text-center">THÊM NGUYÊN LIỆU</h2>
                                        </div>
                                                        
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="../control/themnguyenlieu.php" method="post">
                                                <div class="form-group">
                                                    <label for="txtMaNguyenLieu">Mã nguyên liệu </label>
                                                    <input type="text" class="form-control" name="txtMaNguyenLieu" id="txtMaNguyenLieu" autocomplete="off" placeholder="Nhập mã nguyên liệu" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtTenNguyenLieu">Tên nguyên liệu: </label>
                                                    <input type="text" class="form-control" name="txtTenNguyenLieu" id="txtTenNguyenLieu" autocomplete="off" placeholder="Nhập tên nguyên liệu" required>
                                                </div>                       
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <input type="submit" class="btn btn-success" name="btnThemNguyenLieu" value="Thêm" required>
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