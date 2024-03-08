<?php



namespace App\Http\Controllers;

use App\Models\Product; 
use App\Models\News;
use Illuminate\View\View;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Count the total number of students
        $studentCount = Product::count();

        // Count the number of active and inactive news
        $activeNewsCount = News::where('status', 'active')->count();
        $inactiveNewsCount = News::where('status', 'inactive')->count();

        // Retrieve the latest products
        $products = Product::latest()->paginate(5);

        return view('auth.dashboard', compact('products', 'studentCount', 'activeNewsCount', 'inactiveNewsCount'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
