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
//Lấy giá trị nhỏ nhất của th_id gán lên url nếu th_id không tồn tại hoặc không hợp lệ
			$check = $_GET['th_id'];

			$sqlCheck = <<<EOT
			SELECT *
			FROM thuonghieu
			WHERE th_id = '$check' LIMIT 1;
			EOT;

			$resultCheck = mysqli_query($conn, $sqlCheck);

			if (mysqli_num_rows($resultCheck) > 0) {
				$th_id = $_GET['th_id'];
			} else {
				$sqlMin = <<<EOT
						SELECT MIN(th_id) AS min
						FROM thuonghieu;
				EOT;
				$result_min = mysqli_query($conn, $sqlMin);

				$min =mysqli_fetch_array($result_min, MYSQLI_ASSOC); 

				$th_id = $min['min'];
			}

			$sqlDanhSachSanPham = <<<EOT
									SELECT sp.sp_id, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_mota_ngan, sp.sp_soluong, th.th_ten, MAX(hsp.hsp_tentaptin) AS hsp_tentaptin
									FROM `sanpham` sp
									JOIN `thuonghieu` th ON sp.th_id = th.th_id
									LEFT JOIN `hinhsanpham` hsp ON sp.sp_id = hsp.sp_id
									WHERE th.th_id = $th_id
									GROUP BY sp.sp_id, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_mota_ngan, sp.sp_soluong, th.th_ten
		EOT;

		$result = mysqli_query($conn, $sqlDanhSachSanPham);

		$dataDanhSachSanPham = [];
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$dataDanhSachSanPham[] = array(
				'sp_id' => $row['sp_id'],
				'sp_ten' => $row['sp_ten'],
				'sp_gia' => number_format($row['sp_gia'], 2, ".", ",") . ' vnđ',
				'sp_giacu' => number_format($row['sp_giacu'], 2, ".", ","). 'vnđ',
				'sp_mota_ngan' => $row['sp_mota_ngan'],
				'sp_soluong' => $row['sp_soluong'],
				'th_ten' => $row['th_ten'],
				'hsp_tentaptin' => $row['hsp_tentaptin'],
			);
		}

		$sqlBrand = <<<EOT
						SELECT *
						FROM thuonghieu
						WHERE th_id = $th_id LIMIT 1;
		EOT;

		$resultBrand = mysqli_query($conn, $sqlBrand);

		$brand =mysqli_fetch_array($resultBrand, MYSQLI_ASSOC); 
	?>

	<section class="featured spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>Thương hiệu <?= $brand['th_ten'] ?></h2>
					</div>
				</div>
			</div>
			<div class="row featured__filter">
			<?php if(!empty($dataDanhSachSanPham)) :?>
			<?php foreach ($dataDanhSachSanPham as $sanpham) : ?>
				<div class="col-lg-3 col-md-4 col-sm-6 ">
					<div class="featured__item">
					<?php if (!empty($sanpham['hsp_tentaptin'])) : ?>
					<a href="/Vsshop/frontend/sanpham/detail.php?sp_id=<?= $sanpham['sp_id'] ?>">
						<div class="featured__item__pic set-bg" data-setbg="/Vsshop/assets/uploads/products/<?= $sanpham['hsp_tentaptin'] ?>">
					<?php else : ?>
					<a href="/Vsshop/frontend/sanpham/detail.php?sp_id=<?= $sanpham['sp_id'] ?>"> <div class="featured__item__pic set-bg" data-setbg="/Vsshop/assets/vendor/backend/img/default-image_600.png">
					<?php endif; ?>
						</div>
					</a>
						<div class="featured__item__text">
							<h6><a href="/Vsshop/frontend/sanpham/detail.php?sp_id=<?= $sanpham['sp_id'] ?>"><?= $sanpham['sp_ten'] ?></a></h6>
							<small class="text-muted text-right">
							<?php if ($sanpham['sp_giacu'] != 0) : ?>
								<s><?= $sanpham['sp_giacu'] ?></s>
							<?php endif; ?>
								<b><?= $sanpham['sp_gia'] ?></b>
							</small>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
				<?php else: ?>
				<div class="col-lg-12">
					<h2 style="text-align: center;">Không có sản phẩm cần tìm</h2>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<?php include_once __DIR__.'/../layouts/partials/footer.php';?>

	<?php include_once __DIR__.'/../layouts/script.php';?>
</body>
</html>