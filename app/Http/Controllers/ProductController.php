<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add other validation rules as needed
        ]);

        // Process the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Generate a unique name for the image
            $imageName = $image->getClientOriginalName();

            // Store the image in the 'public' disk
            $image->storeAs('public', $imageName);

            // Save the image name to the database
            Product::create([
                'name' => $request->input('name'),
                'detail' => $request->input('detail'),
                'image' => $imageName,
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'status' => $request->input('status'),
                'dob' => $request->input('dob'),
                // Add other fields as needed
            ]);

            return redirect()->route('products.index')->with('success', 'Student created successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload image.');
    }

    public function show($id)
    {
        if (Auth::check()) {
            $product = Product::find($id);

            if ($product) {
                return view('products.show', ['product' => $product]);
            } else {
                return redirect()->route('dashboard')->with('error', 'Student not found.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to be logged in to view this student.');
        }
    }

    public function edit($id)
    {
        if (Auth::check()) {
            $product = Product::find($id);

            if ($product) {
                return view('products.edit', ['product' => $product]);
            } else {
                return redirect()->route('dashboard')->with('error', 'Student not found.');
            }
        } else {
            return redirect()->route('login')->with('error', 'You need to be logged in to edit a product.');
        }
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }

            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();

            // Store the new image in the 'public' disk
            $image->storeAs('public', $imageName);

            // Update the product with the new image name
            $product->update([
                'name' => $request->input('name'),
                'detail' => $request->input('detail'),
                'image' => $imageName,
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'status' => $request->input('status'),
                'dob' => $request->input('dob'),
                
            ]);

            return redirect()->route('products.index')->with('success', 'Student updated successfully with a new image.');
        }

        // No new image uploaded, update other fields without touching the image
        $product->update([
            'name' => $request->input('name'),
            'detail' => $request->input('detail'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'status' => $request->input('status'),
            'dob' => $request->input('dob'),
            
        ]);

        return redirect()->route('products.index')->with('success', 'Student updated successfully without changing the image.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        // Delete the product image if it exists
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        // Delete the product
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}