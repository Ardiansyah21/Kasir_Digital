@extends('layouts.app')

@section('title', 'Data User')

@section('contents')

<div class="info">
    @if(session('successs'))
    <div class="alert alert-success">
        {{ session('successs') }}
    </div>
    @endif
    @if (Session::get('successDelete'))
    <div class="alert alert-danger w-32 h-10">
        {{ Session::get('successDelete') }}
    </div>
    @endif
    @if (Session::get('successEditUser'))
    <div class="alert alert-success w-32 h-10">
        {{ Session::get('successEditUser') }}
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <div class="card-body">
            <a href="/register" class="btn btn-primary mb-3">Tambah data user</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($users as $user)
                        <tr>
                            <th>{{ $no++ }}</th>
                            <td>{{ $user['name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['role'] }}</td>
                            <td>
                                <a href="/editt/{{$user->id}}" class="btn btn-warning">Edit</a>
                                <form action="/hapuss/{{$user->id}}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class=" btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
    @endsection