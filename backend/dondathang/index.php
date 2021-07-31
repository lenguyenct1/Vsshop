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

		include_once(__DIR__ . '/../../dbconnect.php');

		$sql = <<<EOT
					SELECT 
					ddh.dh_id, ddh.dh_ngaylap, ddh.dh_ngaygiao, ddh.dh_noigiao, ddh.dh_trangthaithanhtoan, kh.kh_ten, kh.kh_dienthoai
					, SUM(spddh.sp_dh_soluong * spddh.sp_dh_dongia) AS TongThanhTien
					FROM `dondathang` ddh
					JOIN `sanpham_dondathang` spddh ON ddh.dh_id = spddh.dh_id
					JOIN `khachhang` kh ON ddh.kh_tendangnhap = kh.kh_tendangnhap
					GROUP BY ddh.dh_id, ddh.dh_ngaylap, ddh.dh_ngaygiao, ddh.dh_noigiao, ddh.dh_trangthaithanhtoan, kh.kh_ten, kh.kh_dienthoai
		EOT;

		$result = mysqli_query($conn, $sql);

		$data = [];
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$data[] = array(
					'dh_id' => $row['dh_id'],
					'dh_ngaylap' => date('d/m/Y', strtotime($row['dh_ngaylap'])),
					'dh_ngaygiao' => empty($row['dh_ngaygiao']) ? 'Chưa giao hàng' : date('d/m/Y', strtotime($row['dh_ngaygiao'])),
					'dh_noigiao' => $row['dh_noigiao'],
					'dh_trangthaithanhtoan' => $row['dh_trangthaithanhtoan'],
					'kh_ten' => $row['kh_ten'],
					'kh_dienthoai' => $row['kh_dienthoai'],
					'TongThanhTien' => number_format($row['TongThanhTien'], 2, ".", ",") . ' vnđ',
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
							<h6 class="m-0 font-weight-bold text-primary">ĐƠN ĐẶT HÀNG</h6>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
									<tr>
										<th>Mã Đơn đặt hàng</th>
										<th>Khách hàng</th>
										<th>Ngày lập</th>
										<th>Ngày giao</th>
										<th>Nơi giao</th>
										<th>Tổng thành tiền</th>
										<th>Trạng thái thanh toán</th>
										<th>Hành động</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach ($data as $dondathang) : ?>
											<tr>
												<td><?= $dondathang['dh_id'] ?></td>
												<td><b><?= $dondathang['kh_ten'] ?></b><br />(<?= $dondathang['kh_dienthoai'] ?>)</td>
												<td><?= $dondathang['dh_ngaylap'] ?></td>
												<td><?= $dondathang['dh_ngaygiao'] ?></td>
												<td><?= $dondathang['dh_noigiao'] ?></td>
												<td><?= $dondathang['TongThanhTien'] ?></td>
												<td>
													<?php if ($dondathang['dh_trangthaithanhtoan'] == 0) : ?>
														<a  onclick="return confirm('Bạn có chắc muốn xử lý đơn hàng này không ?')" href="edit.php?dh_id=<?= $dondathang['dh_id'] ?>"><span class="badge badge-danger"> Chưa xử lý</span></a>
													<?php else : ?>
														<span class="badge badge-success">Đã giao hàng</span>
													<?php endif; ?>
												</td>
												<td>
													<?php if ($dondathang['dh_trangthaithanhtoan'] == 0) : ?>
														<button type="button" class="btn btn-danger btnDelete" data-dh_id="<?= $dondathang['dh_id'] ?>">
															Xóa
														</button>
													<?php else : ?>
														<a href="print.php?dh_id=<?= $dondathang['dh_id'] ?>" class="btn btn-success">
															In
														</a>
													<?php endif; ?>
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
<script>
		$(document).ready(function() {
			$('.btnDelete').click(function() {
				swal({
					title: "Bạn có chắc chắn muốn xóa?",
					text: "Một khi đã xóa, không thể phục hồi....",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {
					var dh_id = $(this).data('dh_id');
					var url = "delete.php?dh_id=" + dh_id;
					location.href = url;
				} else {
					swal("Cẩn thận hơn nhé!");
				}
				});

			});
		});
</script>
</body>
</html>