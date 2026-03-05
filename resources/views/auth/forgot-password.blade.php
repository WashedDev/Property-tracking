@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-[80vh]">
        <div class="glass-panel w-full max-w-md p-8 rounded-3xl shadow-2xl relative overflow-hidden">
            <div
                class="absolute -top-24 -right-24 w-48 h-48 bg-gradient-to-br from-green-300 to-green-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30">
            </div>

            <div class="relative z-10">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Forgot Password</h2>
                    <p class="text-gray-500 mt-2 text-sm">Enter your email address and we will send you a password reset
                        link.</p>
                </div>

                @if (session('status'))
                    <div
                        class="mb-4 font-medium text-sm text-emerald-600 bg-emerald-50 p-4 rounded-xl border border-emerald-200 text-center">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="glass-input w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-emerald-500/50 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="btn-ctech w-full py-3 px-4 rounded-xl shadow-lg transform transition hover:scale-[1.02]">
                        Email Password Reset Link
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}"
                        class="text-sm text-gray-500 hover:text-emerald-600 font-semibold flex items-center justify-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection