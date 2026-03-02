@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-[80vh]">
        <div class="glass-panel w-full max-w-md p-8 rounded-3xl shadow-2xl relative overflow-hidden">
            <!-- Decorative Glow -->
            <div
                class="absolute -top-24 -right-24 w-48 h-48 bg-gradient-to-br from-green-300 to-green-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30">
            </div>
            <div
                class="absolute -bottom-24 -left-24 w-48 h-48 bg-gradient-to-br from-blue-300 to-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30">
            </div>

            <div class="relative z-10">
                <div class="text-center mb-8">
                    <div
                        class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-emerald-400 to-blue-500 flex items-center justify-center shadow-lg">
                        <span class="text-3xl font-bold text-white">C</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Welcome Back</h2>
                    <p class="text-gray-500 mt-2">Sign in to Ctech Property Portal</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <input id="email" type="email" name="email" required autofocus
                            class="glass-input w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-emerald-500/50">
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <input id="password" type="password" name="password" required
                            class="glass-input w-full px-4 py-3 rounded-xl focus:ring-2 focus:ring-emerald-500/50">
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <input id="remember" type="checkbox" name="remember"
                                class="w-4 h-4 rounded border-gray-300 text-emerald-500 focus:ring-emerald-500">
                            <label for="remember" class="ml-2 block text-sm text-gray-600">Remember me</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-emerald-600 hover:text-emerald-700 font-medium"
                                href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                        class="btn-ctech w-full py-3 px-4 rounded-xl shadow-lg transform transition hover:scale-[1.02]">
                        Login
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}"
                            class="text-emerald-600 hover:text-emerald-700 font-semibold">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection