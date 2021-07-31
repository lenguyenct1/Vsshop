<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Vsshop - Trang danh sách sản phẩm</title>

	<?php include_once __DIR__.'/../layouts/style.php';?>
	<?php include_once __DIR__.'/../layouts/meta.php';?>
</head>

<body id="page-top">
	<?php
		include_once __DIR__.'/../../dbconnect.php';
		$sql = <<<EOT
					SELECT * FROM `sanpham` sp
					JOIN thuonghieu th ON sp.th_id=th.th_id
					JOIN  xuatxu xx ON sp.xx_id=xx.xx_id
					ORDER BY sp.sp_id DESC
		EOT;

		$result = mysqli_query($conn, $sql);

		$data = [];
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[] = array(
				'sp_id' => $row['sp_id'],
				'sp_ten' => $row['sp_ten'],
				'sp_soluong' => $row['sp_soluong'],
				'sp_gia' => number_format($row['sp_gia'], 0, '.', ','),
				'sp_giacu' => number_format($row['sp_giacu'], 0, '.',','),
				'th_ten' => $row['th_ten'],
				'xx_ten'=> $row['xx_ten'],
				'sp_ngaycapnhat'=> date('d/m/Y H:i:s', strtotime($row['sp_ngaycapnhat'])),
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
							<h6 class="m-0 font-weight-bold text-primary">SẢN PHẨM</h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>Mã sản phẩm</th>
											<th>Tên sản phẩm</th>
											<th>Số lượng sản phẩm</th>
											<th>Giá</th>
											<th>Giá cũ</th>
											<th>Thương hiệu</th>
											<th>Xuất xứ</th>
											<th>Ngày cập nhật</th>
											<th>Quản lý</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($data as $sp): ?>
										<tr>
											<td><?= $sp['sp_id']; ?></td>
											<td><?= $sp['sp_ten']; ?></td>
											<td><?= $sp['sp_soluong']; ?></td>
											<td class="text-right"><?= $sp['sp_gia']; ?></td>
											<?php if ($sp['sp_giacu'] !=0){ ?>
											<td class="text-right"><?= $sp['sp_giacu']; ?></td>
											<?php } else { ?>
												<td>Không có <br/>giá cũ</td>
											<?php }?>
											<td><?= $sp['th_ten']; ?></td>
											<td><?= $sp['xx_ten']; ?></td>
											<td><?= $sp['sp_ngaycapnhat']; ?></td>
											<td>
												<a href="edit.php?id=<?=$sp['sp_id']; ?>"><button type="button" class="btn btn-primary">Sửa</button><a>
												<a onclick="return confirm('Bạn có chắc là muốn xóa thương hiệu này không ?')" href="delete.php?id=<?=$sp['sp_id']; ?>"><button type="button" class="btn btn-danger">Xóa</button></a>
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