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

    public function __construct()
    {
        $this->middleware('auth');
    }
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
    // public function store(Request $request): RedirectResponse
    // {
    //     // dd('Zdravo Jas ucham laravel');
    //     // dd($request);
    //     $request->validate([
    //         'name' => 'required',
    //         'detail' => 'required',
    //     ]);
        
    //     Product::create($request->all());
         
    //     return redirect()->route('products.index')
    //                     ->with('success','Product created successfully.');
    // }





//    

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
        $image->storeAs('public', $imageName,);

        // Save the image name to the database
        Product::create([
            'name' => $request->input('name'),
            'detail' => $request->input('detail'),
            'image' => $imageName,
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'status' => $request->input('status'),
            'dob' => $request->input('dob')
            // Add other fields as needed
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    return redirect()->back()->with('error', 'Failed to upload image.');
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