@extends('layouts.master')
@section('content')
	<h4 style="margin-top: 10px; margin-bottom: 25px;">Detail Product</h4>

	<table>
		<tr>
			<td><a href="{{route('products.create')}}" class="btn btn-primary btn-sm" style="margin: 10px 0px;">Add product</a></td>
			<td>
				@php
			      $product->cart ? $option = 'disabled' : $option = '';
			    @endphp
				<form action="{{route('products.add_to_cart', [$product->id])}}" method="POST">
			        @csrf
					<button type="submit" name="button" class="btn btn-success btn-sm" {{$option}}>Add to cart</button>
				</form>
			</td>
			<td>
				@if(Auth::user()->status == 1)
				<a href="{{route('products.edit', [$product->id])}}" class="btn btn-warning btn-sm">Edit</a>
				@endif
			</td>
			<td><button type="button" name="button" onclick="history.back()" class="btn btn-default btn-sm">Back</button></td>
		</tr>	
	</table>

	<table class="table table-hover table-sm table-striped">
	    <tr>
	    	<th style="width: 200px;">Category</th>
	    	<td>{{$product->category->name}}</td>
	    </tr>
	    <tr>
	    	<th>Name</th>
	    	<td>{{$product->name}}</td>
	    </tr>
	    <tr>
	    	<th>Description</th>
	    	<td>{{$product->description}}</td>
	    </tr>
	    <tr>
	    	<th>Stock</th>
	    	<td>{{$product->stock}}</td>
	    </tr>
	    <tr>
	    	<th>Unit</th>
	    	<td>{{$product->unit->name}}</td>
	    </tr>
	    <tr>
	    	<th>Price/unit</th>
	    	<td>Rp. {{number_format($product->price, 2, ',', '.')}}</td>
	    </tr>
	    <tr>
	    	<th>Created by</th>
	    	<td>{{$product->user->name}}</td>
	    </tr>
	    <tr>
	    	<th>Created at</th>
	    	<td>{{$product->created_at->format('d, M Y H:i')}}</td>
	    </tr>
	    <tr>
	    	<th>Updated at</th>
	    	<td>{{$product->updated_at->format('d, M Y H:i')}}</td>
	    </tr>
	</table>
@endsection