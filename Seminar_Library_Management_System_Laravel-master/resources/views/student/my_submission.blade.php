@extends('layouts.student')

@section('title', 'My Submission')

@section('content')
    <div style="margin-top:-20px;">
    @include('includes.alerts')
    <h1 style="margin-top:-50px; padding-left:320px; padding-bottom:50px">My Submission</h1>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Writer Name</th>
                <th>Collection Date</th>
                <th>Expired Date</th>
                <th>Submission Date</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach($submission as $row)
            <?php
                $book_count_mode=DB::table('books')->where('Book_ID',$row->Book_ID)->count();
            ?>
            @if($book_count_mode > 0)
            <tr>
            <td>{{ $count }}</td>
                <td>{{$row->Book_ID }}</td>
                <?php
                    $book_info=DB::table('books')->where('Book_ID',$row->Book_ID)->first();
                ?>
                <td>{{ $book_info->Book_Name ?? 'N/A' }}</td>
                <td>{{ $book_info->Writer_Name ?? 'N/A' }}</td>
                <td>{{ $row->Collection_Date }}</td>
                <td>{{ $row->Expired_Date }}</td>
                <td>{{ $row->Submission_Date }}</td>
            </tr>
            <?php $count++; ?>
            @endif
            @endforeach
        </tbody>
    </table>
    </div>
@endsection

