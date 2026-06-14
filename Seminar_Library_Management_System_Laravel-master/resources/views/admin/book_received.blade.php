@extends('layouts.admin')

@section('title', 'Book Received')

@section('content')
    @include('includes.alerts')
    <h1 class="page-title">Book Received</h1>

    <div class="container">
        <div class="table-responsive">
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $count = 1; ?>
                @foreach($book_order as $row)
                    <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $row->Student_ID }}</td>
                        <td>{{ $row->Book_ID }}</td>
                        <td>{{ $row->Book_Name }}</td>
                        <td>{{ $row->Collection_Date }}</td>
                        <td>{{ $row->Expired_Date }}</td>
                        <td style="color: {{ $row->Fine > 0 ? '#e74c3c' : 'inherit' }}; font-weight: bold;">
                            Rs. {{ $row->Fine }}
                        </td>
                        <td>
                            <span class="badge badge-warning" style="background: rgba(255, 144, 0, 0.2); color: #ff9000; border: 1px solid rgba(255,144,0,0.3); padding: 5px 10px;">
                                {{ $row->Submission_Status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ url('admin/book-received/process/'.$row->id) }}" class="btn btn-success btn-sm">Receive</a>
                        </td>
                    </tr>
                    <?php $count++; ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
