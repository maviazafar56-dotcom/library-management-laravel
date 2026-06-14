@extends('layouts.admin')

@section('title', 'Change Password')

@section('content')
<div style="margin-top:-30px;">
<a href="{{ url('/') }}" class="btn btn-danger" style="float:right; margin-right:50px;">Go to User Panel</a>
<div class="content" style="margin-left:50px;margin-top:50px;padding:30px;width:60%; text-align:left; border: 2px solid blue; border-radius:25px">
    @include('includes.alerts')
    <h1 style="color:blue">Change Password</h1>
<form method="post" action="{{ url('admin/recover-password/process') }}">
    @csrf 
    <div id="wrapper">
        <div class="login">
            <div class="logo"> 
                <img src="{{ asset('image/librarylogo.png') }}" alt="" style="width: 100px;">
            </div>
            <div class="loginBox" style="margin-top:20px;">
                <div class="form-group">
                    <strong><i class="fa fa-key"></i>New Password</strong><br>
                    <input type="password" name="new_password" class="form-control" required><br>
                </div>
                <div class="form-group">
                    <strong><i class="fa fa-key"></i>Confirm Password</strong><br>
                    <input type="password" name="confirm_password" class="form-control" required><br>
                </div>
                <input id="loginButton" type="submit" value="Submit" class="btn btn-primary">
            </div>
        </div>
    </div>
</form>
</div>
</div>
@endsection