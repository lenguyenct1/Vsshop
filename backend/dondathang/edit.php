<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<?php

	include_once(__DIR__.'/../../dbconnect.php');

	$dh_id = $_GET['dh_id'];
	$dh_ngaygiao= date_create('now', timezone_open('Asia/Ho_Chi_Minh'))->format('Y-m-d');
	$sqlUpdateDonHang = "Update `dondathang` set dh_trangthaithanhtoan = 1, dh_ngaygiao='".$dh_ngaygiao."' WHERE dh_id=" . $dh_id;
	$resultDonHang = mysqli_query($conn, $sqlUpdateDonHang);

	mysqli_close($conn);

	echo '<script>
			location.href="index.php";
			alert("Cập nhật trạng thái thanh toán thành công");
		</script>';
?>