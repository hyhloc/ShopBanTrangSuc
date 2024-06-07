<?php
    session_start();
    include("database/ketnoi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/styles.css" rel="stylesheet" />
</head>
<style>
    header {
        height: 250px; /* Đặt giá trị chiều cao mới tùy chỉnh */
    }
	header img {
        width: 700px; /* Đặt kích thước tối đa là 100% của phần tử cha */
        height: auto; /* Duy trì tỷ lệ khung hình */
        height: 500px; /* Đặt chiều cao tối đa nếu cần */
    }

	.pagination {
    display: flex;
    justify-content: center;
	}	

	.pagination li {
		margin: 0 5px;
	}
	


</style>
<body>

<!-- Navigation 1-->
<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <!-- Brand/logo -->
    <!-- Links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="#!" data-toggle="modal" data-target="#modalThongtin"><i class="fas fa-user"></i>&nbsp; Tài khoản</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="giohang.php"><i class="fas fa-shopping-cart"></i>&nbsp; Giỏ hàng</a>
        </li>
    </ul>
</nav>



<!-- Navigation 2-->
<nav class="navbar navbar-expand-sm " style="background-color:#444444">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php" style="color:white">Trang chủ</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">Danh mục</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                            $dm = "SELECT * FROM DanhMucSanPham";
                            $tam = $kn->query($dm);
                            if($tam->num_rows > 0){
                                while($dm_tam = $tam->fetch_assoc()){
                                    echo '<li><a class="dropdown-item" href="timsp_danhmuc.php?MaDM=' . $dm_tam["MaDanhMuc"] . '">' . $dm_tam["TenDanhMuc"] . '</a></li>';
                                }
                            }
                        ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <div class="navbar-nav d-flex">
                        					<?php
if (isset($_SESSION['taikhoan'])) {
    // Nếu người dùng đã đăng nhập, thực hiện truy vấn để lấy thông tin đầy đủ
    $taikhoan = $_SESSION['taikhoan'];
    $sql = "SELECT TenDayDu FROM NguoiDungWeb WHERE TaiKhoan = '$taikhoan'";
    $result = mysqli_query($kn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Kiểm tra xem có dữ liệu từ câu truy vấn không
        if ($row !== null) {
            $tenDayDu = $row['TenDayDu'];

            echo ('<li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">'.$tenDayDu.'</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">    
                            <li><a class="dropdown-item" href="" data-toggle="modal" data-target="#modalDonhang"><i class="fas fa-shipping-fast"></i> Đơn hàng</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="control/dangxuat_xuly.php"><i class="fas fa-sign-out-alt"></i> Thoát</a></li>
                        </ul>
                    </li>');
        } else {
            // Xử lý trường hợp không tìm thấy dữ liệu
            echo "Không tìm thấy thông tin người dùng";
        }
    }
} else {
    echo ("<button style='margin-right: 10px;' class='btn btn-outline-light' data-toggle='modal' data-target='#modalDangky'>Đăng ký</button>");
    echo ("<button class='btn btn-outline-light' data-toggle='modal' data-target='#modalDangnhap'>Đăng nhập</button>");
}
?>
                    </div>
                </li>
            </ul>
            <form class="d-flex" id="searchForm">
    <input class="form-control me-2" type="text" placeholder="Search" id="searchInput">
    <button class="btn btn-primary" type="button" onclick="searchProduct()">Search</button>
</form>

        </div>
    </div>
</nav>
<script>
    function searchProduct() {
        var searchTerm = document.getElementById('searchInput').value;
        if (searchTerm.trim() !== "") {
            window.location.href = 'timkiem.php?search=' + searchTerm;
        }
    }
</script>


		
		<!-------------------MODAL ĐĂNG KÝ---------------------------->
		<div class="modal" id="modalDangky">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title text-info">Đăng ký thành viên</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
											
					<!-- Modal body -->
					<div class="modal-body">
						<form action="control/dangky_xuly.php" method="post">
							<div class="form-group">
								<label for="txtTenDK">Tên đăng nhập: </label>
								<input type="text" class="form-control" name="txtTenDK" id="txtTenDK" autocomplete="off" placeholder="Nhập tên tài khoản" required>
							</div>

							<div class="form-group">
								<label for="password">Mật khẩu: </label>
								<input type="password" class="form-control" name="txtMatKhauDK" id="txtMatKhauDK" autocomplete="off" placeholder="Nhập mật khẩu" required>
							</div>

							<div class="form-group">
								<label for="username">Tên đầy đủ: </label>
								<input type="text" class="form-control" name="txtTenDD" id="txtTenDD" autocomplete="off" placeholder="Nhập tên đầy đủ" required>
							</div>

							<div class="form-group">
								<label for="txtEmail">Email: </label>
								<input type="text" class="form-control" name="txtEmail" id="txtEmail" autocomplete="off" placeholder="Nhập email" required>
							</div>

							<div class="form-group">
								<label for="txtDiaChi">Địa chỉ: </label>
								<input type="text" class="form-control" name="txtDiaChi" id="txtDiaChi" autocomplete="off" placeholder="Nhập địa chỉ" required>
							</div>

							<div class="form-group">
								<label for="txtDienThoai">Điện thoại: </label>
								<input type="text" class="form-control" name="txtDienThoai" id="txtDienThoai" autocomplete="off" placeholder="Nhập số điện thoại" required>
							</div>
															
							<!-- Modal footer -->
							<div class="modal-footer">
								<input type="submit" class="btn btn-outline-info" name="btnDangky" value="Đăng ký" required>
								<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Đóng</button>
							</div>
						</form>
					</div>		
				</div>
			</div>
		</div>
					
		<!-------------------MODAL ĐĂNG NHẬP-------------------------->
		<div class="modal" id="modalDangnhap">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title text-success">Đăng nhập</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
											
					<!-- Modal body -->
					<div class="modal-body">
						<form action="control/dangnhap_xuly.php" method="post">
							<div class="form-group">
								<label for="txtTenDN">Tên đăng nhập: </label>
								<input type="text" class="form-control" name="txtTenDN" id="txtTenDN" autocomplete="off" placeholder="Nhập tên đăng nhập" required>
							</div>

							<div class="form-group">
								<label for="password">Mật khẩu: </label>
								<input type="password" class="form-control" name="txtMatKhau" id="txtMatKhau" autocomplete="off" placeholder="Nhập mật khẩu" required>
							</div>

							<!-- Modal footer -->
							<div class="modal-footer">
								<input type="submit" class="btn btn-outline-success" name="btnDangnhap" value="Đăng nhập" required>
								<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Đóng</button>
							</div>
						</form>
					</div>				
				</div>
			</div>
		</div>

		<!---------------------MODAL THÔNG TIN CÁ NHÂN ------------------->
		<div class="modal" id="modalThongtin">
			<div class="modal-dialog text-center">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title text-info">Thông tin cá nhân</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
											
					<!-- Modal body -->
					<div class="modal-body ">
						<div class="card" style="width:460px">
							<img class="card-img-top" src="images/img_avatar1.png" alt="Card image" style="width:100%">
							<div class="card-body">
								<?php
									$tt = "SELECT * FROM NguoiDungWeb";
									$tt_tam = ($kn -> query($tt)) -> fetch_assoc();
									if(isset($_SESSION['taikhoan']) && $_SESSION['taikhoan'] = $tt_tam['TaiKhoan']){
										echo '<h4 class="card-title">'.$tt_tam['TenDayDu'].'</h4>';
										echo '<p class="card-text">Email: '.$tt_tam['Email'].'</p>';
										echo '<p class="card-text">Địa chỉ: '.$tt_tam['DiaChi'].'</p>';
										echo '<p class="card-text">Điện thoại: '.$tt_tam['DienThoai'].'</p>';	
									}	
								?>	
							</div>
							<div class="card-footer">
								<a href="#" data-toggle='modal' data-target='#modalSuathongtin' class="btn btn-outline-info" data-dismiss="modal">Chỉnh sửa</a>
							</div>
						</div>
					</div>				
				</div>
			</div>
		</div>

		<!----------------------------- MODAL ĐƠN HÀNG -------------------------------->
		<div class="modal" id="modalDonhang">
			<div class="modal-dialog modal-lg ">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title text-dark">Đơn hàng của bạn</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
											
					<!-- Modal body -->
					<div class="modal-body">
						<table class="table">
							<thead>
								<th scope="col">Mã đơn hàng</th>
								<th scope="col">Tổng tiền</th>
								<th scope="col">Ngày đặt hàng</th>
								<th scope="col"></th>
							</thead>
							<tbody>
							<?php
$tendn_tam = mysqli_query($kn, "SELECT * FROM NguoiDungWeb");
$tendn = $tendn_tam->fetch_assoc();
if (isset($_SESSION['taikhoan']) && $_SESSION['taikhoan'] == $tendn['TaiKhoan']) {
    $email_tam = $tendn['Email'];
    $dh_tam = mysqli_query($kn, "SELECT * FROM DonHang WHERE Email = '$email_tam'");
    while ($dh = mysqli_fetch_array($dh_tam)) {
        // Format giá và tổng tiền với dấu chấm sau 3 số và thêm VNĐ
        $formattedTongTien = number_format($dh['TongTien'], 0, ',', '.') . ' VNĐ';

        echo '<tr>
                <td class="align-middle">
                    <p class="mb-0" style="font-weight: 500;">' . $dh['MaDonHang'] . '</p>
                </td>
                <td class="align-middle" style="width:200px">
                    <p class="mb-0" style="font-weight: 500;">' . $formattedTongTien . '</p>
                </td>
                <td class="align-middle">
                    <p class="mb-0" style="font-weight: 500;">' . $dh['NgayLap'] . '</p>
                </td>
                <td>
                    <form action="donhang.php?MaDH=' . $dh["MaDonHang"] . '" method="POST">
                        <div class="d-flex flex-row">
                            <input type="submit" name="xemchitiet" class="btn btn-outline-primary btn-block" value="Xem chi tiết">
                        </div>
                    </form>
                </td>                        
            </tr>';
    }
}
?>
							
							</tbody>
						</table>
					</div>				
				</div>
			</div>
		</div>
		

		<!-------------------MODAL SỬA THÔNG TIN-------------------------->
		<div class="modal" id="modalSuathongtin">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title text-success">Chỉnh sửa thông tin cá nhân</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
											
					<!-- Modal body -->
					<div class="modal-body">
						<form action="control/suathongtin_xuly.php" method="post">
							<div class="form-group">
								<label for="txtDiachi">Địa chỉ: </label>
								<input type="text" class="form-control" name="txtDiachi" id="txtDiachi" autocomplete="off" placeholder="Nhập địa chỉ" required>
							</div>

							<div class="form-group">
								<label for="txtSodt">Số điện thoại: </label>
								<input type="text" class="form-control" name="txtSodt" id="txtSodt" autocomplete="off" placeholder="Nhập số điện thoại" required>
							</div>

							<!-- Modal footer -->
							<div class="modal-footer">
								<input type="submit" class="btn btn-outline-success" name="btnSuatt" value="Sửa thông tin" required>
								<button type="button" class="btn btn-outline-danger" data-dismiss="modal">Đóng</button>
							</div>
						</form>
					</div>				
				</div>
			</div>
		</div>


        <!-- Header-->
		<header class="bg-light py-5 d-flex align-items-center justify-content-center">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <img src="images/logo.png" alt="">
        </div>
    </div>
</header>