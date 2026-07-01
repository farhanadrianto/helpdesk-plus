@extends('layouts.user')

@section('content')

<style>

.page-title{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.btn-create{
    background:#2563eb;
    color:white;
    padding:12px 18px;
    border-radius:8px;
    text-decoration:none;
    font-weight:600;
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

.btn{
    background:#2563eb;
    color:white;
    padding:7px 14px;
    border-radius:6px;
    text-decoration:none;
    display:inline-block;
}

/* --- PERBAIKAN CSS PAGINATION DI TENGAH BAWAH (SAMA SEPERTI ADMIN) --- */
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

<h2>My Tickets</h2>

<a
href="{{ route('ticket.create') }}"
class="btn-create">

+ Create Ticket

</a>

</div>

<form method="GET" action="{{ url()->current() }}" class="search-box" id="filterForm">

<input
type="text"
name="search"
id="jsSearchInput"
class="search-input"
placeholder="Search ticket..."
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
                    <th>Title</th>
                    <th>Category</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tickets as $ticket)
                <tr class="ticket-row" data-id-ticket="{{ $ticket->id }}">
                    <td class="row-number">{{ ($tickets->currentPage() - 1) * $tickets->perPage() + $loop->iteration }}</td>
                    <td>{{ $ticket->ticket_code }}</td>
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
                        <a href="{{ route('ticket.show',$ticket->id) }}" class="btn">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" align="center">No tickets found.</td>
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

    let numberMemory = {};
    let debounceTimer;

    function saveOriginalNumbers() {
        const rows = document.querySelectorAll('.ticket-row');
        rows.forEach(row => {
            const ticketId = row.getAttribute('data-id-ticket');
            const currentNo = row.querySelector('.row-number').textContent.trim();
            if (ticketId && !numberMemory[ticketId]) {
                numberMemory[ticketId] = currentNo;
            }
        });
    }

    function applySavedNumbers() {
        const rows = document.querySelectorAll('.ticket-row');
        rows.forEach(row => {
            const ticketId = row.getAttribute('data-id-ticket');
            if (ticketId && numberMemory[ticketId]) {
                row.querySelector('.row-number').textContent = numberMemory[ticketId];
            }
        });
    }

    function fetchFilteredData(targetUrl = null) {
        const query = encodeURIComponent(searchInput.value.trim());
        const status = encodeURIComponent(statusSelect.value);
        
        // Jika tidak ada url pagination yang diklik, gunakan action form asal bawaan filter pencarian
        let url = targetUrl;
        if (!url) {
            url = `${filterForm.action}?search=${query}&status=${status}`;
        }

        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            tableContainer.innerHTML = doc.getElementById('table-container').innerHTML;
            
            // --- FIX: Mengubah URL Browser di atas secara otomatis ---
            window.history.pushState({ path: url }, '', url);

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

                // Eksekusi data fetch menggunakan URL halaman tujuan
                fetchFilteredData(targetUrl);
                window.scrollTo({ top: tableContainer.offsetTop - 50, behavior: 'smooth' });
            });
        });
    }

    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => fetchFilteredData(), 300);
    });

    statusSelect.addEventListener('change', () => fetchFilteredData());
    
    saveOriginalNumbers();
    bindPaginationLinks();

    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        fetchFilteredData();
    });

    // Menangani tombol 'Back' / 'Forward' bawaan browser agar data ikut sinkron kembali
    window.addEventListener('popstate', function() {
        window.location.reload();
    });
});
</script>

@endsection