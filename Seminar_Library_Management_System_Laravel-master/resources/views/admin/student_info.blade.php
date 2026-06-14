@extends('layouts.admin')

@section('title', 'Student Info')

@section('content')
    <div style="margin-top:-50px;">
    @include('includes.alerts')
    <h1 style="margin-top:-50px; padding-left:330px; padding-bottom:50px">Student Info</h1>
    <div class="container">
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Image</th>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Session</th>
                <th>Contact no</th>
                <th>Books Order (Not Submited)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach($student as $row)
            <tr>
                <td>{{ $count }}</td>
                <td><img src="{{ asset($row->Image) }}" alt="" style="width:60px; height:60px; border-radius:50%"></td>
                <td>{{$row->Student_ID }}</td>
                <td>{{ $row->Name }}</td>
                <td>{{ $row->Session }}</td>
                <td>{{ $row->Contact_no }}</td>
                <?php
                    $available_student_copy=DB::table('records')->where('Student_ID',$row->Student_ID)
                    ->where('Submission_Status','No')
                    ->count();
                ?>
                <td>{{ $available_student_copy }}</td>
                <td>
                    <a href="{{ url('admin/student/info/details/'.$row->id) }}" class="btn btn-primary">Details</a>
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
