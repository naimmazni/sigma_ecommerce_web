<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sigma Shop - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Farro&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/brands.min.css">
    <style>
        body {
            font-family: "Farro", Helvetica, sans-serif;
            background-color: #121212;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen text-white">
    <!-- Navigation -->
    <nav class="bg-gray-900 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo Section -->
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-white">SIGMA</a>
                </div>
                
                <!-- Center Navigation Section -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-300 hover:text-white">Home</a>
                    <a href="/products" class="text-gray-300 hover:text-white">Shop</a>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.messages.index') }}" class="text-gray-300 hover:text-white">
                                <i class="fas fa-comments mr-1"></i>
                                Message Board
                            </a>
                        @endif
                    @endauth
                    <a href="/contact" class="text-gray-300 hover:text-white">Contact</a>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Dashboard
                            </a>
                        @endif
                    @endauth
                </div>
                
                <!-- Right Section - Cart and User Actions -->
                <div class="hidden md:flex items-center space-x-8">
                    @auth
                        <a href="{{ route('favourites.index') }}" class="text-gray-300 hover:text-white relative">
                            <i class="fas fa-heart"></i>
                            @php
                                $favouritesCount = auth()->user()->favourites()->count();
                            @endphp
                            @if($favouritesCount > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $favouritesCount }}
                                </span>
                            @endif
                        </a>
                    @endauth
                    <a href="/cart" class="text-gray-300 hover:text-white relative">
                        <i class="fas fa-shopping-cart"></i>
                        @auth
                            @php
                                $cartCount = auth()->user()->cart()->sum('quantity');
                            @endphp
                            @if($cartCount > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        @endauth
                    </a>
                    @auth
                        <a href="/profile" class="text-gray-300 hover:text-white">
                            <i class="fas fa-user"></i>
                        </a>
                    @else
                        <a href="/login" class="text-gray-300 hover:text-white">Login</a>
                        <a href="/register" class="text-gray-300 hover:text-white">Register</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="text-gray-300 hover:text-white focus:outline-none focus:text-white" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="/" class="block px-3 py-2 text-gray-300 hover:text-white">Home</a>
                    <a href="/products" class="block px-3 py-2 text-gray-300 hover:text-white">Shop</a>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.messages.index') }}" class="block px-3 py-2 text-gray-300 hover:text-white">
                                <i class="fas fa-comments mr-2"></i>
                                Message Board
                            </a>
                        @endif
                    @endauth
                    <a href="/contact" class="block px-3 py-2 text-gray-300 hover:text-white">Contact</a>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-gray-300 hover:text-white">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Dashboard
                            </a>
                        @endif
                    @endauth
                    <a href="/cart" class="block px-3 py-2 text-gray-300 hover:text-white relative">
                        <i class="fas fa-shopping-cart"></i>
                        @auth
                            @php
                                $cartCount = auth()->user()->cart()->sum('quantity');
                            @endphp
                            @if($cartCount > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        @endauth
                    </a>
                    @auth
                        <a href="/profile" class="block px-3 py-2 text-gray-300 hover:text-white">
                            <i class="fas fa-user"></i>
                        </a>
                    @else
                        <a href="/login" class="block px-3 py-2 text-gray-300 hover:text-white">Login</a>
                        <a href="/register" class="block px-3 py-2 text-gray-300 hover:text-white">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow bg-gray-900">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-center py-6 mt-auto">
        <p class="text-sm sm:text-base">
            © 2025 Sigma Shop. All rights reserved.
        </p>
    </footer>

    <!-- Floating Help Button -->
    <div class="fixed bottom-6 right-6 z-50">
        <button id="helpButton" onclick="toggleHelpModal()" class="bg-blue-600 hover:bg-blue-700 text-white rounded-full p-4 shadow-lg transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-4 focus:ring-blue-300 group">
            <div class="flex items-center">
                <span class="text-sm font-medium mr-2">Help</span>
                <i class="fas fa-question text-xl"></i>
            </div>
        </button>
    </div>

    <!-- Help Modal -->
    <div id="helpModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-gray-800 rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <!-- Modal Header -->
                <div class="flex items-center justify-between p-6 border-b border-gray-700">
                    <h2 class="text-2xl font-bold text-white">Help & FAQ</h2>
                    <button onclick="toggleHelpModal()" class="text-gray-400 hover:text-white text-2xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <!-- Modal Content -->
                <div class="p-6">
                    <!-- Quick Help Section -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-white mb-4">Quick Help</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-700 rounded-lg p-4">
                                <h4 class="text-lg font-medium text-white mb-2">How to Shop</h4>
                                <p class="text-gray-300 text-sm">Browse products, add to cart, and checkout easily.</p>
                            </div>
                            <div class="bg-gray-700 rounded-lg p-4">
                                <h4 class="text-lg font-medium text-white mb-2">Account Help</h4>
                                <p class="text-gray-300 text-sm">Create account, manage profile, and track orders.</p>
                            </div>
                            <div class="bg-gray-700 rounded-lg p-4">
                                <h4 class="text-lg font-medium text-white mb-2">Payment & Shipping</h4>
                                <p class="text-gray-300 text-sm">Secure payments and fast delivery options.</p>
                            </div>
                            <div class="bg-gray-700 rounded-lg p-4">
                                <h4 class="text-lg font-medium text-white mb-2">Returns & Support</h4>
                                <p class="text-gray-300 text-sm">Easy returns and 24/7 customer support.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick FAQ -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-white mb-4">Quick Questions</h3>
                        <div class="space-y-3">
                            <div class="bg-gray-700 rounded-lg p-4">
                                <h4 class="text-white font-medium">How do I create an account?</h4>
                                <p class="text-gray-300 text-sm mt-1">Click "Register" in the top navigation and fill in your details.</p>
                            </div>
                            <div class="bg-gray-700 rounded-lg p-4">
                                <h4 class="text-white font-medium">What payment methods do you accept?</h4>
                                <p class="text-gray-300 text-sm mt-1">We accept all major credit cards, debit cards, and digital wallets.</p>
                            </div>
                            <div class="bg-gray-700 rounded-lg p-4">
                                <h4 class="text-white font-medium">How long does shipping take?</h4>
                                <p class="text-gray-300 text-sm mt-1">Standard shipping takes 3-5 business days.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('help.index') }}" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-6 rounded-lg font-medium transition-colors">
                            <i class="fas fa-book mr-2"></i>
                            View Full Help Guide
                        </a>
                        <a href="{{ route('contact.show') }}" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white text-center py-3 px-6 rounded-lg font-medium transition-colors">
                            <i class="fas fa-envelope mr-2"></i>
                            Contact Support
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }

        function toggleHelpModal() {
            const modal = document.getElementById('helpModal');
            modal.classList.toggle('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('helpModal').addEventListener('click', function(e) {
            if (e.target === this) {
                toggleHelpModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const modal = document.getElementById('helpModal');
                if (!modal.classList.contains('hidden')) {
                    toggleHelpModal();
                }
            }
        });
    </script>
</body>
</html> 