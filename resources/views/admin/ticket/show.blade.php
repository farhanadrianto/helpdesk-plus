@extends('layouts.admin')

@section('content')

<style>

.card{
    background:white;
    border-radius:12px;
    padding:30px;
    max-width:900px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

.row{
    margin-bottom:18px;
}

label{
    display:block;
    font-weight:700;
    margin-bottom:6px;
    color:#374151;
}

.value{
    background:#f8fafc;
    border:1px solid #e5e7eb;
    border-radius:8px;
    padding:12px;
}

.badge{
    display:inline-block;
    padding:6px 14px;
    border-radius:20px;
    color:white;
    font-size:14px;
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

.btn{
    display:inline-flex;
    justify-content:center;
    align-items:center;
    min-width:140px;
    padding:10px 18px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
    text-decoration:none;
    transition:.2s;
}

.btn:hover{
    opacity:.9;
}

.btn-primary{
    background:#2563eb;
    color:white;
}

.btn-warning{
    background:#f59e0b;
    color:white;
}

.btn-success{
    background:#16a34a;
    color:white;
}

.btn-secondary{
    background:#e5e7eb;
    color:#111827;
}

select{
    width:100%;
    padding:12px;
    border:1px solid #ddd;
    border-radius:8px;
}

.action-box{
    margin-top:35px;
    padding-top:25px;
    border-top:1px solid #e5e7eb;
}

.action-buttons{
    display:flex;
    gap:10px;
    margin-top:20px;
}

.archive-action{
    margin-top:15px;
}

</style>

<h2 style="margin-bottom:25px;">
    Ticket Detail
</h2>

<div class="card">

    <div class="row">
        <label>Ticket Code</label>
        <div class="value">{{ $ticket->ticket_code }}</div>
    </div>

    <div class="row">
        <label>Employee</label>
        <div class="value">{{ $ticket->name }}</div>
    </div>

    <div class="row">
        <label>Category</label>
        <div class="value">{{ $ticket->category }}</div>
    </div>

    <div class="row">
        <label>Title</label>
        <div class="value">{{ $ticket->title }}</div>
    </div>

    <div class="row">
        <label>Priority</label>
        <div class="value">{{ $ticket->priority }}</div>
    </div>

    <div class="row">
        <label>Description</label>
        <div class="value">
            {!! nl2br(e($ticket->description)) !!}
        </div>
    </div>

    <div class="row">
        <label>Attachment</label>

        <div class="value">

            @if($ticket->attachment)

                <a href="{{ asset('uploads/'.$ticket->attachment) }}" target="_blank">
                    View Attachment
                </a>

            @else

                -

            @endif

        </div>

    </div>

    <div class="row">

        <label>Current Status</label>

        <div class="value">

            <span class="badge
            @if($ticket->status=='Open') open
            @elseif($ticket->status=='In Progress') progress
            @elseif($ticket->status=='Resolved') resolved
            @else closed
            @endif">

                {{ $ticket->status }}

            </span>

        </div>

    </div>

    <div class="action-box">

        <h3 style="margin-bottom:20px;">
            Ticket Action
        </h3>

        <form action="{{ route('admin.ticket.status',$ticket->id) }}" method="POST">

            @csrf

            <input
                type="hidden"
                name="from_archive"
                value="{{ $ticket->is_archived }}">


            @csrf

            <div class="row">

                <label>Update Status</label>

                <select name="status">

                    <option value="Open" {{ $ticket->status=='Open'?'selected':'' }}>
                        Open
                    </option>

                    <option value="In Progress" {{ $ticket->status=='In Progress'?'selected':'' }}>
                        In Progress
                    </option>

                    <option value="Resolved" {{ $ticket->status=='Resolved'?'selected':'' }}>
                        Resolved
                    </option>

                    <option value="Closed" {{ $ticket->status=='Closed'?'selected':'' }}>
                        Closed
                    </option>

                </select>

            </div>

            <div class="action-buttons">

                <button
                    type="submit"
                    class="btn btn-primary">

                    Update Status

                </button>

                <a
                href="{{ $ticket->is_archived == 1
                        ? route('admin.ticket.archive.index')
                        : route('admin.ticket.index') }}"
                class="btn btn-secondary">

                Back

                </a>

            </div>

        </form>

        <div class="archive-action">

        @if($ticket->is_archived==0)

            @if($ticket->status=='Resolved' || $ticket->status=='Closed')

            <form action="{{ route('admin.ticket.archive',$ticket->id) }}" method="POST">

                @csrf

                <button
                    type="submit"
                    class="btn btn-warning"
                    onclick="return confirm('Archive ticket ini?')">

                    Archive Ticket

                </button>

            </form>

            @endif

        @else

            <form action="{{ route('admin.ticket.activate',$ticket->id) }}" method="POST">

                @csrf

                <button
                    type="submit"
                    class="btn btn-success"
                    onclick="return confirm('Aktifkan kembali ticket ini?')">

                    Activate Ticket

                </button>

            </form>

        @endif

        </div>

    </div>

</div>

@endsection