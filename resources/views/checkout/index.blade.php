@extends('layouts.app')

@section('title', 'Thanh toán đơn hàng - HaanPhone')

@section('content')
<div class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-black text-gray-900 mb-8 border-l-8 border-blue-600 pl-4 uppercase">Thanh toán</h1>

        <form action="{{ url('/place-order') }}" method="POST">
            @csrf
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-12">
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-3xl shadow-sm p-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 uppercase tracking-wider">Thông tin giao hàng</h2>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Họ và tên</label>
                                <input type="text" value="{{ Auth::user()->name }}" disabled class="bg-gray-50 border-none rounded-2xl py-3 px-4 w-full text-gray-500">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Số điện thoại</label>
                                <input type="text" value="{{ Auth::user()->customer->phoneNumber ?? 'Chưa cập nhật' }}" disabled class="bg-gray-50 border-none rounded-2xl py-3 px-4 w-full text-gray-500">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Địa chỉ nhận hàng</label>
                                <textarea name="shippingAddress" rows="3" required class="bg-gray-100 border-none rounded-2xl py-3 px-4 w-full focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố...">{{ Auth::user()->customer->address ?? '' }}</textarea>
                            </div>
                        </div>

                        <h2 class="text-xl font-bold text-gray-900 mt-12 mb-6 uppercase tracking-wider">Phương thức thanh toán</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($paymentMethods as $method)
                            <label class="relative flex border border-gray-100 rounded-2xl p-4 cursor-pointer focus:outline-none bg-gray-50 transition-all hover:bg-white hover:border-blue-500">
                                <input type="radio" name="payment_method_id" value="{{ $method->id }}" required class="h-4 w-4 mt-0.5 cursor-pointer text-blue-600 border-gray-300 focus:ring-blue-500">
                                <span class="ml-3 flex flex-col">
                                    <span class="block text-sm font-bold text-gray-900">{{ $method->methodName }}</span>
                                </span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-16 lg:mt-0 lg:col-span-5">
                    <div class="bg-white rounded-3xl shadow-sm p-8 sticky top-24">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 uppercase tracking-wider">Tóm tắt đơn hàng</h2>
                        <ul role="list" class="divide-y divide-gray-100 mb-6">
                            @foreach($cart as $id => $details)
                            <li class="py-4 flex">
                                <img src="{{ asset($details['imgUrl']) }}" class="flex-none w-16 h-16 bg-gray-100 rounded-xl object-contain p-2">
                                <div class="ml-4 flex-auto">
                                    <h4 class="text-sm font-bold text-gray-900">{{ $details['name'] }}</h4>
                                    <p class="text-xs text-gray-400 mt-1">x {{ $details['quantity'] }}</p>
                                </div>
                                <p class="flex-none text-sm font-bold text-gray-900">{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}đ</p>
                            </li>
                            @endforeach
                        </ul>

                        <div class="mt-8 border-t border-gray-100 pt-8">
                            <label for="coupon_code" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Mã giảm giá</label>
                            <div class="flex gap-2">
                                <input type="text" id="coupon_code" name="coupon_code" class="bg-gray-100 border-none rounded-2xl py-3 px-4 w-full focus:ring-2 focus:ring-blue-500 transition-all uppercase tracking-widest text-sm" placeholder="NHẬP MÃ TẠI ĐÂY">
                                <button type="button" id="apply-coupon" class="bg-gray-900 text-white font-bold px-6 rounded-2xl hover:bg-black transition-all text-xs uppercase tracking-widest">Áp dụng</button>
                            </div>
                            <p id="coupon-message" class="mt-2 text-xs font-bold hidden"></p>
                        </div>

                        <div class="space-y-4 border-t border-gray-50 pt-8 mt-8">
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>Tạm tính</span>
                                <span class="font-bold text-gray-900">{{ number_format($total, 0, ',', '.') }}đ</span>
                            </div>
                            <div id="discount-row" class="flex items-center justify-between text-sm text-green-600 hidden">
                                <span>Giảm giá</span>
                                <span id="discount-value" class="font-bold">-0đ</span>
                            </div>
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>Phí vận chuyển</span>
                                <span class="text-green-500 font-bold uppercase text-xs tracking-widest">Miễn phí</span>
                            </div>
                            <div class="flex items-center justify-between mt-6 pt-6 border-t border-gray-100">
                                <span class="text-lg font-bold text-gray-900">Tổng thanh toán</span>
                                <span id="final-total" class="text-2xl font-black text-blue-600" data-base="{{ $total }}">{{ number_format($total, 0, ',', '.') }}đ</span>
                            </div>
                        </div>

                        <button type="submit" class="mt-8 block w-full bg-blue-600 text-white text-center font-bold py-4 rounded-2xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 uppercase tracking-widest text-sm">
                            Đặt hàng ngay
                        </button>
                        <p class="mt-4 text-center text-xs text-gray-400">Bằng việc đặt hàng, bạn đồng ý với các điều khoản mua sắm của HaanPhone.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
    <script>
        document.getElementById('apply-coupon').addEventListener('click', function() {
            const code = document.getElementById('coupon_code').value;
            const message = document.getElementById('coupon-message');
            const discountRow = document.getElementById('discount-row');
            const discountValue = document.getElementById('discount-value');
            const finalTotal = document.getElementById('final-total');
            const baseTotal = parseInt(finalTotal.dataset.base);

            if (!code) {
                alert('Vui lòng nhập mã giảm giá');
                return;
            }

            fetch('{{ url("/check-coupon") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ code: code })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    message.textContent = 'Áp dụng mã thành công!';
                    message.classList.remove('hidden', 'text-red-500');
                    message.classList.add('text-green-600');
                    
                    discountRow.classList.remove('hidden');
                    discountValue.textContent = '-' + new Intl.NumberFormat('vi-VN').format(data.discount) + 'đ';
                    
                    const newTotal = baseTotal - data.discount;
                    finalTotal.textContent = new Intl.NumberFormat('vi-VN').format(newTotal > 0 ? newTotal : 0) + 'đ';
                } else {
                    message.textContent = data.message;
                    message.classList.remove('hidden', 'text-green-600');
                    message.classList.add('text-red-500');
                    discountRow.classList.add('hidden');
                    finalTotal.textContent = new Intl.NumberFormat('vi-VN').format(baseTotal) + 'đ';
                }
            });
        });
    </script>
@endsection
