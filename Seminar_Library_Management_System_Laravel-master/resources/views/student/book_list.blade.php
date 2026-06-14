@extends('layouts.student')

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
                        Book Catalog
                    @endif
                </h1>
                <p style="color: var(--text-muted); font-size: 14px;">Browse and request books from the library catalog.</p>
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ url('student/books') }}" style="display: flex; gap: 10px; max-width: 450px; width: 100%;">
                <input type="text" name="search" placeholder="Search by name, writer, category..." value="{{ request('search') }}" style="border-radius: 25px; padding-left: 20px;">
                <button type="submit" class="btn btn-primary" style="border-radius: 25px; padding: 10px 25px;">Search</button>
            </form>
        </div>
    </div>

    <!-- Books Card Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px; margin-top: 30px;">
        @forelse($books as $row)
            <div class="glass-panel" style="margin: 0; padding: 20px; display: flex; flex-direction: column; justify-content: space-between; min-height: 220px; border-color: rgba(218, 170, 87, 0.15); transition: var(--transition-smooth);">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 10px;">
                        <span class="badge" style="background: rgba(218, 170, 87, 0.15); color: var(--primary-color); font-size: 11px; padding: 4px 10px; border-radius: 12px; border: 1px solid rgba(218,170,87,0.25);">
                            {{ $row->Catagory }}
                        </span>
                        <span style="font-size: 12px; color: var(--text-muted);">ID: {{ $row->Book_ID }}</span>
                    </div>

                    <h3 style="color: var(--text-white); font-weight: 600; font-size: 18px; margin-top: 15px; margin-bottom: 5px; line-height: 1.4;">
                        {{ $row->Book_Name }}
                    </h3>
                    <p style="color: var(--text-muted); font-size: 14px; font-style: italic; margin-bottom: 15px;">
                        By {{ $row->Writer_Name }}
                    </p>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid rgba(218,170,87,0.1); padding-top: 15px; margin-top: 15px;">
                    <div>
                        <span style="font-size: 12px; color: var(--text-muted); display: block;">Location</span>
                        <strong style="color: var(--primary-color); font-size: 14px;">Shelf {{ $row->Shelf_ID }}</strong>
                    </div>

                    <div style="text-align: right; display: flex; align-items: center; gap: 15px;">
                        <div style="margin-right: 5px;">
                            @if($row->Amounts > 0)
                                <span style="color: #2ecc71; font-size: 12px; font-weight: 600; display: block;"><i class="fas fa-check-circle"></i> Available</span>
                                <span style="color: var(--text-muted); font-size: 11px;">({{ $row->Amounts }} copies)</span>
                            @else
                                <span style="color: #e74c3c; font-size: 12px; font-weight: 600; display: block;"><i class="fas fa-times-circle"></i> Out of stock</span>
                            @endif
                        </div>

                        <form method="post" action="{{ url('student/allocate-book/process') }}">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $row->Book_ID }}">
                            <button type="submit" class="btn btn-primary btn-sm" style="border-radius: 20px;" {{ $row->Amounts <= 0 ? 'disabled' : '' }}>
                                Request
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="glass-panel" style="grid-column: 1 / -1; text-align: center; padding: 50px;">
                <i class="fas fa-search" style="font-size: 40px; color: var(--primary-color); margin-bottom: 20px; opacity: 0.5;"></i>
                <h3 style="color: var(--text-white); font-weight: 600; margin-bottom: 10px;">No Books Found</h3>
                <p style="color: var(--text-muted); font-size: 14px;">We couldn't find any books matching your criteria.</p>
            </div>
        @endforelse
    </div>
@endsection
