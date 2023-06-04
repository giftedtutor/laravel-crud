<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->input('records', 10); // Default value is 10 if 'records' parameter is not provided
    
        $products = Product::paginate($perPage);
    
        return response()->json(['Products' => $products]);
        // return response()->json($products);
    }
    

    public function create()
    {
        // Return any necessary data or view for product creation
        // For example:
        return response()->json(['message' => 'Create product view']);
    }

    public function store(Request $request)
    {
        try {
            // Validate the request data if needed
    
            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->save();
    
            return response()->json(['status' => 'success', 'message' => 'Product created successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    
    public function edit(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        try {
            // Validate the request data if needed
    
            $validatedData = $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|numeric',
            ]);
    
            $product->name = $validatedData['name'];
            $product->description = $validatedData['description'];
            $product->price = $validatedData['price'];
            $product->save();
    
            return response()->json(['status' => 'success', 'message' => 'Product updated successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
    
    

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['status' => 'success', 'message' => 'Product deleted successfully']);
    }
}