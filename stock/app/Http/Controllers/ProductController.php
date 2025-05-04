<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::all();

        return view('pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
         'pname' => 'required|string'   
        ]);

        $product = new Product();
        $product->pname = $request->input('pname');
        $product->save();
        return redirect()->route('products.index')->with('success', 'product  create Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($pcode )
    {
      
    $products = Product::findOrFail($pcode);
    return view('pages.products.edit', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $pcode)
    {
        
        $request->validate([
         
            'pname' => 'required|string'   
           ]);

           $products = Product::findOrFail($pcode);

        $products->pname = $request->input('pname');
        $products->save();
        return redirect()->route('products.index')->with('success', 'product  updated Successfully!');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($pcode)
    {
       $products = Product::findOrFail($pcode);

       $products->delete();

       return redirect()->route('products.index')->with('success', 'product deleted successfully');
    }
}
