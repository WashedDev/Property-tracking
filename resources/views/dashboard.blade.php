@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-1">
            <div class="glass-panel rounded-3xl p-8 sticky top-28 overflow-hidden relative">
                <div class="absolute -top-12 -right-12 w-32 h-32 bg-ctech-green rounded-full filter blur-3xl opacity-20">
                </div>

                <div class="relative z-10">
                    <h3 class="text-xl font-bold text-ctech-dark mb-6 flex items-center gap-3">
                        <span class="w-1.5 h-6 bg-gradient-to-b from-ctech-cyan to-ctech-green rounded-full"></span>
                        Register New Property
                    </h3>

                    <form method="POST" action="{{ route('properties.store') }}">
                        @csrf

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-ctech-grey mb-1.5">Property Name</label>
                            <input type="text" name="name" required placeholder="e.g. Office Car"
                                class="glass-input w-full px-4 py-3 rounded-xl text-sm">
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-ctech-grey mb-1.5">Model</label>
                            <input type="text" name="model" required placeholder="e.g. Toyota Corolla"
                                class="glass-input w-full px-4 py-3 rounded-xl text-sm">
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-ctech-grey mb-1.5">Type</label>
                            <select name="type" id="property_type" onchange="toggleVehicleFields()"
                                class="glass-input w-full px-4 py-3 rounded-xl text-sm appearance-none cursor-pointer">
                                <option value="Electronics">Electronics</option>
                                <option value="Vehicle">Vehicle</option>
                                <option value="Furniture">Furniture</option>
                            </select>
                        </div>

                        <div class="mb-5">
                            <label class="block text-sm font-semibold text-ctech-grey mb-1.5">Quantity</label>
                            <input type="number" name="quantity" value="1" min="1"
                                class="glass-input w-full px-4 py-3 rounded-xl text-sm">
                        </div>

                        <div id="serial_div" class="mb-5">
                            <label class="block text-sm font-semibold text-ctech-grey mb-1.5">Serial Number</label>
                            <input type="text" name="serial_number" class="glass-input w-full px-4 py-3 rounded-xl text-sm">
                        </div>

                        <div id="license_div" class="mb-5 hidden">
                            <label class="block text-sm font-bold text-red-500 mb-1.5">License Plate (Required)</label>
                            <input type="text" name="license_plate"
                                class="glass-input w-full px-4 py-3 rounded-xl text-sm border-red-200 focus:border-red-400 focus:ring-red-100">
                        </div>

                        <button type="submit"
                            class="btn-ctech w-full py-3.5 rounded-xl font-bold mt-4 tracking-wide text-sm">
                            Save Property
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="glass-panel rounded-3xl overflow-hidden relative min-h-[500px]">
                <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-ctech-cyan rounded-full filter blur-3xl opacity-20">
                </div>

                <div class="p-8 border-b border-white/60 flex justify-between items-center relative z-10 bg-white/20">
                    <h3 class="text-xl font-bold text-ctech-dark">My Registered Items</h3>
                    <span
                        class="bg-white/80 text-ctech-cyan text-xs px-4 py-2 rounded-full border border-ctech-cyan/20 font-bold shadow-sm">
                        {{ $properties->count() }} Assets
                    </span>
                </div>

                <div class="overflow-x-auto relative z-10 p-4">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-ctech-grey text-xs uppercase tracking-wider border-b border-gray-200/50">
                                <th class="p-4 font-semibold">Property</th>
                                <th class="p-4 font-semibold">Identifier</th>
                                <th class="p-4 font-semibold">Type</th>
                                <th class="p-4 font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($properties as $property)
                                <tr class="border-b border-gray-100/50 hover:bg-white/40 transition duration-200">
                                    <td class="p-4">
                                        <div class="font-bold text-ctech-dark">{{ $property->name }}</div>
                                        <div class="text-xs text-gray-500 mt-1">{{ $property->model }}</div>
                                    </td>
                                    <td
                                        class="p-4 font-mono text-ctech-cyan font-semibold bg-white/30 rounded-lg m-2 inline-block">
                                        {{ $property->type == 'Vehicle' ? $property->license_plate : $property->serial_number }}
                                    </td>
                                    <td class="p-4">
                                        <span
                                            class="px-3 py-1 rounded-full bg-ctech-green/10 text-ctech-green text-xs font-bold border border-ctech-green/20">
                                            {{ $property->type }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <span class="flex items-center gap-2 text-ctech-cyan text-xs font-bold">
                                            <span class="w-2 h-2 rounded-full bg-ctech-cyan animate-pulse"></span>
                                            Registered
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-12 text-center text-gray-400">
                                        <div class="text-4xl mb-3 opacity-50">📦</div>
                                        <p class="font-medium text-ctech-grey">No properties registered yet.</p>
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