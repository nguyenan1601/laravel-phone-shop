<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PhoneStatus;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Customer;
use App\Models\Admin;
use App\Models\Phone;
use App\Models\Coupon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. Phone Statuses
        $statuses = ['Mới', 'Cũ', 'Hết hàng'];
        foreach ($statuses as $status) {
            PhoneStatus::firstOrCreate(['statusName' => $status]);
        }
        $statusMoi = PhoneStatus::where('statusName', 'Mới')->first()->id;

        // 2. Order Statuses
        $orderStatuses = ['Chờ duyệt', 'Đang giao', 'Đã giao', 'Đã hủy'];
        foreach ($orderStatuses as $status) {
            OrderStatus::firstOrCreate(['statusName' => $status]);
        }

        // 3. Payment Methods
        $paymentMethods = ['Tiền mặt', 'Chuyển khoản'];
        foreach ($paymentMethods as $method) {
            PaymentMethod::firstOrCreate(['methodName' => $method]);
        }

        // 4. Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        );
        Admin::firstOrCreate(['user_id' => $admin->id]);

        // 5. Regular Users
        $users = [
            ['email' => 'user1@gmail.com', 'name' => 'User 1'],
            ['email' => 'user2@gmail.com', 'name' => 'User 2'],
            ['email' => 'user3@gmail.com', 'name' => 'User 3'],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('user123'),
                    'role' => 'customer'
                ]
            );
            Customer::firstOrCreate(['user_id' => $user->id]);
        }

        // 6. Real Phones Data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Phone::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $phones = [
            [
                'name' => 'iPhone 15 Pro Max',
                'brand' => 'Apple',
                'price' => 34990000,
                'description' => 'Siêu phẩm mới nhất từ Apple với khung Titan siêu bền.',
                'color' => 'Titan Tự Nhiên',
                'storage' => '256GB',
                'stockQuantity' => 10,
                'imgUrl' => 'images/iPhone 15 Pro Max crop.png',
                'status_id' => $statusMoi,
                'specifications' => [
                    'Màn hình' => '6.7 inch, OLED, Super Retina XDR',
                    'CPU' => 'Apple A17 Pro (3 nm)',
                    'RAM' => '8 GB',
                    'Camera sau' => '48MP + 12MP + 12MP',
                    'Pin' => '4,441 mAh',
                    'Hệ điều hành' => 'iOS 17'
                ]
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra',
                'brand' => 'Samsung',
                'price' => 29990000,
                'description' => 'Đỉnh cao công nghệ AI trên di động.',
                'color' => 'Xám Titanium',
                'storage' => '512GB',
                'stockQuantity' => 15,
                'imgUrl' => 'images/Samsung Galaxy S24 Ultra crop.png',
                'status_id' => $statusMoi,
                'specifications' => [
                    'Màn hình' => '6.8 inch, Dynamic AMOLED 2X',
                    'CPU' => 'Snapdragon 8 Gen 3 for Galaxy',
                    'RAM' => '12 GB',
                    'Camera sau' => '200MP + 50MP + 12MP + 10MP',
                    'Pin' => '5,000 mAh',
                    'Hệ điều hành' => 'Android 14 (One UI 6.1)'
                ]
            ],
            [
                'name' => 'Oppo Find X7',
                'brand' => 'Oppo',
                'price' => 18990000,
                'description' => 'Thiết kế sang trọng, camera Hasselblad đỉnh cao.',
                'color' => 'Nâu',
                'storage' => '256GB',
                'stockQuantity' => 8,
                'imgUrl' => 'images/Oppo Find X7 crop.png',
                'status_id' => $statusMoi,
                'specifications' => [
                    'Màn hình' => '6.78 inch, AMOLED, 120Hz',
                    'CPU' => 'Dimensity 9300',
                    'RAM' => '12 GB',
                    'Camera sau' => '50MP + 50MP + 64MP',
                    'Pin' => '5,000 mAh',
                    'Sạc nhanh' => '100W'
                ]
            ],
            [
                'name' => 'Xiaomi 14 Ultra',
                'brand' => 'Xiaomi',
                'price' => 24990000,
                'description' => 'Ống kính Leica, cấu hình mạnh mẽ nhất.',
                'color' => 'Đen',
                'storage' => '512GB',
                'stockQuantity' => 12,
                'imgUrl' => 'images/Xiaomi 14 Ultra crop.png',
                'status_id' => $statusMoi,
                'specifications' => [
                    'Màn hình' => '6.73 inch, LTPO AMOLED 12B colors',
                    'CPU' => 'Snapdragon 8 Gen 3',
                    'RAM' => '16 GB',
                    'Camera sau' => '50MP + 50MP + 50MP + 50MP',
                    'Pin' => '5,300 mAh',
                    'Hệ điều hành' => 'HyperOS'
                ]
            ],
            [
                'name' => 'Realme 11',
                'brand' => 'Realme',
                'price' => 6990000,
                'description' => 'Hiệu năng ổn định, giá thành hợp lý.',
                'color' => 'Vàng',
                'storage' => '128GB',
                'stockQuantity' => 20,
                'imgUrl' => 'images/Realme_11.png',
                'status_id' => $statusMoi,
                'specifications' => [
                    'Màn hình' => '6.4 inch, Super AMOLED 90Hz',
                    'CPU' => 'Helio G99',
                    'RAM' => '8 GB',
                    'Camera sau' => '108MP + 2MP',
                    'Pin' => '5,000 mAh',
                    'Sạc nhanh' => '67W'
                ]
            ],
            [
                'name' => 'Vivo Y36',
                'brand' => 'Vivo',
                'price' => 5490000,
                'description' => 'Thiết kế trẻ trung, pin trâu.',
                'color' => 'Xanh',
                'storage' => '128GB',
                'stockQuantity' => 25,
                'imgUrl' => 'images/Vivo Y36 crop.png',
                'status_id' => $statusMoi,
                'specifications' => [
                    'Màn hình' => '6.64 inch, IPS LCD 90Hz',
                    'CPU' => 'Snapdragon 680',
                    'RAM' => '8 GB',
                    'Camera sau' => '50MP + 2MP + 2MP',
                    'Pin' => '5,000 mAh',
                    'Sạc nhanh' => '44W'
                ]
            ],
            [
                'name' => 'Google Pixel 8 Pro',
                'brand' => 'Google',
                'price' => 19990000,
                'description' => 'Trải nghiệm Android thuần khiết với camera AI đỉnh cao.',
                'color' => 'Bay Blue',
                'storage' => '128GB',
                'stockQuantity' => 10,
                'imgUrl' => 'images/Google_Pixel_8_Pro.png',
                'status_id' => $statusMoi,
                'specifications' => [
                    'Màn hình' => '6.7 inch, LTPO OLED, 120Hz',
                    'CPU' => 'Google Tensor G3',
                    'RAM' => '12 GB',
                    'Camera sau' => '50MP + 48MP + 48MP',
                    'Pin' => '5,050 mAh',
                    'Hệ điều hành' => 'Android 14'
                ]
            ],
            [
                'name' => 'Samsung Galaxy Z Fold 5',
                'brand' => 'Samsung',
                'price' => 32990000,
                'description' => 'Smartphone màn hình gập tối tân nhất từ Samsung.',
                'color' => 'Icy Blue',
                'storage' => '256GB',
                'stockQuantity' => 5,
                'imgUrl' => 'images/Samsung_Galaxy_Z_Fold_5.png',
                'status_id' => $statusMoi,
                'specifications' => [
                    'Màn hình' => '7.6 inch, Dynamic AMOLED 2X, 120Hz',
                    'CPU' => 'Snapdragon 8 Gen 2 for Galaxy',
                    'RAM' => '12 GB',
                    'Camera sau' => '50MP + 12MP + 10MP',
                    'Pin' => '4,400 mAh',
                    'Tính năng' => 'S Pen support, IPX8'
                ]
            ],
        ];

        foreach ($phones as $phoneData) {
            Phone::updateOrCreate(['name' => $phoneData['name']], $phoneData);
        }

        // 6.5 Thêm 100 sản phẩm ngẫu nhiên để kiểm tra phân trang
        $randomBrands = ['Apple', 'Samsung', 'Xiaomi', 'Oppo', 'Vivo', 'Realme', 'Nokia', 'Huawei', 'Asus', 'Sony'];
        $modelSuffixes = ['SE', 'Plus', 'Lite', 'Pro', 'Ultra', 'Max', 'Prime', 'Neo', 'FE', 'A'];
        $existingImages = [
            'images/Galaxy A54 crop.png',
            'images/Galaxy A55 crop.png',
            'images/Google_Pixel_8_Pro.png',
            'images/Oppo A58 crop.png',
            'images/Oppo A79 crop.png',
            'images/Oppo Find X7 crop.png',
            'images/Realme_11.png',
            'images/Redmi 12 crop.png',
            'images/Redmi Note 13 crop.png',
            'images/Samsung Galaxy S24 Ultra crop.png',
            'images/Samsung_Galaxy_Z_Fold_5.png',
            'images/Vivo Y36 crop.png',
            'images/Xiaomi 14 Ultra crop.png',
            'images/iPhone 14 crop.png',
            'images/iPhone 15 Pro Max crop.png'
        ];

        for ($i = 1; $i <= 100; $i++) {
            $brand = $randomBrands[array_rand($randomBrands)];
            $suffix = $modelSuffixes[array_rand($modelSuffixes)];
            $name = "$brand Phone $suffix " . (2020 + rand(0, 6)) . " Gen $i";
            
            Phone::updateOrCreate(
                ['name' => $name],
                [
                    'brand' => $brand,
                    'price' => rand(5, 45) * 1000000 + rand(0, 9) * 100000 + 90000,
                    'description' => "Trải nghiệm đỉnh cao với phiên bản $name, hiệu năng mạnh mẽ và camera sắc nét.",
                    'color' => ['Xanh', 'Đen', 'Bạc', 'Vàng', 'Tím', 'Trắng'][rand(0, 5)],
                    'storage' => ['128GB', '256GB', '512GB', '1TB'][rand(0, 3)],
                    'stockQuantity' => rand(10, 100),
                    'imgUrl' => $existingImages[array_rand($existingImages)],
                    'status_id' => rand(1, 2), // Mới hoặc Cũ
                    'specifications' => [
                        'Màn hình' => rand(6, 7) . '.' . rand(1, 9) . ' inch',
                        'CPU' => 'Chip xử lý thế hệ mới',
                        'RAM' => [8, 12, 16][rand(0, 2)] . ' GB',
                        'Pin' => rand(4000, 5500) . ' mAh',
                    ]
                ]
            );
        }

        // 7. Coupons
        $coupons = [
            [
                'couponCode' => 'PHONEXIN100',
                'discountValue' => 100000,
                'description' => 'Giảm ngay 100.000đ cho đơn hàng bất kỳ.'
            ],
            [
                'couponCode' => 'CHAOXUAN2026',
                'discountValue' => 500000,
                'description' => 'Lì xì công nghệ - Giảm trực tiếp 500.000đ từ năm 2026.'
            ],
            [
                'couponCode' => 'VIPPRO',
                'discountValue' => 1000000,
                'description' => 'Ưu đãi đặc quyền cho khách hàng thân thiết HaanPhone.'
            ],
            [
                'couponCode' => 'HEMOI2026',
                'discountValue' => 200000,
                'description' => 'Chào hè rực rỡ - Giảm ngay 200.000đ cho mọi đơn hàng.'
            ],
            [
                'couponCode' => 'HOCSINH50',
                'discountValue' => 50000,
                'description' => 'Ưu đãi dành riêng cho học sinh, sinh viên.'
            ],
            [
                'couponCode' => 'NEWPHONE',
                'discountValue' => 300000,
                'description' => 'Mã giảm giá cho khách hàng mua sản phẩm mới lần đầu.'
            ],
            [
                'couponCode' => 'GAMING2026',
                'discountValue' => 400000,
                'description' => 'Chiến thuật tiết kiệm - Giảm ngay 400.000đ cho Gaming Phone.'
            ],
            [
                'couponCode' => 'PHUKIENTANG',
                'discountValue' => 150000,
                'description' => 'Combo hoàn hảo - Giảm 150.000đ khi mua kèm phụ kiện.'
            ],
        ];

        foreach ($coupons as $coupon) {
            Coupon::updateOrCreate(['couponCode' => $coupon['couponCode']], $coupon);
        }
    }
}
