<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use App\Customer;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('carts.index', ['carts' => Cart::all(), 'customers' => Customer::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1',
        ]);

        $cart = Cart::findOrFail($request->cart_id);
        if ($request->qty > $cart->product->stock){
            return redirect()->route('carts.index')->with('warning', 'Item quantity must not exceed stock!');
        }
        $cart->quantity = $request->qty;
        $cart->save();
        return redirect()->route('carts.index')->with('success', 'Quantity updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::findOrFail($id)->delete();
        return redirect()->route('carts.index')->with('success', 'Cart deleted successfully!');
    }
}
