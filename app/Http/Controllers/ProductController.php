<?php
  
namespace App\Http\Controllers;
  
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


  
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(5);
        
        return view('products.index',compact('products'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
  
    /**
     * Show the form for creating a new resource.
     */

     public function create()
    {
        // Check if the user is authenticated
        // if (Auth::check()) {
            
            return view('products.create');
        // } else {
            
        //     return redirect()->route('login')->with('error', 'You need to be logged in to create a product.');
        // }
    }


  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // dd('Zdravo Jas ucham laravel');
        // dd($request);
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
        
        Product::create($request->all());
         
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
  

  

    public function show($id)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            
            $product = Product::find($id);

            
            if ($product) {
                // Product found, pass it to the view
                return view('products.show', ['product' => $product]);
            } else {
                
                return redirect()->route('dashboard')->with('error', 'Product not found.');
            }
        } else {
            
            return redirect()->route('login')->with('error', 'You need to be logged in to view this product.');
        }
    }
    

    public function edit($id)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            
            $product = Product::find($id);

            if ($product) {
                
                return view('products.edit', ['product' => $product]);
            } else {
                
                return redirect()->route('dashboard')->with('error', 'Product not found.');
            }
        } else {
            
            return redirect()->route('login')->with('error', 'You need to be logged in to edit a product.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
        
        $product->update($request->all());
        
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
         
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}