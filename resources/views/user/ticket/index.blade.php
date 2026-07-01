@extends('layouts.user')

@section('content')

<style>

.page-title{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.page-title h2{
    font-size:28px;
}

.btn{
    background:#2563eb;
    color:white;
    text-decoration:none;
    padding:10px 18px;
    border-radius:8px;
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
    text-align:left;
}

td{
    padding:14px;
    border-bottom:1px solid #eee;
}

.badge{
    padding:6px 12px;
    border-radius:20px;
    color:white;
    font-size:13px;
    font-weight:600;
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

.view-btn{
    background:#2563eb;
    color:white;
    padding:7px 12px;
    border-radius:6px;
    text-decoration:none;
    font-size:13px;
}

.file-link{
    color:#2563eb;
    text-decoration:none;
    font-weight:600;
}

.file-link:hover{
    text-decoration:underline;
}

.empty{
    text-align:center;
    padding:30px;
    color:#6b7280;
}

</style>

<div class="page-title">

    <h2>My Tickets</h2>

    <a href="{{ route('ticket.create') }}" class="btn">
        + Create Ticket
    </a>

</div>

@if(session('success'))

<div style="background:#dcfce7;color:#166534;padding:12px 18px;border-radius:8px;margin-bottom:20px;">
    {{ session('success') }}
</div>

@endif

<div class="table-box">

<table>

<thead>

<tr>

<th>Code</th>
<th>Title</th>
<th>Category</th>
<th>Priority</th>
<th>Attachment</th>
<th>Status</th>
<th>Created</th>
<th>Action</th>

</tr>

</thead>

<tbody>

@forelse($tickets as $ticket)

<tr>

<td>{{ $ticket->ticket_code }}</td>

<td>{{ $ticket->title }}</td>

<td>{{ $ticket->category }}</td>

<td>{{ $ticket->priority }}</td>

<td>

@if($ticket->attachment)

<a
href="{{ asset('uploads/'.$ticket->attachment) }}"
target="_blank"
class="file-link">

View File

</a>

@else

-

@endif

</td>

<td>

<span class="badge

@if($ticket->status=='Open')
open
@elseif($ticket->status=='In Progress')
progress
@elseif($ticket->status=='Resolved')
resolved
@else
closed
@endif

">

{{ $ticket->status }}

</span>

</td>

<td>

{{ date('d M Y', strtotime($ticket->created_at)) }}

</td>

<td>

<a
href="{{ route('ticket.show',$ticket->id) }}"
class="view-btn">

View

</a>

</td>

</tr>

@empty

<tr>

<td colspan="8" class="empty">

No tickets found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

@endsection