<?php
if(isset($_GET["term"]))
{
	$connect = new PDO("mysql:host=localhost; dbname=vsshop", "root", "");

 $query = "
 SELECT sp.sp_id, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_mota_ngan, sp.sp_soluong, th.th_ten, MAX(hsp.hsp_tentaptin) AS hsp_tentaptin
									FROM `sanpham` sp
									JOIN `thuonghieu` th ON sp.th_id = th.th_id
									LEFT JOIN `hinhsanpham` hsp ON sp.sp_id = hsp.sp_id
									WHERE sp_ten LIKE '%".$_GET["term"]."%' 
									GROUP BY sp.sp_id, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_mota_ngan, sp.sp_soluong, th.th_ten	
									ORDER BY sp_ten ASC
 ";

 $statement = $connect->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();

 $total_row = $statement->rowCount();

 $output = array();
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $temp_array = array();
   $temp_array['value'] = $row['sp_ten'];
   $temp_array['label'] = '<img src="/Vsshop/assets/uploads/products/'.$row['hsp_tentaptin'].'" width="70" />&nbsp;&nbsp;&nbsp;'.$row['sp_ten'].'';
   $output[] = $temp_array;
  }
 }
 else
 {
  $output['value'] = '';
  $output['label'] = 'No Record Found';
 }

 echo json_encode($output);
}
?>