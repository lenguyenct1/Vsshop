	<script src="/Vsshop/assets/vendor/backend/jquery/jquery.min.js"></script>

	<script src="/Vsshop/assets/vendor/backend/bootstrap/js/bootstrap.bundle.min.js"></script>

	<script src="/Vsshop/assets/vendor/backend/jquery-easing/jquery.easing.min.js"></script>

	<script src="/Vsshop/assets/vendor/backend/js/sb-admin-2.min.js"></script>

	<script src="/Vsshop/assets/vendor/backend/jquery-validation/dist/jquery.validate.min.js"></script>

	<script src="/Vsshop/assets/vendor/backend/jquery-validation/dist/localization/messages_vi.min.js"></script>

	<script src="/Vsshop/assets/vendor/backend/datatables/jquery.dataTables.min.js"></script>

	<script src="/Vsshop/assets/vendor/backend/datatables/dataTables.bootstrap4.min.js"></script>

	<script src="/Vsshop/assets/vendor/backend/js/demo/datatables-demo.js"></script>

	<script src="/Vsshop/assets/vendor/backend/chart.js/Chart.min.js"></script>

	<script src="/Vsshop/assets/vendor/backend/datatables/pdfmake.min.js"></script>

	<script src="/Vsshop/assets/vendor/backend/datatables/vfs_fonts.js"></script>

	<script src="/Vsshop/assets/vendor/backend/datatables/dataTables.buttons.min.js"></script>

	<script src="/Vsshop/assets/vendor/backend/datatables/buttons.html5.min.js"></script>

	<script src="/Vsshop/assets/vendor/backend/datatables/buttons.print.min.js"></script>

	<script src="/Vsshop/assets/vendor/backend/datatables/jszip.min.js"></script>

	<script src="/Vsshop/assets/vendor/backend/js/sweetalert.min.js"></script>

	<script src="/Vsshop/assets/vendor/backend/ckeditor/ckeditor.js"></script>

	<script>
		 $('#dataTable').DataTable({
			responsive: true,
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				],
				order: [
					[0, 'desc']
				],
				'language': {
					'info': 'Hiển thị _START_ đến _END_ của _TOTAL_ danh sách',
					'lengthMenu': "Hiển thị _MENU_",
					"emptyTable": "Không có dữ liệu trong bảng",
					"paginate": {
						"previous": "Trước",
						"next": "Sau",
						"infoEmpty": "Không có dữ liệu"
					},
					"search": "Lọc / Tìm kiếm:"
				},
		});
	</script>