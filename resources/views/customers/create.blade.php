@extends('layouts.master')
@section('content')
	<h4 style="margin-top: 10px; margin-bottom: 50px;">Create Customer</h4>
	<form method="POST" action="{{route('customers.store')}}">
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
		<div class="form-group row">
		    <label class="col-sm-2 col-form-label">Name</label>
		    <div class="col-sm-6">
		    	<input class="form-control" name="name" required>
			</div>
		</div>
		<div class="form-group row">
		    <label class="col-sm-2 col-form-label">Email</label>
		    <div class="col-sm-6">
		    	<input class="form-control" name="email" type="email">
			</div>
		</div>
		<div class="form-group row">
		    <label class="col-sm-2 col-form-label">Phone number</label>
		    <div class="col-sm-6">
		    	<input class="form-control" name="phone_number" type="number" placeholder="ex: 0812xxxxxxxx" required>
			</div>
		</div>
		<div class="form-group row">
		    <label class="col-sm-2 col-form-label">Address</label>
		    <div class="col-sm-6">
		    	<input class="form-control" name="address" required>
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