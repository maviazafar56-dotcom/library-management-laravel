@extends('layouts.admin')

@section('title', 'Add Book')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/style5.css') }}">
@endsection

@section('content')
<div style="margin-top:-30px;">
    <div style="
        margin-top:-20px;
        padding:20px;
        width:60%;
        text-align:left;
        border:2px solid blue;
        border-radius:25px;
        margin-left:50px;
    ">
        @include('includes.alerts')

        <h1 style="padding-bottom:10px; color:blue">Add Book</h1>

        <form method="post" action="{{ url('admin/add-book/process') }}" class="action_form">
            @csrf

            <div class="form-group">
                <label>Book ID</label>
                <input type="text" class="form-control" placeholder="Enter Book ID" name="book_id" required>
            </div>

            <div class="form-group">
                <label>Book Name</label>
                <input type="text" class="form-control" placeholder="Enter Book Name" name="book_name" required>
            </div>

            <div class="form-group">
                <label>Writer Name</label>
                <input type="text" class="form-control" placeholder="Enter Writer Name" name="writer_name" required>
            </div>

            <div class="form-group">
                <label>Block</label>
                <select class="form-control" name="block" required>
                    <option value="">-- Select Block --</option>
                    <option value="Block A">Block A</option>
                    <option value="Block B">Block B</option>
                    <option value="Block C">Block C</option>
                </select>
            </div>

            <div class="form-group">
                <label>Amount</label>
                <input type="number" class="form-control" placeholder="Enter Book Amount" name="amounts" required>
            </div>

            <div class="form-group">
                <label>Shelf (ID - Location)</label>
                <select class="form-control" name="shelf_id" required>
                    <option value="">-- Select Shelf --</option>
                    @foreach($shelf as $row)
                        <option value="{{ $row->Shelf_ID }}">
                            {{ $row->Shelf_ID }} - {{ $row->Shelf_Location }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
@endsection
