<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Vsshop - Sửa thương hiệu</title>

	<?php include_once __DIR__.'/../layouts/style.php';?>
	<?php include_once __DIR__.'/../layouts/meta.php';?>
</head>

<body id="page-top">
	<div id="wrapper">
		<?php	include_once __DIR__.'/../layouts/partials/sidebar.php';
				include_once  __DIR__.'/../../dbconnect.php' ;

					$id= $_GET['id'];
					$sql= "SELECT * FROM thuonghieu WHERE th_id= $id";
					$resultSelect= mysqli_query($conn, $sql);
					$th=mysqli_fetch_array($resultSelect, MYSQLI_ASSOC); ?>
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<?php include_once __DIR__.'/../layouts/partials/header.php';?>
				<div class="container-fluid">
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Thương hiệu</h6>
						</div>
						<div class="card-body">
							<form  id="frmThuonghieu" name="frmcreate" method="post" action="">
								<div class="form-group">
									<label for="th_ten">Tên thương hiệu</label>
									<input type="text" class="form-control" id="th_ten" value="<?= $th['th_ten'] ?>" name="th_ten" placeholder="Tên thương hiệu" >
								</div>
								<button class="btn btn-primary" name="btnSave">Lưu dữ liệu</button>
								<a href="index.php" class="btn btn-outline-secondary" name="btnBack" id="btnBack">Trở về</a>
							</form>
							<?php
								if(isset($_POST['btnSave'])){
									include_once  __DIR__.'/../../dbconnect.php' ;
									$th_ten= $_POST['th_ten'];

									$errors = [];

									if (empty($th_ten)) {
										$errors['th_ten'][] = [
											'rule' => 'required',
											'rule_value' => true,
											'value' => $th_ten,
											'msg' => 'Vui lòng nhập tên thương hiệu'
										];
									}

									if (!empty($th_ten) && strlen($th_ten) < 3) {
										$errors['th_ten'][] = [
											'rule' => 'minlength',
											'rule_value' => 3,
											'value' => $th_ten,
											'msg' => 'Tên thương hiệu phải có ít nhất 3 ký tự'
										];
									}

									if (!empty($th_ten) && strlen($th_ten) > 255) {
										$errors['th_ten'][] = [
											'rule' => 'maxlength',
											'rule_value' => 255,
											'value' => $th_ten,
											'msg' => 'Tên thương hiệu không được vượt quá 255 ký tự'
										];
									}

									if(empty($errors)){
										$sql = <<<EOT
													UPDATE thuonghieu SET th_ten= '$th_ten' WHERE th_id= $id ;
										EOT;

										mysqli_query($conn, $sql);
										echo	'<script>
													location.href="index.php";
													alert("Sửa thương hiệu thành công");
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
		$("#frmThuonghieu").validate({
			rules: {
				th_ten: {
					required: true,
					minlength: 3,
					maxlength: 255
				},
			},
			messages: {
				th_ten: {
				required: "Vui lòng nhập tên thương hiệu",
				minlength: "Tên thương hiệu phải có ít nhất 3 ký tự",
				maxlength: "Tên thương hiệu không được vượt quá 50 ký tự"
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