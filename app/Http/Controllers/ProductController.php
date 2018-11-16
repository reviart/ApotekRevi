<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
use App\Category;
use App\Unit;
use App\Cart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products.index', ['products' => Product::orderBy('name', 'asc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create', ['categories' => Category::all(), 'units' => Unit::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->generate_product($request, 0);
        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('products.show', ['product' => Product::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('products.edit', ['product' => Product::findOrFail($id), 'categories' => Category::all(), 'units' => Unit::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->generate_product($request, $id);
        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    function generate_product($request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'required|max:100',
            'stock' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required',
            'unit_id' => 'required'
        ]);

        $id==0 ? $product = new Product : $product = Product::findOrFail($id);
        
        $product->name = strtoupper($request->name);
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->user_id = Auth::id();
        $product->category_id = $request->category_id;
        $product->unit_id = $request->unit_id;
        $product->save();
    }

    public function add_to_cart($id)
    {
        $cart = new Cart;
        $cart->product_id = $id;
        $cart->quantity = 1;
        $cart->save();

        return redirect()->back();
    }
}
