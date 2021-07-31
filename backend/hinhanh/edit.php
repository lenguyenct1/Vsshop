<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Vsshop - Sửa hình ảnh</title>

	<?php include_once __DIR__.'/../layouts/style.php';?>
	<?php include_once __DIR__.'/../layouts/meta.php';?>
</head>

<body id="page-top">
	<?php
			include_once(__DIR__ . '/../../dbconnect.php');

			$sqlSanPham = "select * from `sanpham`";

			$resultSanPham = mysqli_query($conn, $sqlSanPham);

			$dataSanPham = [];

			while ($rowSanPham = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)) {
				$sp_tomtat = sprintf(
					"Sản phẩm %s, giá: %s",
					$rowSanPham['sp_ten'],
					number_format($rowSanPham['sp_gia'], 2, ".", ",") . ' vnđ'
				);

				$dataSanPham[] = array(
				'sp_id' => $rowSanPham['sp_id'],
				'sp_tomtat' => $sp_tomtat
				);
			}

			$hsp_id = $_GET['hsp_id'];
			$sqlSelect = "SELECT * FROM `hinhsanpham` WHERE hsp_id = $hsp_id;";

			$resultSelect = mysqli_query($conn, $sqlSelect);
			$hinhsanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);
		?>
	<div id="wrapper">
		<?php include_once __DIR__.'/../layouts/partials/sidebar.php';?>
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<?php include_once __DIR__.'/../layouts/partials/header.php';?>
				<div class="container-fluid">
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">Hình ảnh</h6>
						</div>
						<div class="card-body">
							<form name="frmhinhsanpham" id="frmhinhanpham" method="post" action="" enctype="multipart/form-data">
								<div class="form-group">
									<label for="">Hình ảnh hiện tại</label>
									<br/>
									<img src="../../assets/uploads/products/<?= $hinhsanphamRow['hsp_tentaptin'] ?>" class="img-fluid" width="300px" />
								</div>
								<div class="form-group">
									<label for="sp_id">Sản phẩm</label>
									<select class="form-control" id="sp_id" name="sp_id" disabled="disabled">
									<?php foreach ($dataSanPham as $sanpham) : ?>
										<?php if ($sanpham['sp_id'] == $hinhsanphamRow['sp_id']) : ?>
										<option value="<?= $sanpham['sp_id'] ?>" selected><?= $sanpham['sp_tomtat'] ?></option>
										<?php else : ?>
										<option value="<?= $sanpham['sp_id'] ?>"><?= $sanpham['sp_tomtat'] ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
									</select>
								</div>
								<div class="form-group">
									<label for="hsp_tentaptin">Tập tin ảnh</label>
									<div class="preview-img-container">
										<img src="../../assets/vendor/backend/img/default-image_600.png" id="preview-img" width="200px" />
									</div>
									<input type="file" class="form-control" id="hsp_tentaptin" name="hsp_tentaptin">
								</div>
								<button class="btn btn-primary" name="btnSave">Lưu</button>
								<a href="index.php" class="btn btn-outline-secondary" name="btnBack" id="btnBack">Trở về</a>
							</form>
							<?php
								if(isset($_POST['btnSave'])){
									$hsp_id = $_GET['hsp_id'];

									if (isset($_FILES['hsp_tentaptin'])) {

										$upload_dir = __DIR__ . "/../../assets/uploads/";

										$subdir = 'products/';

										if ($_FILES['hsp_tentaptin']['error'] > 0) {
											echo 'File Upload Bị Lỗi';
										} else {
											$old_file = $upload_dir . $subdir . $hinhsanphamRow['hsp_tentaptin'];

											if (file_exists($old_file)) {
												unlink($old_file);
											}

											$hsp_tentaptin = $_FILES['hsp_tentaptin']['name'];
											$tentaptin = date('YmdHis') . '_' . $hsp_tentaptin; 

											move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir . $subdir . $tentaptin);
										}

										$sql = "UPDATE `hinhsanpham` SET hsp_tentaptin='$tentaptin' WHERE hsp_id=$hsp_id;";

										mysqli_query($conn, $sql);

										mysqli_close($conn);

										echo '<script>
												location.href="index.php";
												alert("Sửa hình ảnh thành công");
											</script>';
									}
								}
							?>
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
	const reader = new FileReader();
	const fileInput = document.getElementById("hsp_tentaptin");
	const img = document.getElementById("preview-img");
	reader.onload = e => {
	  img.src = e.target.result;
	}
	fileInput.addEventListener('change', e => {
	  const f = e.target.files[0];
	  reader.readAsDataURL(f);
	})
  </script>
</body>
</html>