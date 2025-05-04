<?php

namespace App\Http\Controllers;

use App\Models\Productout;
use App\Models\Product; // Ensure you import this
use Illuminate\Http\Request;

class ProductoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productouts = Productout::with('productin')->get(); // Use relationship if available
        return view('pages.productouts.index', compact('productouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('pages.productouts.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pcode' => 'required|exists:products,pcode',
            'productout_date' => 'required|date',
            'productout_quantity' => 'required|integer|min:1',
            'productout_unitprice' => 'required|numeric|min:0',
        ]);

        $totalprice = $validated['productout_quantity'] * $validated['productout_unitprice'];

        $productout = new Productout();
        $productout->pcode = $validated['pcode'];
        $productout->productout_date = $validated['productout_date'];
        $productout->productout_quantity = $validated['productout_quantity'];
        $productout->productout_unitprice = $validated['productout_unitprice'];
        $productout->productout_totalprice = $totalprice;
        $productout->save();

        return redirect()->route('productout.index')->with('success', 'The product-out was added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $productout = Productout::with('productin')->findOrFail($id);
        return view('pages.productouts.show', compact('productout'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $productout = Productout::findOrFail($id);
        $products = Product::all();
        return view('pages.productouts.edit', compact('productout', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pcode' => 'required|exists:products,pcode',
            'productout_date' => 'required|date',
            'productout_quantity' => 'required|integer|min:1',
            'productout_unitprice' => 'required|numeric|min:0',
        ]);

        $totalprice = $validated['productout_quantity'] * $validated['productout_unitprice'];

        $productout = Productout::findOrFail($id);
        $productout->pcode = $validated['pcode'];
        $productout->productout_date = $validated['productout_date'];
        $productout->productout_quantity = $validated['productout_quantity'];
        $productout->productout_unitprice = $validated['productout_unitprice'];
        $productout->productout_totalprice = $totalprice;
        $productout->save();

        return redirect()->route('productout.index')->with('success', 'The product-out was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $productout = Productout::findOrFail($id);
        $productout->delete();
        return redirect()->route('productout.index')->with('success', 'The product-out was deleted successfully');
    }
}
