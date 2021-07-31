<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<?php

	include_once(__DIR__.'/../../dbconnect.php');

	$dh_id = $_GET['dh_id'];

	$sqlDeleteChiTietDonHang = "DELETE FROM `sanpham_dondathang` WHERE dh_id=" . $dh_id;

	$resultChiTietDonHang = mysqli_query($conn, $sqlDeleteChiTietDonHang);


	$sqlDeleteDonHang = "DELETE FROM `dondathang` WHERE dh_id=" . $dh_id;


	$resultDonHang = mysqli_query($conn, $sqlDeleteDonHang);

	mysqli_close($conn);

	echo '<script>
			location.href="index.php";
			alert("Xóa đơn đặt hàng thành công");
		</script>';
?>