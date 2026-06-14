@extends('layouts.admin')

@section('title', 'Remove Shelf')

@section('content')
    <div style="margin-top:-50px;">
    @include('includes.alerts')
    <div class="container">
    <h1 style="margin-top:-50px; padding-left:320px; padding-bottom:50px">Remove Shelf</h1>
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Shelf Name</th>
                <th>Shelf Location</th>
                <th>Amounts of Book (Shelf)</th>
                <th>Amounts of Book (Students)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach($shelf as $row)
                <?php
                    $books_amount=DB::table('books')->where('Shelf_ID',$row->Shelf_ID)->sum('amounts');
                    $amount=0;
                    $books_stu_copy=DB::table('books')->where('Shelf_ID',$row->Shelf_ID)->get();

                    foreach($books_stu_copy as $row_ul)
                    {
                      $books_ultra_copy=DB::table('records')->where('Book_ID',$row_ul->Book_ID)
                      ->where('Submission_Status','No')
                      ->count();
                      $amount=$amount+$books_ultra_copy;
                    }
                ?>
            <tr>
                <td>{{ $count }}</td>
                <td>{{$row->Shelf_ID }}</td>
                <td>{{ $row->Shelf_Location }}</td>
                <td>{{ $books_amount }}</td>
                <td>{{ $amount }}</td>
                <td>
                    <a href="{{ url('admin/shelf/delete/'.$row->id) }}" class="btn btn-danger">Delete</a>
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
