@extends('layouts.admin')

@section('title', 'Book Details')

@section('content')
<div style="margin-top:50px;">
    @include('includes.alerts')
    <div class="container bootstrap snippet">
    @foreach($book as $row)
    <div style="padding-left:10%; padding-top:30px">
        <h2 style="padding-bottom:20px;">Book ID : {{ $row->Book_ID }}</h2>
        <h3 style="padding-bottom:20px;">Book Name : {{ $row->Book_Name }}</h3>
        <h4 style="padding-bottom:50px;">Writer Name : {{ $row->Writer_Name }}</h4>
    </div>
    @endforeach
    <div class="row">
    <div class="col-lg-12">
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Student ID</th>
                <th>Collection Date</th>
                <th>Expired Date</th>
                <th>Submission Status</th>
                <th>Submission Date</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach($records as $row)
            <tr>
                <td>{{ $count }}</td>
                <td>{{$row->Student_ID }}</td>
                <td>{{$row->Collection_Date }}</td>
                <td>{{$row->Expired_Date }}</td>
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
