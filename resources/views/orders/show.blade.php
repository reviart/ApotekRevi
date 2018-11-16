@extends('layouts.master')

@section('content')
    <h4 style="margin-top: 10px; margin-bottom: 25px;">Order detail</h4>
    <button type="button" name="button" onclick="history.back()" class="btn btn-default btn-sm">Back</button><br><br>
    <div class="table-responsive">
      <table class="table table-striped table-sm table-hover">
        <thead>
          <tr style="text-align: center;">
            <th>#</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Unit</th>
            <th>Price/unit</th>
            <th>Qty</th>
            <th>Sub-total</th>
          </tr>
        </thead>
        <tbody>
          @php $key=0; @endphp
          @foreach($order_detail as $order)
          <tr>
            <td>{{$key+=1}}</td>
            <td>{{$order->product->name}}</td>
            <td>{{$order->product->category->name}}</td>
            <td>{{$order->product->unit->name}}</td>
            <td>Rp. {{number_format($order->product->price, 2, ',', '.')}}</td>
            <td>{{$order->quantity}}</td>
            <td>Rp. {{ number_format($order->price, 2, ',','.') }}</td>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection
