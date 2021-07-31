<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="UTF-8">
	<meta name="description" content="Ogani Template">
	<meta name="keywords" content="Ogani, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Vsshop | Danh sách sản phẩm</title>

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
	$timkiem= (isset($_GET['timkiem'])) ? $_GET['timkiem']: '';
	if (isset($_GET['btnTimkiem'])) {	
		include_once __DIR__.'/../../dbconnect.php';
// PHẦN XỬ LÝ PHP
		// BƯỚC 1: KẾT NỐI CSDL
		// BƯỚC 2: TÌM TỔNG SỐ RECORDS
		$result = mysqli_query($conn, 'select count(sp_id) as total from sanpham');
		$row = mysqli_fetch_assoc($result);
		$total_records = $row['total'];
 
		// BƯỚC 3: TÌM LIMIT VÀ CURRENT_PAGE
		$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$limit = 10;
 
		// BƯỚC 4: TÍNH TOÁN TOTAL_PAGE VÀ START
		// tổng số trang
		$total_page = ceil($total_records / $limit);
 
		// Giới hạn current_page trong khoảng 1 đến total_page
		if ($current_page > $total_page){
			$current_page = $total_page;
		}
		else if ($current_page < 1){
			$current_page = 1;
		}
 
		// Tìm Start
		$start = ($current_page - 1) * $limit;
 
		// BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
		// Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
			$sqlDanhSachSanPham = <<<EOT
									SELECT sp.sp_id, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_mota_ngan, sp.sp_soluong, th.th_ten, MAX(hsp.hsp_tentaptin) AS hsp_tentaptin
									FROM `sanpham` sp
									JOIN `thuonghieu` th ON sp.th_id = th.th_id
									LEFT JOIN `hinhsanpham` hsp ON sp.sp_id = hsp.sp_id
									WHERE sp_ten LIKE '%$timkiem%' 
									GROUP BY sp.sp_id, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_mota_ngan, sp.sp_soluong, th.th_ten
									LIMIT $start, $limit
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
	}
	?>
<section class="featured spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>Tìm kiếm sản phẩm </h2>
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
			<?php if(!empty($dataDanhSachSanPham)) :?>
			<div class="product__pagination">
					
					<?php 
					for ($i = 1; $i <= $total_page; $i++){
					echo '<a href="?page='.$i.'">'.$i.'</a> ';
						
					}
					?>
			</div>
			<?php endif; ?>
		</div>
	
	</section>

	<?php include_once __DIR__.'/../layouts/partials/session_banner.php';?>

	<?php include_once __DIR__.'/../layouts/partials/footer.php';?>

	<?php include_once __DIR__.'/../layouts/script.php';?>
</body>
</html>