@extends('layouts.admin')

@section('title', 'Book Issue')

@section('content')
    <div style="margin-top:-20px; width:100%;">
    <h1 style="margin-top:-50px; padding-bottom:30px">Book Issue</h1>

    <a href="{{ url('/admin/add-order') }}" class="btn btn-primary" style="float:right; margin-top:-80px; margin-right:20px;">Issue New Book</a>

    <div style="width:100%; overflow-x:auto;">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Student ID</th>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Collection Date</th>
                <th>Expired Date</th>
                <th>Fine (Rs)</th>
                <th>Submission Status</th>
                <th>Submission Date</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach($book_order as $row)
            <?php
                $book=DB::table('books')->where('Book_ID',$row->Book_ID)->count();
            ?>
            @if($book > 0)
            <tr>
            <td>{{ $count }}</td>
                <td>{{$row->Student_ID }}</td>
                <?php
                    $student=DB::table('students')->where('Verify','Approve')->where('Student_ID',$row->Student_ID)->first();
                    $book=DB::table('books')->where('Book_ID',$row->Book_ID)->first();
                ?>
                <td>{{ $row->Book_ID }}</td>
                <td>{{ $book->Book_Name ?? 'N/A' }}</td>
                <td>{{ $row->Collection_Date }}</td>
                <td>{{ $row->Expired_Date }}</td>
                <td style="color: {{ $row->Fine > 0 ? 'red' : 'inherit' }}; font-weight: {{ $row->Fine > 0 ? 'bold' : 'normal' }}; text-align: center;">{{ $row->Fine }}</td>
                <td>{{ $row->Submission_Status }}</td>
                <td>{{ $row->Submission_Date }}</td>
            </tr>
            <?php $count++; ?>
            @endif
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
@endsection
