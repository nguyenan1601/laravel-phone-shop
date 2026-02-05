@extends('layouts.app')

@section('title', 'Tất cả điện thoại - HaanPhone')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <h1 class="text-3xl font-black text-gray-900 border-l-8 border-blue-600 pl-4 uppercase tracking-tighter italic">Cửa hàng công nghệ</h1>
            
            <form action="{{ url('/phones') }}" method="GET" class="mt-4 md:mt-0 flex items-center bg-white rounded-2xl shadow-sm border border-gray-100 p-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Bạn tìm điện thoại gì?" class="border-none focus:ring-0 bg-transparent px-4 py-2 w-full md:w-64 text-sm">
                <button type="submit" class="bg-blue-600 text-white p-2 rounded-xl hover:bg-blue-700 transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
        </div>

        <div class="lg:grid lg:grid-cols-4 lg:gap-x-8">
            <!-- Sidebar Lọc -->
            <aside class="hidden lg:block">
                <form action="{{ url('/phones') }}" method="GET" id="filter-form" class="space-y-8 sticky top-24">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    
                    <div>
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Hãng sản xuất</h3>
                        <div class="space-y-2">
                            <label class="flex items-center group cursor-pointer">
                                <input type="radio" name="brand" value="" {{ !request('brand') ? 'checked' : '' }} onchange="this.form.submit()" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500 rounded-full">
                                <span class="ml-3 text-sm text-gray-600 group-hover:text-blue-600 transition-colors">Tất cả hãng</span>
                            </label>
                            @foreach($brands as $brand)
                                <label class="flex items-center group cursor-pointer">
                                    <input type="radio" name="brand" value="{{ $brand }}" {{ request('brand') == $brand ? 'checked' : '' }} onchange="this.form.submit()" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500 rounded-full">
                                    <span class="ml-3 text-sm text-gray-600 group-hover:text-blue-600 transition-colors">{{ $brand }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Khoảng giá</h3>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Từ" class="bg-white border-gray-200 rounded-xl py-2 px-3 text-sm focus:ring-blue-500 focus:border-blue-500">
                            <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Đến" class="bg-white border-gray-200 rounded-xl py-2 px-3 text-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <button type="submit" class="mt-4 w-full bg-gray-900 text-white font-bold py-2 rounded-xl text-xs uppercase tracking-widest hover:bg-black transition-all">Áp dụng giá</button>
                    </div>

                    <div class="pt-8 border-t border-gray-200">
                        <a href="{{ url('/phones') }}" class="text-xs font-bold text-red-500 hover:text-red-700 uppercase tracking-widest italic">Xóa tất cả bộ lọc</a>
                    </div>
                </form>
            </aside>

            <!-- Danh sách sản phẩm -->
            <div class="lg:col-span-3">
                <div class="flex items-center justify-between mb-6 bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                    <p class="text-sm text-gray-500">Hiển thị <span class="font-bold text-gray-900">{{ $phones->count() }}</span> sản phẩm</p>
                    
                    <div class="flex items-center">
                        <span class="text-xs font-bold text-gray-400 uppercase mr-3">Sắp xếp:</span>
                        <select name="sort" form="filter-form" onchange="this.form.submit()" class="border-none bg-gray-50 rounded-xl text-sm font-bold text-gray-900 focus:ring-0 py-2 pl-3 pr-8">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Mới nhất</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Giá: Thấp đến Cao</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Giá: Cao đến Thấp</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                    @forelse($phones as $phone)
                    <div class="bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden group border border-transparent hover:border-blue-100 relative">
                        <!-- Badge Trạng thái -->
                        @if($phone->status)
                        <span class="absolute top-4 left-4 z-10 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm {{ $phone->status->statusName == 'Mới' ? 'text-blue-600' : 'text-orange-600' }}">
                            {{ $phone->status->statusName }}
                        </span>
                        @endif

                        <div class="relative bg-gray-50 aspect-square flex items-center justify-center p-10 overflow-hidden">
                            <img src="{{ asset($phone->imgUrl) }}" alt="{{ $phone->name }}" class="max-h-full object-contain group-hover:scale-110 transition-transform duration-700 ease-out z-0">
                            <div class="absolute inset-0 bg-blue-600/0 group-hover:bg-blue-600/5 transition-colors duration-500"></div>
                        </div>
                        
                        <div class="p-8">
                            <p class="text-[10px] text-blue-600 font-black uppercase tracking-[0.2em] mb-2 italic">{{ $phone->brand }}</p>
                            <h3 class="text-lg font-bold text-gray-900 mb-2 truncate group-hover:text-blue-600 transition-colors leading-tight">
                                <a href="{{ url('/phones/'.$phone->id) }}">{{ $phone->name }}</a>
                            </h3>
                            <p class="text-gray-400 text-xs mb-6 line-clamp-1 font-medium">{{ $phone->description }}</p>
                            
                            <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                                <div class="flex flex-col">
                                    <span class="text-xs font-black text-gray-300 uppercase leading-none mb-1">Giá bán</span>
                                    <span class="text-xl font-black text-gray-900 tracking-tighter">{{ number_format($phone->price, 0, ',', '.') }}đ</span>
                                </div>
                                <a href="{{ url('/phones/'.$phone->id) }}" class="bg-gray-900 text-white w-12 h-12 rounded-2xl flex items-center justify-center hover:bg-blue-600 transition-all shadow-xl shadow-gray-100 group-hover:shadow-blue-100">
                                    <svg class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-3xl border-2 border-dashed border-gray-100">
                        <div class="max-w-xs mx-auto">
                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="mt-4 text-gray-500 font-bold uppercase tracking-widest text-xs">Không tìm thấy sản phẩm phù hợp</p>
                            <a href="{{ url('/phones') }}" class="mt-4 inline-block text-blue-600 font-black text-xs uppercase tracking-widest hover:underline">Xem tất cả sản phẩm</a>
                        </div>
                    </div>
                    @endforelse
                </div>

                <div class="mt-16">
                    {{ $phones->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
