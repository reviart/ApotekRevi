@extends('layouts.master')

@section('content')
    <h4 style="margin-top: 10px;">List Categories</h4><br>
    
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
    
    <a href="{{route('categories.create')}}" class="btn btn-success btn-sm" style="margin: 10px 0px;">Add category</a>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr style="text-align: center;">
              <th>#</th>
              <th>Name</th>
              <th>Description</th>
              <th>Created by</th>
              <th>Created at</th>
              <th>Updated at</th>
              <th colspan="2">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($categories as $key => $category)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$category->name}}</td>
              <td>{{$category->description}}</td>
              <td>{{$category->user->name}}</td>
              <td>{{$category->created_at->format('d, M Y H:i')}}</td>
              <td>{{$category->updated_at->format('d, M Y H:i')}}</td>
              <td width="5%"><a href="{{route('categories.edit', [$category->id])}}" class="btn btn-warning btn-sm">Edit</a></td>
              <td width="5%">
                @if(Auth::user()->status == 1)
                <form class="" action="{{route('categories.destroy', [$category->id])}}" method="post">
                  @csrf
                  {{ method_field('DELETE') }}
                  <button type="submit" name="button" onclick="return confirm('Are you sure to delete {{$category->name}} ?')" class="btn btn-danger btn-sm">Delete</button>
                </form>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection
