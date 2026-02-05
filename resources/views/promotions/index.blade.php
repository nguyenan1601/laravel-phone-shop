@extends('layouts.app')

@section('title', 'Khuyến mại cực hot - PhoneXịn')

@section('content')
<div class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="relative rounded-3xl overflow-hidden mb-16 bg-blue-600 shadow-2xl shadow-blue-100 italic">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-indigo-700 opacity-90"></div>
            <div class="relative z-10 p-12 md:p-20 text-white">
                <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tighter mb-4">Đại tiệc công nghệ</h1>
                <p class="text-xl md:text-2xl font-light opacity-90 mb-8 max-w-2xl">Săn mã giảm giá cực đỉnh, nâng cấp dế yêu với mức giá không tưởng chỉ có tại PhoneXịn.</p>
                <a href="{{ url('/phones') }}" class="inline-block bg-white text-blue-600 font-black py-4 px-10 rounded-full hover:bg-gray-100 transition-all uppercase tracking-widest text-sm shadow-xl not-italic">Mua sắm ngay</a>
            </div>
            <div class="absolute top-0 right-0 w-1/3 h-full bg-white/5 skew-x-12 transform translate-x-20"></div>
        </div>

        <h2 class="text-3xl font-black text-gray-900 mb-10 border-l-8 border-blue-600 pl-4 uppercase tracking-tighter italic">Mã giảm giá hấp dẫn</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($coupons as $coupon)
                <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-xl transition-all relative group">
                    <div class="p-8">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                            </div>
                            <span class="bg-green-100 text-green-700 text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full italic">Đang diễn ra</span>
                        </div>
                        
                        <h3 class="text-2xl font-black text-gray-900 italic uppercase leading-none mb-2">Giảm {{ number_format($coupon->discountValue, 0, ',', '.') }}đ</h3>
                        <p class="text-gray-500 text-sm mb-6">{{ $coupon->description }}</p>
                        
                        <div class="bg-gray-100 rounded-2xl p-4 flex items-center justify-between group-hover:bg-blue-50 transition-colors">
                            <span class="text-lg font-mono font-bold text-gray-800 uppercase tracking-widest">{{ $coupon->couponCode }}</span>
                            <button onclick="copyToClipboard('{{ $coupon->couponCode }}')" class="text-blue-600 font-bold text-xs uppercase hover:underline">Sao chép</button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center bg-white rounded-3xl shadow-sm">
                    <p class="text-gray-500 font-medium lowercase">hiện tại chưa có chương trình khuyến mãi nào được tung ra.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Đã sao chép mã giảm giá: ' + text);
        });
    }
</script>
@endsection
