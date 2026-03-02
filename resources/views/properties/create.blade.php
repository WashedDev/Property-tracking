@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="glass-panel rounded-3xl p-8 shadow-2xl relative overflow-hidden">
            <!-- Decorative Glow -->
            <div
                class="absolute -top-24 -right-24 w-48 h-48 bg-gradient-to-br from-green-300 to-green-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30">
            </div>
            <div
                class="absolute -bottom-24 -left-24 w-48 h-48 bg-gradient-to-br from-blue-300 to-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-30">
            </div>

            <div class="relative z-10">
                <div class="mb-8 text-center">
                    <div
                        class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gradient-to-br from-emerald-400 to-blue-500 flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Register Company Property</h2>
                    <p class="text-gray-500 text-sm mt-2">Add a new asset to the Ctech inventory system</p>
                </div>

                <form method="POST" action="{{ route('properties.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Property Name</label>
                            <input type="text" name="name" required placeholder="e.g., Office Car, Work Laptop"
                                class="glass-input w-full px-4 py-3 rounded-xl">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Model</label>
                            <input type="text" name="model" required class="glass-input w-full px-4 py-3 rounded-xl">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Type</label>
                            <select name="type" id="property_type" onchange="toggleVehicleFields()"
                                class="glass-input w-full px-4 py-3 rounded-xl">
                                <option value="Electronics">Electronics</option>
                                <option value="Vehicle">Vehicle</option>
                                <option value="Furniture">Furniture</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Quantity</label>
                            <input type="number" name="quantity" value="1" min="1"
                                class="glass-input w-full px-4 py-3 rounded-xl">
                        </div>

                        <div id="serial_div">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Serial Number</label>
                            <input type="text" name="serial_number" class="glass-input w-full px-4 py-3 rounded-xl">
                        </div>

                        <div id="license_div" class="hidden">
                            <label class="block text-sm font-bold text-red-600 mb-2">License Plate (Required for
                                Vehicles)</label>
                            <input type="text" name="license_plate"
                                class="glass-input w-full px-4 py-3 rounded-xl border-red-300 focus:border-red-500">
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="btn-ctech w-full py-3 rounded-xl font-bold text-lg shadow-lg">
                            Save Property
                        </button>
                        <a href="{{ route('dashboard') }}"
                            class="block text-center text-gray-500 text-sm mt-4 hover:text-emerald-600 font-medium">
                            Cancel and return to Dashboard
                        </a>
                    </div>
                </form>
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