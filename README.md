# Vsshop
Vsshop- Trang web bán hàng thương mại điện tử -  shop điện thoại di dộng
# Thông tin Thành viên Thực hiện dự án
- Thành viên 1
	- Mã lớp: CP21SCF08
	- Mã học viên: D21058
	- Họ tên: Lê Nguyễn
	# Mô tả dự án
Dự án tạo Trang web bán hàng thương mại điện tử -  shop điện thoại di dộng Vsshop. Trong dự án có:
## Vùng Frontend
Có các chức năng:
- Đăng nhập, đăng xuất
- Đăng ký
- Tìm kiếm theo tên sản phẩm/ Hiển thị gợi ý sản phẩm dùng ajax
- Xem chi tiết sản phẩm với nhiều hình ảnh
- Có chức năng liên hệ gởi mail
- Có giỏ hàng(Thêm,sửa, xóa sản phẩm),
- Có Thanh toán (cập nhật số lượng khi mua hàng thành công và gửi mail cho khách hàng).
- Có Trang chủ, trang tìm sản phẩm theo thương hiệu , trang danh sách sản phẩm và trang Giới thiệu về Vsshop.
## Vùng Backend
Có các chức năng:
- Có chức năng đăng nhập, đăng xuất
- Có chức năng CRUD (Xem Thêm Sửa Xóa) sản phẩm, thương hiệu, xuất xứ, hình ảnh.
- Có chức năng xuất Excel, mẫu báo cáo PDF, Word, Excel.
- Có chức năng upload hình ảnh.
- Xem , tạo đơn đặt hàng(khi tạo đơn sẽ cập nhật lại số lượng sản phẩm), thay đổi trạng thái đơn hàng, in và xóa đơn hàng.
- Có trang tổng quan để xem thống kê.

# Hướng dẫn setup dự án
## Cấu hình thư mục dự án
- Download và giải nén file .zip
- Chép vào c:\xampp\htdocs\Vsshop

## Khởi tạo database
- Vào thư mục db trong Vsshop có file `vsshop.sql`
- Sử dụng HeidiSQL truy cập MySQL Server -> chọn file `vsshop.sql` -> thực thi câu lệnh để khởi tạo database `vsshop`
...

## Truy cập trang web

### Vùng Frontend
- Sử dụng tài khoản khách hàng:
	 - Tên đăng nhập: TEST
	 - Mật khẩu: 123456
=> Để đặt hàng trên trang web (hoặc đăng ký để đặt hàng).

### Vùng Backend
- Sử dụng tài khoản admin:
	 - Tên đăng nhập: admin
	 - Mật khẩu: admin
=> Để sử dụng toàn quyền hệ thống (quyền admin là 1 và khách hàng là 0 và khách hàng không thể vào trang admin).
