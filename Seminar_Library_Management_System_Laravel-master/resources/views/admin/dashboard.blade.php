@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <h1 class="page-title">Admin Dashboard</h1>

    @include('includes.alerts')

    <!-- Dashboard Statistics Grid -->
    <div class="parent_card">
        <div class="card_special">
            <div>
                <h5>Total Students</h5>
                <h2>{{ $total_student }}</h2>
            </div>
            <img src="{{ asset('image/Card_graph2.png') }}" alt="Students Graph">
        </div>

        <div class="card_special">
            <div>
                <h5>Total Books</h5>
                <h2>{{ $total_book }}</h2>
            </div>
            <img src="{{ asset('image/Card_graph3.png') }}" alt="Books Graph">
        </div>

        <div class="card_special">
            <div>
                <h5>Total Shelves</h5>
                <h2>{{ $total_shelf }}</h2>
            </div>
            <img src="{{ asset('image/Card_graph4.png') }}" alt="Shelves Graph">
        </div>

        <div class="card_special">
            <div>
                <h5>Active Issues</h5>
                <h2>{{ $total_order }}</h2>
            </div>
            <img src="{{ asset('image/Card_graph5.png') }}" alt="Issues Graph">
        </div>

        <div class="card_special" style="border-color: #e74c3c;">
            <div>
                <h5 style="color: #e74c3c;">Total Fines</h5>
                <h2 style="color: #e74c3c;">Rs. {{ $total_fine }}</h2>
            </div>
            <img src="{{ asset('image/Card_graph.png') }}" alt="Fines Graph">
        </div>
    </div>

    <!-- Recent Issue Activity Table -->
    <div class="glass-panel" style="margin-top: 30px;">
        <h3 style="color: var(--primary-color); margin-bottom: 20px; font-weight: 600; letter-spacing: 0.5px;">
            <i class="fas fa-history" style="margin-right: 10px;"></i> Recent Book Issues
        </h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Serial</th>
                        <th scope="col">Student ID</th>
                        <th scope="col">Book ID</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Collection Date</th>
                        <th scope="col">Expired Date</th>
                        <th scope="col">Active Fine</th>
                    </tr>
                </thead>
                <tbody>
                <?php $count = 1; ?>
                @foreach($records as $row)
                    <?php
                        $bookInfo = DB::table('books')->where('Book_ID', $row->Book_ID)->first();
                    ?>
                    <tr>
                        <th scope="row">{{ $count }}</th>
                        <td>{{ $row->Student_ID }}</td>
                        <td>{{ $row->Book_ID }}</td>
                        <td>{{ $bookInfo->Book_Name ?? 'N/A' }}</td>
                        <td>{{ $row->Collection_Date }}</td>
                        <td>{{ $row->Expired_Date }}</td>
                        <td style="color: {{ $row->Fine > 0 ? '#e74c3c' : 'inherit' }}; font-weight: bold;">
                            Rs. {{ $row->Fine }}
                        </td>
                    </tr>
                    <?php $count++; ?>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="margin-top: 20px;">
            {{ $records->links() }}
        </div>
    </div>
@endsection
