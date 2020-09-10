<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Stap 2: Maak je controllers

    //Gedeeltelijk automatisch gegenereerd
    //  php artisan make:controller ProductController --resource --model=Product


    //Laad de products view (Lijst met producten)
    public function index()
    {
        $products = Product::latest()->paginate(5);
  
        return view('products.index',compact('products'));
    }
   
    //Opent de create view
    public function create()
    {
        return view('products.create');
    }
  
    //Functie voor het aanmaken van een product
    //Redirect automatisch naar index met parameter van goedkeuring
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
  
        Product::create($request->all());
   
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }
   
    //Laat een product zien met de show view
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }
   
    //Laat een product zien met de update view
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }
  
    //Werkt een product bij, en stuurt je door naar index met een update.
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
  
        $product->update($request->all());
  
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
  
    //Verwijderd een product uit de database (Hard-delete!)
    public function destroy(Product $product)
    {
        $product->delete();
  
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
