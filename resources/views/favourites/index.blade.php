@extends('layouts.app')

@section('title', 'My Favourites')

@section('content')
<div class="bg-gray-900 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-white">
                <i class="fas fa-heart text-red-500 mr-3"></i>
                My Favourites
            </h1>
            <span class="text-gray-400">{{ $favourites->count() }} {{ $favourites->count() === 1 ? 'item' : 'items' }}</span>
        </div>

        @if(session('success'))
            <div class="bg-green-500 text-white px-6 py-4 rounded-lg mb-6">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($favourites->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($favourites as $favourite)
                    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300">
                        <div class="relative group">
                            <a href="{{ route('products.show', $favourite->product->slug) }}">
                                <img src="{{ $favourite->product->image }}" 
                                     alt="{{ $favourite->product->name }}" 
                                     class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300">
                            </a>
                            <div class="absolute top-3 right-3 z-10">
                                <form action="{{ route('favourites.destroy', $favourite) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-10 h-10 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center transition-colors duration-200 shadow-lg">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="p-4">
                            <a href="{{ route('products.show', $favourite->product->slug) }}" 
                               class="block mb-2">
                                <h3 class="text-lg font-semibold text-white hover:text-blue-400 transition-colors">
                                    {{ $favourite->product->name }}
                                </h3>
                            </a>
                            
                            <p class="text-gray-400 text-sm mb-4 line-clamp-2">
                                {{ $favourite->product->description }}
                            </p>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span class="text-2xl font-bold text-white">
                                        RM{{ number_format($favourite->product->price, 2) }}
                                    </span>
                                </div>
                                <a href="{{ route('products.show', $favourite->product->slug) }}" 
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200">
                                    View Details
                                </a>
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-700">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-400">
                                        Added {{ $favourite->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gray-800 rounded-lg p-12 text-center">
                <i class="fas fa-heart text-gray-600 text-6xl mb-4"></i>
                <h3 class="text-2xl font-semibold text-white mb-2">No Favourites Yet</h3>
                <p class="text-gray-400 mb-6">Start adding products to your favourites to see them here!</p>
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="fas fa-shopping-bag mr-2"></i>
                    Browse Products
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
