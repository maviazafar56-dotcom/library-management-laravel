@extends('layouts.admin')

@section('title', 'Student Request')

@section('content')
    <div style="margin-top:-50px;">
    @include('includes.alerts')
    <h1 style="margin-top:-50px; padding-left:330px; padding-bottom:50px">Student Request</h1>
    <div class="container">
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Image</th>
                <th>Name</th>
                <th>Roll</th>
                <th>Session</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach($student as $row)
            <tr>
                <td>{{ $count }}</td>
                <td><img src="{{ asset($row->Image) }}" alt="" style="width:60px; height:60px; border-radius:50%"></td>
                <td>{{ $row->Name }}</td>
                <td>{{ $row->Student_ID }}</td>
                <td>{{ $row->Session }}</td>
                <td>
                    <a href="{{ url('student/approve/'.$row->id) }}" class="btn btn-success">Approve</a>
                    <a href="{{ url('student/reject/'.$row->id) }}" class="btn btn-danger">Reject</a>
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
