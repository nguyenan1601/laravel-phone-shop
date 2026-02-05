@extends('layouts.app')

@section('title', 'Bảng điều khiển - PhoneXịnPhone')

@section('content')
<div class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-black text-gray-900 mb-8 border-l-8 border-blue-600 pl-4 uppercase">Bảng điều khiển</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Quick Link: Profile -->
            <a href="{{ route('profile.edit') }}" class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-xl transition-all group">
                <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wider">Hồ sơ cá nhân</h3>
                <p class="text-sm text-gray-500 mt-2">Cập nhật thông tin liên lạc và địa chỉ giao hàng của bạn.</p>
            </a>

            <!-- Quick Link: Orders -->
            <a href="{{ route('orders.index') }}" class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-xl transition-all group">
                <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center text-green-600 mb-6 group-hover:bg-green-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wider">Đơn hàng của tôi</h3>
                <p class="text-sm text-gray-500 mt-2">Theo dõi trạng thái và lịch sử các đơn hàng đã đặt.</p>
            </a>

            <!-- Quick Link: Shopping -->
            <a href="{{ url('/phones') }}" class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-xl transition-all group">
                <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center text-purple-600 mb-6 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wider">Tiếp tục mua sắm</h3>
                <p class="text-sm text-gray-500 mt-2">Khám phá những mẫu điện thoại mới nhất tại cửa hàng.</p>
            </a>
        </div>
        
        <div class="mt-8 bg-blue-600 rounded-3xl p-8 text-white shadow-lg shadow-blue-100 relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-2xl font-black uppercase tracking-tighter italic">Chào mừng trở lại, {{ Auth::user()->name }}!</h2>
                <p class="mt-2 text-blue-100 text-sm opacity-80">Rất vui được gặp lại bạn. Chúc bạn có một ngày mua sắm tuyệt vời tại PhoneXịn.</p>
            </div>
            <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        </div>
    </div>
</div>
@endsection
