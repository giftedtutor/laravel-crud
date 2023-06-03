<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function create()
    {
        // Return any necessary data or view for product creation
        // For example:
        return response()->json(['message' => 'Create product view']);
    }

    public function store(Request $request)
    {
        // Validate the request data if needed

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        return response()->json(['message' => 'Product created successfully']);
    }
    public function edit(Product $product)
    {
        return response()->json($product);
    }
    public function update(Request $request, Product $product)
    {
        // Validate the request data if needed

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        return response()->json(['message' => 'Product updated successfully']);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}