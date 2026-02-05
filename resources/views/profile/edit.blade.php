@extends('layouts.app')

@section('title', 'Thông tin cá nhân - HaanPhone')

@section('content')
<div class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-black text-gray-900 mb-8 border-l-8 border-blue-600 pl-4 uppercase">Hồ sơ của tôi</h1>

        @if (session('status') === 'profile-updated')
            <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-2xl text-sm font-bold flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Thông tin hồ sơ đã được cập nhật thành công!
            </div>
        @endif

        <div class="grid grid-cols-1 gap-8">
            <!-- Update Profile Information -->
            <div class="bg-white rounded-3xl shadow-sm p-8">
                <h2 class="text-xl font-bold text-gray-900 mb-6 uppercase tracking-wider">Thông tin chi tiết</h2>
                <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Họ và tên</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required class="bg-gray-100 border-none rounded-2xl py-3 px-4 w-full focus:ring-2 focus:ring-blue-500 transition-all">
                            @error('name') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Địa chỉ Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required class="bg-gray-100 border-none rounded-2xl py-3 px-4 w-full focus:ring-2 focus:ring-blue-500 transition-all">
                            @error('email') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="phoneNumber" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Số điện thoại</label>
                            <input id="phoneNumber" name="phoneNumber" type="text" value="{{ old('phoneNumber', $user->customer->phoneNumber ?? '') }}" class="bg-gray-100 border-none rounded-2xl py-3 px-4 w-full focus:ring-2 focus:ring-blue-500 transition-all" placeholder="0xxx.xxx.xxx">
                            @error('phoneNumber') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Vai trò</label>
                            <span class="inline-flex items-center px-4 py-3 rounded-2xl text-sm font-bold bg-blue-50 text-blue-700 w-full">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-bold text-gray-700 uppercase tracking-widest mb-2">Địa chỉ giao hàng mặc định</label>
                        <textarea id="address" name="address" rows="3" class="bg-gray-100 border-none rounded-2xl py-3 px-4 w-full focus:ring-2 focus:ring-blue-500 transition-all" placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố...">{{ old('address', $user->customer->address ?? '') }}</textarea>
                        @error('address') <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-blue-600 text-white font-bold py-3 px-8 rounded-full hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 uppercase tracking-widest text-xs">
                            Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>

            <!-- Danger Zone - Logout (Optional duplicate but visible) -->
            <div class="bg-white rounded-3xl shadow-sm p-8 border border-red-50">
                <h2 class="text-xl font-bold text-gray-900 mb-6 uppercase tracking-wider text-red-600">Quản lý tài khoản</h2>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold text-gray-900">Đăng xuất khỏi thiết bị</p>
                        <p class="text-xs text-gray-500 mt-1">Kết thúc phiên làm việc hiện tại của bạn.</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-50 text-red-600 font-bold py-2 px-6 rounded-full hover:bg-red-100 transition-all uppercase tracking-widest text-xs">
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
