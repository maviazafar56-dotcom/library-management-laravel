@extends('layouts.student')

@section('title', 'My Collection')

@section('content')
    <div style="margin-top:-20px;">
    @include('includes.alerts')
    <div class="container bootstrap snippet">
    <h1 style="margin-top:-50px; padding-left:320px; padding-bottom:50px">My Collection</h1>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Writer Name</th>
                <th>Collection Date</th>
                <th>Expired Date</th>
                <th>Fine (Rs)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach($collection as $row)
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
                <td style="color: {{ $row->Fine > 0 ? 'red' : 'green' }}; font-weight: bold;">{{ $row->Fine }}</td>
                    <td>
                        <form action="{{ url('student/submit-book/'.$row->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to submit this book?')">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Submit</button>
                        </form>
                    </td>
            </tr>
            <?php $count++; ?>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
@endsection
