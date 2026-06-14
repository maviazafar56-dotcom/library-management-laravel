@extends('layouts.admin')

@section('title', 'Add Shelf')

@section('content')
    <div style="margin-top:-30px;">
    <div style="margin-top:-20px; padding:30px; width:60%; text-align:left; border: 2px solid blue; border-radius:25px; margin-left:50px;">
    @include('includes.alerts')
    <h1 style="padding-bottom:20px; color:blue"> Add Shelf </h1>
    <form method="post" action="{{ url('admin/add-shelf/process') }}" class="action_form">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Shelf Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Shelf Name" name="shelf_id" required>
        </div>
        <div class="form-group">
        <label for="exampleFormControlSelect1">Shelf Location</label>
        <select class="form-control" id="exampleFormControlSelect1" name="shelf_location">
            <option value="Block A">Block A</option>
            <option value="Block B">Block B</option>
            <option value="Block C">Block C</option>
        </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
    </div>
@endsection
