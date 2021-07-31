<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Vsshop - Sửa xuất xứ</title>

	<?php include_once __DIR__.'/../layouts/style.php';?>
	<?php include_once __DIR__.'/../layouts/meta.php';?>
</head>

<body id="page-top">
	<div id="wrapper">
		<?php	include_once __DIR__.'/../layouts/partials/sidebar.php';
				include_once  __DIR__.'/../../dbconnect.php' ;

					$id= $_GET['id'];
					$sql= "SELECT * FROM xuatxu WHERE xx_id= $id";
					$resultSelect= mysqli_query($conn, $sql);
					$xx=mysqli_fetch_array($resultSelect, MYSQLI_ASSOC); ?>
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<?php include_once __DIR__.'/../layouts/partials/header.php';?>
				<div class="container-fluid">
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Xuất xứ</h6>
						</div>
						<div class="card-body">
							<form  id="frmXuatxu" name="frmcreate" method="post" action="">
								<div class="form-group">
									<label for="xx_ten">Tên xuất xứ</label>
									<input type="text" class="form-control" id="xx_ten" value="<?= $xx['xx_ten'] ?>" name="xx_ten" placeholder="Tên Xuất xứ" >
								</div>
								<button class="btn btn-primary" name="btnSave">Lưu dữ liệu</button>
								<a href="index.php" class="btn btn-outline-secondary" name="btnBack" id="btnBack">Trở về</a>
							</form>
							<?php
								if(isset($_POST['btnSave'])){
									include_once  __DIR__.'/../../dbconnect.php' ;
									$xx_ten= $_POST['xx_ten'];

									$errors = [];

									if (empty($xx_ten)) {
										$errors['xx_ten'][] = [
											'rule' => 'required',
											'rule_value' => true,
											'value' => $xx_ten,
											'msg' => 'Vui lòng nhập tên Xuất xứ'
										];
									}

									if (!empty($xx_ten) && strlen($xx_ten) < 3) {
										$errors['xx_ten'][] = [
											'rule' => 'minlength',
											'rule_value' => 3,
											'value' => $xx_ten,
											'msg' => 'Tên Xuất xứ phải có ít nhất 3 ký tự'
										];
									}

									if (!empty($xx_ten) && strlen($xx_ten) > 255) {
										$errors['xx_ten'][] = [
											'rule' => 'maxlength',
											'rule_value' => 255,
											'value' => $xx_ten,
											'msg' => 'Tên Xuất xứ không được vượt quá 255 ký tự'
										];
									}

									if(empty($errors)){
										$sql = <<<EOT
													UPDATE xuatxu SET xx_ten= '$xx_ten' WHERE xx_id= $id ;
										EOT;

										mysqli_query($conn, $sql);
										echo	'<script>
													location.href="index.php";
													alert("Sửa Xuất xứ thành công");
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
		$("#frmXuatxu").validate({
			rules: {
				xx_ten: {
					required: true,
					minlength: 3,
					maxlength: 255
				},
			},
			messages: {
				xx_ten: {
				required: "Vui lòng nhập tên xuất xứ",
				minlength: "Tên xuất xứ phải có ít nhất 3 ký tự",
				maxlength: "Tên xuất xứ không được vượt quá 50 ký tự"
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