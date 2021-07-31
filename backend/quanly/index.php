<?php
if (session_id() === '') {
	session_start();
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

	<title>Vsshop - Trang đăng nhập</title>

	<?php include_once __DIR__.'/../layouts/style.php';?>
	<?php include_once __DIR__.'/../layouts/meta.php';?>
</head>

<body class="bg-gradient-primary">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-10 col-lg-12 col-md-9">
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block " style="background-image: url('../../assets/vendor/backend/img/smartphone-png.png');  background-position: center;background-size: cover; height: 400px; width: 600px;"></div>
							<div class="col-lg-6">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Đăng nhập</h1>
									</div>
									<?php
										if (isset($_SESSION['kh_tendangnhap_logged']) && !empty($_SESSION['kh_tendangnhap_logged'])) :
									?>

									<h4>Bạn đã đăng nhập rồi. <br/> <a href="/Vsshop/backend/index.php">Về trang chủ.</a></h4>

									<?php else : ?>
										<form name="frmLogin" id="frmLogin" method="post" action="" class="user">
											<div class="form-group">
												<input type="text" class="form-control form-control-user"
													id="tendangnhap" name="kh_tendangnhap" placeholder="Tên đăng nhập">
											</div>
											<div class="form-group">
												<input type="password" class="form-control form-control-user"
													id="matkhau" name="kh_matkhau" placeholder="Mật khẩu">
											</div>
											<button class="btn btn-primary btn-user btn-block" name="btnLogin">
												Đăng nhập
											</button>
										</form>
											<?php
												include_once(__DIR__ . '/../../dbconnect.php');
													if (isset($_POST['btnLogin'])) {
														$kh_tendangnhap = $_POST['kh_tendangnhap'];
														$kh_matkhau = $_POST['kh_matkhau'];
														$sqlSelect = <<<EOT
														SELECT *
														FROM khachhang kh
														WHERE kh.kh_tendangnhap = '$kh_tendangnhap' AND kh.kh_matkhau = '$kh_matkhau' LIMIT 1;
														EOT;

														$result = mysqli_query($conn, $sqlSelect);

														$kh =mysqli_fetch_array($result, MYSQLI_ASSOC); 

														if (mysqli_num_rows($result) > 0) {
															if($kh['kh_quantri'] == 1){
															$_SESSION['kh_tendangnhap_logged'] = $kh_tendangnhap;

															echo '<script>
																	location.href="/Vsshop/backend/index.php";
																	alert("Đăng nhập thành công!");
																</script>';
															} else {
																echo ' <br/> <h4 style="color: red;text-align: center;">Bạn không có quyền truy cập ADMIN!</h4>';
																}
														} else {
															echo ' <br/> <h4 style="color: red;text-align: center;">Đăng nhập thất bại!</h4>';
														}
													}
									endif;
											?>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>
	<?php include_once __DIR__.'/../layouts/partials/user_logout.php';?>
	<?php include_once __DIR__.'/../layouts/script.php';?>
</body>
</html>
