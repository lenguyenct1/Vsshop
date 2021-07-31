<?php include_once __DIR__.'/../layouts/partials/session.php';?>
<?php 
	include_once  __DIR__.'/../../dbconnect.php' ;
	$hsp_id = $_GET['hsp_id'];

	$sqlSelect = "SELECT * FROM `hinhsanpham` WHERE hsp_id=$hsp_id;";

	$resultSelect = mysqli_query($conn, $sqlSelect);

	$hinhsanphamRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);

	$upload_dir = __DIR__ . "/../../../assets/uploads/";

	$subdir = 'products/';

	$old_file = $upload_dir . $subdir . $hinhsanphamRow['hsp_tentaptin'];
	if (file_exists($old_file)) {
		unlink($old_file);
	}

	$hsp_id = $_GET['hsp_id'];

	$sql = "DELETE FROM `hinhsanpham` WHERE hsp_id=" . $hsp_id;

	$result = mysqli_query($conn, $sql);

	mysqli_close($conn);

	echo '<script>
			location.href="index.php";
			alert("Xóa hình ảnh thành công");
		</script>';
?>