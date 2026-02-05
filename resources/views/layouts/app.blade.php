<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PhoneXịn Store - @yield('title', 'Website Bán Điện Thoại Online')</title>

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS v4 (via CDN for simplicity) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <!-- Navbar -->
    <nav class="glass-nav sticky top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center">
                        <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">PhoneXịn</span>
                    </a>
                    <div class="hidden sm:ml-8 sm:flex sm:space-x-8">
                        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all">Trang chủ</a>
                        <a href="{{ url('/phones') }}" class="{{ request()->is('phones*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all">Sản phẩm</a>
                        <a href="{{ url('/promotions') }}" class="{{ request()->is('promotions*') ? 'border-blue-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-all">Khuyến mãi</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <form action="{{ url('/phones') }}" method="GET" class="hidden md:block relative">
                        <input type="text" name="search" placeholder="Tìm kiếm điện thoại..." class="bg-gray-100 border-none rounded-full py-2 px-4 pl-10 focus:ring-2 focus:ring-blue-500 transition-all text-sm w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                    </form>
                    
                    <a href="{{ url('/cart') }}" class="p-2 text-gray-400 hover:text-blue-500 transition-colors relative">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        @php $cartCount = count(session('cart', [])); @endphp
                        @if($cartCount > 0)
                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 rounded-full text-[10px] font-bold leading-none text-white bg-blue-600 transform translate-x-1/2 -translate-y-1/2">{{ $cartCount }}</span>
                        @endif
                    </a>

                    @if (Route::has('login'))
                        @auth
                            <div class="flex items-center space-x-4 border-l pl-4 ml-4">
                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ url('/admin') }}" class="text-sm font-bold text-blue-600 hover:text-blue-700 flex items-center transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        Quản trị
                                    </a>
                                @endif
                                
                                <div class="relative">
                                    <button id="user-menu-button" class="flex items-center space-x-1 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors focus:outline-none">
                                        <span>Chào, {{ Auth::user()->name }}</span>
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </button>
                                    
                                    <!-- Simple Dropdown -->
                                    <div id="user-menu-dropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 hidden z-50">
                                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Thông tin tài khoản</a>
                                        <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Đơn hàng của tôi</a>
                                        <hr class="my-1 border-gray-50">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                Đăng xuất
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">Đăng nhập</a>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 transition-all shadow-sm">Đăng ký</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline font-medium">{{ session('error') }}</span>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-1">
                    <span class="text-2xl font-bold text-blue-600">PhoneXịn</span>
                    <p class="mt-4 text-gray-500 text-sm leading-6">Cửa hàng điện thoại uy tín hàng đầu. Cam kết sản phẩm chính hãng, bảo hành tận tâm và giá cả cạnh tranh nhất thị trường.</p>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Hỗ trợ khách hàng</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600">Câu hỏi thường gặp</a></li>
                        <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600">Chính sách bảo hành</a></li>
                        <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600">Chính sách đổi trả</a></li>
                        <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600">Phương thức vận chuyển</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Về chúng tôi</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600">Giới thiệu cửa hàng</a></li>
                        <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600">Liên hệ qua Hotline</a></li>
                        <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600">Hệ thống cửa hàng</a></li>
                        <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600">Tuyển dụng</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Bản tin</h3>
                    <p class="mt-4 text-sm text-gray-500">Đăng ký để nhận thông báo mới nhất về các chương trình khuyến mãi.</p>
                    <form class="mt-4 flex">
                        <input type="email" class="bg-gray-100 border-none rounded-l-lg py-2 px-4 focus:ring-2 focus:ring-blue-500 text-sm w-full" placeholder="Email của bạn">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-lg text-sm font-medium hover:bg-blue-700 transition-colors">Gửi</button>
                    </form>
                </div>
            </div>
            <div class="mt-16 border-t border-gray-100 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-gray-400">&copy; 2024 PhoneXịn Store. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-gray-500"><span class="sr-only">Facebook</span><svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"></path></svg></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const button = document.getElementById('user-menu-button');
            const dropdown = document.getElementById('user-menu-dropdown');

            if (button && dropdown) {
                button.addEventListener('click', function(event) {
                    event.stopPropagation();
                    dropdown.classList.toggle('hidden');
                });

                document.addEventListener('click', function(event) {
                    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                        dropdown.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>
