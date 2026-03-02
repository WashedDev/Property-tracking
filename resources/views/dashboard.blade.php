@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

        <div class="lg:col-span-1 animate-fade-in-up order-2 lg:order-1">
            <div class="card-panel p-6 sm:p-8 lg:sticky lg:top-28">
                <h3 class="text-lg font-bold text-ctech-dark mb-5 sm:mb-6 flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-ctech-cyan"></div>
                    Register New Property
                </h3>

                <form method="POST" action="{{ route('properties.store') }}">
                    @csrf
                    <div class="mb-4 sm:mb-5">
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5 sm:mb-2">Property Name</label>
                        <input type="text" name="name" required placeholder="e.g. Office Car"
                            class="sleek-input w-full px-4 py-2.5 sm:py-3 rounded-xl text-sm">
                    </div>

                    <div class="mb-4 sm:mb-5">
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5 sm:mb-2">Model</label>
                        <input type="text" name="model" required placeholder="e.g. Toyota Corolla"
                            class="sleek-input w-full px-4 py-2.5 sm:py-3 rounded-xl text-sm">
                    </div>

                    <div class="mb-4 sm:mb-5">
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5 sm:mb-2">Type</label>
                        <select name="type" id="property_type" onchange="toggleVehicleFields()"
                            class="sleek-input w-full px-4 py-2.5 sm:py-3 rounded-xl text-sm cursor-pointer">
                            <option value="Electronics">Electronics</option>
                            <option value="Vehicle">Vehicle</option>
                            <option value="Furniture">Furniture</option>
                        </select>
                    </div>

                    <div class="mb-4 sm:mb-5">
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5 sm:mb-2">Quantity</label>
                        <input type="number" name="quantity" value="1" min="1"
                            class="sleek-input w-full px-4 py-2.5 sm:py-3 rounded-xl text-sm">
                    </div>

                    <div id="serial_div" class="mb-4 sm:mb-5">
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5 sm:mb-2">Serial Number</label>
                        <input type="text" name="serial_number"
                            class="sleek-input w-full px-4 py-2.5 sm:py-3 rounded-xl text-sm">
                    </div>

                    <div id="license_div" class="mb-4 sm:mb-5 hidden">
                        <label class="block text-sm font-bold text-red-500 mb-1.5 sm:mb-2">License Plate (Required)</label>
                        <input type="text" name="license_plate"
                            class="sleek-input w-full px-4 py-2.5 sm:py-3 rounded-xl text-sm border-red-200 focus:border-red-400">
                    </div>

                    <button type="submit" class="btn-ctech w-full py-3 sm:py-3.5 rounded-xl font-medium mt-2 text-sm">
                        Save Property
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-2 animate-fade-in-up delay-100 order-1 lg:order-2">
            <div class="card-panel overflow-hidden">
                <div
                    class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 bg-white">
                    <h3 class="text-lg font-bold text-ctech-dark">My Registered Items</h3>
                    <span
                        class="bg-slate-50 text-slate-600 text-xs px-3 py-1.5 rounded-lg border border-slate-200 font-semibold self-start sm:self-auto">
                        {{ $properties->count() }} Total
                    </span>
                </div>

                <div class="overflow-x-auto w-full">
                    <table class="w-full text-left border-collapse min-w-[500px]">
                        <thead>
                            <tr
                                class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider border-b border-slate-200">
                                <th class="p-4 font-semibold">Property Details</th>
                                <th class="p-4 font-semibold">Identifier</th>
                                <th class="p-4 font-semibold">Type</th>
                                <th class="p-4 font-semibold text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($properties as $index => $property)
                                <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors animate-fade-in-up"
                                    style="animation-delay: {{ 100 + ($index * 50) }}ms;">
                                    <td class="p-4">
                                        <div class="font-bold text-ctech-dark whitespace-nowrap">{{ $property->name }}</div>
                                        <div class="text-xs text-slate-500 mt-1">{{ $property->model }}</div>
                                    </td>
                                    <td class="p-4">
                                        <span
                                            class="font-mono text-slate-600 bg-slate-100 px-2 py-1 rounded text-xs border border-slate-200 whitespace-nowrap">
                                            {{ $property->type == 'Vehicle' ? $property->license_plate : $property->serial_number }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <span
                                            class="px-2.5 py-1 rounded-md bg-green-50 text-ctech-green text-xs font-semibold border border-green-100">
                                            {{ $property->type }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-right">
                                        <span
                                            class="inline-flex items-center justify-end gap-1.5 text-ctech-cyan text-xs font-semibold">
                                            <span class="w-1.5 h-1.5 rounded-full bg-ctech-cyan"></span>
                                            Active
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-10 sm:p-16 text-center">
                                        <div
                                            class="w-12 sm:w-16 h-12 sm:h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                            <svg class="w-5 sm:w-6 h-5 sm:h-6 text-slate-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                            </svg>
                                        </div>
                                        <p class="font-medium text-slate-500 text-sm sm:text-base">No properties registered yet.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleVehicleFields() {
            const type = document.getElementById('property_type').value;
            const licenseDiv = document.getElementById('license_div');
            const serialDiv = document.getElementById('serial_div');

            if (type === 'Vehicle') {
                licenseDiv.classList.remove('hidden');
                serialDiv.classList.add('hidden');
                licenseDiv.querySelector('input').setAttribute('required', 'true');
                licenseDiv.querySelector('input').removeAttribute('required');
            } else {
                licenseDiv.classList.add('hidden');
                serialDiv.classList.remove('hidden');
                licenseDiv.querySelector('input').removeAttribute('required');
                serialDiv.querySelector('input').setAttribute('required', 'true');
            }
        }
        document.addEventListener('DOMContentLoaded', toggleVehicleFields);
    </script>
@endsection