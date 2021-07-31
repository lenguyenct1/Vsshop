<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<?php
	include_once(__DIR__.'/../../dbconnect.php');

	$sql = <<<EOT
		SELECT th.th_ten, COUNT(*) AS SoLuong
		FROM `sanpham` sp
		JOIN `thuonghieu` th ON sp.th_id = th.th_id
		GROUP BY sp.th_id
	EOT;

	$result = mysqli_query($conn, $sql);

	$data = [];
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$data[] = array(
			'TenThuongHieu' => $row['th_ten'],
			'SoLuong' => $row['SoLuong'] 
		);
	}

	echo json_encode($data);
?>