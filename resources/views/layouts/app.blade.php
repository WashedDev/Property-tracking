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
                            dark: '#1e293b',
                            light: '#f8fafc'
                        }
                    }
                }
            }
        }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            /* Applied Poppins Font */
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            /* Added slight letter spacing which makes Poppins look even better */
            letter-spacing: -0.01em;
        }

        .card-panel {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border-radius: 1.5rem;
        }

        .sleek-input {
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            color: #1e293b;
            transition: all 0.2s ease-in-out;
        }

        .sleek-input:focus {
            background-color: #ffffff;
            border-color: #1bb1e7;
            box-shadow: 0 0 0 4px rgba(27, 177, 231, 0.1);
            outline: none;
        }

        .btn-ctech {
            background-color: #1bb1e7;
            color: white;
            font-weight: 600;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(27, 177, 231, 0.2);
        }

        .btn-ctech:hover {
            background-color: #1598c9;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(27, 177, 231, 0.3);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes modalPop {
            0% {
                transform: scale(0.95);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.5s ease-out forwards;
            opacity: 0;
        }

        .modal-animate {
            animation: modalPop 0.3s ease-out forwards;
        }

        /* Delays */
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
    </style>
</head>

<body class="antialiased">

    @if ($errors->any() || session('success') || session('error'))
        <div id="systemModal"
            class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm transition-opacity">
            <div class="card-panel w-full max-w-md p-6 sm:p-8 modal-animate relative">
                <button onclick="document.getElementById('systemModal').style.display='none'"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-800 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>

                @if(session('success'))
                    <div
                        class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-green-50 text-ctech-green flex items-center justify-center mb-4 sm:mb-5 mx-auto border border-green-100">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-center text-ctech-dark mb-2">Success</h3>
                    <p class="text-center text-slate-500 text-sm mb-6">{{ session('success') }}</p>
                @endif

                @if($errors->any() || session('error'))
                    <div
                        class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-red-50 text-red-500 flex items-center justify-center mb-4 sm:mb-5 mx-auto border border-red-100">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-center text-ctech-dark mb-3">Notice</h3>
                    <div class="bg-red-50/50 rounded-xl p-4 border border-red-100 mb-6">
                        @if(session('error'))
                            <p class="text-red-600 text-sm font-medium text-center">{{ session('error') }}</p>
                        @endif
                        @if($errors->any())
                            <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif

                <button onclick="document.getElementById('systemModal').style.display='none'"
                    class="btn-ctech w-full py-3 rounded-xl font-semibold text-sm">
                    Acknowledge & Close
                </button>
            </div>
        </div>

        <script>
            window.onclick = function (event) {
                let modal = document.getElementById('systemModal');
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    @endif

    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-3">
                    <a href="{{ url('/') }}" class="transform transition hover:opacity-80">
                        <img src="{{ asset('images/ctech-int-logo.png') }}" alt="Ctech Systems Logo"
                            class="h-8 sm:h-10 w-auto object-contain">
                    </a>
                </div>

                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-6">
                        @auth
                            <a href="{{ Auth::user()->is_admin ? route('admin.dashboard') : route('dashboard') }}"
                                class="text-slate-500 hover:text-ctech-cyan text-sm font-semibold transition">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="text-slate-500 hover:text-red-500 text-sm font-semibold transition">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-slate-500 hover:text-ctech-cyan text-sm font-semibold transition">Login</a>
                            <a href="{{ route('register') }}"
                                class="btn-ctech px-6 py-2.5 rounded-xl text-sm font-medium tracking-wide">Register</a>
                        @endauth
                    </div>
                </div>

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-slate-500 hover:text-ctech-dark focus:outline-none p-2">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-slate-100 shadow-lg absolute w-full">
            <div class="px-4 pt-2 pb-4 space-y-1 flex flex-col gap-2">
                @auth
                    <a href="{{ Auth::user()->is_admin ? route('admin.dashboard') : route('dashboard') }}"
                        class="block px-3 py-2 text-base font-semibold text-slate-600 hover:text-ctech-cyan hover:bg-slate-50 rounded-lg">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-3 py-2 text-base font-semibold text-slate-600 hover:text-red-500 hover:bg-red-50 rounded-lg">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block px-3 py-2 text-base font-semibold text-slate-600 hover:text-ctech-cyan hover:bg-slate-50 rounded-lg">Login</a>
                    <a href="{{ route('register') }}"
                        class="block px-3 py-2 text-base font-semibold text-ctech-cyan hover:bg-slate-50 rounded-lg">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 relative z-10 w-full overflow-hidden">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-slate-200 mt-auto">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left">
                <div class="mb-4 md:mb-0">
                    <p class="text-sm text-slate-500">
                        &copy; 2026 <span class="text-ctech-cyan font-semibold">Ctech Systems</span> - Malawi.
                    </p>
                </div>
                <div class="flex justify-center space-x-6">
                    <a href="#" class="text-slate-400 hover:text-ctech-cyan transition text-sm">Privacy</a>
                    <a href="#" class="text-slate-400 hover:text-ctech-cyan transition text-sm">Terms</a>
                    <a href="#" class="text-slate-400 hover:text-ctech-cyan transition text-sm">Support</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>