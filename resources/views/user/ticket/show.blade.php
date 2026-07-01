@extends('layouts.user')

@section('content')

<style>
.card{
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

table{
    width:100%;
}

td{
    padding:10px 0;
    vertical-align:top;
}

.label{
    width:180px;
    font-weight:600;
}

.badge{
    background:#2563eb;
    color:white;
    padding:5px 12px;
    border-radius:20px;
    display: inline-block;
    line-height: 1;
    vertical-align: middle;
}

/* Mengubah tombol Back menjadi abu-abu */
.btn{
    display:inline-block;
    margin-top:20px;
    background:#64748b; /* Abu-abu Slate */
    color:white;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    font-weight: 500;
    transition: .2s;
}

.btn:hover{
    background:#475569; /* Abu-abu yang lebih gelap saat di-hover */
}
</style>

<div class="card">

<h2>Ticket Detail</h2>

<hr><br>

<table>

<tr>
    <td class="label">Ticket Code</td>
    <td>{{ $ticket->ticket_code }}</td>
</tr>

<tr>
    <td class="label">Title</td>
    <td>{{ $ticket->title }}</td>
</tr>

<tr>
    <td class="label">Category</td>
    <td>{{ $ticket->category }}</td>
</tr>

<tr>
    <td class="label">Priority</td>
    <td>{{ $ticket->priority }}</td>
</tr>

<tr>
    <td class="label">Status</td>
    <td>
        <span class="badge">
            {{ $ticket->status }}
        </span>
    </td>
</tr>

<tr>
    <td class="label">Description</td>
    <td>{{ $ticket->description }}</td>
</tr>


<tr>
    <td class="label">Attachment</td>
    <td>
        @if($ticket->attachment)
            <a href="{{ asset('uploads/'.$ticket->attachment) }}" target="_blank">
                {{ $ticket->attachment }}
            </a>
        @else
            -
        @endif
    </td>
</tr>
</table>

<a href="{{ route('ticket.index') }}" class="btn">
← Back
</a>

</div>

@endsection