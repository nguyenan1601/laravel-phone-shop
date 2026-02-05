# 📱 PhoneXịn - Hệ thống Thương mại Điện tử Bán Điện Thoại

Chào mừng đến với **PhoneXịn** - Nền tảng bán lẻ điện thoại trực tuyến hiện đại, được xây dựng với trải nghiệm người dùng tối ưu và hệ thống quản trị mạnh mẽ.

## ✨ Giới thiệu

**PhoneXịn** là đồ án môn học thiết kế phần mềm, hướng tới việc xây dựng một website bán hàng hoàn chỉnh với đầy đủ các quy trình từ tìm kiếm sản phẩm, đặt hàng, thanh toán đến quản trị kho và đơn hàng.

## 🚀 Tính năng Nổi bật

### 👤 Dành cho Khách hàng

- **Trải nghiệm Mua sắm Mượt mà**: Giao diện đẹp mắt, responsive, hỗ trợ **Lọc & Sắp xếp** sản phẩm thông minh.
- **Hệ thống Khuyến mãi**: Săn mã giảm giá tại trang **Khuyến mãi** và áp dụng trực tiếp khi thanh toán với công nghệ AJAX.
- **Quản lý Tài khoản**: Dashboard cá nhân cho phép theo dõi **Lịch sử đơn hàng** và cập nhật thông tin giao hàng.
- **Giỏ hàng Thông minh**: Lưu trữ sản phẩm, cập nhật số lượng và tính toán tổng tiền tự động.

### 🛡️ Dành cho Quản trị viên (Admin Panel)

- **Quản lý Sản phẩm**: Thêm, sửa, xóa điện thoại kèm theo cấu hình chi tiết (JSON Spec).
- **Quản lý Đơn hàng**: Theo dõi trạng thái đơn hàng (Chờ duyệt -> Đang giao -> Đã giao).
- **Quản lý Mã giảm giá (Coupons)**: Tạo các chiến dịch khuyến mãi linh hoạt.
- **Quản lý Người dùng**: Phân quyền và quản lý hồ sơ khách hàng.

## 🛠 Công nghệ Sử dụng

- **Backend**: Laravel 9.x
- **Frontend**: Blade Templates, Tailwind CSS
- **Admin Panel**: Filament v2
- **Database**: MySQL
- **Tools**: Composer, NPM

## ⚙️ Hướng dẫn Cài đặt & Chạy dự án

1. **Clone dự án**:

    ```bash
    git clone https://github.com/nguyenan1601/laravel-phone-shop.git
    cd tkpm
    ```

2. **Cài đặt Dependencies**:

    ```bash
    composer install
    npm install && npm run build
    ```

3. **Cấu hình Môi trường**:
    - Copy file `.env.example` thành `.env`
    - Cấu hình thông tin Database trong `.env`

4. **Khởi tạo Database**:
   Lệnh này sẽ tạo bảng và nạp dữ liệu mẫu (Sản phẩm, User, Coupon...).

    ```bash
    php artisan migrate:fresh --seed
    ```

    _> **Lưu ý**: Dữ liệu mẫu bao gồm 1 tài khoản Admin và hơn 100 sản phẩm thực tế._

5. **Khởi chạy Server**:
    ```bash
    php artisan serve
    ```
    Truy cập website tại: `http://localhost:8000`

## 🔑 Tài khoản Demo

| Vai trò   | Email             | Mật khẩu   |
| --------- | ----------------- | ---------- |
| **Admin** | `admin@gmail.com` | `admin123` |
| **User**  | `user1@gmail.com` | `user123`  |

---

