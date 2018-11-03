@extends('layouts.master')
@section('content')
	<h4 style="margin-top: 10px; margin-bottom: 50px;">Detail Customer</h4>
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
	</table>
	<br><br>
	<h4>{{ucfirst(strtolower($customer->name))}}'s Transaction</h4>
@endsection