@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">

        <div class="mb-8 flex items-center gap-5 glass-panel px-6 py-4 rounded-3xl w-fit">
            <img src="{{ asset('images/ctech-int-logo.png') }}" alt="Ctech Systems Logo" class="h-12 w-auto object-contain">
            <div class="border-l-2 border-gray-200 pl-5">
                <h2 class="text-2xl font-bold text-ctech-dark tracking-tight">Admin Dashboard</h2>
                <p class="text-ctech-grey text-sm font-medium mt-0.5">System Overview & Management</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div
                class="glass-panel rounded-3xl p-6 relative overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-ctech-cyan rounded-full filter blur-3xl opacity-20">
                </div>
                <div class="relative z-10">
                    <div class="text-ctech-grey text-sm font-semibold mb-2 uppercase tracking-wide">Total Personnel</div>
                    <div class="text-4xl font-bold text-ctech-dark">{{ $users->count() }}</div>
                    <div class="text-ctech-cyan text-xs mt-2 font-bold">↑ Active Employees</div>
                </div>
            </div>

            <div
                class="glass-panel rounded-3xl p-6 relative overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-ctech-green rounded-full filter blur-3xl opacity-20">
                </div>
                <div class="relative z-10">
                    <div class="text-ctech-grey text-sm font-semibold mb-2 uppercase tracking-wide">Active Assets</div>
                    <div class="text-4xl font-bold text-ctech-dark">{{ $users->sum(fn($u) => $u->properties->count()) }}
                    </div>
                    <div class="text-ctech-green text-xs mt-2 font-bold">↑ Total Items</div>
                </div>
            </div>

            <div
                class="glass-panel rounded-3xl p-6 relative overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-300 rounded-full filter blur-3xl opacity-30"></div>
                <div class="relative z-10">
                    <div class="text-ctech-grey text-sm font-semibold mb-2 uppercase tracking-wide">Contracts Generated
                    </div>
                    <div class="text-4xl font-bold text-ctech-dark">{{ $users->count() }}</div>
                    <div class="text-blue-500 text-xs mt-2 font-bold">↑ Ready to Export</div>
                </div>
            </div>
        </div>

        <div class="glass-panel rounded-3xl overflow-hidden relative border border-white/60 min-h-[400px]">
            <div
                class="absolute -bottom-24 -right-24 w-64 h-64 bg-ctech-cyan rounded-full filter blur-[80px] opacity-15 pointer-events-none">
            </div>

            <div class="p-6 border-b border-white/60 bg-white/30 flex items-center justify-between relative z-10">
                <div>
                    <h3 class="text-lg font-bold text-ctech-dark uppercase tracking-wider flex items-center gap-3">
                        <span class="w-1.5 h-6 bg-gradient-to-b from-ctech-cyan to-ctech-green rounded-full"></span>
                        Employee Property Registry
                    </h3>
                    <p class="text-ctech-grey text-sm mt-1">Manage employee assets and generate contracts</p>
                </div>
            </div>

            <div class="overflow-x-auto relative z-10 p-2">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-ctech-grey text-xs uppercase tracking-wider border-b border-gray-200/50">
                            <th class="p-5 font-semibold">Employee Name & Contact</th>
                            <th class="p-5 font-semibold text-center">Items Assigned</th>
                            <th class="p-5 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($users as $user)
                            <tr class="border-b border-gray-100/50 hover:bg-white/50 transition duration-200 group">
                                <td class="p-5">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 rounded-2xl bg-gradient-to-br from-ctech-cyan to-ctech-green flex items-center justify-center text-white font-bold shadow-md text-lg transform group-hover:scale-105 transition duration-300">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div
                                                class="font-bold text-ctech-dark text-base group-hover:text-ctech-cyan transition">
                                                {{ $user->name }}
                                            </div>
                                            <div class="text-ctech-grey text-xs mt-0.5">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-5 text-center">
                                    <span
                                        class="inline-flex items-center px-4 py-1.5 rounded-full bg-white/80 text-ctech-cyan border border-ctech-cyan/20 font-bold text-xs shadow-sm">
                                        {{ $user->properties->count() }} Assets
                                    </span>
                                </td>
                                <td class="p-5 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.contract', $user->id) }}"
                                            class="inline-flex items-center gap-2 btn-ctech px-5 py-2.5 rounded-xl text-sm font-semibold transition shadow-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Generate PDF
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-20 text-center">
                                    <div class="text-gray-300 text-6xl mb-4 opacity-70">👥</div>
                                    <div class="text-ctech-dark font-bold mb-2 text-lg">No employee records found.</div>
                                    <p class="text-sm text-ctech-grey">New employees will appear here once they register.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection