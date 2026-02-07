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
                </div>

                <div class="mt-6 flex items-center justify-center space-x-8 text-xs text-gray-500 font-medium">
                    <div class="flex items-center"><svg class="h-4 w-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Chính hãng 100%</div>
                    <div class="flex items-center"><svg class="h-4 w-4 mr-1 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Bảo hành 12 tháng</div>
                </div>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="mt-12 mb-12">
            <div class="bg-white rounded-3xl shadow-sm p-8 lg:p-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-8 border-b border-gray-100 pb-4">Đánh giá sản phẩm</h2>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Review List -->
                    <div>
                         <div class="flex items-center mb-6">
                            <div class="flex items-center">
                                @php $avgRating = $phone->reviews->avg('rating'); @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="h-6 w-6 {{ $i <= round($avgRating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            <span class="ml-2 text-gray-600">({{ $phone->reviews->count() }} đánh giá)</span>
                        </div>

                        <div class="space-y-6">
                            @forelse($phone->reviews as $review)
                                <div class="border-b border-gray-50 pb-6 last:border-0">
                                    <div class="flex items-center justify-between mb-2">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs uppercase mr-3">
                                                {{ substr($review->customer->user->name ?? 'A', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-900">{{ $review->customer->user->name ?? 'Ẩn danh' }}</p>
                                                <div class="flex text-yellow-400 text-xs">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-400">{{ $review->reviewDate ? \Carbon\Carbon::parse($review->reviewDate)->format('d/m/Y') : '' }}</span>
                                    </div>
                                    <p class="text-gray-600 text-sm pl-11">{{ $review->description }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500 italic">Chưa có đánh giá nào.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Review Form -->
                    <div class="bg-gray-50 rounded-2xl p-6 h-fit">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Viết đánh giá của bạn</h3>
                        @auth
                            <form action="{{ route('reviews.store', $phone->id) }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Đánh giá chung</label>
                                    <div class="flex items-center flex-row-reverse justify-end">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" id="rating-{{$i}}" name="rating" value="{{ $i }}" class="sr-only peer">
                                            <label for="rating-{{$i}}" class="cursor-pointer text-gray-300 peer p-1 transition-colors hover:text-yellow-400 peer-checked:text-yellow-400 peer-hover:text-yellow-400">
                                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Nhận xét của bạn</label>
                                    <textarea name="description" id="description" rows="4" class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Chia sẻ cảm nhận của bạn về sản phẩm..."></textarea>
                                </div>
                                <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition-colors">Gửi đánh giá</button>
                            </form>
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-500 mb-4">Bạn cần đăng nhập để viết đánh giá.</p>
                                <a href="{{ route('login') }}" class="inline-block bg-white border border-gray-300 text-gray-700 font-bold py-2 px-6 rounded-full hover:bg-gray-50 transition-colors">Đăng nhập ngay</a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
