@extends('layouts.admin')

@section('content')

<style>

.page-title{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.tabs{
    margin-bottom:20px;
}

.tab{
    display:inline-block;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    margin-right:10px;
    font-weight:600;
}

.active-tab{
    background:#2563eb;
    color:white;
}

.inactive-tab{
    background:#e5e7eb;
    color:#111827;
}

/* SEARCH */
.search-box{
    display:flex;
    gap:12px;
    margin-bottom:20px;
}

.search-input{
    padding:12px;
    border:1px solid #dbe2ea;
    border-radius:8px;
    outline:none;
    width:280px;
}

.search-btn{
    background:#2563eb;
    color:white;
    border:none;
    padding:12px 18px;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
}

.table-box{
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#1e293b;
    color:white;
    padding:14px;
    text-align:center;
}

td{
    padding:14px;
    border-bottom:1px solid #eee;
    text-align:center;
    vertical-align:middle;
}

/* FIX BADGE STATUS (FLEX / NO-WRAP) */
.badge{
    padding:6px 12px;
    border-radius:20px;
    color:white;
    font-size:13px;
    font-weight:600;
    display: inline-block;
    white-space: nowrap;
}

.open{
    background:#2563eb;
}

.progress{
    background:#f59e0b;
}

.resolved{
    background:#16a34a;
}

.closed{
    background:#6b7280;
}

/* BUTTON VIEW */
.btn-view{
    background:#2563eb;
    color:white;
    padding:7px 0;
    border-radius:6px;
    text-decoration:none;
    display:inline-block;
    width:80px;
    text-align:center;
    font-size:14px;
    border:1px solid transparent;
    box-sizing:border-box;
}

/* BUTTON DELETE */
.btn-delete{
    background:#dc2626;
    color:white;
    padding:7px 0;
    border:1px solid transparent;
    border-radius:6px;
    cursor:pointer;
    margin-left:5px;
    display:inline-block;
    width:80px;
    text-align:center;
    font-size:14px;
    box-sizing:border-box;
}

/* FIX PAGINATION DI TENGAH BAWAH */
.pagination-wrapper {
    display: flex;
    justify-content: center; 
    margin-top: 15px;        
    margin-bottom: 25px;
}

.pagination-wrapper nav div:first-child {
    display: none !important;
}

.pagination-wrapper nav {
    display: flex;
    justify-content: center; 
    align-items: center;
}

.pagination-wrapper ul, 
.pagination {
    display: flex;
    gap: 8px;
    list-style: none;
    padding: 0;
    margin: 0;
    flex-wrap: wrap;
}

.pagination-wrapper li a,
.pagination-wrapper li span,
.pagination li a,
.pagination li span {
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;  
    height: 36px;
    padding: 0 12px;
    border-radius: 8px;
    text-decoration: none;
    border: 1px solid #dbe2ea;
    color: #1e293b;
    font-size: 14px;
    box-sizing: border-box;
    background: white;
}

.pagination-wrapper li.active span,
.pagination li.active span,
.pagination-wrapper li[aria-current="page"] span {
    background: #2563eb !important;
    color: white !important;
    border-color: #2563eb !important;
    font-weight: 600;
}

.pagination-wrapper li a:hover,
.pagination li a:hover {
    background: #eff6ff;
    border-color: #2563eb;
    color: #2563eb;
}

.pagination-wrapper li.disabled span,
.pagination li.disabled span {
    color: #9ca3af;
    background: #f3f4f6;
    border-color: #e5e7eb;
    cursor: not-allowed;
}

.pagination-wrapper nav svg,
.pagination nav svg {
    width: 14px;
    height: 14px;
    vertical-align: middle;
}

</style>

<div class="page-title">

<h2>Ticket Management</h2>

</div>

<div class="tabs">

<a href="{{ route('admin.ticket.index') }}" class="tab inactive-tab">

Active Tickets

</a>

<a href="{{ route('admin.ticket.archive.index') }}" class="tab active-tab">

Archived Tickets

</a>

</div>

<form method="GET" action="{{ route('admin.ticket.archive.index') }}" class="search-box" id="filterForm">

<input
type="text"
name="search"
id="jsSearchInput"
class="search-input"
placeholder="Search archived ticket..."
value="{{ request('search') }}"
autocomplete="off">

<select
name="status"
id="jsStatusSelect"
class="search-input"
style="width:180px;">

<option value="">All Status</option>

<option value="Open" {{ request('status') == 'Open' ? 'selected' : '' }}>Open</option>
<option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
<option value="Resolved" {{ request('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
<option value="Closed" {{ request('status') == 'Closed' ? 'selected' : '' }}>Closed</option>

</select>

<button type="submit" class="search-btn">Filter</button>

</form>

<div id="table-container">
    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>Employee</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>File</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                <tr class="ticket-row" data-id-ticket="{{ $ticket->id }}">
                    <td class="row-number">{{ ($tickets->currentPage() - 1) * $tickets->perPage() + $loop->iteration }}</td>
                    <td>{{ $ticket->ticket_code }}</td>
                    <td>{{ $ticket->employee }}</td>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->category }}</td>
                    <td>{{ $ticket->priority }}</td>
                    <td>
                        <span class="badge 
                            @if($ticket->status=='Open') open
                            @elseif($ticket->status=='In Progress') progress
                            @elseif($ticket->status=='Resolved') resolved
                            @else closed
                            @endif">
                            {{ $ticket->status }}
                        </span>
                    </td>
                    <td>{{ date('d M Y', strtotime($ticket->created_at)) }}</td>
                    <td>
                        @if($ticket->attachment)
                            <a href="{{ asset('uploads/'.$ticket->attachment) }}" target="_blank">See File</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.ticket.show',$ticket->id) }}" class="btn-view">View</a>
                        <form action="{{ route('admin.ticket.destroy',$ticket->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Hapus ticket ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" align="center">No archived tickets.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $tickets->links() }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('jsSearchInput');
    const statusSelect = document.getElementById('jsStatusSelect');
    const filterForm = document.getElementById('filterForm');
    const tableContainer = document.getElementById('table-container');

    // Tempat menyimpan memori nomor urut asli berdasarkan ID tiket di browser
    let numberMemory = {};
    let debounceTimer;

    // Fungsi mencatat nomor urut asli saat data pertama kali dirender oleh Laravel
    function saveOriginalNumbers() {
        const rows = document.querySelectorAll('.ticket-row');
        rows.forEach(row => {
            const ticketId = row.getAttribute('data-id-ticket');
            const currentNo = row.querySelector('.row-number').textContent.trim();
            
            // Catat ke memori browser hanya jika ID tersebut belum pernah tersimpan
            if (ticketId && !numberMemory[ticketId]) {
                numberMemory[ticketId] = currentNo;
            }
        });
    }

    // Fungsi menerapkan ulang nomor urut yang terkunci dari memori browser
    function applySavedNumbers() {
        const rows = document.querySelectorAll('.ticket-row');
        rows.forEach(row => {
            const ticketId = row.getAttribute('data-id-ticket');
            if (ticketId && numberMemory[ticketId]) {
                row.querySelector('.row-number').textContent = numberMemory[ticketId];
            }
        });
    }

    function fetchFilteredData() {
        const query = encodeURIComponent(searchInput.value.trim());
        const status = encodeURIComponent(statusSelect.value);
        const url = `${filterForm.action}?search=${query}&status=${status}`;

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            tableContainer.innerHTML = doc.getElementById('table-container').innerHTML;
            
            // Gunakan nomor urut yang tersimpan di memori browser
            applySavedNumbers();
            bindPaginationLinks();
        })
        .catch(error => console.error('Error fetching data:', error));
    }

    function bindPaginationLinks() {
        const paginationLinks = tableContainer.querySelectorAll('.pagination-wrapper a');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const targetUrl = this.href;

                fetch(targetUrl, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    tableContainer.innerHTML = doc.getElementById('table-container').innerHTML;
                    
                    // Catat nomor urut halaman baru jika user klik tombol pagination (misal page 2, 3 dst)
                    saveOriginalNumbers();
                    applySavedNumbers();
                    bindPaginationLinks();
                    window.scrollTo({ top: tableContainer.offsetTop - 50, behavior: 'smooth' });
                });
            });
        });
    }

    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(fetchFilteredData, 300);
    });

    statusSelect.addEventListener('change', fetchFilteredData);
    
    // Inisialisasi awal saat pertama kali halaman diakses
    saveOriginalNumbers();
    bindPaginationLinks();

    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        fetchFilteredData();
    });
});
</script>

@endsection