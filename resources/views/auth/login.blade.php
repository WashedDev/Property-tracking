@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-[70vh]">
        <div class="card-panel w-full max-w-md p-6 sm:p-10 animate-fade-in-up mx-auto">

            <div class="text-center mb-6 sm:mb-8">
                <img src="{{ asset('images/ctech-int-logo.png') }}" alt="Ctech Systems Logo"
                    class="h-10 sm:h-12 w-auto mx-auto mb-4 sm:mb-6 object-contain">
                <h2 class="text-xl sm:text-2xl font-bold text-ctech-dark">Welcome Back</h2>
                <p class="text-slate-500 text-xs sm:text-sm mt-1">Sign in to your portal</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4 sm:mb-5">
                    <label for="email" class="block text-sm font-semibold text-slate-600 mb-1.5 sm:mb-2">Email
                        Address</label>
                    <input id="email" type="email" name="email" required autofocus
                        class="sleek-input w-full px-4 py-3 rounded-xl">
                </div>

                <div class="mb-4 sm:mb-5">
                    <label for="password" class="block text-sm font-semibold text-slate-600 mb-1.5 sm:mb-2">Password</label>
                    <input id="password" type="password" name="password" required
                        class="sleek-input w-full px-4 py-3 rounded-xl">
                </div>

                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-6 sm:mb-8">
                    <div class="flex items-center">
                        <input id="remember" type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-slate-300 text-ctech-cyan focus:ring-ctech-cyan">
                        <label for="remember" class="ml-2 block text-sm text-slate-600 font-medium">Remember me</label>
                    </div>
                    <a class="text-sm text-ctech-cyan hover:text-ctech-dark font-medium transition"
                        href="{{ route('password.request') }}">Forgot
                        password?</a>
                </div>

                <button type="submit" class="btn-ctech w-full py-3 sm:py-3.5 px-4 rounded-xl">
                    Login
                </button>
            </form>

            <div class="mt-6 sm:mt-8 text-center border-t border-slate-100 pt-5 sm:pt-6">
                <p class="text-sm text-slate-500">
                    Don't have an account?
                    <a href="{{ route('register') }}"
                        class="text-ctech-green hover:text-ctech-dark font-semibold transition">Register here</a>
                </p>
            </div>
        </div>
    </div>
@endsection