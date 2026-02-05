@extends('layouts.app')

@section('title', 'Giỏ hàng của bạn - HaanPhone')

@section('content')
<div class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-black text-gray-900 mb-8 border-l-8 border-blue-600 pl-4 uppercase">Giỏ hàng</h1>

        @if(count($cart) > 0)
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
            <div class="lg:col-span-8">
                <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
                    <ul role="list" class="divide-y divide-gray-100">
                        @foreach($cart as $id => $details)
                        <li class="p-6 flex flex-col sm:flex-row items-center">
                            <div class="flex-shrink-0 w-24 h-24 bg-gray-100 rounded-2xl overflow-hidden p-2">
                                <img src="{{ asset($details['imgUrl']) }}" alt="{{ $details['name'] }}" class="w-full h-full object-contain">
                            </div>

                            <div class="mt-4 sm:mt-0 sm:ml-6 flex-1">
                                <div class="flex justify-between">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $details['name'] }}</h3>
                                    <p class="text-lg font-black text-blue-600">{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}đ</p>
                                </div>
                                <p class="text-xs text-gray-400 uppercase font-bold tracking-widest mt-1">{{ $details['brand'] }}</p>

                                <div class="mt-4 flex items-center justify-between">
                                    <div class="flex items-center border border-gray-200 rounded-full p-1">
                                        <button class="update-cart p-1 text-gray-400 hover:text-blue-600" data-id="{{ $id }}" data-quantity="{{ $details['quantity'] - 1 }}">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                        </button>
                                        <span class="mx-4 text-sm font-bold w-4 text-center">{{ $details['quantity'] }}</span>
                                        <button class="update-cart p-1 text-gray-400 hover:text-blue-600" data-id="{{ $id }}" data-quantity="{{ $details['quantity'] + 1 }}">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        </button>
                                    </div>

                                    <button class="remove-from-cart text-sm font-bold text-red-500 hover:text-red-700 flex items-center" data-id="{{ $id }}">
                                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Xóa
                                    </button>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="mt-16 lg:mt-0 lg:col-span-4">
                <div class="bg-white rounded-3xl shadow-sm p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6 uppercase tracking-wider">Tổng đơn hàng</h2>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>Tạm tính</span>
                            <span class="font-bold text-gray-900">{{ number_format($total, 0, ',', '.') }}đ</span>
                        </div>
                        <div class="flex items-center justify-between text-sm text-gray-500 border-t border-gray-50 pt-4">
                            <span>Phí vận chuyển</span>
                            <span class="text-green-500 font-bold uppercase text-xs tracking-widest">Miễn phí</span>
                        </div>
                        <div class="flex items-center justify-between mt-6 pt-6 border-t border-gray-100">
                            <span class="text-lg font-bold text-gray-900">Tổng cộng</span>
                            <span class="text-2xl font-black text-blue-600">{{ number_format($total, 0, ',', '.') }}đ</span>
                        </div>
                    </div>

                    <a href="{{ url('/checkout') }}" class="mt-8 block w-full bg-blue-600 text-white text-center font-bold py-4 rounded-2xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 uppercase tracking-widest text-sm">
                        Tiến hành thanh toán
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-24 bg-white rounded-3xl shadow-sm">
            <svg class="mx-auto h-24 w-24 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            <h2 class="mt-6 text-xl font-bold text-gray-900">Giỏ hàng của bạn đang trống</h2>
            <p class="mt-2 text-gray-500">Tiếp tục khám phá những mẫu điện thoại tuyệt vời tại HaanPhone.</p>
            <a href="{{ url('/phones') }}" class="mt-8 inline-block bg-blue-600 text-white font-bold py-3 px-8 rounded-full hover:bg-blue-700 transition-all uppercase tracking-widest text-xs">
                Xem sản phẩm ngay
            </a>
        </div>
        @endif
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(".update-cart").click(function (e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        var quantity = $(this).attr("data-quantity");
        if(quantity < 1) return;

        $.ajax({
            url: '{{ url('update-cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: id, 
                quantity: quantity
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var id = $(this).attr("data-id");

        if(confirm("Bạn có chắc muốn xóa sản phẩm này?")) {
            $.ajax({
                url: '{{ url('remove-from-cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: id
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
@endsection
