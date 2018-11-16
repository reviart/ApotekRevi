@extends('layouts.master')

@section('content')
    <h4 style="margin-top: 10px;">Carts</h4><br>
    
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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
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
            <th colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          @php $total_cost=0; @endphp
          @foreach($carts as $key => $cart)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$cart->product->name}}</td>
            <td>{{$cart->product->category->name}}</td>
            <td>{{$cart->product->unit->name}}</td>
            <td>Rp. {{number_format($cart->product->price, 2, ',', '.')}}</td>
            <td>{{$cart->quantity}}</td>
            <td>Rp. {{ number_format(($cart->quantity)*($cart->product->price), 2, ',','.') }}</td>
            <td width="5%">
              <button type="button" class="btn btn-warning btn-sm open-editCart" data-toggle="modal" data-target="#editModal" data-cart-qty="{{$cart->quantity}}" data-cart-id="{{$cart->id}}"><span data-feather="edit"></span></button>
            </td>
            <td width="5%">
              <form class="" action="{{route('carts.destroy', [$cart->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" name="button" onclick="return confirm('Are you sure to delete cart {{$cart->product->name}} ?')" class="btn btn-danger btn-sm"><span data-feather="trash-2"></span></button>
              </form>
            </td>

            @php $total_cost += ($cart->product->price*$cart->quantity); @endphp
          </tr>
          @endforeach
        </tbody>
      </table>
    </div><br>
    
    <h4>Transaction</h4><br>

    <form method="POST" action="{{route('orders.store')}}">
      @csrf
      <div class="form-group row">
          <label class="col-sm-2 col-form-label">Customer</label>
          <div class="col-sm-6">
            <select class="form-control" name="customer_id" required>
              <option value="">choose customer</option>
              @foreach($customers as $customer)
                <option value="{{$customer->id}}">{{$customer->name}}</option>
              @endforeach
            </select>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-sm-2 col-form-label">Total cost</label>
          <div class="col-sm-6">
            <input class="form-control" name="total_cost" value="{{$total_cost}}" readonly>
          </div>
      </div>
      <div class="form-group row">
          <label class="col-sm-2 col-form-label">Tend Cash</label>
          <div class="col-sm-6">
            <input class="form-control" type="number" name="cash" placeholder="ex: 155000" required>
          </div>
      </div>
      <div class="form-group row">
          <div class="col-sm-2"></div>
          <div class="col-sm-6">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm" onclick="return confirm('Has the data been filled in correctly? and finish transaction?')">
          </div>
      </div>
    </form>

    <!-- editModal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModallabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form method="POST" action="{{route('carts.update')}}">
            @csrf
            @method('PUT')
            <div class="modal-header">
              <h5 class="modal-title" id="editModallabel">Edit Cart</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Quantity</label>
                  <div class="col-sm-10">
                    <input type="hidden" name="cart_id" id="cart_id">
                    <input class="form-control" name="qty" id="qty" type="number" required>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <input type="submit" name="submit" value="Save changes" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>

    <script type="text/javascript">
    $(function(){
      $(".open-editCart").click(function(){
        $('#cart_id').val($(this).data('cart-id'));
        $('#qty').val($(this).data('cart-qty'));
        $("#editModal").modal("show");
      });
    });
    </script>
@endsection
