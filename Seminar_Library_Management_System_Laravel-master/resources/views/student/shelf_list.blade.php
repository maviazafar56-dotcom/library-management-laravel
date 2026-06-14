@extends('layouts.student')

@section('title', 'Shelf List')

@section('content')
    <div style="margin-top:-20px;">
    @include('includes.alerts')
    <h1 style="margin-top:-50px; padding-left:330px; padding-bottom:50px">Shelf List</h1>
    <div class="container">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Serial</th>
                <th>Shelf Name</th>
                <th>Shelf Location</th>
                <th>Books Available(Shelf)</th>
                <th>Action</th>
               
            </tr>
        </thead>
        
        <tbody>
        <?php
             $count=1;
             ?>
            @foreach($shelf as $row)


            <tr>
                <td>{{ $count }}</td>
                <td>{{$row->Shelf_ID }}</td>
                <td>{{ $row->Shelf_Location }}</td>

              
                             
                <?php

                    $available_copy=DB::table('books')->where('Shelf_ID',$row->Shelf_ID)
                    ->sum('Amounts');



                ?>


                <td>{{ $available_copy }}</td>

                <td>
                
                <a href="{{ url('student/shelf/details/'.$row->id) }}" class="btn btn-primary">Details</a>
                
                </td>
               
               
            </tr>
            <?php

                $count++;

            ?>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
@endsection

