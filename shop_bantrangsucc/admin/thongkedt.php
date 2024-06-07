<?php
    session_start();
    include("header_ad.php");
?>

<?php
   include ("../database/ketnoi.php"); 
?>
<?php
// Kết nối cơ sở dữ liệu
include ("../database/ketnoi.php");

// Truy vấn số lượng đơn hàng và tổng doanh thu theo ngày
$sql = "
SELECT NgayLap, COUNT(MaDonHang) AS SoLuongDonHang, SUM(TongTien) AS TongDoanhThu
FROM DonHang
GROUP BY NgayLap
ORDER BY NgayLap
";
$result = $kn->query($sql);

if (!$result) {
    die("Query failed: " . $kn->error);
}

$ngay = [];
$soLuongDonHang = [];
$tongDoanhThu = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ngay[] = $row['NgayLap'];
        $soLuongDonHang[] = $row['SoLuongDonHang'];
        $tongDoanhThu[] = $row['TongDoanhThu'];
    }
} else {
    echo "0 kết quả";
}
$kn->close();
?>


<div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div id="columnChartContainer">
                    <canvas id="columnChart"></canvas>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th >Ngày</th>
                            <th >Doanh thu (VND)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($ngay as $index => $ngayLap) {
                            echo "<tr>";
                            echo "<td>" . $ngayLap . "</td>";
                            echo "<td>" . number_format($tongDoanhThu[$index], 0, ',', '.') . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('columnChart').getContext('2d');
        var columnChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($ngay); ?>, // Mảng các nhãn ngày
                datasets: [{
                    label: 'Số lượng đơn hàng',
                    data: <?php echo json_encode($soLuongDonHang); ?>, // Mảng số lượng đơn hàng
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    barThickness: 45 
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: 18 
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 18 
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 18 
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y;
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    </script>







<?php
    include("footer_ad.php")
?>