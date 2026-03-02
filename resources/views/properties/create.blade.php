@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto animate-fade-in-up">
        <div class="card-panel p-6 sm:p-10 mt-2 sm:mt-6">

            <div class="mb-6 sm:mb-8 text-center border-b border-slate-100 pb-6 sm:pb-8">
                <img src="{{ asset('images/ctech-int-logo.png') }}" alt="Ctech Systems Logo"
                    class="h-10 sm:h-12 w-auto mx-auto mb-4 sm:mb-5 object-contain">
                <h2 class="text-xl sm:text-2xl font-bold text-ctech-dark">Register New Asset</h2>
                <p class="text-slate-500 text-xs sm:text-sm mt-1">Add a new item to the company inventory</p>
            </div>

            <form method="POST" action="{{ route('properties.store') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mb-6 sm:mb-8">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5 sm:mb-2">Property Name</label>
                        <input type="text" name="name" required placeholder="e.g., Company Laptop"
                            class="sleek-input w-full px-4 py-2.5 sm:py-3 rounded-xl">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5 sm:mb-2">Model</label>
                        <input type="text" name="model" required placeholder="e.g., MacBook Pro 16"
                            class="sleek-input w-full px-4 py-2.5 sm:py-3 rounded-xl">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5 sm:mb-2">Type</label>
                        <select name="type" id="property_type" onchange="toggleVehicleFields()"
                            class="sleek-input w-full px-4 py-2.5 sm:py-3 rounded-xl cursor-pointer">
                            <option value="Electronics">Electronics</option>
                            <option value="Vehicle">Vehicle</option>
                            <option value="Furniture">Furniture</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5 sm:mb-2">Quantity</label>
                        <input type="number" name="quantity" value="1" min="1"
                            class="sleek-input w-full px-4 py-2.5 sm:py-3 rounded-xl">
                    </div>

                    <div id="serial_div">
                        <label class="block text-sm font-semibold text-slate-600 mb-1.5 sm:mb-2">Serial Number</label>
                        <input type="text" name="serial_number" placeholder="Enter S/N"
                            class="sleek-input w-full px-4 py-2.5 sm:py-3 rounded-xl">
                    </div>

                    <div id="license_div" class="hidden">
                        <label class="block text-sm font-bold text-red-500 mb-1.5 sm:mb-2">License Plate (Required)</label>
                        <input type="text" name="license_plate" placeholder="e.g., KA 1234"
                            class="sleek-input w-full px-4 py-2.5 sm:py-3 rounded-xl border-red-200 focus:border-red-400">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center gap-3 sm:gap-4">
                    <button type="submit"
                        class="btn-ctech w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl font-semibold text-sm">
                        Save to Inventory
                    </button>
                    <a href="{{ route('dashboard') }}"
                        class="text-slate-500 hover:text-ctech-dark text-sm font-medium transition text-center w-full sm:w-auto">
                        Cancel and return
                    </a>
                </div>
            </form>
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
                licenseDiv.querySelector('input').setAttribute('required', 'true');
            }
        }
        document.addEventListener('DOMContentLoaded', toggleVehicleFields);
    </script>
@endsection