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

            @if($order->paymentMethod->methodName == 'Chuyển khoản' && $order->status->statusName != 'Đã hủy')
                <div class="px-8 pb-8 pt-0">
                    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 flex flex-col md:flex-row items-center gap-8">
                        <div class="flex-shrink-0 bg-white p-2 rounded-xl shadow-sm">
                            <img src="https://img.vietqr.io/image/VCB-1016544995-compact2.png?amount={{ $order->totalAmount }}&addInfo=Thanh toan don hang {{ $order->id }}&accountName=NGUYEN PHU AN" 
                                alt="Mã QR Thanh toán" 
                                class="w-48 h-auto">
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-blue-900 mb-2 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                Quét mã để thanh toán
                            </h3>
                            <p class="text-blue-700 text-sm mb-4">Sử dụng ứng dụng ngân hàng hoặc ví điện tử để quét mã QR bên cạnh.</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                                <div class="bg-white/50 p-3 rounded-lg">
                                    <p class="text-blue-500 text-xs uppercase font-bold">Ngân hàng</p>
                                    <p class="font-bold text-blue-900">Vietcombank(Ngân hàng ngoại thương)</p>
                                </div>
                                <div class="bg-white/50 p-3 rounded-lg">
                                    <p class="text-blue-500 text-xs uppercase font-bold">Số tài khoản</p>
                                    <p class="font-bold text-blue-900 tracking-wider">1016544995</p>
                                </div>
                                <div class="bg-white/50 p-3 rounded-lg">
                                    <p class="text-blue-500 text-xs uppercase font-bold">Chủ tài khoản</p>
                                    <p class="font-bold text-blue-900 uppercase">NGUYEN PHU AN</p>
                                </div>
                                <div class="bg-white/50 p-3 rounded-lg">
                                    <p class="text-blue-500 text-xs uppercase font-bold">Nội dung chuyển khoản</p>
                                    <p class="font-bold text-blue-900">Thanh toan don hang {{ $order->id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

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
