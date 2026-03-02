@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="glass-panel rounded-3xl p-10 shadow-2xl relative overflow-hidden mt-8">

            <div class="relative z-10">
                <div class="mb-10 text-center">
                    <img src="{{ asset('images/ctech-int-logo.png') }}" alt="Ctech Systems Logo"
                        class="h-16 w-auto mx-auto mb-6 object-contain">

                    <h2 class="text-3xl font-bold text-ctech-dark">Register Property</h2>
                    <p class="text-ctech-grey text-sm mt-2 font-medium">Add a new asset to the Ctech inventory system</p>
                </div>

                <form method="POST" action="{{ route('properties.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white/20 p-6 rounded-2xl border border-white/50">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-ctech-grey mb-2">Property Name</label>
                            <input type="text" name="name" required placeholder="e.g., Office Car, Work Laptop"
                                class="glass-input w-full px-4 py-3.5 rounded-xl">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-ctech-grey mb-2">Model</label>
                            <input type="text" name="model" required placeholder="e.g., Dell XPS 15"
                                class="glass-input w-full px-4 py-3.5 rounded-xl">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-ctech-grey mb-2">Type</label>
                            <select name="type" id="property_type" onchange="toggleVehicleFields()"
                                class="glass-input w-full px-4 py-3.5 rounded-xl appearance-none cursor-pointer">
                                <option value="Electronics">Electronics</option>
                                <option value="Vehicle">Vehicle</option>
                                <option value="Furniture">Furniture</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-ctech-grey mb-2">Quantity</label>
                            <input type="number" name="quantity" value="1" min="1"
                                class="glass-input w-full px-4 py-3.5 rounded-xl">
                        </div>

                        <div id="serial_div">
                            <label class="block text-sm font-semibold text-ctech-grey mb-2">Serial Number</label>
                            <input type="text" name="serial_number" placeholder="Enter S/N"
                                class="glass-input w-full px-4 py-3.5 rounded-xl">
                        </div>

                        <div id="license_div" class="hidden">
                            <label class="block text-sm font-bold text-red-500 mb-2">License Plate (Required)</label>
                            <input type="text" name="license_plate" placeholder="e.g., KA 1234"
                                class="glass-input w-full px-4 py-3.5 rounded-xl border-red-200 focus:border-red-400">
                        </div>
                    </div>

                    <div class="mt-8 pt-4">
                        <button type="submit" class="btn-ctech w-full py-4 rounded-xl font-bold text-lg shadow-lg">
                            Save to Inventory
                        </button>
                        <a href="{{ route('dashboard') }}"
                            class="block text-center text-ctech-grey text-sm mt-5 hover:text-ctech-cyan font-semibold transition">
                            &larr; Cancel and return to Dashboard
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