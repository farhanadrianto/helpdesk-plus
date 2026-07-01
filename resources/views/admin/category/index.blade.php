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

    <h2>Category Management</h2>

    <a href="{{ route('category.create') }}" class="btn btn-primary">

        + Add Category

    </a>

</div>

<div class="table-box">

<table>

<thead>

<tr>

<th width="80">No</th>
<th>Category Name</th>
<th width="180">Created At</th>
<th width="220">Action</th>

</tr>

</thead>

<tbody>

@forelse($categories as $category)

<tr>

<td>

{{ $loop->iteration }}

</td>

<td>

{{ $category->category_name }}

</td>

<td>

{{ date('d M Y', strtotime($category->created_at)) }}

</td>

<td>

<div class="action">

<a
href="{{ route('category.edit',$category->id) }}"
class="btn-edit">

Edit

</a>

<form
action="{{ route('category.delete',$category->id) }}"
method="GET"
onsubmit="return confirm('Delete this category?')">

<button
type="submit"
class="btn-delete">

Delete

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="4">

No categories found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

@endsection