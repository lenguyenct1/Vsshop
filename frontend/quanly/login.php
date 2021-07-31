<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="UTF-8">
	<meta name="description" content="Ogani Template">
	<meta name="keywords" content="Ogani, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Vsshop | Đăng nhập</title>

	<?php include_once __DIR__.'/../layouts/meta.php';?>
	<?php include_once __DIR__.'/../layouts/style.php';?>
</head>

<body>
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<?php include_once __DIR__.'/../layouts/partials/header.php';?>

	<?php include_once __DIR__.'/../layouts/partials/sidebar.php';?>

	 <!-- Breadcrumb Section Begin -->
	 <section class="breadcrumb-section set-bg" data-setbg="/Vsshop/assets/vendor/frontend/img/breadcrumb.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<div class="breadcrumb__text">
						<h2>Đăng nhập</h2>
						<div class="breadcrumb__option">
							<a href="/Vsshop">Trang chủ</a>
							<span>Đăng nhập</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Breadcrumb Section End -->
  <!-- Checkout Section Begin -->
	<section class="checkout spad">
		<div class="container">
			<div class="checkout__form">
				<h4>Đăng Nhập</h4>
				<form id="frmDangNhap" name="frmcreate" method="post" action="">
					<div class="row">
						<div class="col-lg-8 col-md-6">
							<div class="row">
								<div class="col-lg-6">
									<div class="checkout__input">
										<p>Tên đăng nhập<span>*</span></p>
										<input type="text" name="kh_tendangnhap" placeholder="Tên đăng nhập">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="checkout__input">
										<p>Mật Khẩu<span>*</span></p>
										<input type="password" name="kh_matkhau" placeholder="Mật khẩu">
									</div>
								</div>
							</div>
							<button type="submit" class="site-btn" name="btnDangNhap">Đăng Ký</button>
						</div>
					</div>
				</form>
				<?php
								if (isset($_POST['btnDangNhap'])) {
									include_once  __DIR__.'/../../dbconnect.php' ;
									$kh_tendangnhap	= $_POST['kh_tendangnhap'];
									$kh_matkhau		= $_POST['kh_matkhau'];

									$errors = [];
//kh_tendangnhap
									if (empty($kh_tendangnhap)) {
										$errors['kh_tendangnhap'][] = [
											'rule' => 'required',
											'rule_value' => true,
											'value' => $kh_tendangnhap,
											'msg' => 'Vui lòng nhập tên đăng nhập'
										];
									}

									if (!empty($kh_tendangnhap) && strlen($kh_tendangnhap) < 3) {
										$errors['kh_tendangnhap'][] = [
											'rule' => 'minlength',
											'rule_value' => 3,
											'value' => $kh_tendangnhap,
											'msg' => 'Tên đăng nhập phải có ít nhất 3 ký tự'
										];
									}

									if (!empty($kh_tendangnhap) && strlen($kh_tendangnhap) > 50) {
										$errors['kh_tendangnhap'][] = [
											'rule' => 'maxlength',
											'rule_value' => 50,
											'value' => $kh_tendangnhap,
											'msg' => 'Tên đăng nhập không được vượt quá 50 ký tự'
										];
									}
//kh_matkhau
									if (empty($kh_matkhau)) {
										$errors['kh_matkhau'][] = [
											'rule' => 'required',
											'rule_value' => true,
											'value' => $kh_matkhau,
											'msg' => 'Vui lòng nhập mật khẩu'
										];
									}

									if (!empty($kh_matkhau) && strlen($kh_matkhau) < 3) {
										$errors['kh_matkhau'][] = [
											'rule' => 'minlength',
											'rule_value' => 3,
											'value' => $kh_matkhau,
											'msg' => 'Mật khẩu phải có ít nhất 3 ký tự'
										];
									}

									if (!empty($kh_matkhau) && strlen($kh_matkhau) > 255) {
										$errors['kh_matkhau'][] = [
											'rule' => 'maxlength',
											'rule_value' => 255,
											'value' => $kh_matkhau,
											'msg' => 'Mật khẩu không được vượt quá 255 ký tự'
										];
									}
									if(empty($errors)){
										$sqlSelect = <<<EOT
										SELECT *
										FROM khachhang kh
										WHERE kh.kh_tendangnhap = '$kh_tendangnhap' AND kh.kh_matkhau = '$kh_matkhau' LIMIT 1;
										EOT;

										$result = mysqli_query($conn, $sqlSelect);
										if (mysqli_num_rows($result) > 0) {
									
											$_SESSION['kh_tendangnhap_logged_frontend'] = $kh_tendangnhap;

											echo '<script>
													location.href="/Vsshop";
													alert("Đăng nhập thành công!");
												</script>';

										} else {
											$errors['kh_check'][] = [
												'msg' => 'Đăng nhập thất bại!'
											];
										}
									}
									
								}
							?>

							<?php if(!empty($errors)): ?>
								<div id="errors-container" class="alert alert-danger face my-2" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<ul>
										<?php foreach ($errors as $fields) : ?>
											<?php foreach ($fields as $field) : ?>
												<li><?php echo $field['msg']; ?></li>
											<?php endforeach; ?>
										<?php endforeach; ?>
									</ul>
								</div>
							<?php endif; ?>
			</div>
		</div>
	</section>
	<!-- Checkout Section End -->

	<?php include_once __DIR__.'/../layouts/partials/footer.php';?>

	<?php include_once __DIR__.'/../layouts/script.php';?>
	<script>
	$(document).ready(function() {
		$("#frmDangNhap").validate({
			rules: {
				kh_tendangnhap: {
					required: true,
					minlength: 3,
					maxlength: 50
				},
				kh_matkhau: {
					required: true,
					minlength: 3,
					maxlength: 255
				},
			},
			messages: {
				kh_tendangnhap: {
				required: "Vui lòng nhập tên đăng nhập",
				minlength: "Tên đăng nhập phải có ít nhất 3 ký tự",
				maxlength: "Tên đăng nhập không được vượt quá 50 ký tự"
				},
				kh_matkhau: {
				required: "Vui lòng nhập mật khẩu",
				minlength: "Mật khẩu phải có ít nhất 3 ký tự",
				maxlength: "Mật khẩu không được vượt quá 255 ký tự"
				},
			},
			errorElement: "em",
			errorPlacement: function(error, element) {
			error.addClass("invalid-feedback");
				if (element.prop("type") === "checkbox") {
					error.insertAfter(element.parent("label"));
				} else {
					error.insertAfter(element);
				}
			},
			success: function(label, element) {},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass("is-invalid").removeClass("is-valid");
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).addClass("is-valid").removeClass("is-invalid");
			}
		});
	});
</script>
</body>
</html>