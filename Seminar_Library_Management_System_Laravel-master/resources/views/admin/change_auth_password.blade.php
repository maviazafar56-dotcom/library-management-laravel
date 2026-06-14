@extends('layouts.admin')

@section('title', 'Change Password')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style5.css') }}">
@endsection

@section('content')
    <div style="margin-top:40px; text-align:left; border: 2px solid blue; border-radius:25px; padding:30px; width:50%; margin-left: 100px;">
    @include('includes.alerts')
    <h1 style="padding-bottom:20px; color:blue"> Change Password </h1>
    <form method="post" action="{{ url('admin/change-auth-password/process') }}" class="action_form">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Old Password</label>
            <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Old Password" name="old_password" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">New Password</label>
            <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter New Password" name="new_password" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Confirm Password</label>
            <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Confirm Password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
@endsection
