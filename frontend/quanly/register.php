<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="UTF-8">
	<meta name="description" content="Ogani Template">
	<meta name="keywords" content="Ogani, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Vsshop | Đăng ký</title>

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
						<h2>Đăng ký</h2>
						<div class="breadcrumb__option">
							<a href="/Vsshop">Trang chủ</a>
							<span>Đăng ký</span>
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
				<h4>Đăng Ký</h4>
				<form id="frmDangky" name="frmcreate" method="post" action="">
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
							<div class="checkout__input">
								<p>Tên khách hàng<span>*</span></p>
								<input type="text" name="kh_ten" placeholder="Tên khách hàng">
							</div>
							<div class="checkout__input">
								<p>Địa chỉ<span>*</span></p>
								<input type="text" placeholder="Địa chỉ" class="checkout__input__add" name="kh_diachi">
							</div>
							<div class="row">
							<div class="col-lg-6">
								<div class="checkout__input">
									<p>Email<span>*</span></p>
										<input type="email" name="kh_email" placeholder="Email">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="checkout__input">
										<p>Điện thoại<span>*</span></p>
										<input type="text" name="kh_dienthoai" placeholder="Điện thoại">
									</div>
								</div>
							</div>
							<button type="submit" class="site-btn" name="btnDangKy">Đăng Ký</button>
						</div>
					</div>
				</form>
				<?php
								if (isset($_POST['btnDangKy'])) {
									include_once  __DIR__.'/../../dbconnect.php' ;
									$kh_tendangnhap	= $_POST['kh_tendangnhap'];
									$kh_matkhau		= $_POST['kh_matkhau'];
									$kh_ten			= $_POST['kh_ten'];
									$kh_diachi		= $_POST['kh_diachi'];
									$kh_email 		= $_POST['kh_email'];
									$kh_dienthoai 	= $_POST['kh_dienthoai'];

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
//kh_ten
									if (empty($kh_ten)) {
										$errors['kh_ten'][] = [
											'rule' => 'required',
											'rule_value' => true,
											'value' => $kh_ten,
											'msg' => 'Vui lòng nhập tên khách hàng'
										];
									}

									if (!empty($kh_ten) && strlen($kh_ten) < 3) {
										$errors['kh_ten'][] = [
											'rule' => 'minlength',
											'rule_value' => 3,
											'value' => $kh_ten,
											'msg' => 'Tên khách hàng phải có ít nhất 3 ký tự'
										];
									}

									if (!empty($kh_ten) && strlen($kh_ten) > 50) {
										$errors['kh_ten'][] = [
											'rule' => 'maxlength',
											'rule_value' => 50,
											'value' => $kh_ten,
											'msg' => 'Tên khách hàng không được vượt quá 50 ký tự'
										];
									}
//kh_diachi
									if (empty($kh_diachi)) {
										$errors['kh_diachi'][] = [
											'rule' => 'required',
											'rule_value' => true,
											'value' => $kh_diachi,
											'msg' => 'Vui lòng nhập địa chỉ'
										];
									}

									if (!empty($kh_diachi) && strlen($kh_diachi) < 3) {
										$errors['kh_diachi'][] = [
											'rule' => 'minlength',
											'rule_value' => 3,
											'value' => $kh_diachi,
											'msg' => 'Địa chỉ phải có ít nhất 3 ký tự'
										];
									}

									if (!empty($kh_diachi) && strlen($kh_diachi) > 100) {
										$errors['kh_diachi'][] = [
											'rule' => 'maxlength',
											'rule_value' => 100,
											'value' => $kh_diachi,
											'msg' => 'Địa chỉ không được vượt quá 100 ký tự'
										];
									}

//kh_email
									if (empty($kh_email)) {
										$errors['kh_email'][] = [
											'rule' => 'required',
											'rule_value' => true,
											'value' => $kh_email,
											'msg' => 'Vui lòng nhập email'
										];
									}

									if (!empty($kh_email) && strlen($kh_email) < 3) {
										$errors['kh_email'][] = [
											'rule' => 'minlength',
											'rule_value' => 3,
											'value' => $kh_email,
											'msg' => 'Email phải có ít nhất 3 ký tự'
										];
									}

									if (!empty($kh_email) && strlen($kh_email) > 50) {
										$errors['kh_kh_email'][] = [
											'rule' => 'maxlength',
											'rule_value' => 50,
											'value' => $kh_email,
											'msg' => 'Email không được vượt quá 50 ký tự'
										];
									}
//kh_dienthoai
									if (empty($kh_dienthoai)) {
										$errors['kh_dienthoai'][] = [
											'rule' => 'required',
											'rule_value' => true,
											'value' => $kh_dienthoai,
											'msg' => 'Vui lòng nhập điện thoại'
										];
									}

									if (!empty($kh_dienthoai) && strlen($kh_dienthoai) < 10) {
										$errors['kh_dienthoai'][] = [
											'rule' => 'minlength',
											'rule_value' => 10,
											'value' => $kh_dienthoai,
											'msg' => 'Điện thoại phải có ít nhất 10 ký tự'
										];
									}

									if (!empty($kh_dienthoai) && strlen($kh_dienthoai) > 11) {
										$errors['kh_dienthoai'][] = [
											'rule' => 'maxlength',
											'rule_value' => 11,
											'value' => $kh_dienthoai,
											'msg' => 'Điện thoại không được vượt quá 11 ký tự'
										];
									}
//Kiểm tra tên đăng nhập trước khi lưu
									$sqlSelect = <<<EOT
														SELECT *
														FROM khachhang kh
														WHERE kh.kh_tendangnhap = '$kh_tendangnhap' LIMIT 1;
														EOT;

														$result = mysqli_query($conn, $sqlSelect);

														if (mysqli_num_rows($result) > 0) {
															$errors['kh_kiemtra'][] = [
																'msg' => 'Tên đăng nhập đã tồn tại'
															];
														} 

														if(empty($errors)){
															$sql = <<<EOT
																		INSERT INTO khachhang
																		(kh_tendangnhap,kh_matkhau,	kh_ten,	kh_diachi,kh_email,kh_quantri,kh_dienthoai) 
																		VALUES('$kh_tendangnhap','$kh_matkhau','$kh_ten','$kh_diachi','$kh_email','$kh_quantri','$kh_dienthoai');
															EOT;
					
															mysqli_query($conn, $sql);
															echo	'<script>
																		location.href="/Vsshop";
																		alert("Đăng ký tài khoản thành công");
																	</script>';
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
		$("#frmDangky").validate({
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
				kh_ten: {
					required: true,
					minlength: 3,
					maxlength: 50
				},
				kh_diachi: {
					required: true,
					minlength: 3,
					maxlength: 100
				},
				kh_email: {
					required: true,
					minlength: 3,
					maxlength: 50
				},
				kh_dienthoai: {
					required: true,
					minlength: 10,
					maxlength: 11
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
				kh_ten: {
				required: "Vui lòng nhập tên khách hàng",
				minlength: "Tên khách hàng phải có ít nhất 3 ký tự",
				maxlength: "Tên khách hàng không được vượt quá 50 ký tự"
				},
				kh_diachi: {
				required: "Vui lòng nhập địa chỉ",
				minlength: "Tên địa chỉ phải có ít nhất 3 ký tự",
				maxlength: "Tên địa chỉ không được vượt quá 100 ký tự"
				},
				kh_email: {
				required: "Vui lòng nhập email",
				minlength: "Email phải có ít nhất 3 ký tự",
				maxlength: "Email không được vượt quá 50 ký tự"
				},
				kh_dienthoai: {
				required: "Vui lòng nhập điện thoại",
				minlength: "Điện thoại phải có ít nhất 10 ký tự",
				maxlength: "Điện thoại không được vượt quá 11 ký tự"
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