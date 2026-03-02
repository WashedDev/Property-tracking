@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-[75vh]">
        <div class="glass-panel w-full max-w-md p-10 rounded-3xl shadow-2xl relative overflow-hidden animate-fade-in-up">

            <div class="relative z-10">
                <div class="text-center mb-8">
                    <img src="{{ asset('images/ctech-int-logo.png') }}" alt="Ctech Systems Logo"
                        class="h-14 w-auto mx-auto mb-6 object-contain transform hover:scale-105 transition duration-500">
                    <h2 class="text-2xl font-bold text-ctech-dark">Create Account</h2>
                    <p class="text-ctech-grey text-sm mt-2">Join the Ctech Property Portal</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-5">
                        <label for="name" class="block text-sm font-semibold text-ctech-grey mb-2">Full Name</label>
                        <input id="name" type="text" name="name" required autofocus
                            class="glass-input w-full px-4 py-3.5 rounded-xl">
                    </div>

                    <div class="mb-5">
                        <label for="email" class="block text-sm font-semibold text-ctech-grey mb-2">Email Address</label>
                        <input id="email" type="email" name="email" required
                            class="glass-input w-full px-4 py-3.5 rounded-xl">
                    </div>

                    <div class="mb-5">
                        <label for="password" class="block text-sm font-semibold text-ctech-grey mb-2">Password</label>
                        <input id="password" type="password" name="password" required
                            class="glass-input w-full px-4 py-3.5 rounded-xl">
                    </div>

                    <div class="mb-8">
                        <label for="password-confirm" class="block text-sm font-semibold text-ctech-grey mb-2">Confirm
                            Password</label>
                        <input id="password-confirm" type="password" name="password_confirmation" required
                            class="glass-input w-full px-4 py-3.5 rounded-xl">
                    </div>

                    <button type="submit"
                        class="btn-ctech w-full py-3.5 px-4 rounded-xl shadow-lg transform transition hover:-translate-y-1 hover:shadow-xl">
                        Register Account
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-ctech-grey">
                        Already have an account?
                        <a href="{{ route('login') }}"
                            class="text-ctech-cyan hover:text-ctech-dark font-bold transition">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection