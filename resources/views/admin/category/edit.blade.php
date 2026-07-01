@extends('layouts.admin')

@section('content')

<style>

.card{
    background:white;
    width:650px;
    padding:30px;
    border-radius:12px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

.form-group{
    margin-bottom:20px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
}

input{
    width:100%;
    padding:12px;
    border:1px solid #ddd;
    border-radius:8px;
}

.btn{
    padding:12px 20px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
}

.btn-primary{
    background:#2563eb;
    color:white;
}

.btn-secondary{
    background:#e5e7eb;
    color:#111827;
    text-decoration:none;
    padding:12px 20px;
    border-radius:8px;
    margin-right:10px;
}

.error{
    color:red;
    font-size:13px;
    margin-top:5px;
}

</style>

<div class="card">

<h2>Edit Category</h2>

<br>

<form action="{{ route('category.update',$category->id) }}" method="POST">

@csrf

<div class="form-group">

<label>Category Name</label>

<input
type="text"
name="category_name"
value="{{ old('category_name',$category->category_name) }}"
placeholder="Example: Hardware">

@error('category_name')

<div class="error">

{{ $message }}

</div>

@enderror

</div>

<a href="{{ route('category.index') }}" class="btn-secondary">

Back

</a>

<button class="btn btn-primary">

Update Category

</button>

</form>

</div>

@endsection