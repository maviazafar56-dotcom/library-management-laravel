@extends('layouts.admin')

@section('title', 'Student Details')

@section('content')
<div style="margin-top:50px;">
    @include('includes.alerts')
    <div class="container bootstrap snippet">
    @foreach($student as $row)
    <div style="text-align:center; padding-top:30px">
        <img src="{{ asset($row->Image) }}" alt="" style="width:100px; height:100px; border-radius:50%; margin-bottom:20px">
        <h2 style="padding-bottom:10px;">Name : {{ $row->Name }}</h2>
        <h3 style="padding-bottom:30px;">Student ID : {{ $row->Student_ID }}</h3>
    </div>
    @endforeach
    <div class="row">
    <div class="col-lg-12">
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Writer Name</th>
                <th>Collection Date</th>
                <th>Expired Date</th>
                <th>Submission Status</th>
                <th>Submission Date</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach($book as $row)
            <?php
                $book_info = DB::table('books')->where('Book_ID',$row->Book_ID)->first();
            ?>
            <tr>
                <td>{{ $count }}</td>
                <td>{{$row->Book_ID }}</td>
                <td>{{$book_info->Book_Name ?? 'N/A' }}</td>
                <td>{{$book_info->Writer_Name ?? 'N/A' }}</td>
                <td>{{ $row->Collection_Date }}</td>
                <td>{{ $row->Expired_Date }}</td>
                <td>{{ $row->Submission_Status }}</td>
                <td>{{ $row->Submission_Date }}</td>
            </tr>
            <?php $count++; ?>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
</div>
@endsection
