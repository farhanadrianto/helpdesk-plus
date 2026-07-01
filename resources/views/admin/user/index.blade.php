@extends('layouts.admin')

@section('content')

<style>

.page-title{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;
}

.page-title h2{
    font-size:28px;
    font-weight:700;
}

.btn{
    display:inline-block;
    padding:12px 22px;
    border-radius:10px;
    text-decoration:none;
    color:white;
    font-weight:600;
    transition:.3s;
}

.btn-primary{
    background:#2563eb;
}

.btn-primary:hover{
    background:#1d4ed8;
}

.table-box{
    background:white;
    border-radius:16px;
    overflow:hidden;
    box-shadow:0 6px 18px rgba(0,0,0,.08);
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#1e293b;
    color:white;
    padding:18px;
    text-align:center;
    font-size:15px;
}

td{
    padding:18px;
    border-bottom:1px solid #eee;
    text-align:center;
}

tbody tr:hover{
    background:#f8fafc;
}

.action{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:10px;
}

.btn-edit,
.btn-delete{
    width:80px;
    height:40px;
    border:none;
    border-radius:8px;
    color:white;
    font-weight:600;
    font-size:14px;
    text-decoration:none;
    display:flex;
    justify-content:center;
    align-items:center;
    cursor:pointer;
    transition:.3s;
}

.btn-edit{
    background:#22c55e;
}

.btn-edit:hover{
    background:#16a34a;
}

.btn-delete{
    background:#ef4444;
}

.btn-delete:hover{
    background:#dc2626;
}

.alert{
    background:#dcfce7;
    color:#166534;
    padding:14px;
    border-radius:10px;
    margin-bottom:20px;
}

</style>

@if(session('success'))

<div class="alert">
    {{ session('success') }}
</div>

@endif

<div class="page-title">

    <h2>Employee Management</h2>

    <a href="{{ route('user.create') }}" class="btn btn-primary">

        + Add Employee

    </a>

</div>

<div class="table-box">

<table>

<thead>

<tr>

<th width="70">No</th>
<th>Employee ID</th>
<th>Name</th>
<th>Email</th>
<th>Department</th>
<th>Phone</th>
<th>Role</th>
<th width="220">Action</th>

</tr>

</thead>

<tbody>

@forelse($users as $u)

<tr>

<td>

{{ $loop->iteration }}

</td>

<td>

{{ $u->employee_id }}

</td>

<td>

{{ $u->name }}

</td>

<td>

{{ $u->email }}

</td>

<td>

{{ $u->department }}

</td>

<td>

{{ $u->phone }}

</td>

<td>

{{ ucfirst($u->role) }}

</td>

<td>

<div class="action">

<a
href="{{ route('user.edit',$u->id) }}"
class="btn-edit">

Edit

</a>

<a
href="{{ route('user.delete',$u->id) }}"
class="btn-delete"
onclick="return confirm('Delete this employee?')">

Delete

</a>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="8">

No employees found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

@endsection