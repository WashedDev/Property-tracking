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
            background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
            background-attachment: fixed;
            color: #333333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

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
            outline: none;
            box-shadow: 0 0 0 3px rgba(27, 177, 231, 0.2);
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
        }

        /* --- NEW ANIMATIONS --- */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes modalPop {
            0% {
                transform: scale(0.9);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        .modal-animate {
            animation: modalPop 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Animation Delays for staggered loading */
        .delay-100 {
            animation-delay: 100ms;
        }

        .delay-200 {
            animation-delay: 200ms;
        }

        .delay-300 {
            animation-delay: 300ms;
        }

        .delay-400 {
            animation-delay: 400ms;
        }

        .delay-500 {
            animation-delay: 500ms;
        }

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

    @if ($errors->any() || session('success') || session('error'))
        <div id="systemModal"
            class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm transition-opacity">
            <div class="glass-panel w-full max-w-md p-8 rounded-3xl shadow-2xl modal-animate relative m-4">

                <button onclick="document.getElementById('systemModal').style.display='none'"
                    class="absolute top-5 right-5 text-gray-400 hover:text-gray-800 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>

                @if(session('success'))
                    <div
                        class="w-16 h-16 rounded-2xl bg-ctech-green/20 text-ctech-green flex items-center justify-center mb-5 mx-auto shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-center text-ctech-dark mb-2">Success!</h3>
                    <p class="text-center text-ctech-grey text-sm mb-6">{{ session('success') }}</p>
                @endif

                @if($errors->any() || session('error'))
                    <div
                        class="w-16 h-16 rounded-2xl bg-red-100 text-red-500 flex items-center justify-center mb-5 mx-auto shadow-inner">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-center text-ctech-dark mb-3">Action Required</h3>
                    <div class="bg-red-50/50 rounded-xl p-4 border border-red-100 mb-6">
                        @if(session('error'))
                            <p class="text-red-500 text-sm font-semibold text-center">{{ session('error') }}</p>
                        @endif
                        @if($errors->any())
                            <ul class="list-disc list-inside text-red-500 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif

                <button onclick="document.getElementById('systemModal').style.display='none'"
                    class="btn-ctech w-full py-3.5 rounded-xl font-bold text-sm">
                    Acknowledge & Close
                </button>
            </div>
        </div>

        <script>
            // Close modal on outside click
            window.onclick = function (event) {
                let modal = document.getElementById('systemModal');
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    @endif

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
                    <a href="{{ url('/') }}" class="transform transition hover:scale-105">
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
                </div>
            </div>
        </div>
    </footer>
</body>

</html>