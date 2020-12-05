@extends('layouts.admin')

@section('content')

    <h1>Admin user page</h1>

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">E-mail</th>
            <th scope="col">Role</th>
            <th scope="col">Status</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
          </tr>
        </thead>
        @if ($users)
            <tbody>
                @foreach ($users as $user)
                    <tr>      
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role->name}}</td>
                        <td>{{$user->is_active==1?"Active" : "Not Active" }}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                    </tr>
                @endforeach   
            </tbody>
        @endif
        
      </table>
    
@endsection