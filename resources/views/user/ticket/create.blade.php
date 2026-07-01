@extends('layouts.user')

@section('content')

<style>

.card{
    background:white;
    width:750px;
    padding:30px;
    border-radius:12px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
}

.form-group{
    margin-bottom:18px;
}

label{
    display:block;
    font-weight:600;
    margin-bottom:8px;
}

input,
select,
textarea{
    width:100%;
    padding:12px;
    border:1px solid #ddd;
    border-radius:8px;
}

textarea{
    resize:none;
    height:150px;
}

.button-group{
    display:flex;
    gap:10px;
    margin-top:10px;
}

.btn{
    border:none;
    padding:12px 22px;
    border-radius:8px;
    cursor:pointer;
    text-decoration:none;
    font-weight:600;
    display:inline-flex;
    align-items:center;
    justify-content:center;
}

.btn-primary{
    background:#2563eb;
    color:white;
}

.btn-secondary{
    background:#e5e7eb;
    color:#111827;
}

</style>

<div class="card">

<h2>Create Ticket</h2>

<br>

<form action="{{ route('ticket.store') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf

<div class="form-group">

<label>Category</label>

<select name="category_id">

@foreach($categories as $category)

<option value="{{ $category->id }}">

{{ $category->category_name }}

</option>

@endforeach

</select>

</div>

<div class="form-group">

<label>Title</label>

<input
type="text"
name="title"
placeholder="Example : Computer cannot boot">

</div>

<div class="form-group">

<label>Priority</label>

<select name="priority">

<option value="Low">Low</option>

<option value="Medium" selected>Medium</option>

<option value="High">High</option>

</select>

</div>

<div class="form-group">

<label>Description</label>

<textarea
name="description"
placeholder="Describe your problem..."></textarea>

</div>

<div class="form-group">

<label>Attachment</label>

<input
type="file"
name="attachment">

<small style="color:#6b7280;">
Optional (jpg, jpeg, png, pdf, docx)
</small>

</div>

<div class="button-group">

<button class="btn btn-primary">

Submit Ticket

</button>

<a href="{{ route('ticket.index') }}"
class="btn btn-secondary">

Back

</a>

</div>

</form>

</div>

@endsection