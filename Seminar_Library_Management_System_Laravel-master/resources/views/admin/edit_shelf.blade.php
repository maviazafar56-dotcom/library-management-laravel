@extends('layouts.admin')

@section('title', 'Update Shelf')

@section('content')
    @foreach($shelf as $row)
    <div style="margin-top:-30px;">
    <div style="margin-top:-20px; padding:30px; width:60%; text-align:left; border: 2px solid blue; border-radius:25px; margin-left:50px;">
    @include('includes.alerts')
    <h1 style="padding-bottom:20px; color:blue"> Edit Shelf </h1>
    <form method="post" action="{{ url('admin/edit-shelf/process/'.$row->id) }}" class="action_form">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Shelf Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Shelf Name" value="{{ $row->Shelf_ID }}" name="shelf_id" required readonly>
        </div>
        <div class="form-group">
        <label for="exampleFormControlSelect1">Shelf Location</label>
        <select class="form-control" id="exampleFormControlSelect1" name="shelf_location">
            <option value="Block A" <?php if($row->Shelf_Location == "Block A") echo"selected";  ?>>Block A</option>
            <option value="Block B" <?php if($row->Shelf_Location == "Block B") echo"selected";  ?>>Block B</option>
            <option value="Block C" <?php if($row->Shelf_Location == "Block C") echo"selected"; ?>>Block C</option>
        </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Amounts of Book (Shelf)</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Shelf ID" value="{{ $books_amount }}" name="shelf_id" required readonly>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    </div>
    </div>
    @endforeach
@endsection
