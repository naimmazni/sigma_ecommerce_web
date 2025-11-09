@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="flex-1">
                    <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">Welcome to Sigma</h1>
                    <p class="mt-6 text-xl max-w-3xl text-gray-300">Discover our premium collection of clothing that defines modern style and comfort.</p>
                    <div class="mt-10">
                        <a href="{{ route('products.index') }}" class="inline-block bg-white text-gray-900 px-8 py-3 rounded-md font-medium hover:bg-gray-200 transition-colors duration-200">
                            Shop Now
                        </a>
                    </div>
                </div>
                <div class="mt-8 lg:mt-0 lg:ml-8">
                    <div class="bg-gray-800 rounded-lg p-6 text-center">
                        <div class="text-2xl font-bold text-white mb-2" id="current-time">Loading...</div>
                        <div class="text-sm text-gray-300" id="current-date">Loading...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            
            // Update time
            const timeString = now.toLocaleTimeString('en-US', {
                hour12: true,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('current-time').textContent = timeString;
            
            // Update date
            const dateString = now.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            document.getElementById('current-date').textContent = dateString;
        }
        
        // Update clock immediately and then every second
        updateClock();
        setInterval(updateClock, 1000);
    </script>

    <!-- Featured Products -->
    <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white mb-4">Featured Products</h2>
                <p class="text-lg text-gray-400 max-w-2xl mx-auto">Discover our handpicked collection of premium streetwear and accessories</p>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
                <div class="group relative bg-gray-800 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                    <!-- Product Image Container -->
                    <div class="relative overflow-hidden">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <img src="{{ $product->image }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-64 object-cover object-center group-hover:scale-110 transition-transform duration-500">
                        </a>
                        
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
                                <a href="{{ route('products.show', $product->slug) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-white text-gray-900 rounded-full font-medium hover:bg-gray-100 transition-colors duration-200">
                                    <i class="fas fa-eye mr-2"></i>
                                    View Details
                                </a>
                            </div>
                        </div>

                        <!-- Featured Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-yellow-400 to-orange-500 text-white shadow-lg">
                                <i class="fas fa-star mr-1"></i>
                                Featured
                            </span>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-700 text-gray-300">
                                {{ $product->category }}
                            </span>
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                                <span class="text-sm text-gray-400 ml-1">4.8</span>
                            </div>
                        </div>

                        <h3 class="text-lg font-semibold text-white mb-2 group-hover:text-blue-400 transition-colors duration-200">
                            <a href="{{ route('products.show', $product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </h3>

                        <p class="text-gray-400 text-sm mb-4 line-clamp-2">
                            Premium quality streetwear designed for modern fashion enthusiasts.
                        </p>

                        <div class="flex items-start justify-between mb-2">
                            <div class="flex flex-col space-y-1 flex-1">
                                <span class="text-2xl font-bold text-white">RM{{ number_format($product->price, 2) }}</span>
                                @if($product->price > 100)
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm text-gray-500 line-through">RM{{ number_format($product->price * 1.2, 2) }}</span>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-500 text-white">
                                        -20%
                                    </span>
                                </div>
                                @endif
                            </div>
                            
                            <div class="flex items-center space-x-2 flex-shrink-0 ml-2">
                                @auth
                                    <button onclick="toggleFavourite({{ $product->id }}, this)" 
                                            class="favourite-btn w-8 h-8 {{ auth()->user()->hasFavourited($product->id) ? 'bg-red-500 hover:bg-red-600' : 'bg-gray-700 hover:bg-gray-600' }} text-white rounded-full flex items-center justify-center transition-colors duration-200"
                                            data-product-id="{{ $product->id }}">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" 
                                       class="w-8 h-8 bg-gray-700 hover:bg-gray-600 text-gray-300 rounded-full flex items-center justify-center transition-colors duration-200"
                                       title="Login to add to favourites">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                @endauth
                                <button onclick="shareProduct('{{ $product->name }}', '{{ route('products.show', $product->slug) }}')" 
                                        class="w-8 h-8 bg-gray-700 hover:bg-gray-600 text-gray-300 rounded-full flex items-center justify-center transition-colors duration-200"
                                        title="Share this product">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Stock Status -->
                        <div class="mt-4 pt-4 border-t border-gray-700">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-green-400 flex items-center">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    In Stock
                                </span>
                                <span class="text-gray-400">Free Shipping</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- View All Products Button -->
            <div class="text-center mt-12">
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <span>View All Products</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-3xl font-bold text-white mb-8">Shop by Category</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="relative group">
                <a href="{{ route('products.index', ['category' => 'men']) }}">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-800">
                        <img src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8" alt="Men's Collection" class="object-cover object-center group-hover:opacity-75">
                    </div>
                </a>
                <h3 class="mt-4 text-lg font-medium text-white">Men's Collection</h3>
                <a href="{{ route('products.index', ['category' => 'men']) }}" class="mt-2 text-sm text-gray-400 hover:text-white transition-colors duration-200">Shop Now →</a>
            </div>
            <div class="relative group">
                <a href="{{ route('products.index', ['category' => 'women']) }}">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-800">
                        <img src="https://images.unsplash.com/photo-1581044777550-4cfa60707c03" alt="Women's Collection" class="object-cover object-center group-hover:opacity-75">
                    </div>
                </a>
                <h3 class="mt-4 text-lg font-medium text-white">Women's Collection</h3>
                <a href="{{ route('products.index', ['category' => 'women']) }}" class="mt-2 text-sm text-gray-400 hover:text-white transition-colors duration-200">Shop Now →</a>
            </div>
            <div class="relative group">
                <a href="{{ route('products.index', ['category' => 'accessories']) }}">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-800">
                        <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f" alt="Accessories" class="object-cover object-center group-hover:opacity-75">
                    </div>
                </a>
                <h3 class="mt-4 text-lg font-medium text-white">Accessories</h3>
                <a href="{{ route('products.index', ['category' => 'accessories']) }}" class="mt-2 text-sm text-gray-400 hover:text-white transition-colors duration-200">Shop Now →</a>
            </div>
        </div>
    </div>

    <!-- Newsletter Section -->
    <div class="bg-gray-900">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="px-6 py-6 bg-gray-800 rounded-lg md:py-12 md:px-12 lg:py-16 lg:px-16 xl:flex xl:items-center">
                <div class="xl:w-0 xl:flex-1">
                    <h2 class="text-2xl font-extrabold tracking-tight text-white sm:text-3xl">
                        Stay updated with our latest collections
                    </h2>
                    <p class="mt-3 max-w-3xl text-lg leading-6 text-gray-300">
                        Sign up for our newsletter to receive updates on new arrivals and special offers.
                    </p>
                </div>
                <div class="mt-8 sm:w-full sm:max-w-md xl:mt-0 xl:ml-8">
                    <form class="sm:flex">
                        <label for="email-address" class="sr-only">Email address</label>
                        <input id="email-address" name="email" type="email" required 
                            class="w-full rounded-md border-gray-700 bg-gray-900 text-white px-5 py-3 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" 
                            placeholder="Enter your email">
                        <button type="submit" 
                            class="mt-3 w-full flex items-center justify-center px-5 py-3 border border-transparent shadow text-base font-medium rounded-md text-white bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0 transition-colors duration-200">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
</div>

<!-- Welcome Popup Example -->
<div id="welcomePopup" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-800 rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-700 flex justify-between items-center">
            <h3 class="text-lg font-medium text-white">Welcome to Sigma Shop!</h3>
            <button onclick="closeWelcomePopup()" class="text-gray-400 hover:text-white text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="px-6 py-4">
            <p class="text-gray-300 mb-4">
                Welcome to our premium streetwear collection! Discover the latest trends and exclusive designs.
            </p>
            <div class="flex justify-end">
                <button onclick="closeWelcomePopup()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-200">
                    Get Started
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Show welcome popup when page loads (only once)
    window.onload = function() {
        // Check if user has already seen the popup
        const hasSeenPopup = localStorage.getItem('hasSeenWelcomePopup');
        
        if (!hasSeenPopup) {
            // Show popup after 2 seconds only if they haven't seen it
            setTimeout(function() {
                showWelcomePopup();
            }, 2000);
        }
    };
    
    function showWelcomePopup() {
        document.getElementById('welcomePopup').classList.remove('hidden');
        // Mark that user has seen the popup
        localStorage.setItem('hasSeenWelcomePopup', 'true');
    }
    
    function closeWelcomePopup() {
        document.getElementById('welcomePopup').classList.add('hidden');
    }
    
    // Close popup when clicking outside
    document.getElementById('welcomePopup').addEventListener('click', function(e) {
        if (e.target === this) {
            closeWelcomePopup();
        }
    });
    
    // Close popup with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeWelcomePopup();
        }
    });

    // Toggle favourite functionality
    function toggleFavourite(productId, button) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        
        if (!csrfToken) {
            showNotification('Security token not found. Please refresh the page.', 'error');
            return;
        }

        fetch(`/favourites/${productId}/toggle`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken.content,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                if (response.status === 401) {
                    window.location.href = '/login';
                    return;
                }
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (!data) return;
            
            if (data.status === 'added') {
                button.classList.remove('bg-gray-700', 'hover:bg-gray-600');
                button.classList.add('bg-red-500', 'hover:bg-red-600');
                showNotification(data.message, 'success');
            } else {
                button.classList.remove('bg-red-500', 'hover:bg-red-600');
                button.classList.add('bg-gray-700', 'hover:bg-gray-600');
                showNotification(data.message, 'info');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Unable to update favourites. Please try again.', 'error');
        });
    }

    // Share product functionality
    function shareProduct(productName, productUrl) {
        const fullUrl = '{{ url('/') }}' + productUrl.replace('{{ url('/') }}', '');
        
        if (navigator.share) {
            navigator.share({
                title: productName,
                text: `Check out ${productName} on Sigma Shop!`,
                url: fullUrl
            }).catch(error => console.log('Error sharing:', error));
        } else {
            // Fallback: Copy to clipboard
            navigator.clipboard.writeText(fullUrl).then(() => {
                showNotification('Link copied to clipboard!', 'success');
            }).catch(() => {
                // Show share modal as final fallback
                showShareModal(productName, fullUrl);
            });
        }
    }

    // Show share modal
    function showShareModal(productName, productUrl) {
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4';
        modal.innerHTML = `
            <div class="bg-gray-800 rounded-lg p-6 max-w-md w-full">
                <h3 class="text-xl font-bold text-white mb-4">Share ${productName}</h3>
                <div class="space-y-3">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(productUrl)}" 
                       target="_blank" 
                       class="block w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg text-center transition-colors">
                        <i class="fab fa-facebook-f mr-2"></i> Share on Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=${encodeURIComponent(productUrl)}&text=${encodeURIComponent('Check out ' + productName + ' on Sigma Shop!')}" 
                       target="_blank" 
                       class="block w-full bg-sky-500 hover:bg-sky-600 text-white py-3 px-4 rounded-lg text-center transition-colors">
                        <i class="fab fa-twitter mr-2"></i> Share on Twitter
                    </a>
                    <a href="https://wa.me/?text=${encodeURIComponent('Check out ' + productName + ' on Sigma Shop! ' + productUrl)}" 
                       target="_blank" 
                       class="block w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg text-center transition-colors">
                        <i class="fab fa-whatsapp mr-2"></i> Share on WhatsApp
                    </a>
                    <button onclick="copyToClipboard('${productUrl}')" 
                            class="block w-full bg-gray-700 hover:bg-gray-600 text-white py-3 px-4 rounded-lg text-center transition-colors">
                        <i class="fas fa-copy mr-2"></i> Copy Link
                    </button>
                </div>
                <button onclick="this.closest('.fixed').remove()" 
                        class="mt-4 w-full bg-gray-600 hover:bg-gray-500 text-white py-2 px-4 rounded-lg transition-colors">
                    Close
                </button>
            </div>
        `;
        document.body.appendChild(modal);
        
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.remove();
            }
        });
    }

    // Copy to clipboard
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            showNotification('Link copied to clipboard!', 'success');
        });
    }

    // Show notification
    function showNotification(message, type = 'info') {
        const colors = {
            success: 'bg-green-500',
            error: 'bg-red-500',
            info: 'bg-blue-500'
        };
        
        const notification = document.createElement('div');
        notification.className = `fixed top-20 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-opacity duration-300`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
</script>

@endsection 