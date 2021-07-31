<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Vsshop - Trang danh sách hình ảnh</title>

	<?php include_once __DIR__.'/../layouts/style.php';?>
	<?php include_once __DIR__.'/../layouts/meta.php';?>
</head>

<body id="page-top">
	<?php
		include_once __DIR__.'/../../dbconnect.php';
		$sql = <<<EOT
					SELECT *
					FROM `hinhsanpham` hsp
					JOIN `sanpham` sp on hsp.sp_id = sp.sp_id
		EOT;
		
		$result = mysqli_query($conn, $sql);

		$data = [];
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$sp_tomtat = sprintf(
					"Sản phẩm %s, giá: %s",
					$row['sp_ten'],
					number_format($row['sp_gia'], 2, ".", ",") . ' vnđ'
				);

				$data[] = array(
					'hsp_id' => $row['hsp_id'],
					'hsp_tentaptin' => $row['hsp_tentaptin'],
					'sp_tomtat' => $sp_tomtat,
				);
			}
	?>
	<div id="wrapper">
		<?php include_once __DIR__.'/../layouts/partials/sidebar.php';?>
		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<?php include_once __DIR__.'/../layouts/partials/header.php';?>
				 <div class="container-fluid">
				 <a href="create.php"><button type="button" class="btn btn-dark">THÊM MỚI</button></a>
					<div class="card shadow mb-4">
						<div class="card-header py-3">
							<h6 class="m-0 font-weight-bold text-primary">HÌNH ẢNH</h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Mã Hình Sản phẩm</th>
											<th>Sản phẩm</th>
											<th>Hình ảnh</th>
											<th>Hành động</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($data as $hinhsanpham): ?>
										<tr>
											<td><?= $hinhsanpham['hsp_id'] ?></td>
											<td><?= $hinhsanpham['sp_tomtat'] ?></td>
											<td>  <img src="../../assets/uploads/products/<?= $hinhsanpham['hsp_tentaptin'] ?>" class="img-fluid" width="100px" /></td>
											<td>
												<a href="edit.php?hsp_id=<?= $hinhsanpham['hsp_id'] ?>"><button type="button" class="btn btn-primary">Sửa</button><a>
												<a onclick="return confirm('Bạn có chắc là muốn xóa hình ảnh này không ?')" href="delete.php?hsp_id=<?= $hinhsanpham['hsp_id'] ?>"><button type="button" class="btn btn-danger">Xóa</button></a>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php include_once __DIR__.'/../layouts/partials/footer.php';?>
		</div>
	</div>
	<?php include_once __DIR__.'/../layouts/partials/user_logout.php';?>
	<?php include_once __DIR__.'/../layouts/script.php';?>
</body>
</html>