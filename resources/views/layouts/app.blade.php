<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Tracker - Ctech Systems</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            /* Ctech Systems Branding Colors */
            --ctech-green: #10b981;
            --ctech-green-dark: #059669;
            --ctech-blue: #3b82f6;
            --ctech-blue-dark: #2563eb;
            --ctech-purple: #8b5cf6;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            background-attachment: fixed;
            color: #1f2937;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Light Mode Glassmorphism Classes */
        .glass-panel {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.7);
        }

        .glass-input {
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(255, 255, 255, 0.5);
            color: #1f2937;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, 1);
            border-color: var(--ctech-green);
            outline: none;
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.3),
                0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .glass-input::placeholder {
            color: #9ca3af;
        }

        .btn-ctech {
            background: linear-gradient(135deg, var(--ctech-green), var(--ctech-blue));
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }

        .btn-ctech:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.5);
            background: linear-gradient(135deg, var(--ctech-green-dark), var(--ctech-blue-dark));
        }

        .text-ctech-green {
            color: var(--ctech-green);
        }

        .bg-ctech-green {
            background-color: var(--ctech-green);
        }

        .border-ctech-green {
            border-color: var(--ctech-green);
        }

        .text-ctech-blue {
            color: var(--ctech-blue);
        }

        .bg-ctech-blue {
            background-color: var(--ctech-blue);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.5);
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--ctech-green);
        }

        /* Animated Background Orbs */
        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(20px, -20px);
            }
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.4;
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>

<body class="antialiased">

    <!-- Background Orbs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="orb w-96 h-96 bg-green-300 top-0 left-0"></div>
        <div class="orb w-96 h-96 bg-blue-300 top-1/2 right-0"></div>
        <div class="orb w-96 h-96 bg-purple-300 bottom-0 left-1/3"></div>
    </div>

    <!-- Navigation -->
    <nav class="glass-panel sticky top-0 z-50 border-b border-white/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-400 to-blue-500 flex items-center justify-center font-bold text-white shadow-lg">
                        <span class="text-lg">C</span>
                    </div>
                    <div>
                        <span class="font-bold text-xl tracking-tight text-gray-800">Ctech</span>
                        <span class="font-bold text-xl tracking-tight text-ctech-green">Systems</span>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        @auth
                            <a href="{{ Auth::user()->is_admin ? route('admin.dashboard') : route('dashboard') }}"
                                class="text-gray-600 hover:text-ctech-green px-3 py-2 rounded-lg text-sm font-medium transition">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="text-gray-600 hover:text-red-500 px-3 py-2 rounded-lg text-sm font-medium transition">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-gray-600 hover:text-ctech-green px-3 py-2 rounded-lg text-sm font-medium transition">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="btn-ctech px-5 py-2 rounded-lg text-sm font-medium">
                                Register
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-8 relative z-10">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="glass-panel border-t border-white/50 mt-auto relative z-10">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p class="text-sm text-gray-600">
                        &copy; 2026 <span class="text-ctech-green font-semibold">Ctech Systems Limited</span> - Malawi.
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Center of Technology Innovations.</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-500 hover:text-ctech-green transition text-sm">Privacy</a>
                    <a href="#" class="text-gray-500 hover:text-ctech-green transition text-sm">Terms</a>
                    <a href="#" class="text-gray-500 hover:text-ctech-green transition text-sm">Support</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>