@extends('layouts.app')

@section('title', 'Trang chủ - Cửa hàng điện thoại HaanPhone')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block xl:inline">Công nghệ đỉnh cao</span>
                            <span class="block text-blue-600 xl:inline">Trong tầm tay bạn</span>
                        </h1>
                        <p class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Khám phá những mẫu điện thoại mới nhất, từ iPhone đẳng cấp đến Samsung đột phá. Trải nghiệm mua sắm online dễ dàng và an toàn hơn bao giờ hết.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ url('/phones') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-white bg-blue-600 hover:bg-blue-700 md:py-4 md:text-lg md:px-10 transition-all">
                                    Mua sắm ngay
                                </a>
                            </div>
                            <div class="mt-3 sm:mt-0 sm:ml-3">
                                <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-full text-blue-700 bg-blue-100 hover:bg-blue-200 md:py-4 md:text-lg md:px-10 transition-all">
                                    Xem khuyến mãi
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="{{ asset('images/home-img.png') }}" alt="Haan Phone Store Hero">
        </div>
    </section>

    <!-- Hot Products -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900">Sản phẩm nổi bật</h2>
                    <p class="mt-2 text-gray-600">Những mẫu điện thoại được săn đón nhất hiện nay.</p>
                </div>
                <a href="{{ url('/phones') }}" class="text-blue-600 font-semibold hover:text-blue-700 flex items-center">
                    Xem tất cả
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredPhones as $phone)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group">
                    <div class="relative bg-gray-100 aspect-square flex items-center justify-center p-8">
                        <img src="{{ asset($phone->imgUrl) }}" alt="{{ $phone->name }}" class="max-h-full object-contain group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 right-4">
                            <span class="bg-blue-600 text-white text-[10px] font-bold px-2 py-1 rounded-full uppercase tracking-wider">Mới</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-xs text-blue-600 font-bold uppercase tracking-widest mb-1">{{ $phone->brand }}</p>
                        <h3 class="text-lg font-bold text-gray-900 mb-2 truncate group-hover:text-blue-600 transition-colors">
                            <a href="{{ url('/phones/'.$phone->id) }}">{{ $phone->name }}</a>
                        </h3>
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-xl font-black text-gray-900">{{ number_format($phone->price, 0, ',', '.') }}đ</span>
                            <button class="bg-gray-900 text-white p-2 rounded-full hover:bg-blue-600 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Brands -->
    <section class="py-16 bg-white border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center items-center gap-12 md:gap-24 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                <img src="{{ asset('images/Apple-logo.png') }}" alt="Apple" class="h-10 md:h-12 w-auto">
                <img src="{{ asset('images/Samsung-logo.png') }}" alt="Samsung" class="h-8 md:h-10 w-auto">
                <img src="{{ asset('images/oppo-logo.png') }}" alt="Oppo" class="h-8 md:h-10 w-auto">
                <img src="{{ asset('images/Xiaomi-logo.png') }}" alt="Xiaomi" class="h-10 md:h-12 w-auto">
                <img src="{{ asset('images/realme-logo.png') }}" alt="Realme" class="h-8 md:h-10 w-auto">
                <img src="{{ asset('images/Vivo-Logo.png') }}" alt="Vivo" class="h-8 md:h-10 w-auto">
            </div>
        </div>
    </section>
@endsection
