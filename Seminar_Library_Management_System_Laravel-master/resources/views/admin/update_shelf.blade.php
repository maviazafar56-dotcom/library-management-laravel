@extends('layouts.admin')

@section('title', 'Update Shelf')

@section('content')
    <div style="margin-top:-50px;">
    @include('includes.alerts')
    <div class="container">
    <h1 style="margin-top:-50px; padding-left:320px; padding-bottom:50px">Update Shelf</h1>
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Shelf Name</th>
                <th>Shelf Location</th>
                <th>Amount of Books (Shelf)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach($shelf as $row)
                <?php
                    $books_amount=DB::table('books')->where('Shelf_ID',$row->Shelf_ID)->sum('amounts');
                ?>
            <tr>
                <td>{{ $count }}</td>
                <td>{{$row->Shelf_ID }}</td>
                <td>{{ $row->Shelf_Location }}</td>
                <td>{{ $books_amount }}</td>
                <td>
                    <a href="{{ url('admin/shelf/edit/'.$row->id) }}" class="btn btn-info">Edit</a>
                </td>
            </tr>
            <?php $count++; ?>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
    </div>
@endsection
