<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Classic Sigma Tee',
                'description' => 'Premium cotton t-shirt featuring the iconic Sigma logo. Crafted from 100% organic cotton for ultimate comfort and breathability. Perfect for everyday wear with a modern, minimalist design.',
                'price' => 29.99,
                'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&q=80', // Classic white t-shirt
                'category' => 'men',
                'featured' => true,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 25,
                    'M' => 30,
                    'L' => 25,
                    'XL' => 20,
                ],
            ],
            [
                'name' => 'Slim Fit Denim Jeans',
                'description' => 'Modern slim fit jeans with premium stretch denim. Features a comfortable elastic waistband and reinforced stitching for durability. Perfect for both casual and semi-formal occasions.',
                'price' => 79.99,
                'image' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=800&q=80', // Blue denim jeans
                'category' => 'men',
                'featured' => false,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 15,
                    'M' => 20,
                    'L' => 10,
                    'XL' => 5,
                ],
            ],
            [
                'name' => 'Elegant Silk Blouse',
                'description' => 'Sophisticated silk blouse with a contemporary cut and flowing design. Made from 100% pure silk with a subtle sheen. Features a flattering silhouette perfect for professional and evening wear.',
                'price' => 59.99,
                'image' => 'https://images.unsplash.com/photo-1564584217132-2271feaeb3c5?w=800&q=80', // Silk blouse
                'category' => 'women',
                'featured' => false,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 20,
                    'M' => 25,
                    'L' => 20,
                    'XL' => 10,
                ],
            ],
            [
                'name' => 'Premium Leather Jacket',
                'description' => 'Handcrafted leather jacket with premium full-grain leather. Features a modern biker design with quilted detailing and multiple pockets. A timeless piece that adds instant edge to any outfit.',
                'price' => 199.99,
                'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=800&q=80', // Leather jacket
                'category' => 'men',
                'featured' => true,
                'sizes' => ['M', 'L', 'XL'],
                'stock_by_size' => [
                    'M' => 8,
                    'L' => 10,
                    'XL' => 7,
                ],
            ],
            [
                'name' => 'Floral Summer Dress',
                'description' => 'Lightweight summer dress with a beautiful floral pattern. Made from breathable cotton blend with an adjustable waist and flowy silhouette. Perfect for warm days and garden parties.',
                'price' => 69.99,
                'image' => 'https://images.unsplash.com/photo-1572804013309-59a88b7e92f1?w=800&q=80', // Floral summer dress
                'category' => 'women',
                'featured' => false,
                'sizes' => ['S', 'M', 'L'],
                'stock_by_size' => [
                    'S' => 15,
                    'M' => 25,
                    'L' => 20,
                ],
            ],
            [
                'name' => 'Minimalist Watch',
                'description' => 'Sleek minimalist watch with a premium stainless steel case and genuine leather strap. Features a clean dial design with precise Japanese movement. A sophisticated accessory for any occasion.',
                'price' => 149.99,
                'image' => 'https://images.unsplash.com/photo-1524805444758-089113d48a6d?w=800&q=80', // Minimalist watch
                'category' => 'accessories',
                'featured' => true,
                'sizes' => ['M'],
                'stock_by_size' => [
                    'M' => 30,
                ],
            ],
            [
                'name' => 'Sustainable Backpack',
                'description' => 'Eco-friendly backpack crafted from recycled materials and sustainable fabrics. Features multiple compartments, laptop sleeve, and water-resistant exterior. Perfect for work, travel, or daily use.',
                'price' => 89.99,
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=800&q=80', // Modern backpack
                'category' => 'accessories',
                'featured' => true,
                'sizes' => ['M', 'L'],
                'stock_by_size' => [
                    'M' => 20,
                    'L' => 20,
                ],
            ],
            [
                'name' => 'Cozy Pullover Hoodie',
                'description' => 'Ultra-soft pullover hoodie made from premium cotton blend. Features a comfortable fit, kangaroo pocket, and embroidered Sigma logo. Perfect for layering during cooler weather.',
                'price' => 49.99,
                'image' => 'https://images.unsplash.com/photo-1556821840-3a63f95609a7?w=800&q=80', // Pullover hoodie
                'category' => 'men',
                'featured' => false,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 20,
                    'M' => 25,
                    'L' => 20,
                    'XL' => 15,
                ],
            ],
            [
                'name' => 'Athletic Performance Tee',
                'description' => 'High-performance athletic t-shirt with moisture-wicking technology. Made from breathable, quick-dry fabric with a comfortable fit. Ideal for workouts, sports, or active lifestyle.',
                'price' => 49.99,
                'image' => 'https://images.unsplash.com/photo-1583743814966-8936f5b7be1a?w=800&q=80', // Athletic tee
                'category' => 'men',
                'featured' => false,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 20,
                    'M' => 25,
                    'L' => 20,
                    'XL' => 15,
                ],
            ],
            [
                'name' => 'Urban Street Hoodie',
                'description' => 'Street-style hoodie with a modern urban aesthetic. Features a relaxed fit, drawstring hood, and side pockets. Made from premium cotton blend for maximum comfort and style.',
                'price' => 49.99,
                'image' => 'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?w=800&q=80', // Urban street hoodie
                'category' => 'men',
                'featured' => true,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 20,
                    'M' => 25,
                    'L' => 20,
                    'XL' => 15,
                ],
            ],
            [
                'name' => 'Casual Crew Neck Sweatshirt',
                'description' => 'Comfortable crew neck sweatshirt perfect for casual wear. Made from soft cotton blend with a relaxed fit and ribbed cuffs. Features a subtle Sigma logo for understated style.',
                'price' => 49.99,
                'image' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=800&q=80', // Crew neck sweatshirt
                'category' => 'men',
                'featured' => false,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 20,
                    'M' => 25,
                    'L' => 20,
                    'XL' => 15,
                ],
            ],
            [
                'name' => 'Premium Zip-Up Hoodie',
                'description' => 'High-quality zip-up hoodie with premium materials and construction. Features a full-zip front, adjustable hood, and side pockets. Perfect for layering and everyday comfort.',
                'price' => 49.99,
                'image' => 'https://images.unsplash.com/photo-1578587018452-892bacefd3f2?w=800&q=80', // Zip-up hoodie
                'category' => 'men',
                'featured' => true,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 20,
                    'M' => 25,
                    'L' => 20,
                    'XL' => 15,
                ],
            ],
        ];

        foreach ($products as $productData) {
            // Create the product
            $product = Product::create([
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'description' => $productData['description'],
                'price' => $productData['price'],
                'image' => $productData['image'],
                'category' => $productData['category'],
                'featured' => $productData['featured'],
            ]);

            // Create size-specific stock records
            foreach ($productData['stock_by_size'] as $size => $stock) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size' => $size,
                    'stock' => $stock,
                ]);
            }
        }
    }
} 