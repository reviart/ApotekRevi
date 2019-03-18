@extends('layouts.master')

@section('content')
    <h4 style="margin-top: 10px;">Units</h4><br>
    
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
    
    <a href="{{route('units.create')}}" class="btn btn-success btn-sm" style="margin: 10px 0px;">Add unit</a>
    <div class="table-responsive">
        <table class="table table-striped table-sm table-hover">
          <thead>
            <tr style="text-align: center;">
              <th>#</th>
              <th>Name</th>
              <th>Created by</th>
              <th>Created at</th>
              <th>Updated at</th>
              <th colspan="2">Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($units as $key => $unit)
            <tr>
              <td></td>
              <td>{{$unit->name}}</td>
              <td>{{$unit->user->name}}</td>
              <td>{{$unit->created_at->format('d, M Y H:i')}}</td>
              <td>{{$unit->updated_at->format('d, M Y H:i')}}</td>
              <td width="5%"><a href="{{route('units.edit', [$unit->id])}}" class="btn btn-warning btn-sm"><span data-feather="edit"></span></a></td>
              <td width="5%">
                @if(Auth::user()->status == 1)
                <form class="" action="{{route('units.destroy', [$unit->id])}}" method="post">
                  @csrf
                  {{ method_field('DELETE') }}
                  <button type="submit" name="button" onclick="return confirm('Are you sure to delete {{$unit->name}} ?')" class="btn btn-danger btn-sm"><span data-feather="trash-2"></span></button>
                </form>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection
