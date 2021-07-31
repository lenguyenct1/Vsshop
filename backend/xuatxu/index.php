<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Vsshop - Trang danh sách xuất xứ</title>

	<?php include_once __DIR__.'/../layouts/style.php';?>
	<?php include_once __DIR__.'/../layouts/meta.php';?>
</head>

<body id="page-top">
	<?php
		include_once __DIR__.'/../../dbconnect.php';
		$sql = <<<EOT
					 SELECT * FROM `xuatxu`;
		EOT;
		
		$result = mysqli_query($conn, $sql);

		$data = [];
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$data[] = array(
					'xx_id' => $row['xx_id'],
					'xx_ten' => $row['xx_ten']
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
							<h6 class="m-0 font-weight-bold text-primary">XUẤT XỨ</h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Mã xuất xứ</th>
											<th>Tên xuất xứ</th>
											<th>Quản lý</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($data as $xx): ?>
										<tr>
											<td><?= $xx['xx_id']; ?></td>
											<td><?= $xx['xx_ten']; ?></td>
											<td>
												<a href="edit.php?id=<?=$xx['xx_id']; ?>"><button type="button" class="btn btn-primary">Sửa</button><a>
												<a onclick="return confirm('Bạn có chắc là muốn xóa xuất xứ này không ?')" href="delete.php?id=<?=$xx['xx_id']; ?>"><button type="button" class="btn btn-danger">Xóa</button></a>
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