@extends('layouts.student')

@section('title', 'Student Dashboard')

@section('content')
    <h1 class="page-title">My Dashboard</h1>

    @include('includes.alerts')

    @foreach($student as $row)
        <?php
            // Calculate active books borrowed count and running fine
            $myRecords = \App\Record::where('Student_ID', $row->Student_ID)
                ->where('Submission_Status', 'No')
                ->get();
                
            $activeBorrowCount = $myRecords->count();
            $runningFineTotal = 0;
            foreach ($myRecords as $rec) {
                $runningFineTotal += $rec->Fine; // triggers accessor
            }
        ?>

        <!-- Dynamic Statistics Row -->
        <div class="parent_card">
            <div class="card_special">
                <div>
                    <h5>Borrowed Books</h5>
                    <h2>{{ $activeBorrowCount }} Active</h2>
                </div>
                <img src="{{ asset('image/Card_graph3.png') }}" alt="Books Graph">
            </div>

            <div class="card_special" style="border-color: {{ $runningFineTotal > 0 ? '#e74c3c' : 'var(--glass-border)' }};">
                <div>
                    <h5 style="color: {{ $runningFineTotal > 0 ? '#e74c3c' : 'var(--text-muted)' }};">Active Fine Accumulating</h5>
                    <h2 style="color: {{ $runningFineTotal > 0 ? '#e74c3c' : 'var(--primary-color)' }};">Rs. {{ $runningFineTotal }}</h2>
                </div>
                <img src="{{ asset('image/Card_graph.png') }}" alt="Fines Graph">
            </div>

            <div class="card_special">
                <div>
                    <h5>Account Status</h5>
                    <h2 style="color: #2ecc71;">ACTIVE</h2>
                </div>
                <img src="{{ asset('image/Card_graph2.png') }}" alt="Status Graph">
            </div>
        </div>

        <!-- Profile Glass Panel -->
        <div class="glass-panel" style="margin-top: 30px;">
            <div class="profile_panel">
                <div class="profile_image_container">
                    <img src="{{ asset($row->Image) }}" alt="Student Picture">
                </div>
                <div class="profile_details">
                    <h1>{{ $row->Name }}</h1>
                    <h2>Student ID: <strong>{{ $row->Student_ID }}</strong></h2>
                    <h2>Session: <strong>{{ $row->Session }}</strong></h2>
                    <h2>Email: <strong>{{ $row->Email }}</strong></h2>
                    <h2>Contact No: <strong>{{ $row->Contact_no }}</strong></h2>
                </div>
            </div>
        </div>
    @endforeach
@endsection
