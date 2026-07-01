@extends('layouts.admin')

@section('content')

<style>

.welcome{
    margin-bottom:30px;
}

.welcome h2{
    color:#1e293b;
    margin-bottom:8px;
}

.welcome p{
    color:#6b7280;
}

.dashboard-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
}

.card{
    background:white;
    border-radius:14px;
    padding:25px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
    transition:.3s;
}

.card:hover{
    transform:translateY(-3px);
}

.card-title{
    font-size:15px;
    color:#6b7280;
    margin-bottom:15px;
}

.card-value{
    font-size:34px;
    font-weight:bold;
    color:#1e293b;
}

.employee{
    border-left:6px solid #2563eb;
}

.category{
    border-left:6px solid #8b5cf6;
}

.active{
    border-left:6px solid #10b981;
}

.archive{
    border-left:6px solid #6b7280;
}

.open{
    border-left:6px solid #3b82f6;
}

.progress{
    border-left:6px solid #f59e0b;
}

.resolved{
    border-left:6px solid #22c55e;
}

.closed{
    border-left:6px solid #ef4444;
}

</style>

<div class="welcome">

    <h2>
        Welcome, {{ session('name') }}
    </h2>

    <p>
        Administrator Dashboard
    </p>

</div>

<div class="dashboard-grid">

    <div class="card employee">
        <div class="card-title">👥 Total Employees</div>
        <div class="card-value">{{ $employees }}</div>
    </div>

    <div class="card category">
        <div class="card-title">📂 Total Categories</div>
        <div class="card-value">{{ $categories }}</div>
    </div>

    <div class="card active">
        <div class="card-title">🎫 Active Tickets</div>
        <div class="card-value">{{ $activeTickets }}</div>
    </div>

    <div class="card archive">
        <div class="card-title">📦 Archived Tickets</div>
        <div class="card-value">{{ $archivedTickets }}</div>
    </div>

    <div class="card open">
        <div class="card-title">🟢 Open Tickets</div>
        <div class="card-value">{{ $openTickets }}</div>
    </div>

    <div class="card progress">
        <div class="card-title">🟡 In Progress</div>
        <div class="card-value">{{ $progressTickets }}</div>
    </div>

    <div class="card resolved">
        <div class="card-title">✅ Resolved Tickets</div>
        <div class="card-value">{{ $resolvedTickets }}</div>
    </div>

    <div class="card closed">
        <div class="card-title">🔴 Closed Tickets</div>
        <div class="card-value">{{ $closedTickets }}</div>
    </div>

</div>

@endsection