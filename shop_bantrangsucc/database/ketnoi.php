<?php
    $kn = mysqli_connect("localhost:3377", "root", "") or die ("Không thể kết nối đến server");
    $csdl = mysqli_select_db($kn, "shop_trangsucc") or die ("Không thể chọn được cơ sở dữ liệu");
    mysqli_query($kn, "SET NAMES 'utf8'");
?>