@extends('layouts.student')

@section('title', 'Edit Info')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style5.css') }}">
@endsection

@section('content')
    <div class="content" style="margin-left:-200px;margin-top:-20px;padding:30px 30px 30px 30px;width:50%; text-align:left; border: 2px solid blue; border-radius:25px">
    @include('includes.alerts')
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><h1 style="padding-bottom:20px; color:blue"> Edit Info </h1>
    @foreach($student as $row)
    
    <form method="post" action="{{ url('student/edit-info/process/'.$row->id) }}" class="action_form">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" name="name" value="{{ $row->Name }}" readonly required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Student ID</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Student ID" value="{{ $row->Student_ID }}" readonly name="student_id" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Session</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Session" value="{{ $row->Session }}" readonly name="session" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username" value="{{ $row->Username }}" name="username" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email" value="{{ $row->Email }}" readonly name="email" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Contact</label>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Contact no" value="{{ $row->Contact_no }}" name="contact" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @endforeach
    </div>
    </div>
    </div>
@endsection
