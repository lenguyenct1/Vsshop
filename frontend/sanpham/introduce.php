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
	 <!-- Breadcrumb Section Begin -->
	 <section class="breadcrumb-section set-bg" data-setbg="/Vsshop/assets/vendor/frontend/img/breadcrumb.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="breadcrumb__text">
						<h2>Giới thiệu</h2>
						<div class="breadcrumb__option">
							<a href="/Vsshop">Trang chủ</a>
							<span>Giới thiệu</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Breadcrumb Section End -->
<section class="featured spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>Giới thiệu Vsshop </h2>
						<a href="/Vsshop"><img src="/Vsshop/assets/vendor/frontend/img/logo.png" alt="" style="width:50%; height:50%;"></a>
						<h4 style="text-align: center;">VSSHOP website chuyên kinh doanh điện thoại di động, cung cấp dịch vụ hỗ trợ khách hàng</br> mua bán thiết bị di dộng trực tuyến dễ dàng thuận tiện nhất</br> mang đến trải nghiệm tuyệt vời cho quý khách hàng</h4>
					</div>
				</div>
			</div>
</section>

	<?php include_once __DIR__.'/../layouts/partials/session_banner.php';?>

	<?php include_once __DIR__.'/../layouts/partials/footer.php';?>

	<?php include_once __DIR__.'/../layouts/script.php';?>
</body>
</html>