@extends('layouts.master')

@section('content')
    <h4 style="margin-top: 10px;">List Employee</h4><br>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Full name</th>
              <th>Email</th>
              <th>Current login</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $key => $user)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>-</td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>
@endsection
