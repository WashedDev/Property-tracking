@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">

        <div class="mb-6 sm:mb-8 flex flex-col sm:flex-row items-start sm:items-center gap-4 animate-fade-in-up">
            <div class="bg-white p-2.5 rounded-2xl border border-slate-200 shadow-sm hidden sm:block">
                <img src="{{ asset('images/ctech-int-logo.png') }}" alt="Ctech Systems Logo"
                    class="h-8 sm:h-10 w-auto object-contain">
            </div>
            <div>
                <h2 class="text-xl sm:text-2xl font-bold text-ctech-dark tracking-tight">Admin Dashboard</h2>
                <p class="text-slate-500 text-xs sm:text-sm mt-0.5 sm:mt-1">System Overview & Management</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
            <div class="card-panel p-5 sm:p-6 animate-fade-in-up delay-100">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="text-slate-500 text-xs sm:text-sm font-semibold mb-1">Total Personnel</div>
                        <div class="text-2xl sm:text-3xl font-bold text-ctech-dark">{{ $users->count() }}</div>
                    </div>
                    <div
                        class="w-8 sm:w-10 h-8 sm:h-10 rounded-full bg-blue-50 flex items-center justify-center text-ctech-cyan">
                        <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="card-panel p-5 sm:p-6 animate-fade-in-up delay-200">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="text-slate-500 text-xs sm:text-sm font-semibold mb-1">Active Assets</div>
                        <div class="text-2xl sm:text-3xl font-bold text-ctech-dark">
                            {{ $users->sum(fn($u) => $u->properties->count()) }}</div>
                    </div>
                    <div
                        class="w-8 sm:w-10 h-8 sm:h-10 rounded-full bg-green-50 flex items-center justify-center text-ctech-green">
                        <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="card-panel p-5 sm:p-6 animate-fade-in-up delay-300">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="text-slate-500 text-xs sm:text-sm font-semibold mb-1">Contracts Gen.</div>
                        <div class="text-2xl sm:text-3xl font-bold text-ctech-dark">{{ $users->count() }}</div>
                    </div>
                    <div
                        class="w-8 sm:w-10 h-8 sm:h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-600">
                        <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-panel overflow-hidden animate-fade-in-up delay-400">
            <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-base sm:text-lg font-bold text-ctech-dark flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-ctech-green"></div>
                    Employee Registry
                </h3>
            </div>

            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse min-w-[600px]">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-200">
                            <th class="p-4 sm:p-5 font-semibold">Employee Details</th>
                            <th class="p-4 sm:p-5 font-semibold text-center">Items Assigned</th>
                            <th class="p-4 sm:p-5 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($users as $index => $user)
                            <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors animate-fade-in-up"
                                style="animation-delay: {{ 300 + ($index * 50) }}ms;">
                                <td class="p-4 sm:p-5">
                                    <div class="flex items-center gap-3 sm:gap-4">
                                        <div
                                            class="w-8 h-8 sm:w-10 sm:h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-600 font-bold text-xs sm:text-sm">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-ctech-dark text-sm sm:text-base whitespace-nowrap">
                                                {{ $user->name }}</div>
                                            <div class="text-slate-500 text-[10px] sm:text-xs mt-0.5">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 sm:p-5 text-center">
                                    <span
                                        class="inline-flex items-center px-2 py-1 sm:px-2.5 sm:py-1 rounded-md bg-slate-50 text-slate-600 border border-slate-200 font-semibold text-[10px] sm:text-xs whitespace-nowrap">
                                        {{ $user->properties->count() }} Assets
                                    </span>
                                </td>
                                <td class="p-4 sm:p-5 text-right">
                                    <a href="{{ route('admin.contract', $user->id) }}"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 sm:px-4 sm:py-2 bg-white border border-slate-200 text-slate-700 hover:text-ctech-cyan hover:border-ctech-cyan rounded-lg text-xs font-semibold transition-colors shadow-sm whitespace-nowrap">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        Export PDF
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-10 sm:p-16 text-center">
                                    <div
                                        class="w-12 h-12 sm:w-16 sm:h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6 text-slate-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="text-ctech-dark font-semibold mb-1 text-sm sm:text-base">No employee records
                                        found.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection