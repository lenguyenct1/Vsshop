<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="UTF-8">
	<meta name="description" content="Ogani Template">
	<meta name="keywords" content="Ogani, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Vsshop | Chi tiết sản phẩm</title>

	<?php include_once __DIR__.'/../layouts/meta.php';?>
	<?php include_once __DIR__.'/../layouts/style.php';?>
</head>

<body>
	<div id="preloder">
		<div class="loader"></div>
	</div>
	<?php include_once __DIR__.'/../layouts/partials/session.php';?>

	<?php include_once __DIR__.'/../layouts/partials/header.php';?>

	<?php include_once __DIR__.'/../layouts/partials/sidebar.php';?>
	<?php
		include_once __DIR__.'/../../dbconnect.php';
//Lấy giá trị nhỏ nhất của sp_id gán lên url nếu sp_id không tồn tại hoặc không hợp lệ
		$check = $_GET['sp_id'];

		$sqlCheck = <<<EOT
		SELECT *
		FROM sanpham
		WHERE sp_id = '$check' LIMIT 1;
		EOT;

		$resultCheck = mysqli_query($conn, $sqlCheck);

		if (mysqli_num_rows($resultCheck) > 0) {
			$sp_id = $_GET['sp_id'];
		} else {
			$sqlMin = <<<EOT
					SELECT MIN(sp_id) AS min
					FROM sanpham;
			EOT;
			$result_min = mysqli_query($conn, $sqlMin);

			$min =mysqli_fetch_array($result_min, MYSQLI_ASSOC); 

			$sp_id = $min['min'];
		}

		$sqlSelectSanPham = <<<EOT
			SELECT sp.sp_id, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_mota_ngan, sp.sp_mota_chitiet, sp.sp_soluong, th.th_ten, xx.xx_ten
			FROM `sanpham` sp
			JOIN `thuonghieu` th ON sp.th_id = th.th_id
			JOIN `xuatxu` xx ON sp.xx_id = xx.xx_id
			WHERE sp.sp_id = $sp_id
		EOT;

		// Thực thi câu truy vấn SQL để lấy về dữ liệu ban đầu của record 
		$resultSelectSanPham = mysqli_query($conn, $sqlSelectSanPham);

		// Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
		// Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
		// Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
		$sanphamRow;
		while ($row = mysqli_fetch_array($resultSelectSanPham, MYSQLI_ASSOC)) {
			$sanphamRow = array(
				'sp_id' => $row['sp_id'],
				'sp_ten' => $row['sp_ten'],
				'sp_gia' => $row['sp_gia'],
				'sp_gia_formated' => number_format($row['sp_gia'], 2, ".", ",") . ' vnđ',
				'sp_giacu_formated' => number_format($row['sp_giacu'], 2, ".", ",") . ' vnđ',
				'sp_mota_ngan' => $row['sp_mota_ngan'],
				'sp_mota_chitiet' => $row['sp_mota_chitiet'],
				'sp_soluong' => $row['sp_soluong'],
				'th_ten' => $row['th_ten'],
				'xx_ten' => $row['xx_ten']
			);
		}
		/* --- End Truy vấn dữ liệu Sản phẩm --- */

		/* --- 
		--- 3.Truy vấn dữ liệu Hình ảnh Sản phẩm 
		--- 
		*/

		$sqlSelect = <<<EOT
			SELECT hsp.hsp_id, hsp.hsp_tentaptin
			FROM `hinhsanpham` hsp
			WHERE hsp.sp_id = $sp_id
EOT;

		// Thực thi câu truy vấn SQL để lấy về dữ liệu ban đầu của record 
		$result = mysqli_query($conn, $sqlSelect);

		// Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
		// Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
		// Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
		$danhsachhinhanh = [];
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$danhsachhinhanh[] = array(
				'hsp_id' => $row['hsp_id'],
				'hsp_tentaptin' => $row['hsp_tentaptin']
			);
		}
		/* --- End Truy vấn dữ liệu Hình ảnh sản phẩm --- */

		// Hiệu chỉnh dữ liệu theo cấu trúc để tiện xử lý
		$sanphamRow['danhsachhinhanh'] = $danhsachhinhanh;
		?>

	<section class="product-details spad">
		<div class="container">
		<div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
				<div id="thongbao">&nbsp;</div>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form name="frmsanphamchitiet" id="frmsanphamchitiet" method="post" action="">
			<div class="row">
				<?php
						$hinhsanphamdautien = empty($sanphamRow['danhsachhinhanh'][0]) ? '' : $sanphamRow['danhsachhinhanh'][0];
						?>
						<input type="hidden" name="sp_id" id="sp_id" value="<?= $sanphamRow['sp_id'] ?>" />
						<input type="hidden" name="sp_ten" id="sp_ten" value="<?= $sanphamRow['sp_ten'] ?>" />
						<input type="hidden" name="sp_gia" id="sp_gia" value="<?= $sanphamRow['sp_gia'] ?>" />
						<input type="hidden" name="hinhdaidien" id="hinhdaidien" value="<?= empty($hinhsanphamdautien) ? '' : $hinhsanphamdautien['hsp_tentaptin'] ?>" />
					<div class="col-lg-6 col-md-6">
						<div class="product__details__pic">
							<?php if (count($sanphamRow['danhsachhinhanh']) > 0) : ?>
							<div class="product__details__pic__item">
								<img class="product__details__pic__item--large"
									src="/Vsshop/assets/uploads/products/<?=$hinhsanphamdautien['hsp_tentaptin'] ?>" alt="">
							</div>
							<div class="product__details__pic__slider owl-carousel">
								<?php foreach ($sanphamRow['danhsachhinhanh'] as $hinhsanpham) : ?>
								<div>
										<img data-imgbigurl="/Vsshop/assets/uploads/products/<?= $hinhsanpham['hsp_tentaptin'] ?>"
											src="/Vsshop/assets/uploads/products/<?= $hinhsanpham['hsp_tentaptin'] ?>" alt="">
								</div>
								<?php endforeach; ?>
							</div>
							<!-- Không có hình sản phẩm nào => lấy ảnh mặc định -->
							<?php else : ?>
							<div class="product__details__pic__item">
								<img class="product__details__pic__item--large tab-pane active" 
									src="/Vsshop/assets/vendor/backend/img/default-image_600.png" alt="">
							</div>
							<div class="product__details__pic__slider owl-carousel">
								<div class="active">
										<img data-imgbigurl="/Vsshop/assets/vendor/backend/img/default-image_600.png"
											src="/Vsshop/assets/vendor/backend/img/default-image_600.png" alt="">
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-lg-6 col-md-6">
						<div class="product__details__text">
							<h3><?= $sanphamRow['sp_ten'] ?></h3>
							<div class="product__details__rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-half-o"></i>
								<span>(1000 reviews)</span>
							</div>
							<?php if ($sanphamRow['sp_giacu_formated'] != 0) : ?>
							<small class="product__details__price text-muted">Giá cũ: <s><span><?= $sanphamRow['sp_giacu_formated'] ?></span></s></small>
							<?php endif; ?>
							<h4 class="product__details__price price">Giá hiện tại: <span><?= $sanphamRow['sp_gia_formated'] ?></span></h4>
							<p><?= $sanphamRow['sp_mota_ngan'] ?></p>
							<div class="product__details__quantity">
								<div class="quantity">
									<div class="pro-qty">
										<input type="text" id="soluong" name="soluong" value="1">
									</div>
								</div>
							</div>
							<a href="#" class="primary-btn" id="btnThemVaoGioHang" >THÊM VÀO GIỎ</a>
							<ul>
								<li><b>Khả dụng</b> <span> Trong kho</span></li>
								<li><b>Xuất xứ</b> <span><?= $sanphamRow['xx_ten'] ?></span></li>
								<li><b>Chuyển hàng</b> <span> Vận chuyển 01 ngày. <samp>Nhận miễn phí ngay hôm nay</samp></span></li>
								<li><b>Chia sẻ</b>
									<div class="share">
										<a href="#"><i class="fa fa-facebook"></i></a>
										<a href="#"><i class="fa fa-twitter"></i></a>
										<a href="#"><i class="fa fa-instagram"></i></a>
										<a href="#"><i class="fa fa-pinterest"></i></a>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="product__details__tab">
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
										aria-selected="true">Thông tin chi tiết về Sản phẩm</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tabs-1" role="tabpanel">
									<div class="product__details__tab__desc">
										<h6>Thông tin về Sản phẩm</h6>
										 <?= $sanphamRow['sp_mota_chitiet'] ?>
									</div>
								</div>
							</div>
						</div>
					</div>
			</div>
			<form>
		</div>
	</section>


	<?php include_once __DIR__.'/../layouts/partials/footer.php';?>

	<?php include_once __DIR__.'/../layouts/script.php';?>
	<script>
		function addSanPhamVaoGioHang() {
			// Chuẩn bị dữ liệu gởi
			var dulieugoi = {
				sp_id: $('#sp_id').val(),
				sp_ten: $('#sp_ten').val(),
				sp_gia: $('#sp_gia').val(),
				hinhdaidien: $('#hinhdaidien').val(),
				soluong: $('#soluong').val(),
			};
			// console.log((dulieugoi));

			$.ajax({
				url: '/Vsshop/frontend/api/giohang-themsanpham.php',
				method: "POST",
				dataType: 'json',
				data: dulieugoi,
				success: function(data) {
					console.log(data);
					var htmlString =
						`Sản phẩm đã được thêm vào Giỏ hàng. <a href="/Vsshop/frontend/sanpham/cart.php">Xem Giỏ hàng</a>.`;
					$('#thongbao').html(htmlString);
					// Hiện thông báo
					$('.alert').removeClass('d-none').addClass('show');
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

		// Đăng ký sự kiện cho nút Thêm vào giỏ hàng
		$('#btnThemVaoGioHang').click(function(event) {
			event.preventDefault();
			addSanPhamVaoGioHang();
		});
	</script>
</body>
</html>