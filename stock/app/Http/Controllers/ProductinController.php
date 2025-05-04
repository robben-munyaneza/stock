<?php

namespace App\Http\Controllers;

use App\Models\Productin;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productins = Productin::all();
        return view('pages.productin.index', compact('productins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all(); // Get all products
        return view('pages.productin.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        $validated = $request->validate([
            'pcode' => 'required|exists:products,pcode',
            'productin_date' => 'required|date',
            'productin_quantity' => 'required|integer|min:1',
            'productin_unitprice' => 'required|numeric|min:0',
        ]);
    
        $totalprice = $validated['productin_quantity'] * $validated['productin_unitprice'];
    
        $productins = new Productin();
        $productins->pcode = $validated['pcode'];
        $productins->productin_date = $validated['productin_date'];
        $productins->productin_quantity = $validated['productin_quantity'];
        $productins->productin_unitprice = $validated['productin_unitprice'];
        $productins->productin_totalprice = $totalprice; // ✅ Add this line
        $productins->save();
    
        return redirect()->route('productin.index')->with('success', 'The product-in was added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Productin $productins)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $productin = Productin::findOrFail($id);
        $products = Product::all();  
        return view('pages.productin.edit', compact('productin', 'products'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'pcode' => 'required|exists:products,pcode',
            'productin_date' => 'required|date',
            'productin_quantity' => 'required|integer|min:1',
            'productin_unitprice' => 'required|numeric|min:0',
            'productin_totalprice' => 'required|numeric|min:0',
        ]);

        $productins = Productin::findOrFail($id);
        $productins->pcode = $request->pcode;
        $productins->productin_date = $request->productin_date;
        $productins->productin_quantity = $request->productin_quantity;
        $productins->productin_unitprice = $request->productin_unitprice;
        $productins->productin_totalprice = $request->productin_totalprice;
        $productins->save();

        return redirect()->route('productin.index')->with('success','the productin added successfull');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)

    {
        $productins = Productin::findOrFail($id);
        $productins->delete();
        return redirect()->route('productin.index')->with('success', 'the product is deleted successfully');
        
    }
}
