<?php
    session_start();
    include("header_ad.php");
    include ("../database/ketnoi.php");
?>


<body>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title fw-bolder">
                        <h2>DANH MỤC SẢN PHẨM</h2>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th>MÃ DANH MỤC</th>
                                        <th>TÊN DANH MỤC</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <?php                                
                                    $sql = "SELECT * FROM DanhMucSanPham";
                                    $kq = mysqli_query($kn,$sql);
                                    while($row=mysqli_fetch_array($kq))
                                    {
                                        echo ("<tbody>");
                                            echo ("<tr>"); $madm=$row["MaDanhMuc"];
                                                echo ("<td>".$row["MaDanhMuc"]."</td>");
                                                echo ("<td>".$row["TenDanhMuc"]."</td>");   
                                                echo ("<td><a class='btn btn-danger btn-block' href='../control/xoadanhmuc_xuly.php?madm=$madm'>Xóa danh mục</a></td>");
                                            echo ("</tr>");
                                        echo ("</tbody>");
                                    }
                                ?>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">
                                        <button class="btn btn-primary btn-block" href='' data-toggle="modal" data-target="#modalThemDM">Thêm danh mục</button>
                                    </td>
                                </tr>
                            </table>
                        <!------------------ THÊM DANH MỤC ----------------->
                            <div class="modal" id="modalThemDM">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h2 class="modal-title text-success font-weight-bolder text-center">THÊM DANH MỤC</h2>
                                        </div>
                                                        
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form action="../control/themdanhmuc_xuly.php" method="post">
                                                <div class="form-group">
                                                    <label for="txtMaDM">Mã danh mục: </label>
                                                    <input type="text" class="form-control" name="txtMaDM" id="txtMaDM" autocomplete="off" placeholder="Nhập mã danh mục" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="txtTenDM">Tên danh mục: </label>
                                                    <input type="text" class="form-control" name="txtTenDM" id="txtTenDM" autocomplete="off" placeholder="Nhập tên danh mục" required>
                                                </div>
                        
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <input type="submit" class="btn btn-danger" data-dismiss="modal" value="Đóng">
                                                    <input type="submit" class="btn btn-primary" name="btnThemSP" value="Thêm">    
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

    <!-- Mainly scripts -->
    <script src="../assets/adJS/jquery-3.1.1.min.js"></script>
    <script src="../assets/adJS/bootstrap.min.js"></script>
    <script src="../assets/adJS/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../assets/adJS/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../assets/adJS/plugins/dataTables/datatables.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../assets/adJS/inspinia.js"></script>
    <script src="../assets/adJS/plugins/pace/pace.min.js"></script>
</body>


<?php
    include("footer_ad.php")
?>