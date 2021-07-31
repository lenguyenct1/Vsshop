<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<?php
	include_once(__DIR__.'/../../dbconnect.php');

	$sqlSoLuongSanPham = "select count(*) as SoLuong from `sanpham`";

	$result = mysqli_query($conn, $sqlSoLuongSanPham);

	$dataSoLuongSanPham = [];
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$dataSoLuongSanPham[] = array(
			'SoLuong' => $row['SoLuong']
		);
	}

	echo json_encode($dataSoLuongSanPham[0]);
?>