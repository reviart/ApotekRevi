<?php

namespace App\Http\Controllers;

use Auth;
use App\Cart;
use App\Order;
use App\OrderDetail;
use App\Customer;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.index', ['orders' => Order::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Cart::count() <= 0) {
            return redirect()->route('carts.index')->with('warning', 'The cart cannot be empty!');
        }elseif ($request->cash < $request->total_cost) {
            return redirect()->route('carts.index')->with('warning', 'The cash has to be at least total cost!');
        }
        else{}

        $request->validate([
            'total_cost' => 'required|numeric|min:0',
            'cash' => 'required|numeric|min:0',
            'customer_id' => 'required',
        ]);

        $order = new Order;
        $order->invoice = $this->generate_invoice($request);
        $order->customer_id = $request->customer_id;
        $order->user_id = Auth::id();
        $order->total_cost = $request->total_cost;
        $order->cash = $request->cash;
        $order->remaining_cost = ($request->cash - $request->total_cost);
        $order->save();

        $this->generate_order_detail();
        Cart::truncate();
        return redirect()->route('orders.index')->with('success', 'Order success, thank you Mr.'.ucfirst(strtolower(Customer::find($request->customer_id)->name)).'!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('orders.show', ['order_detail' => OrderDetail::all()->where('order_id',$id)]);
    }

    private function generate_order_detail()
    {
        $order_id = Order::all()->last()->id;
        foreach (Cart::all() as $key => $value) {
            $order_detail = new OrderDetail;
            $order_detail->order_id = $order_id;
            $order_detail->product_id = $value->product_id;
            $order_detail->quantity = $value->quantity;
            $order_detail->price = ($value->product->price * $value->quantity);
            $order_detail->save();

            $product = Product::find($value->product_id);
            $product->stock = ($product->stock - $value->quantity);
            $product->save();
        }
    }

    private function generate_invoice($request)
    {
        $phone_number = substr(Customer::findOrFail($request->customer_id)->phone_number, -4);
        $invoice = "INV/".$phone_number."/".(Order::count()+1);
        return $invoice;
    }
}
