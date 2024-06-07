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
                        <h2>QUẢN LÝ NGƯỜI DÙNG</h2>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th>TÊN ĐẦY ĐỦ</th>
                                        <th>EMAIL</th>
                                        <th>ĐỊA CHỈ</th>
                                        <th>ĐIỆN THOẠI</th>
                                        <th>NGÀY LẬP TK</th>
                                    </tr>
                                </thead>

                                <?php
                                    include ("../database/ketnoi.php");
                                    $sql="SELECT TenDayDu, Email, DiaChi, DienThoai, NgayTao FROM NguoiDungWeb WHERE VaiTro=1";
                                    $kq=mysqli_query($kn,$sql);
                                    while($row=mysqli_fetch_array($kq))
                                    {
                                        echo ("<tbody>");
                                            echo ("<tr>"); $email=$row["Email"];
                                                echo ("<td>".$row["TenDayDu"]."</td>");
                                                echo ("<td>".$row["Email"]."</td>");
                                                echo ("<td>".$row["DiaChi"]."</td>");
                                                echo ("<td>".$row["DienThoai"]."</td>");
                                                echo ("<td>".$row["NgayTao"]."</td>");
                                                echo ("<td><a class='btn btn-warning btn-block' href=''>Sửa người dùng</a></td>");
                                                echo ("<td><a class='btn btn-danger btn-block' href='../control/xoanguoidung_xuly.php?email=$email'>Xóa người dùng</a></td>");
                                            echo ("</tr>");
                                        echo ("</tbody>");
                                    }
                                ?>
                            </table>
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