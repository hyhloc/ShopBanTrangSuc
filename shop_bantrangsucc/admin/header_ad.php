<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ADMIN | Quản lý</title>

    <link href="../assets/adCSS/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../assets/adCSS/animate.css" rel="stylesheet">
    <link href="../assets/adCSS/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
 
    <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> -->
    


</head>
<style>
    #pieChart {
    width: 700px !important;
    height: 750px !important;

    
    
}
#columnChartContainer {
            width: 80%; 
            height: 400px; 
            margin: auto;
        }
</style>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img alt="image" class="img-circle" src="../images/img_avatar1.png" style="height:50px ;" />
                                </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Admin</strong>
                                </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="index_ad.php">Trang chủ</a></li>
                                <li><a href="../index.php">Trang bán hàng</a></li>
                                <li><a href="mailbox.html"></a></li>
                                <li class="divider"></li>
                                <li><a href='../control/dangxuat_xuly.php'>Đăng xuất</a></li>                           
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Quản lý thành viên</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <!-- <li><a href="../admin/quanly_qtv.php">Quản trị viên</a></li> -->
                            <li><a href="../admin/quanly_nguoidung.php">Người dùng</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart" ></i> <span class="nav-label">Thống kê</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="../admin/thongkesp.php">Thống kê số lượng sản phẩm</a></li>
                            <li><a href="../admin/thongkedt.php">Thống kê doanh thu</a></li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="../admin/sanpham_quanly.php"><i class="fa fa-edit"></i> <span class="nav-label">Quản lý sản phẩm</span></a>
                    </li>

                    <li>
                        <a href="../admin/quanly_danhmuc.php"><i class="fa fa-folder"></i> <span class="nav-label">Quản lý danh mục</span></a>
                    </li>
                    <li>
                        <a href="../admin/nguyenlieu_quanly.php"><i class="fa fa-edit"></i> <span class="nav-label">Quản lý nguyên liệu</span></a>
                    </li>
                    <li>
                        <a href="../admin/quanly_nhacungcap.php"><i class="fa fa-institution"></i> <span class="nav-label">Quản lý nhà cung cấp</span></a>
                    </li>

                    <li>
                        <a href="../admin/donhang_quanly.php"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Quản lý đơn hàng</span></a>
                    </li>
                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message"></span>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i>  <span class="label label-warning"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li>
                                    
                                </li>
                                <li class="divider"></li>

                                <li>
                                    <div class="text-center link-block">
                                        <a href="mailbox.html">
                                            <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i>  <span class="label label-primary"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                            
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="notifications.html">
                                            <strong>See All Alerts</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a href="../control/dangxuat_xuly.php">
                                <i class="fa fa-sign-out"></i>Đăng xuất
                            </a>
                        </li>
                        <li>
                            <a class="right-sidebar-toggle">
                                <i class="fa fa-tasks"></i>
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
            <div class="wrapper wrapper-content">
                <div class="row">   