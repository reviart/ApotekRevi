@extends('layouts.master')
@section('content')
	<h4 style="margin-top: 10px; margin-bottom: 25px;">Detail Customer</h4>
	<button type="button" name="button" onclick="history.back()" class="btn btn-dark btn-sm">Back</button>
	<br><br>
	<table class="table table-hover table-sm table-striped">
	    <tr>
	    	<th style="width: 200px;">Name</th>
	    	<td>{{$customer->name}}</td>
	    </tr>
	    <tr>
	    	<th>Email</th>
	    	<td>{{$customer->email}}</td>
	    </tr>
	    <tr>
	    	<th>Phone number</th>
	    	<td>{{$customer->phone_number}}</td>
	    </tr>
	    <tr>
	    	<th>Address</th>
	    	<td>{{$customer->address}}</td>
	    </tr>
	    <tr>
	    	<th>Created by</th>
	    	<td>{{$customer->user->name}}</td>
	    </tr>
	    <tr>
	    	<th>Created at</th>
	    	<td>{{$customer->created_at->format('d, M Y H:i')}}</td>
	    </tr>
	    <tr>
	    	<th>Updated at</th>
	    	<td>{{$customer->updated_at->format('d, M Y H:i')}}</td>
	    </tr>
	</table><br><br>

	<h4>{{ucfirst(strtolower($customer->name))}}'s Transaction</h4><br>
	<div class="table-responsive">
      <table class="table table-striped table-sm table-hover">
        <thead>
          <tr style="text-align: center;">
            <th>#</th>
            <th>Invoice No</th>
            <th>Admin</th>
            <th>Total Cost</th>
            <th>Tend Cash</th>
            <th>Change Due</th>
            <th>Created at</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $key => $order)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$order->invoice}}</td>
            <td>{{$order->user->name}}</td>
            <td>Rp. {{number_format($order->total_cost, 2, ',', '.')}}</td>
            <td>Rp. {{number_format($order->cash, 2, ',', '.')}}</td>
            <td>Rp. {{number_format($order->remaining_cost, 2, ',', '.')}}</td>
            <td>{{$order->created_at->format('d, M Y H:i')}}</td>
            <td width="5%"><a href="{{route('orders.show', [$order->id])}}" class="btn btn-primary btn-sm"><span data-feather="eye"></span></a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
@endsection