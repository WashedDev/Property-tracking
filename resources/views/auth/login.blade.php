@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-[75vh]">
        <div class="glass-panel w-full max-w-md p-10 rounded-3xl shadow-2xl relative overflow-hidden animate-fade-in-up">

            <div class="relative z-10">
                <div class="text-center mb-8">
                    <img src="{{ asset('images/ctech-int-logo.png') }}" alt="Ctech Systems Logo"
                        class="h-14 w-auto mx-auto mb-6 object-contain transform hover:scale-105 transition duration-500">
                    <h2 class="text-2xl font-bold text-ctech-dark">Welcome Back</h2>
                    <p class="text-ctech-grey text-sm mt-2">Sign in to your portal</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-semibold text-ctech-grey mb-2">Email Address</label>
                        <input id="email" type="email" name="email" required autofocus
                            class="glass-input w-full px-4 py-3.5 rounded-xl">
                    </div>

                    <div class="mb-5">
                        <label for="password" class="block text-sm font-semibold text-ctech-grey mb-2">Password</label>
                        <input id="password" type="password" name="password" required
                            class="glass-input w-full px-4 py-3.5 rounded-xl">
                    </div>

                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center">
                            <input id="remember" type="checkbox" name="remember"
                                class="w-4 h-4 rounded border-gray-300 text-ctech-cyan focus:ring-ctech-cyan bg-white/50">
                            <label for="remember" class="ml-2 block text-sm text-ctech-grey font-medium">Remember me</label>
                        </div>
                        <a class="text-sm text-ctech-cyan hover:text-ctech-dark font-semibold transition" href="#">Forgot
                            password?</a>
                    </div>

                    <button type="submit"
                        class="btn-ctech w-full py-3.5 px-4 rounded-xl shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl">
                        Login
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-ctech-grey">
                        Don't have an account?
                        <a href="{{ route('register') }}"
                            class="text-ctech-green hover:text-ctech-dark font-bold transition">Register here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection