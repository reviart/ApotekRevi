@extends('layouts.master')
@section('content')
	<h4 style="margin-top: 10px; margin-bottom: 50px;">Edit Product</h4>
	<form method="POST" action="{{route('products.update', [$product->id])}}">
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		@csrf
		@method('PUT')
		<div class="form-group row">
		    <label class="col-sm-2 col-form-label">Category</label>
		    <div class="col-sm-6">
		    	<select class="form-control" name="category_id" required>
                  <option value="{{ $product->category->id }}">{{ $product->category->name }}</option>
                  @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
			</div>
		</div>
		<div class="form-group row">
		    <label class="col-sm-2 col-form-label">Name</label>
		    <div class="col-sm-6">
		    	<input class="form-control" name="name" required value="{{$product->name}}">
			</div>
		</div>
		<div class="form-group row">
		    <label class="col-sm-2 col-form-label">Description</label>
		    <div class="col-sm-6">
		    	<input class="form-control" name="description" required value="{{$product->description}}">
			</div>
		</div>
		<div class="form-group row">
		    <label class="col-sm-2 col-form-label">Stock</label>
		    <div class="col-sm-6">
		    	<input class="form-control" name="stock" type="number" required value="{{$product->stock}}">
			</div>
		</div>
		<div class="form-group row">
		    <label class="col-sm-2 col-form-label">Unit</label>
		    <div class="col-sm-6">
		    	<select class="form-control" name="category_id" required>
                  <option value="{{ $product->unit->id }}">{{ $product->unit->name }}</option>
                  @foreach($units as $unit)
                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                  @endforeach
                </select>
			</div>
		</div>
		<div class="form-group row">
		    <label class="col-sm-2 col-form-label">Price (Rupiah)</label>
		    <div class="col-sm-6">
		    	<input class="form-control" name="price" type="number" placeholder="155000" required value="{{$product->price}}">
			</div>
		</div>
		<div class="form-group row">
		    <div class="col-sm-2"></div>
		    <div class="col-sm-6">
		    	<input type="submit" name="submit" value="Submit" onclick="return confirm('Has the data been filled in correctly?')" class="btn btn-primary btn-sm">
                <button type="button" name="button" onclick="history.back()" class="btn btn-warning btn-sm">Cancel</button>
			</div>
		</div>
	</form>
@endsection