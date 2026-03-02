@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="glass-panel rounded-2xl p-6 relative overflow-hidden">
                <div
                    class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-green-300 to-green-500 rounded-full mix-blend-multiply filter blur-2xl opacity-30">
                </div>
                <div class="relative z-10">
                    <div class="text-gray-500 text-sm font-semibold mb-2">Total Personnel</div>
                    <div class="text-4xl font-bold text-gray-800">{{ $users->count() }}</div>
                    <div class="text-emerald-600 text-xs mt-2 font-semibold">↑ Active Employees</div>
                </div>
            </div>

            <div class="glass-panel rounded-2xl p-6 relative overflow-hidden">
                <div
                    class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-blue-300 to-blue-500 rounded-full mix-blend-multiply filter blur-2xl opacity-30">
                </div>
                <div class="relative z-10">
                    <div class="text-gray-500 text-sm font-semibold mb-2">Active Assets</div>
                    <div class="text-4xl font-bold text-gray-800">{{ $users->sum(fn($u) => $u->properties->count()) }}</div>
                    <div class="text-blue-600 text-xs mt-2 font-semibold">↑ Total Items</div>
                </div>
            </div>

            <div class="glass-panel rounded-2xl p-6 relative overflow-hidden">
                <div
                    class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-purple-300 to-purple-500 rounded-full mix-blend-multiply filter blur-2xl opacity-30">
                </div>
                <div class="relative z-10">
                    <div class="text-gray-500 text-sm font-semibold mb-2">Contracts Generated</div>
                    <div class="text-4xl font-bold text-gray-800">{{ $users->count() }}</div>
                    <div class="text-purple-600 text-xs mt-2 font-semibold">↑ Ready to Export</div>
                </div>
            </div>
        </div>

        <!-- Main Table -->
        <div class="glass-panel rounded-3xl overflow-hidden relative border border-white/50 shadow-2xl">
            <!-- Decorative Glow -->
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-300 to-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20">
            </div>

            <div class="p-6 border-b border-gray-200 bg-white/50 flex items-center justify-between relative z-10">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 uppercase tracking-wider flex items-center gap-2">
                        <span class="w-2 h-6 bg-gradient-to-b from-emerald-400 to-emerald-600 rounded-full"></span>
                        Employee Property Registry
                    </h3>
                    <p class="text-gray-500 text-sm mt-1">Manage employee assets and generate contracts</p>
                </div>
            </div>

            <div class="overflow-x-auto relative z-10">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-gray-500 text-xs uppercase tracking-wider bg-gray-100/80 border-b border-gray-200">
                            <th class="p-5 font-semibold">Employee Name & Contact</th>
                            <th class="p-5 font-semibold text-center">Items Assigned</th>
                            <th class="p-5 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-emerald-50/50 transition duration-200 group">
                                <td class="p-5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-12 h-12 rounded-full bg-gradient-to-br from-emerald-400 to-blue-500 flex items-center justify-center text-white font-bold shadow-lg">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div
                                                class="font-bold text-gray-800 text-base group-hover:text-emerald-600 transition">
                                                {{ $user->name }}
                                            </div>
                                            <div class="text-gray-500 text-sm">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-5 text-center">
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-700 border border-blue-200 font-semibold">
                                        {{ $user->properties->count() }} Assets
                                    </span>
                                </td>
                                <td class="p-5 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.contract', $user->id) }}"
                                            class="inline-flex items-center gap-2 btn-ctech px-5 py-2.5 rounded-xl font-semibold transition transform hover:-translate-y-0.5 shadow-lg">
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
                                    <div class="text-gray-400 text-6xl mb-4">👥</div>
                                    <div class="text-gray-500 font-semibold mb-2">No employee records found.</div>
                                    <p class="text-sm text-gray-400">New employees will appear here once they register.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection