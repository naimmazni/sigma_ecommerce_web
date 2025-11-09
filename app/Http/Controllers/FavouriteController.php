<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $favourites = auth()->user()->favourites()->with('product')->latest()->get();
        return view('favourites.index', compact('favourites'));
    }

    public function toggle($productId)
    {
        $user = auth()->user();
        
        // Find the product by ID
        $product = Product::findOrFail($productId);
        
        $favourite = Favourite::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($favourite) {
            $favourite->delete();
            return response()->json([
                'status' => 'removed',
                'message' => 'Removed from favourites'
            ]);
        } else {
            Favourite::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
            return response()->json([
                'status' => 'added',
                'message' => 'Added to favourites'
            ]);
        }
    }

    public function destroy(Favourite $favourite)
    {
        // Ensure the user owns this favourite
        if ($favourite->user_id !== auth()->id()) {
            abort(403);
        }

        $favourite->delete();

        return redirect()->route('favourites.index')
            ->with('success', 'Removed from favourites');
    }
}
