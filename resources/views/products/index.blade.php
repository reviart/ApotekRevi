@extends('layouts.master')

@section('content')
    <h4 style="margin-top: 10px;">Products</h4><br>
    
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
              <th>Price(unit)</th>
              <th colspan="4">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($products as $key => $product)
            <tr>
              <td></td>
              <td>{{$product->name}}</td>
              <td>{{$product->category->name}}</td>

              <?php
                $stock = $product->stock;
                if ($stock <= 25) {
                  $badge = 'badge-danger';
                }
                elseif ($stock > 25 and $stock <= 50) {
                  $badge = 'badge-warning';
                }
                else{
                  $badge = 'badge-success';
                }
              ?>

              <td><span class="badge {{$badge}}">{{$stock}}</span></td>
              <td>{{$product->unit->name}}</td>
              <td>@money($product->price)</td>
              <td width="5%">
                @php
                  $product->cart ? $option = 'disabled' : $option = '';
                @endphp
                <form action="{{route('products.add_to_cart', [$product->id])}}" method="POST">
                  @csrf
                  <button type="submit" name="button" class="btn btn-success btn-sm" {{$option}}>Add to cart</button>
                </form>
              </td>
              <td width="3%"><a href="{{route('products.show', [$product->id])}}" class="btn btn-primary btn-sm"><span data-feather="eye"></span></a></td>
              @if(Auth::user()->status == 1)
                <td width="3%"><a href="{{route('products.edit', [$product->id])}}" class="btn btn-warning btn-sm"><span data-feather="edit"></span></a></td>
                <td width="3%">
                  <form class="" action="{{route('products.destroy', [$product->id])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" name="button" onclick="return confirm('Are you sure to delete {{$product->name}} ?')" class="btn btn-danger btn-sm"><span data-feather="trash-2"></span></button>
                  </form>
                </td>
              @endif
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
