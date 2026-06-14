@extends('layouts.admin')

@section('title', 'Edit Info')

@section('content')
    @foreach($admin as $row)
    <div style="margin-top:-20px; padding:30px; width:60%; text-align:left; border: 2px solid blue; border-radius:25px; margin-left: 50px;">
    @include('includes.alerts')
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1>Edit Info</h1>
    <form method="post" action="{{ url('admin/update-info/process') }}" class="action_form">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Old Password" name="username" value="{{ $row->Username }}" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter New Password" name="email" value="{{ $row->Email }}" readonly required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    </div>
    </div>
    @endforeach
@endsection
