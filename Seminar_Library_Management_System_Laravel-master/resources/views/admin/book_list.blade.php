@extends('layouts.admin')

@section('title', 'Book Catalog')

@section('content')
    @include('includes.alerts')

    <div class="glass-panel" style="margin-top: 0; padding: 25px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
            <div>
                <h1 style="color: var(--primary-color); margin-bottom: 5px; font-weight: 700; font-size: 28px;">
                    @if(isset($category))
                        Category: {{ ucwords(str_replace('-', ' ', $category)) }}
                    @else
                        Book Inventory
                    @endif
                </h1>
                <p style="color: var(--text-muted); font-size: 14px;">Manage library catalog inventory, update listings, and review stocks.</p>
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ url('admin/books') }}" style="display: flex; gap: 10px; max-width: 450px; width: 100%;">
                <input type="text" name="search" placeholder="Search by name, writer, ID..." value="{{ request('search') }}" style="border-radius: 25px; padding-left: 20px;">
                <button type="submit" class="btn btn-primary" style="border-radius: 25px; padding: 10px 25px;">Search</button>
            </form>
        </div>
    </div>

    <!-- Inventory Table -->
    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Book ID</th>
                        <th>Book Name</th>
                        <th>Writer Name</th>
                        <th>Category</th>
                        <th>Shelf</th>
                        <th>Available (Shelf)</th>
                        <th>Active Loans</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php $count = 1; ?>
                @forelse($books as $row)
                    <?php
                        $activeLoansCount = DB::table('records')
                            ->where('Book_ID', $row->Book_ID)
                            ->where('Submission_Status', 'No')
                            ->count();
                    ?>
                    <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $row->Book_ID }}</td>
                        <td>{{ $row->Book_Name }}</td>
                        <td>{{ $row->Writer_Name }}</td>
                        <td>
                            <span class="badge" style="background: rgba(218, 170, 87, 0.1); color: var(--primary-color); padding: 5px 10px; border: 1px solid rgba(218, 170, 87, 0.2); border-radius: 12px;">
                                {{ $row->Catagory }}
                            </span>
                        </td>
                        <td><strong>Shelf {{ $row->Shelf_ID }}</strong></td>
                        <td>
                            @if($row->Amounts > 0)
                                <span style="color: #2ecc71; font-weight: 500;">{{ $row->Amounts }} copies</span>
                            @else
                                <span style="color: #e74c3c; font-weight: 500;">Out of Stock</span>
                            @endif
                        </td>
                        <td>
                            @if($activeLoansCount > 0)
                                <span class="badge badge-warning" style="background: rgba(255,144,0,0.15); color: #ff9000; border: 1px solid rgba(255,144,0,0.25);">
                                    {{ $activeLoansCount }} on loan
                                </span>
                            @else
                                <span style="color: var(--text-muted);">None</span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 5px; justify-content: center;">
                                <a href="{{ url('admin/book/details/'.$row->id) }}" class="btn btn-info btn-sm">Details</a>
                                <a href="{{ url('admin/book/edit/'.$row->id) }}" class="btn btn-primary btn-sm" style="color: #12100e !important;">Edit</a>
                                <a href="{{ url('admin/book/delete/'.$row->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php $count++; ?>
                @empty
                    <tr>
                        <td colspan="9" style="text-align: center; padding: 40px 0;">
                            <i class="fas fa-search" style="font-size: 30px; color: var(--primary-color); opacity: 0.5; margin-bottom: 15px; display: block;"></i>
                            <h5 style="color: var(--text-white);">No matches found</h5>
                            <p style="color: var(--text-muted); font-size: 13px;">Modify your search keyword or browse all books.</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
