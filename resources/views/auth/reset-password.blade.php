@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-[80vh]">
        <div class="glass-panel w-full max-w-md p-8 rounded-3xl shadow-2xl relative overflow-hidden">
            <div class="relative z-10">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Set New Password</h2>
                    <p class="text-gray-500 mt-2 text-sm">Please choose a strong password for your account.</p>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required readonly
                            class="glass-input w-full px-4 py-3 rounded-xl bg-gray-50/50 text-gray-500">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                        <input id="password" type="password" name="password" required
                            class="glass-input w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-emerald-500/50">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm
                            Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="glass-input w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-emerald-500/50">
                    </div>

                    <button type="submit"
                        class="btn-ctech w-full py-3 px-4 rounded-xl shadow-lg transform transition hover:scale-[1.02]">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection