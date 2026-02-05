@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng #' . $order->id . ' - HaanPhone')

@section('content')
<div class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-black text-gray-900 border-l-8 border-blue-600 pl-4 uppercase">Đơn hàng #{{ $order->id }}</h1>
            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold bg-blue-100 text-blue-800">
                {{ $order->status->statusName }}
            </span>
        </div>

        <div class="bg-white rounded-3xl shadow-sm overflow-hidden mb-8">
            <div class="p-8 border-b border-gray-50 flex flex-col md:flex-row justify-between gap-8">
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Thông tin giao hàng</h3>
                    <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ Auth::user()->customer->phoneNumber }}</p>
                    <p class="text-sm text-gray-500 mt-2 italic">{{ $order->shippingAddress }}</p>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Thông tin thanh toán</h3>
                    <p class="text-sm font-bold text-gray-900">{{ $order->paymentMethod->methodName }}</p>
                    <p class="text-sm text-gray-500 mt-1">Ngày đặt: {{ $order->orderDate }}</p>
                </div>
            </div>

            <div class="p-8">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">Sản phẩm đã mua</h3>
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach($order->details as $detail)
                    <li class="py-6 flex items-center">
                        <img src="{{ asset($detail->phone->imgUrl) }}" class="flex-none w-20 h-20 bg-gray-50 rounded-2xl object-contain p-2">
                        <div class="ml-6 flex-auto">
                            <h4 class="text-base font-bold text-gray-900">{{ $detail->phone->name }}</h4>
                            <p class="text-xs text-gray-400 mt-1 uppercase tracking-widest">{{ $detail->phone->brand }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-gray-900">{{ number_format($detail->price, 0, ',', '.') }}đ x {{ $detail->quantity }}</p>
                            <p class="text-base font-black text-blue-600 mt-1">{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}đ</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="bg-gray-50 p-8 flex justify-between items-center">
                <span class="text-sm font-bold text-gray-900 uppercase tracking-widest">Tổng tiền thanh toán</span>
                <span class="text-3xl font-black text-blue-600">{{ number_format($order->totalAmount, 0, ',', '.') }}đ</span>
            </div>
        </div>

        <div class="flex justify-center">
            <a href="{{ route('orders.index') }}" class="text-sm font-bold text-blue-600 hover:text-blue-700 flex items-center">
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Quay lại danh sách
            </a>
        </div>
    </div>
</div>
@endsection
