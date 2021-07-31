<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<?php
	include_once(__DIR__.'/../../dbconnect.php');

	$sqlSoLuongKhachHang = "select count(*) as SoLuong from `khachhang`";

	$result = mysqli_query($conn, $sqlSoLuongKhachHang);

	$dataSoLuongKhachHang = [];
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$dataSoLuongKhachHang[] = array(
			'SoLuong' => $row['SoLuong'] 
		);
	}

echo json_encode($dataSoLuongKhachHang[0]);
?>