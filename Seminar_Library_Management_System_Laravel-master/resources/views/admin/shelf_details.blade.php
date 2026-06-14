@extends('layouts.admin')

@section('title', 'Shelf Details')

@section('content')
<div style="margin-top:50px;">
    @include('includes.alerts')
    <div class="container bootstrap snippet" style="padding-top:30px">
    @foreach($shelf as $row)
    <div style="padding-left:10%;">
    <h2 style="padding-bottom:20px;">Shelf Name : {{ $row->Shelf_ID }}</h2>
    <h3 style="padding-bottom:50px;">Shelf Location : {{ $row->Shelf_Location }}</h3>
    </div>
    @endforeach
    <div class="container">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Writer Name</th>
                <th>Available(Shelf)</th>
            </tr>
        </thead>
        <tbody>
        <?php $count=1; ?>
            @foreach($book as $row)
            <tr>
                <td>{{ $count }}</td>
                <td>{{$row->Book_ID }}</td>
                <td>{{$row->Book_Name }}</td>
                <td>{{$row->Writer_Name }}</td>
                <td>{{ $row->Amounts }}</td>
            </tr>
            <?php $count++; ?>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
</div>
@endsection
