@extends('layouts.admin')

@section('title', 'Issue Book')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style5.css') }}">
@endsection

@section('content')
    <div style="margin-top:-20px; padding:30px; width:60%; text-align:left; border: 2px solid blue; border-radius:25px; margin-left:50px;">
    @include('includes.alerts')
    <h1 style="color:blue">Issue Book</h1>
    <form method="post" action="{{ url('admin/add-order/process') }}" class="action_form">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Student ID</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Student ID" name="student_id" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Book ID</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Book ID" name="book_id" required>
        </div>
       
        <div class="form-group">
        <label for="exampleFormControlSelect1">Collection Duration</label>
        <select class="form-control" id="exampleFormControlSelect1" name="duration">
            <option value="7 Days">7 Days</option>
            <option value="15 Days">15 Days</option>
            <option value="1 Month">1 Month</option>
            <option value="2 Months">2 Months</option>
        </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
@endsection
