<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="UTF-8">
	<meta name="description" content="Ogani Template">
	<meta name="keywords" content="Ogani, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Vsshop | Giỏ hàng</title>

	<?php include_once __DIR__.'/../layouts/meta.php';?>
	<?php include_once __DIR__.'/../layouts/style.php';?>
</head>

<body>
<style>
		.hinhdaidien {
			width: 100px;
			height: 100px;
		}
</style>

	<div id="preloder">
		<div class="loader"></div>
	</div>
	<?php include_once __DIR__.'/../layouts/partials/session.php';?>

	<?php include_once __DIR__.'/../layouts/partials/header.php';?>

	<?php include_once __DIR__.'/../layouts/partials/sidebar.php';?>
	<?php
		include_once __DIR__.'/../../dbconnect.php';

		$giohangdata = [];
		if (isset($_SESSION['giohangdata'])) {
			$giohangdata = $_SESSION['giohangdata'];
		} else {
			$giohangdata = [];
		}
	?>

		<!-- Breadcrumb Section Begin -->
		<section class="breadcrumb-section set-bg" data-setbg="/Vsshop/assets/vendor/frontend/img/breadcrumb.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="breadcrumb__text">
						<h2>Giỏ hàng</h2>
						<div class="breadcrumb__option">
							<a href="/Vsshop">Trang chủ</a>
							<span>Giỏ hàng</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Breadcrumb Section End -->

	<!-- Shoping Cart Section Begin -->
	<div class="container mt-4">
			<!-- Vùng ALERT hiển thị thông báo -->
			<div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
				<div id="thongbao">&nbsp;</div>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<h1 class="text-center">Giỏ hàng</h1>
			<div class="row">
				<div class="col col-md-12">
					<?php if (!empty($giohangdata)) : ?>
						<table id="tblGioHang" class="table table-bordered">
							<thead>
								<tr>
									<th>STT</th>
									<th>Ảnh đại diện</th>
									<th>Tên sản phẩm</th>
									<th>Số lượng</th>
									<th>Đơn giá</th>
									<th>Thành tiền</th>
									<th>Hành động</th>
								</tr>
							</thead>
							<tbody id="datarow">
								<?php $stt = 1; ?>
								<?php foreach ($giohangdata as $sanpham) : ?>
									<tr>
										<td><?= $stt++; ?></td>
										<td>
											<?php if (empty($sanpham['hinhdaidien'])) : ?>
												<img src="/Vsshop/assets/vendor/frontend/img/default-image_600.png" class="img-fluid hinhdaidien" />
											<?php else : ?>
												<img src="/Vsshop/assets/uploads/products/<?= $sanpham['hinhdaidien'] ?>" class="img-fluid hinhdaidien" />
											<?php endif; ?>
										</td>
										<td><?= $sanpham['sp_ten'] ?></td>
										<td>
											<input type="number" class="form-control" id="soluong_<?= $sanpham['sp_id'] ?>" name="soluong" value="<?= $sanpham['soluong'] ?>"/>
											<button class="btn btn-primary btn-sm btn-capnhat-soluong" data-sp-id="<?= $sanpham['sp_id'] ?>">Cập nhật</button>
										</td>
										<td><?= number_format($sanpham['gia'], 2, ".", ",")?> vnđ</td>
										<td><?= number_format($sanpham['soluong'] * $sanpham['gia'], 2, ".", ",")?> vnđ</td>
										<td>
											<a id="delete_<?= $stt ?>" data-sp-id="<?= $sanpham['sp_id'] ?>" class="btn btn-danger btn-delete-sanpham">
												<i class="fa fa-trash" aria-hidden="true"></i> Xóa
											</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php else : ?>
						<h2>Giỏ hàng rỗng!!!</h2>
					<?php endif; ?>
					<a href="/Vsshop" class="btn btn-warning btn-md"><i class="fa fa-arrow-left" aria-hidden="true"></i> Quay
						về trang chủ</a>
					<a href="/Vsshop/frontend/sanpham/checkout.php" class="btn btn-primary btn-md"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Thanh toán</a>
				</div>
			</div>
		</div>

	<!-- Shoping Cart Section End -->

	<?php include_once __DIR__.'/../layouts/partials/footer.php';?>

	<?php include_once __DIR__.'/../layouts/script.php';?>
	 <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
	 <script>
		$(document).ready(function() {
			function removeSanPhamVaoGioHang(id) {
				// Dữ liệu gởi
				var dulieugoi = {
					sp_id: id
				};

				// AJAX đến API xóa sản phẩm khỏi Giỏ hàng trong Session
				$.ajax({
					url: '/Vsshop/frontend/api/giohang-xoasanpham.php',
					method: "POST",
					dataType: 'json',
					data: dulieugoi,
					success: function(data) {
						// Refresh lại trang
						location.reload();
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus, errorThrown);
						var htmlString = `<h1>Không thể xử lý</h1>`;
						$('#thongbao').html(htmlString);
						// Hiện thông báo
						$('.alert').removeClass('d-none').addClass('show');
					}
				});
			};

			// Đăng ký sự kiện cho các nút đang sử dụng class .btn-delete-sanpham
			$('#tblGioHang').on('click', '.btn-delete-sanpham', function(event) {
				// debugger;
				event.preventDefault();
				var id = $(this).data('sp-id');

				console.log(id);
				removeSanPhamVaoGioHang(id);
			});

			// Cập nhật số lượng trong Giỏ hảng
			function capnhatSanPhamTrongGioHang(id, soluong) {
				// Dữ liệu gởi
				var dulieugoi = {
					sp_id: id,
					soluong: soluong
				};

				$.ajax({
					url: '/Vsshop/frontend/api/giohang-capnhatsanpham.php',
					method: "POST",
					dataType: 'json',
					data: dulieugoi,
					success: function(data) {
						// Refresh lại trang
						location.reload();
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus, errorThrown);
						var htmlString = `<h1>Không thể xử lý</h1>`;
						$('#thongbao').html(htmlString);
						// Hiện thông báo
						$('.alert').removeClass('d-none').addClass('show');
					}
				});
			};
			$('#tblGioHang').on('click', '.btn-capnhat-soluong', function(event) {
				// debugger;
				event.preventDefault();
				var id = $(this).data('sp-id');
				var soluongmoi = $('#soluong_' + id).val();
				capnhatSanPhamTrongGioHang(id, soluongmoi);
			});
		});
	</script>
</body>
</html>