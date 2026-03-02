@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left Column: Register Property Form -->
        <div class="lg:col-span-1">
            <div class="glass-panel rounded-3xl p-6 sticky top-24 overflow-hidden relative">
                <!-- Decorative Glow -->
                <div
                    class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-green-300 to-green-500 rounded-full mix-blend-multiply filter blur-2xl opacity-30">
                </div>

                <div class="relative z-10">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-2 h-6 bg-gradient-to-b from-emerald-400 to-emerald-600 rounded-full"></span>
                        Register New Property
                    </h3>

                    <form method="POST" action="{{ route('properties.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Property Name</label>
                            <input type="text" name="name" required placeholder="e.g. Office Car"
                                class="glass-input w-full px-4 py-3 rounded-xl text-sm">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Model</label>
                            <input type="text" name="model" required placeholder="e.g. Toyota Corolla"
                                class="glass-input w-full px-4 py-3 rounded-xl text-sm">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Type</label>
                            <select name="type" id="property_type" onchange="toggleVehicleFields()"
                                class="glass-input w-full px-4 py-3 rounded-xl text-sm">
                                <option value="Electronics">Electronics</option>
                                <option value="Vehicle">Vehicle</option>
                                <option value="Furniture">Furniture</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Quantity</label>
                            <input type="number" name="quantity" value="1" min="1"
                                class="glass-input w-full px-4 py-3 rounded-xl text-sm">
                        </div>

                        <div id="serial_div" class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Serial Number</label>
                            <input type="text" name="serial_number" class="glass-input w-full px-4 py-3 rounded-xl text-sm">
                        </div>

                        <div id="license_div" class="mb-4 hidden">
                            <label class="block text-sm font-bold text-red-600 mb-1">License Plate (Required)</label>
                            <input type="text" name="license_plate"
                                class="glass-input w-full px-4 py-3 rounded-xl text-sm border-red-300 focus:border-red-500">
                        </div>

                        <button type="submit" class="btn-ctech w-full py-3 rounded-xl font-bold mt-2">
                            Save Property
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column: Asset List -->
        <div class="lg:col-span-2">
            <div class="glass-panel rounded-3xl overflow-hidden relative">
                <!-- Decorative Glow -->
                <div
                    class="absolute -bottom-10 -left-10 w-32 h-32 bg-gradient-to-br from-blue-300 to-blue-500 rounded-full mix-blend-multiply filter blur-2xl opacity-30">
                </div>

                <div class="p-6 border-b border-white/50 flex justify-between items-center relative z-10">
                    <h3 class="text-xl font-bold text-gray-800">My Registered Items</h3>
                    <span
                        class="bg-emerald-100 text-emerald-700 text-xs px-4 py-2 rounded-full border border-emerald-300 font-semibold">
                        {{ $properties->count() }} Assets
                    </span>
                </div>

                <div class="overflow-x-auto relative z-10">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-gray-500 text-sm border-b border-gray-200 bg-gray-50/50">
                                <th class="p-4 font-semibold">Property</th>
                                <th class="p-4 font-semibold">Identifier</th>
                                <th class="p-4 font-semibold">Type</th>
                                <th class="p-4 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($properties as $property)
                                <tr class="border-b border-gray-100 hover:bg-emerald-50/50 transition">
                                    <td class="p-4">
                                        <div class="font-bold text-gray-800">{{ $property->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $property->model }}</div>
                                    </td>
                                    <td class="p-4 font-mono text-emerald-600 font-semibold">
                                        {{ $property->type == 'Vehicle' ? $property->license_plate : $property->serial_number }}
                                    </td>
                                    <td class="p-4">
                                        <span
                                            class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold border border-blue-200">
                                            {{ $property->type }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <span class="flex items-center gap-2 text-emerald-600 text-xs font-semibold">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                            Registered
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-gray-500">
                                        <div class="text-lg mb-2">📦</div>
                                        No properties registered yet.
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
                serialDiv.querySelector('input').removeAttribute('required');
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