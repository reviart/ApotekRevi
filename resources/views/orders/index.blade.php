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
            <th>Invoice No</th>
            <th>Customer Name</th>
            <th>Admin</th>
            <th>Total Cost</th>
            <th>Tend Cash</th>
            <th>Change Due</th>
            <th>Created at</th>
            <th colspan="2">Action</th>
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
            <td width="5%"><a href="{{route('orders.show', [$order->id])}}" class="btn btn-primary btn-sm"><span data-feather="eye"></span></a></td>
            <td width="5%"><a href="{{route('orders.print_bill', [$order->id])}}" target="_blank" class="btn btn-primary btn-sm"><span data-feather="printer"></span></a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection
