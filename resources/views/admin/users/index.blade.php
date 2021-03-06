@extends('layouts.admin')

@section('content')

@if (session('deleted_user'))
  <p class="alert alert-danger">{{session('deleted_user')}}</p>
@endif



    <h1>Admin user page</h1>

    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Photo</th>
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
                        <td><img height="50" src="{{$user->photo ? $user->photo->file : "/images/male-placeholder-image.jpeg"}}" alt=""></td>
                        <td><a href="{{route('admin.users.edit',$user->id)}}">{{$user->name}}</a></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->role ? $user->role->name : "User has no role"}}</td>
                        <td>{{$user->is_active==1?"Active" : "Not Active" }}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                        <td>{{$user->updated_at->diffForHumans()}}</td>
                    </tr>
                @endforeach   
            </tbody>
        @endif
        
      </table>
    
@endsection