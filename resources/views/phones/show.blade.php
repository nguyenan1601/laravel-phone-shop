@extends('layouts.app')

@section('title', $phone->name . ' - HaanPhone')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="{{ url('/') }}" class="hover:text-blue-600">Trang chủ</a></li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                    <a href="{{ url('/phones') }}" class="ml-2 hover:text-blue-600 uppercase">{{ $phone->brand }}</a>
                </li>
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                    <span class="ml-2 text-gray-900 font-medium">{{ $phone->name }}</span>
                </li>
            </ol>
        </nav>

        <div class="bg-white rounded-3xl shadow-sm overflow-hidden lg:grid lg:grid-cols-2 lg:gap-x-12">
            <!-- Image gallery -->
            <div class="p-8 lg:p-12 bg-gray-50 flex items-center justify-center">
                <img src="{{ asset($phone->imgUrl) }}" alt="{{ $phone->name }}" class="max-h-[500px] object-contain transform transition-transform hover:scale-105 duration-500">
            </div>

            <!-- Product details -->
            <div class="p-8 lg:p-12 border-l border-gray-100">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-blue-600 font-bold uppercase tracking-widest text-sm">{{ $phone->brand }}</p>
                        <h1 class="text-3xl font-black text-gray-900 mt-2">{{ $phone->name }}</h1>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $phone->status->statusName == 'Mới' ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800' }}">
                        {{ $phone->status->statusName }}
                    </span>
                </div>

                <div class="mt-8">
                    <h2 class="sr-only">Thông tin giá</h2>
                    <p class="text-4xl font-black text-blue-600">{{ number_format($phone->price, 0, ',', '.') }}đ</p>
                    <p class="mt-2 text-sm text-gray-500">Miễn phí vận chuyển toàn quốc.</p>
                </div>

                <div class="mt-8 border-t border-gray-100 pt-8">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Cấu hình chi tiết</h3>
                    <div class="mt-4 space-y-4">
                        @if($phone->specifications)
                            <div class="overflow-hidden bg-white border border-gray-100 rounded-2xl">
                                <table class="min-w-full divide-y divide-gray-100">
                                    <tbody class="divide-y divide-gray-100 bg-white">
                                        @foreach($phone->specifications as $key => $value)
                                            <tr>
                                                <td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-gray-500 bg-gray-50 w-1/3">{{ $key }}</td>
                                                <td class="px-4 py-3 text-sm text-gray-900">{{ $value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-gray-50 p-4 rounded-2xl">
                                    <span class="text-xs text-gray-400 block mb-1">Dung lượng</span>
                                    <span class="font-bold">{{ $phone->storage ?? 'N/A' }}</span>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-2xl">
                                    <span class="text-xs text-gray-400 block mb-1">Màu sắc</span>
                                    <span class="font-bold">{{ $phone->color ?? 'N/A' }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Mô tả sản phẩm</h3>
                    <div class="mt-4 text-gray-600 leading-relaxed">
                        {{ $phone->description }}
                    </div>
                </div>

                <div class="mt-10 flex gap-4">
                    <form action="{{ url('add-to-cart/'.$phone->id) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-4 px-8 rounded-2xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 flex items-center justify-center">
                            <svg class="h-6 w-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Thêm vào giỏ hàng
                        </button>
                    </form>
                    <button class="p-4 bg-gray-100 text-gray-400 rounded-2xl hover:text-red-500 transition-all">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    </button>
                </div>

                <div class="mt-6 flex items-center justify-center space-x-8 text-xs text-gray-500 font-medium">
                    <div class="flex items-center"><svg class="h-4 w-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Chính hãng 100%</div>
                    <div class="flex items-center"><svg class="h-4 w-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Bảo hành 12 tháng</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
