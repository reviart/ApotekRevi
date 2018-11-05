@extends('layouts.master')

@section('content')
    <h4 style="margin-top: 10px;">List Products</h4><br>
    
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
    
    <a href="{{route('products.create')}}" class="btn btn-success btn-sm" style="margin: 10px 0px;">Add product</a>
    <div class="table-responsive">
        <table class="table table-striped table-sm table-hover">
          <thead>
            <tr style="text-align: center;">
              <th>#</th>
              <th>Name</th>
              <th>Category</th>
              <th>Stock</th>
              <th>Unit</th>
              <th>Price</th>
              <th colspan="4">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $key => $product)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$product->name}}</td>
              <td>{{$product->category->name}}</td>
              <td>{{$product->stock}}</td>
              <td>{{$product->unit->name}}</td>
              <td>Rp. {{number_format($product->price, 2, ',', '.')}}</td>
              <td width="5%">
                @php
                  $product->cart ? $option = 'disabled' : $option = '';
                @endphp
                <form action="{{route('products.add_to_cart', [$product->id])}}" method="POST">
                  @csrf
                  <button type="submit" name="button" class="btn btn-success btn-sm" {{$option}}>Add to cart</button>
                </form>
              </td>
              <td width="5%"><a href="{{route('products.show', [$product->id])}}" class="btn btn-primary btn-sm">Detail</a></td>
              @if(Auth::user()->status == 1)
                <td width="5%"><a href="{{route('products.edit', [$product->id])}}" class="btn btn-warning btn-sm">Edit</a></td>
                <td width="5%">
                  <form class="" action="{{route('products.destroy', [$product->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" name="button" onclick="return confirm('Are you sure to delete {{$product->name}} ?')" class="btn btn-danger btn-sm">Delete</button>
                  </form>
                </td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection
