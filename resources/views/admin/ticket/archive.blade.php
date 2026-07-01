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
}

.open{background:#2563eb;}
.progress{background:#f59e0b;}
.resolved{background:#16a34a;}
.closed{background:#6b7280;}

/* Update tombol View */
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
    border: 1px solid transparent;
    box-sizing: border-box;
}

/* Update tombol Delete */
.btn-delete{
    background:#dc2626;
    color:white;
    padding:7px 0;
    border: 1px solid transparent;
    border-radius:6px;
    cursor:pointer;
    margin-left:5px;
    display:inline-block;
    width:80px;
    text-align:center;
    font-size:14px;
    box-sizing: border-box;
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

<tr>

<td>{{ $loop->iteration }}</td>

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

<td>

{{ date('d M Y', strtotime($ticket->created_at)) }}

</td>

<td>

@if($ticket->attachment)

<a
href="{{ asset('uploads/'.$ticket->attachment) }}"
target="_blank">

See File

</a>

@else

-

@endif

</td>

<td>

<a
href="{{ route('admin.ticket.show',$ticket->id) }}"
class="btn-view">

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

<tr>

<td colspan="10" align="center">

No archived tickets.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

@endsection