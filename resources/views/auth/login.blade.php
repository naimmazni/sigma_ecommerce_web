@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen bg-gray-900 py-12">
    <div class="max-w-md mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-8 bg-gray-800 border-b border-gray-700">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-white">Login</h2>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-white text-gray-900 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-200 transition-colors duration-200">
                        Register
                    </a>
                </div>

                @if (session('status'))
                    <div class="mb-6 bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('status') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Role Selection -->
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="customer" class="peer hidden" {{ old('role', 'customer') == 'customer' ? 'checked' : '' }}>
                            <div class="flex items-center justify-center p-4 border-2 border-gray-700 rounded-xl peer-checked:border-indigo-500 peer-checked:bg-indigo-900 peer-checked:text-white hover:bg-gray-700 transition-all duration-200">
                                <i class="fas fa-user mr-2"></i>
                                <span class="font-medium text-white">Customer</span>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="role" value="admin" class="peer hidden" {{ old('role') == 'admin' ? 'checked' : '' }}>
                            <div class="flex items-center justify-center p-4 border-2 border-gray-700 rounded-xl peer-checked:border-indigo-500 peer-checked:bg-indigo-900 peer-checked:text-white hover:bg-gray-700 transition-all duration-200">
                                <i class="fas fa-user-shield mr-2"></i>
                                <span class="font-medium text-white">Admin</span>
                            </div>
                        </label>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus class="block w-full px-4 py-3 rounded-lg border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('email')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <input type="password" name="password" id="password" required class="block w-full px-4 py-3 rounded-lg border-gray-700 bg-gray-700 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('password')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" class="h-4 w-4 rounded border-gray-700 bg-gray-700 text-indigo-600 focus:ring-indigo-500">
                            <label for="remember" class="ml-2 block text-sm text-gray-300">Remember me</label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-indigo-400 hover:text-indigo-300">
                                Forgot your password?
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Login
                        </button>
                    </div>
                </form>

                <!-- Demo Credentials - Show based on selected role -->
                <div class="mt-6 pt-6 border-t border-gray-700">
                    <h3 class="text-sm font-semibold text-gray-200 mb-4 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Demo Credentials for Testing
                    </h3>
                    
                    <!-- Admin Credentials - Show when Admin is selected -->
                    <div id="admin-credentials" class="credential-box hidden">
                        <div class="bg-gray-700 rounded-lg p-4 border border-gray-600">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center">
                                    <i class="fas fa-user-shield text-purple-400 mr-2 text-lg"></i>
                                    <h4 class="text-sm font-semibold text-purple-400 uppercase">Admin Account</h4>
                                </div>
                                <button type="button" onclick="fillAdminCredentials()" 
                                        class="bg-purple-600 hover:bg-purple-700 text-white text-xs px-3 py-1.5 rounded-lg transition-colors duration-200 flex items-center">
                                    <i class="fas fa-magic mr-1"></i>
                                    Fill In
                                </button>
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-xs text-gray-400 block mb-1">Email:</span>
                                    <div class="bg-gray-800 px-3 py-2 rounded text-gray-200 break-all">
                                        admin@sigma.com
                                    </div>
                                </div>
                                <div>
                                    <span class="text-xs text-gray-400 block mb-1">Password:</span>
                                    <div class="bg-gray-800 px-3 py-2 rounded text-gray-200">
                                        admin123
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Credentials - Show when Customer is selected -->
                    <div id="customer-credentials" class="credential-box hidden">
                        <div class="bg-gray-700 rounded-lg p-4 border border-gray-600">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center">
                                    <i class="fas fa-user text-blue-400 mr-2 text-lg"></i>
                                    <h4 class="text-sm font-semibold text-blue-400 uppercase">Customer Account</h4>
                                </div>
                                <button type="button" onclick="fillCustomerCredentials()" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1.5 rounded-lg transition-colors duration-200 flex items-center">
                                    <i class="fas fa-magic mr-1"></i>
                                    Fill In
                                </button>
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-xs text-gray-400 block mb-1">Email:</span>
                                    <div class="bg-gray-800 px-3 py-2 rounded text-gray-200 break-all">
                                        test@example.com
                                    </div>
                                </div>
                                <div>
                                    <span class="text-xs text-gray-400 block mb-1">Password:</span>
                                    <div class="bg-gray-800 px-3 py-2 rounded text-gray-200">
                                        password123
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-xs text-gray-500 mt-4 text-center">
                        <i class="fas fa-lock mr-1"></i>
                        Use these credentials to test the website features
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fill in Admin credentials
    function fillAdminCredentials() {
        document.getElementById('email').value = 'admin@sigma.com';
        document.getElementById('password').value = 'admin123';
        
        // Show visual feedback
        showFillNotification('Admin credentials filled in!');
    }
    
    // Fill in Customer credentials
    function fillCustomerCredentials() {
        document.getElementById('email').value = 'test@example.com';
        document.getElementById('password').value = 'password123';
        
        // Show visual feedback
        showFillNotification('Customer credentials filled in!');
    }
    
    // Show/hide credentials based on selected role
    function updateCredentials() {
        const selectedRole = document.querySelector('input[name="role"]:checked').value;
        const adminCreds = document.getElementById('admin-credentials');
        const customerCreds = document.getElementById('customer-credentials');
        
        if (selectedRole === 'admin') {
            adminCreds.classList.remove('hidden');
            customerCreds.classList.add('hidden');
        } else {
            customerCreds.classList.remove('hidden');
            adminCreds.classList.add('hidden');
        }
    }
    
    // Listen for role changes
    document.querySelectorAll('input[name="role"]').forEach(radio => {
        radio.addEventListener('change', updateCredentials);
    });
    
    // Set initial state on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateCredentials();
    });
</script>

@endsection 