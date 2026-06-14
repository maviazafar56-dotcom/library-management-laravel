@extends('layouts.student')

@section('title', 'Shelf Details')

@section('content')
    @include('includes.alerts')
    
    @foreach($shelf as $row)
        <div class="glass-panel" style="margin-top: 0;">
            <h1 class="page-title" style="margin-bottom: 10px; border-bottom: none; padding-bottom: 0;">Shelf Name: {{ $row->Shelf_ID }}</h1>
            <h4 style="color: var(--text-muted);">Location: {{ $row->Shelf_Location }}</h4>
        </div>
    @endforeach

    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Book ID</th>
                        <th>Book Name</th>
                        <th>Writer Name</th>
                        <th>Available (Shelf)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $count = 1; ?>
                @foreach($book as $row)
                    <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $row->Book_ID }}</td>
                        <td>{{ $row->Book_Name }}</td>
                        <td>{{ $row->Writer_Name }}</td>
                        <td>{{ $row->Amounts }}</td>
                        <td>
                            <form method="post" action="{{ url('student/allocate-book/process') }}">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $row->Book_ID }}">
                                <button type="submit" class="btn btn-success btn-sm" {{ $row->Amounts <= 0 ? 'disabled' : '' }}>
                                    Allocate
                                </button>
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
