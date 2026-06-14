@extends('layouts.admin')

@section('title', 'Update Book')

@section('content')
    <div style="margin-top:-50px;">
    @include('includes.alerts')
    <h1 style="margin-top:-50px; padding-left:330px; padding-bottom:50px">Update Book</h1>
    <div class="container">
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Writer Name</th>
                <th>Shelf Name</th>
                <th>Available(Shelf)</th>
                <th>Available(Student)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach($books as $row)
            <tr>
            <td>{{ $count }}</td>
                <td>{{$row->Book_ID }}</td>
                <td>{{ $row->Book_Name }}</td>
                <td>{{ $row->Writer_Name }}</td>
                <td>{{ $row->Shelf_ID }}</td>
                <?php
                    $available_student_copy=DB::table('records')->where('Book_ID',$row->Book_ID)
                    ->where('Submission_Status','No')
                    ->count();
                ?>
                <td>{{ $row->Amounts }}</td>
                <td>{{ $available_student_copy }}</td>
                <td>
                    <a href="{{ url('admin/book/edit/'.$row->id) }}" class="btn btn-info">Edit</a>
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
