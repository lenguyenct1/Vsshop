<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Vsshop - Thêm đơn đặt hàng</title>

	<?php include_once __DIR__.'/../layouts/style.php';?>
	<?php include_once __DIR__.'/../layouts/meta.php';?>
</head>

<body id="page-top">
<?php
				include_once(__DIR__ . '/../../dbconnect.php');

				$sqlKhachHang = "select * from `khachhang`";

				$resultKhachHang = mysqli_query($conn, $sqlKhachHang);

				$dataKhachHang = [];
				while ($rowKhachHang = mysqli_fetch_array($resultKhachHang, MYSQLI_ASSOC)) {

					$kh_tomtat = sprintf(
						"Họ tên %s, số điện thoại: %s",
						$rowKhachHang['kh_ten'],
						$rowKhachHang['kh_dienthoai'],
					);

					$dataKhachHang[] = array(
						'kh_tendangnhap' => $rowKhachHang['kh_tendangnhap'],
						'kh_tomtat' => $kh_tomtat,
					);
				}

				$sqlSanPham = "select * from `sanpham`";

				
				$resultSanPham = mysqli_query($conn, $sqlSanPham);

				$dataSanPham = [];
				while ($rowSanPham = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)) {
					$dataSanPham[] = array(
						'sp_id' => $rowSanPham['sp_id'],
						'sp_gia' => $rowSanPham['sp_gia'],
						'sp_ten' => $rowSanPham['sp_ten'],
					);
				}
				// var_dump($dataSanPham);die;
				/* --- End Truy vấn dữ liệu sản phẩm --- */
				?>
	<div id="wrapper">
		<?php include_once __DIR__.'/../layouts/partials/sidebar.php';?>
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<?php include_once __DIR__.'/../layouts/partials/header.php';?>
				<div class="container-fluid">
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">ĐƠN ĐẶT HÀNG</h6>
						</div>
						<div class="card-body">
							<form name="frmhinhsanpham" id="frmhinhanpham" method="post" action="" enctype="multipart/form-data">
								<fieldset id="donHangContainer">
									<legend>Thông tin Đơn hàng</legend>
									<div class="form-row">
										<div class="col">
											<div class="form-group">
												<label>Khách hàng</label>
												<select name="kh_tendangnhap" id="kh_tendangnhap" class="form-control">
													<option value="">Vui lòng chọn Khách hàng</option>
													<?php foreach ($dataKhachHang as $khachhang) : ?>
														<option value="<?= $khachhang['kh_tendangnhap'] ?>"><?= $khachhang['kh_tomtat'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="col">
											<div class="form-group">
												<label>Ngày lập</label>
												<input type="date" name="dh_ngaylap" id="dh_ngaylap" class="form-control" />
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label>Ngày giao</label>
												<input type="date" name="dh_ngaygiao" id="dh_ngaygiao" class="form-control" />
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label>Nơi giao</label>
												<input type="text" name="dh_noigiao" id="dh_noigiao" class="form-control" />
											</div>
										</div>
									</div>
									<br/>
									<div class="form-row">
										<div class="col">
											<div class="form-group">
												<label>Trạng thái thanh toán</label><br />
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-1" class="custom-control-input" value="0" checked>
													<label class="custom-control-label" for="dh_trangthaithanhtoan-1">Chưa thanh toán</label>
												</div>
												<div class="custom-control custom-radio custom-control-inline">
													<input type="radio" name="dh_trangthaithanhtoan" id="dh_trangthaithanhtoan-2" class="custom-control-input" value="1">
													<label class="custom-control-label" for="dh_trangthaithanhtoan-2">Đã thanh toán</label>
												</div>
											</div>
										</div>
									</div>
								</fieldset>

								<fieldset id="chiTietDonHangContainer">
									<legend>Thông tin Chi tiết Đơn hàng</legend>
									<div class="form-row">
										<div class="col">
											<div class="form-group">
												<label for="sp_id">Sản phẩm</label>
												<select class="form-control" id="sp_id" name="sp_id">
													<option value="">Vui lòng chọn Sản phẩm</option>
													<?php foreach ($dataSanPham as $sanpham) : ?>
														<option value="<?= $sanpham['sp_id'] ?>" data-sp_gia="<?= $sanpham['sp_gia'] ?>"><?= $sanpham['sp_ten'] ?></option>
													<?php endforeach; ?>
												</select>
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label>Số lượng</label>
												<input type="text" name="soluong" id="soluong" class="form-control" />
											</div>
										</div>
										<div class="col">
											<div class="form-group">
												<label>Xử lý</label><br />
												<button type="button" id="btnThemSanPham" class="btn btn-secondary">Thêm vào đơn hàng</button>
											</div>
										</div>
									</div>

									<table id="tblChiTietDonHang" class="table table-bordered">
										<thead>
											<th>Sản phẩm</th>
											<th>Số lượng</th>
											<th>Đơn giá</th>
											<th>Thành tiền</th>
											<th>Hành động</th>
										</thead>
										<tbody>
										</tbody>
									</table>
								</fieldset>

								<button class="btn btn-primary" name="btnSave">Lưu dữ liệu</button>
								<a href="index.php" class="btn btn-outline-secondary" name="btnBack" id="btnBack">Trở về</a>
							</form>
							<?php
								if (isset($_POST['btnSave'])) {

									$kh_tendangnhap = $_POST['kh_tendangnhap'];
									$dh_ngaylap = $_POST['dh_ngaylap'];
									$dh_ngaygiao = $_POST['dh_ngaygiao'];
									$dh_noigiao = $_POST['dh_noigiao'];
									$dh_trangthaithanhtoan = $_POST['dh_trangthaithanhtoan'];

								
									$arr_sp_id = $_POST['sp_id'];
									isset($_POST['sp_dh_soluong']) ? ($arr_sp_dh_soluong = $_POST['sp_dh_soluong'] ) : null;
									isset($_POST['sp_dh_dongia']) ? ($arr_sp_dh_dongia = $_POST['sp_dh_dongia']) : null;

									$errors = [];

									if (empty($kh_tendangnhap)) {
										$errors['kh_tendangnhap'][] = [
											'rule' => 'required',
											'rule_value' => true,
											'value' => $kh_tendangnhap,
											'msg' => 'Vui lòng nhập tên đăng nhập'
										];
									}

									if (empty($dh_ngaylap)) {
										$errors['dh_ngaylap'][] = [
											'msg' => 'Vui lòng nhập ngày lập'
										];
									}

									if (!empty($dh_ngaylap) && !preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",str_replace('/', '-', $dh_ngaylap))) {
										$errors['dh_ngaylap'][] = [
											'msg' => 'Ngày lập không hợp lệ'
										];
									}

									if (empty($dh_ngaygiao)) {
										$errors['dh_ngaygiao'][] = [
											'msg' => 'Vui lòng nhập ngày giao'
										];
									}

									if (!empty($dh_ngaygiao) && !preg_match("/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/",str_replace('/', '-', $dh_ngaygiao))) {
										$errors['dh_ngaygiao'][] = [
											'msg' => 'Ngày giao không hợp lệ'
										];
									}

									if (empty($dh_noigiao)) {
										$errors['dh_noigiao'][] = [
											'rule' => 'required',
											'rule_value' => true,
											'value' => $dh_noigiao,
											'msg' => 'Vui lòng nhập nơi giao'
										];
									}

									if (!empty($dh_noigiao) && strlen($dh_noigiao) < 3) {
										$errors['dh_noigiao'][] = [
											'rule' => 'minlength',
											'rule_value' => 3,
											'value' => $dh_noigiao,
											'msg' => 'Nơi giao phải có ít nhất 3 ký tự'
										];
									}

									if (!empty($dh_noigiao) && strlen($dh_noigiao) > 255) {
										$errors['dh_noigiao'][] = [
											'rule' => 'maxlength',
											'rule_value' => 255,
											'value' => $dh_noigiao,
											'msg' => 'Nơi giao không được vượt quá 255 ký tự'
										];
									}

									if(empty($errors)){
										$sqlInsertDonHang = "INSERT INTO `dondathang` (`dh_ngaylap`, `dh_ngaygiao`, `dh_noigiao`, `dh_trangthaithanhtoan`, `kh_tendangnhap`) VALUES ('$dh_ngaylap', '$dh_ngaygiao', N'$dh_noigiao', '$dh_trangthaithanhtoan', '$kh_tendangnhap')";

										mysqli_query($conn, $sqlInsertDonHang);

										$dh_id = $conn->insert_id;

										for($i = 0; $i < count($arr_sp_id); $i++) {

											$sp_id = $arr_sp_id[$i];
											$sp_dh_soluong = $arr_sp_dh_soluong[$i];
											$sp_dh_dongia = $arr_sp_dh_dongia[$i];

											$sqlUpdateSoLuongSanPham = <<<EOT
											Update sanpham set sp_soluong = sp_soluong - $sp_dh_soluong  WHERE sp_id = $sp_id 
											EOT;

											$sqlInsertSanPhamDonDatHang = "INSERT INTO `sanpham_dondathang` (`sp_id`, `dh_id`, `sp_dh_soluong`, `sp_dh_dongia`) VALUES ($sp_id, $dh_id, $sp_dh_soluong, $sp_dh_dongia)";

											mysqli_query($conn, $sqlUpdateSoLuongSanPham);
											mysqli_query($conn, $sqlInsertSanPhamDonDatHang);
										}

										echo '<script>location.href = "index.php";	alert("Thêm đơn hàng thành công");</script>';
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
				</div>
			</div>
			<?php include_once __DIR__.'/../layouts/partials/footer.php';?>
		</div>
	</div>
	<?php include_once __DIR__.'/../layouts/partials/user_logout.php';?>
	<?php include_once __DIR__.'/../layouts/script.php';?>
	<script>
	$(document).ready(function() {
		$("#frmhinhanpham").validate({
			rules: {
				kh_tendangnhap: {
					required: true,
				},

				dh_ngaylap: {
					required: true,
					date: true
				},

				dh_ngaygiao: {
					required: true,
					date: true
				},

				dh_noigiao: {
					required: true,
					minlength: 3,
					maxlength: 255
				},

			},
			messages: {
				kh_tendangnhap: {
				required: "Vui lòng nhập tên đăng nhập",
				},
				dh_ngaylap: {
				required: "Vui lòng nhập ngày lập",
				date: "Ngày lập không hợp lệ",
				},
				dh_ngaygiao: {
				required: "Vui lòng nhập ngày giao",
				date: "Ngày giao không hợp lệ",
				},
				dh_noigiao: {
				required: "Vui lòng nhập nơi giao",
				minlength: "Nơi giao phải có ít nhất 3 ký tự",
				maxlength: "Nơi giao không được vượt quá 255 ký tự"
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
	<script>
		$('#btnThemSanPham').click(function() {
			var sp_id = $('#sp_id').val();
			var sp_gia = $('#sp_id option:selected').data('sp_gia');
			var sp_ten = $('#sp_id option:selected').text();
			var soluong = $('#soluong').val();
			var thanhtien = (soluong * sp_gia);
			
			var htmlTemplate = '<tr>'; 
			htmlTemplate += '<td>' + sp_ten + '<input type="hidden" name="sp_id[]" value="' + sp_id + '"/></td>';
			htmlTemplate += '<td>' + soluong + '<input type="hidden" name="sp_dh_soluong[]" value="' + soluong + '"/></td>';
			htmlTemplate += '<td>' + sp_gia + '<input type="hidden" name="sp_dh_dongia[]" value="' + sp_gia + '"/></td>';
			htmlTemplate += '<td>' + thanhtien + '</td>';
			htmlTemplate += '<td><button type="button" class="btn btn-danger btn-delete-row">Xóa</button></td>';
			htmlTemplate += '</tr>';

			$('#tblChiTietDonHang tbody').append(htmlTemplate);

			$('#sp_id').val('');
			$('#soluong').val('');
		});

		$('#chiTietDonHangContainer').on('click', '.btn-delete-row', function() {
			$(this).parent().parent()[0].remove();
		});
	</script>
</body>
</html>