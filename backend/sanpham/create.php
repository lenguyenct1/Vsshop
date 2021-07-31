<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Vsshop - Thêm sản phẩm</title>

	<?php include_once __DIR__.'/../layouts/style.php';?>
	<?php include_once __DIR__.'/../layouts/meta.php';?>
</head>

<body id="page-top">
	<div id="wrapper">
		<?php include_once __DIR__.'/../layouts/partials/sidebar.php';?>
		<?php
				include_once(__DIR__ . '/../../dbconnect.php');

				$sqlThuongHieu = "select * from `thuonghieu`";

				$resultThuongHieu = mysqli_query($conn, $sqlThuongHieu);

				$dataThuongHieu = [];
				while ($rowThuongHieu = mysqli_fetch_array($resultThuongHieu, MYSQLI_ASSOC)) {
					$dataThuongHieu[] = array(
						'th_id' => $rowThuongHieu['th_id'],
						'th_ten' => $rowThuongHieu['th_ten']
					);
				}
				$sqlXuatXu = "select * from `xuatxu`";

				$resultXuatXu = mysqli_query($conn, $sqlXuatXu);

				$dataXuatXu = [];
				while ($rowXuatXu = mysqli_fetch_array($resultXuatXu, MYSQLI_ASSOC)) {
					$dataXuatXu[] = array(
						'xx_id' => $rowXuatXu['xx_id'],
						'xx_ten' => $rowXuatXu['xx_ten']
					);
				}
			?>
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<?php include_once __DIR__.'/../layouts/partials/header.php';?>
				<div class="container-fluid">
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Sản phẩm</h6>
						</div>
						<div class="card-body">
							<form  id="frmSanpham" name="frmcreate" method="post" action="">
								<div class="form-group">
									<label for="sp_ten">Tên Sản phẩm</label>
									<input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Tên Sản phẩm" value="">
								</div>
								<div class="form-group">
									<label for="sp_gia">Giá Sản phẩm</label>
									<input type="text" class="form-control" id="sp_gia" name="sp_gia" placeholder="Giá Sản phẩm" value="">
								</div>
								<div class="form-group">
									<label for="sp_mota_ngan">Mô tả ngắn</label>
									<input type="text" class="form-control" id="sp_mota_ngan" name="sp_mota_ngan" placeholder="Mô tả ngắn Sản phẩm" value="">
								</div>
								<div class="form-group">
									<label for="sp_mota_chitiet">Mô tả chi tiết</label>
									<textarea class="form-control" id="sp_mota_chitiet" name="sp_mota_chitiet" placeholder="Mô tả chi tiết Sản phẩm" style="resize: none;" ></textarea>
								</div>
								<div class="form-group">
									<label for="sp_soluong">Số lượng</label>
									<input type="text" class="form-control" id="sp_soluong" name="sp_soluong" placeholder="Số lượng Sản phẩm" value="">
								</div>
								<div class="form-group">
									<label for="th_id">Thương hiệu</label>
									<select class="form-control" id="th_id" name="th_id">
										<?php foreach ($dataThuongHieu as $thuonghieu) : ?>
											<option value="<?= $thuonghieu['th_id'] ?>"><?= $thuonghieu['th_ten'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label for="xx_id">Xuất xứ</label>
									<select class="form-control" id="xx_id" name="xx_id">
										<?php foreach ($dataXuatXu as $xuatxu) : ?>
											<option value="<?= $xuatxu['xx_id'] ?>"><?= $xuatxu['xx_ten'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<button class="btn btn-primary" name="btnSave">Lưu dữ liệu</button>
								<a href="index.php" class="btn btn-outline-secondary" name="btnBack" id="btnBack">Trở về</a>
							</form>
							<?php
								if(isset($_POST['btnSave'])){
									include_once  __DIR__.'/../../dbconnect.php' ;
									$sp_ten				= $_POST['sp_ten'];
									$sp_gia				= $_POST['sp_gia'];
									$sp_mota_ngan		= $_POST['sp_mota_ngan'];
									$sp_mota_chitiet	= $_POST['sp_mota_chitiet'];
									$sp_ngaycapnhat		=  date_create('now', timezone_open('Asia/Ho_Chi_Minh'))->format('Y-m-d H:i:s');
									$sp_soluong			= $_POST['sp_soluong'];
									$th_id				= $_POST['th_id'];
									$xx_id				= $_POST['xx_id'];


									$errors = [];

									if (empty($sp_ten)) {
										$errors['sp_ten'][] = [
											'rule' => 'required',
											'rule_value' => true,
											'value' => $sp_ten,
											'msg' => 'Vui lòng nhập tên sản phẩm'
										];
									}

									if (!empty($sp_ten) && strlen($sp_ten) < 3) {
										$errors['sp_ten'][] = [
											'rule' => 'minlength',
											'rule_value' => 3,
											'value' => $sp_ten,
											'msg' => 'Tên sản phẩm phải có ít nhất 3 ký tự'
										];
									}

									if (!empty($sp_ten) && strlen($sp_ten) > 255) {
										$errors['sp_ten'][] = [
											'rule' => 'maxlength',
											'rule_value' => 255,
											'value' => $sp_ten,
											'msg' => 'Tên sản phẩm không được vượt quá 255 ký tự'
										];
									}

									if (empty($sp_gia)) {
										$errors['sp_gia'][] = [
											'msg' => 'Vui lòng nhập giá sản phẩm'
										];
									}

									if (!empty($sp_gia) && !is_numeric($sp_gia)) {
										$errors['sp_gia'][] = [
											'msg' => 'Giá sản phẩm phải là số'
										];
									}

									if (empty($sp_mota_ngan)) {
										$errors['sp_mota_ngan'][] = [
											'rule' => 'required',
											'rule_value' => true,
											'value' => $sp_mota_ngan,
											'msg' => 'Vui lòng nhập mô tả ngắn sản phẩm'
										];
									}

									if (!empty($sp_mota_ngan) && strlen($sp_mota_ngan) < 3) {
										$errors['sp_mota_ngan'][] = [
											'rule' => 'minlength',
											'rule_value' => 3,
											'value' => $sp_mota_ngan,
											'msg' => 'Mô tả ngắn sản phẩm phải có ít nhất 3 ký tự'
										];
									}

									if (!empty($sp_mota_ngan) && strlen($sp_mota_ngan) > 255) {
										$errors['sp_mota_ngan'][] = [
											'rule' => 'maxlength',
											'rule_value' => 255,
											'value' => $sp_mota_ngan,
											'msg' => 'Mô tả ngắn sản phẩm không được vượt quá 255 ký tự'
										];
									}

									if (empty($sp_mota_chitiet)) {
										$errors['sp_mota_chitiet'][] = [
											'rule' => 'required',
											'rule_value' => true,
											'value' => $sp_mota_chitiet,
											'msg' => 'Vui lòng nhập mô tả chi tiết sản phẩm'
										];
									}

									if (!empty($sp_mota_chitiet) && strlen($sp_mota_chitiet) < 3) {
										$errors['sp_mota_chitiet'][] = [
											'rule' => 'minlength',
											'rule_value' => 3,
											'value' => $sp_mota_chitiet,
											'msg' => 'Mô tả chi tiết sản phẩm phải có ít nhất 3 ký tự'
										];
									}

									if (empty($sp_soluong)) {
										$errors['sp_soluong'][] = [
											'msg' => 'Vui lòng nhập số lượng sản phẩm'
										];
									}

									if (!empty($sp_soluong) && !is_numeric($sp_soluong)) {
										$errors['sp_soluong'][] = [
											'msg' => 'Số lượng sản phẩm phải là số'
										];
									}

									if (empty($th_id)) {
										$errors['th_id'][] = [
											'msg' => 'Vui lòng nhập thương hiệu sản phẩm'
										];
									}

									if (!empty($th_id) && !is_numeric($th_id)) {
										$errors['th_id'][] = [
											'msg' => 'Thương hiệu không hợp lệ'
										];
									}

									if (empty($xx_id)) {
										$errors['xx_id'][] = [
											'msg' => 'Vui lòng xuất xứ sản phẩm'
										];
									}

									if (!empty($xx_id) && !is_numeric($xx_id)) {
										$errors['xx_id'][] = [
											'msg' => 'Xuất xứ không hợp lệ'
										];
									}

									if(empty($errors)){
									$sql = "INSERT INTO `sanpham` (sp_ten, sp_gia, sp_mota_ngan, sp_mota_chitiet, sp_ngaycapnhat, sp_soluong, th_id, xx_id) VALUES ('$sp_ten', $sp_gia, '$sp_mota_ngan', '$sp_mota_chitiet', '" . $sp_ngaycapnhat . "', $sp_soluong, $th_id, $xx_id);";

									mysqli_query($conn, $sql);

									mysqli_close($conn);

									echo '<script>
											location.href="index.php";
											alert("Thêm sản phẩm thành công");
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
				</div>
			</div>
			<?php include_once __DIR__.'/../layouts/partials/footer.php';?>
		</div>
	</div>
	<?php include_once __DIR__.'/../layouts/partials/user_logout.php';?>
	<?php include_once __DIR__.'/../layouts/script.php';?>
	<script>
	$(document).ready(function() {
		$("#frmSanpham").validate({
			rules: {
				sp_ten: {
					required: true,
					minlength: 3,
					maxlength: 255
				},

				sp_gia: {
				required: true,
				number: true
				},

				sp_mota_ngan: {
					required: true,
					minlength: 3,
					maxlength: 255
				},

				sp_mota_chitiet: {
					required: true,
					minlength: 3
				},

				sp_soluong: {
				required: true,
				number: true
				},

				th_id: {
				required: true,
				number: true
				},

				xx_id: {
				required: true,
				number: true
				},
			},
			messages: {
				sp_ten: {
				required: "Vui lòng nhập tên sản phẩm",
				minlength: "Tên sản phẩm phải có ít nhất 3 ký tự",
				maxlength: "Tên sản phẩm không được vượt quá 255 ký tự"
				},
				sp_gia: {
				required: "Vui lòng nhập giá sản phẩm",
				number: "Giá sản phẩm phải là số",
				},
				sp_mota_ngan: {
				required: "Vui lòng nhập mô tả ngắn sản phẩm",
				minlength: "Mô tả ngắn sản phẩm phải có ít nhất 3 ký tự",
				maxlength: "Mô tả ngắn sản phẩm không được vượt quá 255 ký tự"
				},
				sp_mota_chitiet: {
				required: "Vui lòng nhập mô tả chi tiết sản phẩm",
				minlength: "Mô tả chi tiết sản phẩm phải có ít nhất 3 ký tự"
				},
				sp_soluong: {
				required: "Vui lòng nhập số lượng sản phẩm",
				number: "Số lượng sản phẩm phải là số",
				},
				th_id: {
				required: "Vui lòng nhập thương hiệu sản phẩm",
				number: "Thương hiệu không hợp lệ",
				},
				xx_id: {
				required: "Vui lòng xuất xứ sản phẩm",
				number: "Xuất xứ không hợp lệ",
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
	var url = '/Vsshop/assets/vendor/backend';
		CKEDITOR.replace('sp_mota_chitiet',{
							filebrowserBrowseUrl: url+'/ckfinder/ckfinder.html',
							filebrowserImageBrowseUrl: url+'/ckfinder/ckfinder.html?type=Images',
							filebrowserUploadUrl: url+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
							filebrowserImageUploadUrl: url+'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
		});
</script>
</body>
</html>