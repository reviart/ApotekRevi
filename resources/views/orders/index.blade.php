@extends('layouts.master')

@section('content')
    <h4 style="margin-top: 10px;">Orders</h4><br>
    
    @if (session('success'))
        <div class="alert alert-success">
          <center>
            {{ session('success') }}
          </center>
        </div>
    @elseif (session('warning'))
        <div class="alert alert-warning">
          <center>
            {{ session('warning') }}
          </center>
        </div>
    @else
    @endif
    
    <div class="table-responsive">
      <table class="table table-striped table-sm table-hover">
        <thead>
          <tr style="text-align: center;">
            <th>#</th>
            <th>Invoice</th>
            <th>Name</th>
            <th>Admin</th>
            <th>Total Cost</th>
            <th>Cash</th>
            <th>Remaining Cost</th>
            <th>Created at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $key => $order)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$order->invoice}}</td>
            <td>{{$order->customer->name}}</td>
            <td>{{$order->user->name}}</td>
            <td>Rp. {{number_format($order->total_cost, 2, ',', '.')}}</td>
            <td>Rp. {{number_format($order->cash, 2, ',', '.')}}</td>
            <td>Rp. {{number_format($order->remaining_cost, 2, ',', '.')}}</td>
            <td>{{$order->created_at->format('d, M Y H:i')}}</td>
            <td width="5%"><a href="{{route('orders.show', [$order->id])}}" class="btn btn-primary btn-sm">Detail</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection
