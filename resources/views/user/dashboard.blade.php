@extends('layouts.user')

@section('content')

<style>

.welcome-box{
    margin-bottom:30px;
}

.welcome-box h2{
    font-size:30px;
    color:#1e293b;
    margin-bottom:8px;
}

.welcome-box p{
    color:#64748b;
}

.dashboard-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

.stat-card{
    background:white;
    border-radius:16px;
    padding:25px;
    box-shadow:0 4px 12px rgba(0,0,0,.06);
    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-3px);
}

.stat-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:15px;
}

.stat-title{
    font-size:15px;
    color:#64748b;
    font-weight:600;
}

.stat-icon{
    font-size:28px;
}

.stat-value{
    font-size:34px;
    font-weight:700;
    color:#0f172a;
}

.total{
    border-left:5px solid #2563eb;
}

.open{
    border-left:5px solid #3b82f6;
}

.progress{
    border-left:5px solid #f59e0b;
}

.resolved{
    border-left:5px solid #22c55e;
}

.closed{
    border-left:5px solid #ef4444;
}

</style>

<div class="welcome-box">

<h2>
Welcome, {{ session('name') }}
</h2>

<p>
Here is your helpdesk ticket summary.
</p>

</div>

<div class="dashboard-grid">

<div class="stat-card total">

<div class="stat-header">

<div class="stat-title">
My Tickets
</div>

<div class="stat-icon">
🎫
</div>

</div>

<div class="stat-value">
{{ $totalTickets }}
</div>

</div>

<div class="stat-card open">

<div class="stat-header">

<div class="stat-title">
Open Tickets
</div>

<div class="stat-icon">
🟢
</div>

</div>

<div class="stat-value">
{{ $openTickets }}
</div>

</div>

<div class="stat-card progress">

<div class="stat-header">

<div class="stat-title">
In Progress
</div>

<div class="stat-icon">
🟡
</div>

</div>

<div class="stat-value">
{{ $progressTickets }}
</div>

</div>

<div class="stat-card resolved">

<div class="stat-header">

<div class="stat-title">
Resolved Tickets
</div>

<div class="stat-icon">
✅
</div>

</div>

<div class="stat-value">
{{ $resolvedTickets }}
</div>

</div>

<div class="stat-card closed">

<div class="stat-header">

<div class="stat-title">
Closed Tickets
</div>

<div class="stat-icon">
🔴
</div>

</div>

<div class="stat-value">
{{ $closedTickets }}
</div>

</div>

</div>

@endsection