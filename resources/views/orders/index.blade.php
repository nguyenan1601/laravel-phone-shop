@extends('layouts.app')

@section('title', 'Lịch sử mua hàng - HaanPhone')

@section('content')
<div class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-black text-gray-900 mb-8 border-l-8 border-blue-600 pl-4 uppercase">Lịch sử đơn hàng</h1>

        @if($orders->count() > 0)
        <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Mã đơn</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Ngày đặt</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Trạng thái</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Tổng tiền</th>
                            <th class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($orders as $order)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900">#{{ $order->id }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $order->orderDate }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $order->status->statusName == 'Đã giao' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $order->status->statusName }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span class="font-black text-blue-600">{{ number_format($order->totalAmount, 0, ',', '.') }}đ</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('orders.show', $order->id) }}" class="text-sm font-bold text-gray-400 hover:text-blue-600">Chi tiết</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
        @else
        <div class="text-center py-24 bg-white rounded-3xl shadow-sm">
            <svg class="mx-auto h-24 w-24 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            <h2 class="mt-6 text-xl font-bold text-gray-900">Bạn chưa có đơn hàng nào</h2>
            <p class="mt-2 text-gray-500">Bắt đầu mua sắm ngay để sở hữu những sản phẩm công nghệ mới nhất.</p>
            <a href="{{ url('/phones') }}" class="mt-8 inline-block bg-blue-600 text-white font-bold py-3 px-8 rounded-full hover:bg-blue-700 transition-all uppercase tracking-widest text-xs">
                Mua sắm ngay
            </a>
        </div>
        @endif
    </div>
</div>
@endsection
