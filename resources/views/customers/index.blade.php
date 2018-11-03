@extends('layouts.master')

@section('content')
    <h4 style="margin-top: 10px;">List Customers</h4><br>
    
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
    
    <a href="{{route('customers.create')}}" class="btn btn-success btn-sm" style="margin: 10px 0px;">Add customer</a>
    <div class="table-responsive">
        <table class="table table-striped table-sm table-hover">
          <thead>
            <tr style="text-align: center;">
              <th>#</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone number</th>
              <th>Address</th>
              <th colspan="3">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($customers as $key => $customer)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$customer->name}}</td>
              <td>{{$customer->email}}</td>
              <td>{{$customer->phone_number}}</td>
              <td>{{$customer->address}}</td>
              <td width="5%"><a href="{{route('customers.show', [$customer->id])}}" class="btn btn-primary btn-sm">Detail</a></td>
              <td width="5%"><a href="{{route('customers.edit', [$customer->id])}}" class="btn btn-warning btn-sm">Edit</a></td>
              <td width="5%">
                @if(Auth::user()->status == 1)
                <form class="" action="{{route('customers.destroy', [$customer->id])}}" method="post">
                  @csrf
                  {{ method_field('DELETE') }}
                  <button type="submit" name="button" onclick="return confirm('Are you sure to delete {{$customer->name}} ?')" class="btn btn-danger btn-sm">Delete</button>
                </form>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection
