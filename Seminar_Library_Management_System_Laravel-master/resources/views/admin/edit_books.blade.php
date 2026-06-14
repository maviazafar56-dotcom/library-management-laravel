@extends('layouts.admin')

@section('title', 'Update Book')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style5.css') }}">
@endsection

@section('content')
    @foreach($books as $row)
    <div style="margin-top:-20px; text-align:left; border: 2px solid blue; border-radius:25px; padding:30px; width:60%; margin-left: 50px;">
    @include('includes.alerts')
    <h1 style="padding-bottom:20px; color:blue"> Edit Book </h1>
   
        <form method="post" action="{{ url('admin/edit-book/process/'.$row->id) }}" class="action_form">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Book ID</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Book ID" value="{{ $row->Book_ID }}" name="book_id" readonly required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Book Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Book Name"  value="{{ $row->Book_Name }}" name="book_name" readonly required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Writer Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Writer Name"  value="{{ $row->Writer_Name }}" name="writer_name" readonly required>
        </div>
        <div class="form-group">
        <label for="exampleFormControlSelect1">Block</label>
        <select class="form-control" id="exampleFormControlSelect1" name="block" required>
            <option value="Block A" {{ $row->Catagory == 'Block A' ? 'selected' : '' }}>Block A</option>
            <option value="Block B" {{ $row->Catagory == 'Block B' ? 'selected' : '' }}>Block B</option>
            <option value="Block C" {{ $row->Catagory == 'Block C' ? 'selected' : '' }}>Block C</option>
        </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Available (Shelf)</label>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Book Amounts"  value="{{ $row->Amounts }}"  name="amounts" required>
        </div>
        <div class="form-group">
        <label for="exampleFormControlSelect1">Shelf Name</label>
        <select class="form-control" id="exampleFormControlSelect1" value=""  name="shelf_id">
            @foreach($shelf as $row2)
            <option value="{{ $row2->Shelf_ID }}" <?php if($row2->Shelf_ID==$row->Shelf_ID) echo "selected"; ?>>{{ $row2->Shelf_ID }}</option>
            @endforeach
        </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
    @endforeach
@endsection
