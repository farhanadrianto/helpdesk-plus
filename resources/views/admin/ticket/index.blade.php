@extends('layouts.admin')

@section('content')

<style>

.page-title{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
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

/* --- PERBAIKAN BADGE STATUS SUPAYA TETAP FLEX / TIDAK NGE-WRAP --- */
.badge{
padding:6px 12px;
border-radius:20px;
color:white;
font-size:13px;
font-weight:600;
display: inline-block;
white-space: nowrap; /* Memaksa teks teks status seperti "In Progress" tetap satu baris */
}

.open{background:#2563eb;}
.progress{background:#f59e0b;}
.resolved{background:#16a34a;}
.closed{background:#6b7280;}

.btn{
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

.file-link{
color:#2563eb;
text-decoration:none;
font-weight:600;
}

.search-box{
margin-bottom:20px;
display:flex;
gap:10px;
align-items:center;
}

.search-input{
padding:10px 14px;
border:1px solid #d1d5db;
border-radius:8px;
width:280px;
outline:none;
font-size:14px;
}

.search-input:focus{
border-color:#2563eb;
}

.search-btn{
background:#2563eb;
color:white;
border:none;
padding:10px 18px;
border-radius:8px;
cursor:pointer;
font-weight:600;
}

/* --- PAGINATION FIXED DI TENGAH BAWAH --- */

.pagination-wrapper{
display:flex;
justify-content:center;
margin-top:15px; /* Menempel tepat di bawah tabel */
margin-bottom:25px;
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
display:flex;
gap:8px;
list-style:none;
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
padding:0 12px;
border-radius:8px;
text-decoration:none;
border:1px solid #dbe2ea;
color:#1e293b;
font-size:14px;
box-sizing: border-box;
background: white;
}

.pagination-wrapper li.active span,
.pagination li.active span,
.pagination-wrapper li[aria-current="page"] span {
background:#2563eb !important;
color:white !important;
border-color:#2563eb !important;
font-weight: 600;
}

.pagination-wrapper li a:hover,
.pagination li a:hover {
background:#eff6ff;
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

<a href="{{ route('admin.ticket.index') }}"
class="tab active-tab">

Active Tickets

</a>

<a href="{{ route('admin.ticket.archive.index') }}"
class="tab inactive-tab">

Archived Tickets

</a>

</div>

<form method="GET" class="search-box" id="filterForm">

<input
type="text"
name="search"
id="jsSearchInput"
class="search-input"
placeholder="Search ticket..."
value="{{ request('search') }}">

<select
name="status"
id="jsStatusSelect"
class="search-input"
style="width:180px;">

<option value="">All Status</option>

<option value="Open"
{{ request('status') == 'Open' ? 'selected' : '' }}>
Open
</option>

<option value="In Progress"
{{ request('status') == 'In Progress' ? 'selected' : '' }}>
In Progress
</option>

<option value="Resolved"
{{ request('status') == 'Resolved' ? 'selected' : '' }}>
Resolved
</option>

<option value="Closed"
{{ request('status') == 'Closed' ? 'selected' : '' }}>
Closed
</option>

</select>

<button
type="submit"
class="search-btn">

Filter

</button>

</form>

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

<tbody id="ticketTableBody">

@forelse($tickets as $ticket)

<tr class="ticket-row">

<td>
{{ ($tickets->currentPage() - 1) * $tickets->perPage() + $loop->iteration }}
</td>

<td>{{ $ticket->ticket_code }}</td>

<td>{{ $ticket->employee }}</td>

<td class="ticket-title">{{ $ticket->title }}</td>

<td>{{ $ticket->category }}</td>

<td>{{ $ticket->priority }}</td>

<td class="ticket-status">

<span class="badge
@if($ticket->status=='Open') open
@elseif($ticket->status=='In Progress') progress
@elseif($ticket->status=='Resolved') resolved
@else closed
@endif">

{{ $ticket->status }}

</span>

</td>

<td>

{{ date('d M Y',strtotime($ticket->created_at)) }}

</td>

<td>

@if($ticket->attachment)

<a
href="{{ asset('uploads/'.$ticket->attachment) }}"
target="_blank"
class="file-link">

See File

</a>

@else

-

@endif

</td>

<td>

<a
href="{{ route('admin.ticket.show',$ticket->id) }}"
class="btn">

View

</a>

<form
action="{{ route('admin.ticket.destroy',$ticket->id) }}"
method="POST"
style="display:inline;">

@csrf
@method('DELETE')

<button
type="submit"
class="btn-delete"
onclick="return confirm('Hapus ticket ini?')">

Delete

</button>

</form>

</td>

</tr>

@empty

<tr id="emptyRow">

<td colspan="10" align="center">

No tickets found.

</td>

</tr>

@endforelse

<tr id="jsNoResultRow" style="display: none;">
    <td colspan="10" align="center" style="color: #6b7280; padding: 20px;">
        No matching tickets found.
    </td>
</tr>

</tbody>

</table>

</div>

<div class="pagination-wrapper" id="paginationSection">

{{ $tickets->links() }}

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('jsSearchInput');
    const statusSelect = document.getElementById('jsStatusSelect');
    const tableRows = document.querySelectorAll('.ticket-row');
    const noResultRow = document.getElementById('jsNoResultRow');
    const paginationSection = document.getElementById('paginationSection');
    const filterForm = document.getElementById('filterForm');

    // Cegah reload form jika menekan enter di input text
    filterForm.addEventListener('submit', function(e) {
        if(e.submitter && e.submitter.type !== 'submit') {
            e.preventDefault();
        }
    });

    function performSearch() {
        const query = searchInput.value.toLowerCase().trim();
        const selectedStatus = statusSelect.value.toLowerCase();
        let visibleCount = 0;

        tableRows.forEach(row => {
            const titleText = row.querySelector('.ticket-title').textContent.toLowerCase();
            const statusText = row.querySelector('.ticket-status').textContent.toLowerCase().trim();

            const matchesQuery = titleText.includes(query);
            const matchesStatus = selectedStatus === "" || statusText === selectedStatus;

            if (matchesQuery && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        if (tableRows.length > 0) {
            if (visibleCount === 0) {
                noResultRow.style.display = '';
            } else {
                noResultRow.style.display = 'none';
            }
        }

        // Sembunyikan pagination angka saat sedang menyaring data lokal aktif
        if (query !== "" || selectedStatus !== "") {
            paginationSection.style.display = 'none';
        } else {
            paginationSection.style.display = '';
        }
    }

    searchInput.addEventListener('input', performSearch);
    statusSelect.addEventListener('change', performSearch);
});
</script>

@endsection