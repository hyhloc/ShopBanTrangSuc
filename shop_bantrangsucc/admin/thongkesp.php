<?php
    session_start();
    include("header_ad.php");
?>

<?php
   include ("../database/ketnoi.php"); 
  
   $sql = "
   SELECT dm.TenDanhMuc, SUM(sp.SoLuong) AS TongSoLuong
   FROM SanPham sp
   JOIN danhmucsanpham dm ON sp.MaDanhMuc = dm.MaDanhMuc
   GROUP BY dm.TenDanhMuc
   ";
$result = $kn->query($sql);

if (!$result) {
    die("Query failed: " . $kn->error);
}

$danhMuc = [];
$tongSoLuong = [];

if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
       $danhMuc[] = $row['TenDanhMuc'];
       $tongSoLuong[] = $row['TongSoLuong'];
   }
} else {
   echo "0 kết quả";
}
$kn->close();
?>

<div class="container">
    <canvas id="pieChart" ></canvas>
</div>

<script>
    var ctx = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($danhMuc); ?>,
            datasets: [{
                label: 'Tổng số lượng sản phẩm',
                data: <?php echo json_encode($tongSoLuong); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top', 
                    labels: {
                        font: {
                            size: 16
                        },
                      
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed !== null) {
                                label += context.parsed;
                            }
                            return label;
                        }
                    },
                    bodyFont: {
                        size: 10 
                    }
                }
            }
        }
    });
</script>

<?php
    include("footer_ad.php")
?>
