@extends('layouts.app')

@section('title', 'Form tambah users')

@section('contents')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@csrf
<div>
    <form action="/ubahh/{{$users->id}}" method="post">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">edit data user</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama </label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$users->name}}">
                        </div>
                        <div class=" form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$users->email}}">
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select id="role" name="role" class="form-control" value="{{$users->role}}">
                                <option value=" admin">Admin</option>
                                <option value="petugas">Petugas</option>
                            </select>
                        </div>

                        <div class=" form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="/user" class="btn btn-danger">Kembali</a>
                        <button type=" submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endsection