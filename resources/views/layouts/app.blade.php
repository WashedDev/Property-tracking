<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Tracker - Ctech Systems</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ctech: {
                            cyan: '#1bb1e7',
                            green: '#a2d06b',
                            grey: '#666666',
                            dark: '#333333'
                        }
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            /* Soft light background to make the glass stand out */
            background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
            background-attachment: fixed;
            color: #333333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Refined Light Mode Glassmorphism */
        .glass-panel {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
        }

        .glass-input {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(27, 177, 231, 0.2);
            color: #333333;
            transition: all 0.3s ease;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.02);
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, 1);
            border-color: #1bb1e7;
            /* ctech-cyan */
            outline: none;
            box-shadow: 0 0 0 3px rgba(27, 177, 231, 0.2);
        }

        .glass-input::placeholder {
            color: #9ca3af;
        }

        .btn-ctech {
            background: linear-gradient(135deg, #1bb1e7, #a2d06b);
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(27, 177, 231, 0.3);
            border: border-transparent;
        }

        .btn-ctech:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(162, 208, 107, 0.4);
            background: linear-gradient(135deg, #1598c9, #8cbb55);
            /* slightly darker */
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #1bb1e7;
        }

        /* Animated Background Orbs */
        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(30px, -30px) scale(1.05);
            }
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            animation: float 8s ease-in-out infinite;
            z-index: -1;
        }
    </style>
</head>

<body class="antialiased relative overflow-x-hidden">

    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <div class="orb w-[500px] h-[500px] bg-ctech-cyan top-[-10%] left-[-10%]"></div>
        <div class="orb w-[400px] h-[400px] bg-ctech-green bottom-[-5%] right-[-5%]" style="animation-delay: -3s;">
        </div>
        <div class="orb w-[300px] h-[300px] bg-blue-200 top-[40%] left-[60%] opacity-30" style="animation-delay: -5s;">
        </div>
    </div>

    <nav class="glass-panel sticky top-0 z-50 border-b border-white/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-3">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/ctech-int-logo.png') }}" alt="Ctech Systems Logo"
                            class="h-10 w-auto object-contain">
                    </a>
                </div>

                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        @auth
                            <a href="{{ Auth::user()->is_admin ? route('admin.dashboard') : route('dashboard') }}"
                                class="text-ctech-grey hover:text-ctech-cyan px-3 py-2 rounded-lg text-sm font-semibold transition">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="text-ctech-grey hover:text-red-500 px-3 py-2 rounded-lg text-sm font-semibold transition">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-ctech-grey hover:text-ctech-cyan px-3 py-2 rounded-lg text-sm font-semibold transition">
                                Login
                            </a>
                            <a href="{{ route('register') }}"
                                class="btn-ctech px-6 py-2.5 rounded-xl text-sm font-medium tracking-wide">
                                Register
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-4 py-8 relative z-10">
        @yield('content')
    </main>

    <footer class="glass-panel border-t border-white/60 mt-auto relative z-10">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p class="text-sm text-ctech-grey">
                        &copy; 2026 <span class="text-ctech-cyan font-semibold">Ctech Systems</span> - Malawi.
                    </p>
                    <p class="text-xs text-gray-400 mt-1 uppercase tracking-wider font-semibold">Center of Technology
                        Innovations.</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-ctech-cyan transition text-sm">Privacy</a>
                    <a href="#" class="text-gray-400 hover:text-ctech-cyan transition text-sm">Terms</a>
                    <a href="#" class="text-gray-400 hover:text-ctech-cyan transition text-sm">Support</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>