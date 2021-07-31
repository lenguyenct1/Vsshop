<?php
if (session_id() === '') {
	session_start();
}

if(!isset($_SESSION['kh_tendangnhap_logged'])) {
	header('location:quanly/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SB Admin 2 - Dashboard</title>

	<?php include_once __DIR__.'/layouts/style.php';?>
	<?php include_once __DIR__.'/layouts/meta.php';?>
</head>

<body id="page-top">
	<div id="wrapper">
		<?php include_once __DIR__.'/layouts/partials/sidebar.php';?>
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<?php include_once __DIR__.'/layouts/partials/header.php';?>
				<div class="container-fluid">
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">Trang Tổng quan bán hàng</h1>
					</div>
					 <div class="container-fluid">
						<div class="row">
							<div class="col-sm-6 col-lg-3">
							<div class="card text-white bg-primary mb-2">
								<div class="card-body pb-0">
								<div class="text-value" id="baocaoSanPham_SoLuong">
									<h1>0</h1>
								</div>
								<div>Tổng số mặt hàng</div>
								</div>
							</div>
							<button class="btn btn-primary btn-sm form-control" id="refreshBaoCaoSanPham">Refresh dữ liệu</button>
							</div> 
							<div class="col-sm-6 col-lg-3">
							<div class="card text-white bg-success mb-2">
								<div class="card-body pb-0">
								<div class="text-value" id="baocaoKhachHang_SoLuong">
									<h1>0</h1>
								</div>
								<div>Tổng số khách hàng</div>
								</div>
							</div>
							<button class="btn btn-success btn-sm form-control" id="refreshBaoCaoKhachHang">Refresh dữ liệu</button>
							</div> 
							<div class="col-sm-6 col-lg-3">
							<div class="card text-white bg-warning mb-2">
								<div class="card-body pb-0">
								<div class="text-value" id="baocaoDonHang_SoLuong">
									<h1>0</h1>
								</div>
								<div>Tổng số đơn hàng</div>
								</div>
							</div>
							<button class="btn btn-warning btn-sm form-control" id="refreshBaoCaoDonHang">Refresh dữ liệu</button>
							</div>
							<div id="ketqua"></div>
						</div>
						<div class="row">
							<div class="col-sm-6 col-lg-6">
								<canvas id="chartOfobjChartThongKeLoaiSanPham"></canvas>
								<button class="btn btn-outline-primary btn-sm form-control" id="refreshThongKeLoaiSanPham">Refresh dữ liệu</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php include_once __DIR__.'/layouts/partials/footer.php';?>
		</div>
	</div>
	<?php include_once __DIR__.'/layouts/partials/user_logout.php';?>
	<?php include_once __DIR__.'/layouts/script.php';?>
<script>
	$(document).ready(function() {
		function getDuLieuBaoCaoTongSoMatHang() {
			$.ajax('/Vsshop/backend/api/baocao-tongsomathang.php', {
			success: function(data) {
				var dataObj = JSON.parse(data);
				var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
				$('#baocaoSanPham_SoLuong').html(htmlString);
			},
			error: function() {
				var htmlString = `<h1>Không thể xử lý</h1>`;
				$('#baocaoSanPham_SoLuong').html(htmlString);
			}
			});
		}
		$('#refreshBaoCaoSanPham').click(function(event) {
			event.preventDefault();
			getDuLieuBaoCaoTongSoMatHang();
		});

		function getDuLieuBaoCaoTongSoKhachHang() {
			$.ajax('/Vsshop/backend/api/baocao-tongsokhachhang.php', {
			success: function(data) {
				var dataObj = JSON.parse(data);
				var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
				$('#baocaoKhachHang_SoLuong').html(htmlString);
			},
			error: function() {
				var htmlString = `<h1>Không thể xử lý</h1>`;
				$('#baocaoKhachHang_SoLuong').html(htmlString);
			}
			});
		}

		$('#refreshBaoCaoKhachHang').click(function(event) {
			event.preventDefault();
			getDuLieuBaoCaoTongSoKhachHang();
		});

		function getDuLieuBaoCaoTongSoDonHang() {
			$.ajax('/Vsshop/backend/api/baocao-tongsodonhang.php', {
				success: function(data) {
					var dataObj = JSON.parse(data);
					var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
					$('#baocaoDonHang_SoLuong').html(htmlString);
				},
				error: function() {
					var htmlString = `<h1>Không thể xử lý</h1>`;
					$('#baocaoDonHang_SoLuong').html(htmlString);
				}
			});
		}
		$('#refreshBaoCaoDonHang').click(function(event) {
			event.preventDefault();
			getDuLieuBaoCaoTongSoDonHang();
		});
	
	var $objChartThongKeLoaiSanPham;
	var $chartOfobjChartThongKeLoaiSanPham = document.getElementById("chartOfobjChartThongKeLoaiSanPham").getContext("2d");
		function renderChartThongKeLoaiSanPham() {
			$.ajax({
				url: '/Vsshop/backend/api/baocao-thongkeloaisanpham.php',
				type: "GET",
				success: function(response) {
					var data = JSON.parse(response);
					var myLabels = [];
					var myData = [];
					$(data).each(function() {
						myLabels.push((this.TenThuongHieu));
						myData.push(this.SoLuong);
					});
					myData.push(0);
					if (typeof $objChartThongKeLoaiSanPham !== "undefined") {
						$objChartThongKeLoaiSanPham.destroy();
					}
					$objChartThongKeLoaiSanPham = new Chart($chartOfobjChartThongKeLoaiSanPham, {
						type: "bar",
						data: {
						labels: myLabels,
						datasets: [{
							data: myData,
							borderColor: "#9ad0f5",
							backgroundColor: "#9ad0f5",
							borderWidth: 1
						}]
						},
						options: {
						legend: {
							display: false
						},
						title: {
							display: true,
							text: "Thống kê Thương hiệu sản phẩm"
						},
						responsive: true
						}
					});
				}
			});
		};
		$('#refreshThongKeLoaiSanPham').click(function(event) {
			event.preventDefault();
			renderChartThongKeLoaiSanPham();
		});

		getDuLieuBaoCaoTongSoMatHang();
		getDuLieuBaoCaoTongSoKhachHang();
		getDuLieuBaoCaoTongSoDonHang();
		renderChartThongKeLoaiSanPham();
	});
</script>
</body>
</html>