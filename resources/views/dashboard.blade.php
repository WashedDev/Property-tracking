@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto animate-fade-in-up">

        <div class="mb-6 sm:mb-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-ctech-cyan/10 flex items-center justify-center text-ctech-cyan border border-ctech-cyan/20 hidden sm:flex">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-ctech-dark tracking-tight">My Assigned Assets</h2>
                    <p class="text-slate-500 text-xs sm:text-sm mt-0.5 sm:mt-1">View and manage equipment assigned to you by Ctech Systems.</p>
                </div>
            </div>
            
            <a href="{{ route('user.assets.pdf') }}" class="px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-lg text-sm font-semibold hover:text-ctech-dark hover:bg-slate-50 transition shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Download My Asset PDF
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
            <div class="card-panel p-5 sm:p-6 animate-fade-in-up delay-100">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-slate-500 text-xs sm:text-sm font-semibold mb-1">Total Assigned</div>
                        <div class="text-2xl sm:text-3xl font-bold text-ctech-dark">{{ $properties->count() }}</div>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-600 border border-slate-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                </div>
            </div>
            <div class="card-panel p-5 sm:p-6 animate-fade-in-up delay-200">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-slate-500 text-xs sm:text-sm font-semibold mb-1">Pending Receipt</div>
                        <div class="text-2xl sm:text-3xl font-bold text-amber-500">{{ $properties->where('status', 'Pending Acknowledgment')->count() }}</div>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-500 border border-amber-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>
            <div class="card-panel p-5 sm:p-6 animate-fade-in-up delay-300">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-slate-500 text-xs sm:text-sm font-semibold mb-1">Active Assets</div>
                        <div class="text-2xl sm:text-3xl font-bold text-ctech-green">{{ $properties->where('status', 'Active')->count() }}</div>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-ctech-green border border-green-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-panel overflow-hidden animate-fade-in-up delay-400">
            <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between bg-white">
                <h3 class="text-lg font-bold text-ctech-dark flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-ctech-cyan"></div>
                    Current Inventory Registry
                </h3>
            </div>

            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse min-w-[700px]">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-200">
                            <th class="p-4 sm:p-5 font-semibold">Asset Details</th>
                            <th class="p-4 sm:p-5 font-semibold">Identification</th>
                            <th class="p-4 sm:p-5 font-semibold">Status</th>
                            <th class="p-4 sm:p-5 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($properties as $index => $property)
                            <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors cursor-pointer" onclick="openAssetModal({{ $property->toJson() }})">
                                <td class="p-4 sm:p-5">
                                    <div class="font-bold text-ctech-dark">{{ $property->name }}</div>
                                    <div class="text-xs text-slate-500 mt-1">{{ $property->model }} • {{ $property->type }}</div>
                                </td>
                                <td class="p-4 sm:p-5">
                                    <span class="font-mono text-slate-700 bg-white border border-slate-200 px-2.5 py-1 rounded text-xs w-fit shadow-sm">
                                        {{ $property->type == 'Vehicle' ? $property->license_plate : $property->serial_number }}
                                    </span>
                                </td>
                                <td class="p-4 sm:p-5">
                                    @if($property->status === 'Pending Acknowledgment')
                                        <span class="inline-flex items-center gap-1.5 text-amber-600 text-xs font-bold bg-amber-50 px-2.5 py-1 rounded-md border border-amber-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            Pending Receipt
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 text-ctech-green text-xs font-semibold bg-green-50 px-2.5 py-1 rounded-md border border-green-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-ctech-green"></span>
                                            Active
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 sm:p-5 text-right" onclick="event.stopPropagation();">
                                    @if($property->status === 'Pending Acknowledgment')
                                        <form action="{{ route('properties.acknowledge', $property->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-500 text-white hover:bg-amber-600 rounded-lg text-xs font-bold transition-colors shadow-sm">
                                                Acknowledge Receipt
                                            </button>
                                        </form>
                                    @else
                                        <button class="inline-flex items-center gap-1.5 px-3 py-1.5 text-slate-500 hover:text-red-500 hover:bg-red-50 rounded-lg text-xs font-semibold transition-colors">
                                            Report Issue
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-10 sm:p-16 text-center">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-ctech-dark mb-1">No Assets Assigned</h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="assetDetailModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm transition-opacity">
        <div class="card-panel w-full max-w-lg p-6 sm:p-8 modal-animate relative">
            <button onclick="document.getElementById('assetDetailModal').style.display='none'" class="absolute top-4 right-4 text-gray-400 hover:text-gray-800 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <div class="mb-6 border-b border-slate-100 pb-4">
                <h3 class="text-xl font-bold text-ctech-dark" id="modal_name">Asset Name</h3>
                <p class="text-slate-500 text-sm mt-1" id="modal_model">Model info</p>
            </div>

            <div class="space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-slate-50">
                    <span class="text-sm text-slate-500 font-medium">Category</span>
                    <span class="text-sm font-bold text-slate-800" id="modal_type"></span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-slate-50">
                    <span class="text-sm text-slate-500 font-medium" id="modal_identifier_label">Serial/License</span>
                    <span class="text-sm font-mono bg-slate-100 px-2 py-1 rounded text-slate-700" id="modal_identifier"></span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-slate-50">
                    <span class="text-sm text-slate-500 font-medium">Procurement Date</span>
                    <span class="text-sm font-bold text-slate-800" id="modal_procurement">N/A</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-slate-50">
                    <span class="text-sm text-slate-500 font-medium">Warranty Expiration</span>
                    <span class="text-sm font-bold text-slate-800" id="modal_warranty">N/A</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-slate-50">
                    <span class="text-sm text-slate-500 font-medium">Estimated Value</span>
                    <span class="text-sm font-bold text-slate-800" id="modal_value">N/A</span>
                </div>
            </div>

            <button onclick="document.getElementById('assetDetailModal').style.display='none'" class="btn-ctech w-full py-3 rounded-xl font-semibold text-sm mt-8">
                Close Details
            </button>
        </div>
    </div>

    <script>
        // Populate and open the details modal
        function openAssetModal(property) {
            document.getElementById('modal_name').textContent = property.name;
            document.getElementById('modal_model').textContent = property.model;
            document.getElementById('modal_type').textContent = property.type;
            
            if(property.type === 'Vehicle') {
                document.getElementById('modal_identifier_label').textContent = 'License Plate';
                document.getElementById('modal_identifier').textContent = property.license_plate;
            } else {
                document.getElementById('modal_identifier_label').textContent = 'Serial Number';
                document.getElementById('modal_identifier').textContent = property.serial_number || 'N/A';
            }

            document.getElementById('modal_procurement').textContent = property.procurement_date || 'Not recorded';
            document.getElementById('modal_warranty').textContent = property.warranty_expiration || 'Not recorded';
            
            // Format currency if value exists
            if(property.estimated_value) {
                let formatter = new Intl.NumberFormat('en-MW', { style: 'currency', currency: 'MWK' });
                document.getElementById('modal_value').textContent = formatter.format(property.estimated_value);
            } else {
                document.getElementById('modal_value').textContent = 'Not recorded';
            }

            document.getElementById('assetDetailModal').style.display = 'flex';
        }
    </script>
@endsection