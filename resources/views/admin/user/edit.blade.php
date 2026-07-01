@extends('layouts.admin')

@section('content')

<style>

.card{
    background:white;
    padding:30px;
    border-radius:12px;
    width:700px;
    box-shadow:0 4px 12px rgba(0,0,0,.08);
}

.card h2{
    margin-bottom:25px;
}

.form-group{
    margin-bottom:18px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#374151;
}

input,
select{
    width:100%;
    padding:12px;
    border:1px solid #d1d5db;
    border-radius:8px;
    outline:none;
}

input:focus,
select:focus{
    border-color:#2563eb;
}

.btn-group{
    display:flex;
    gap:10px;
    margin-top:25px;
}

.btn-update{
    background:#2563eb;
    color:white;
    border:none;
    padding:12px 22px;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
    transition:.3s;
}

.btn-update:hover{
    background:#1d4ed8;
}

.btn-back{
    background:#6b7280;
    color:white;
    text-decoration:none;
    padding:12px 22px;
    border-radius:8px;
    font-weight:600;
    transition:.3s;
}

.btn-back:hover{
    background:#4b5563;
}

</style>

<div class="card">

<h2>Edit Employee</h2>

<form action="{{ route('user.update',$user->id) }}" method="POST">

@csrf

<div class="form-group">

<label>Employee ID</label>

<input
type="text"
name="employee_id"
value="{{ $user->employee_id }}"
required>

</div>

<div class="form-group">

<label>Name</label>

<input
type="text"
name="name"
value="{{ $user->name }}"
required>

</div>

<div class="form-group">

<label>Email</label>

<input
type="email"
name="email"
value="{{ $user->email }}"
required>

</div>

<div class="form-group">

<label>Phone</label>

<input
type="text"
name="phone"
value="{{ $user->phone }}">

</div>

<div class="form-group">

<label>Department</label>

<select name="department">

<option value="IT" {{ $user->department=='IT' ? 'selected' : '' }}>
IT
</option>

<option value="Finance" {{ $user->department=='Finance' ? 'selected' : '' }}>
Finance
</option>

<option value="HR" {{ $user->department=='HR' ? 'selected' : '' }}>
HR
</option>

<option value="Marketing" {{ $user->department=='Marketing' ? 'selected' : '' }}>
Marketing
</option>

<option value="Operations" {{ $user->department=='Operations' ? 'selected' : '' }}>
Operations
</option>

</select>

</div>

<div class="form-group">

<label>Role</label>

<select name="role">

<option value="user"
{{ $user->role=='user' ? 'selected' : '' }}>
Employee
</option>

<option value="admin"
{{ $user->role=='admin' ? 'selected' : '' }}>
Admin
</option>

</select>

</div>

<div class="btn-group">

<button
type="submit"
class="btn-update">

Update Employee

</button>

<a
href="{{ route('user.index') }}"
class="btn-back">

Back

</a>

</div>

</form>

</div>

@endsection