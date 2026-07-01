@extends('layouts.user')

@section('content')

<style>

.profile-wrapper{
    max-width:850px;
}

.profile-card{
    background:white;
    border-radius:16px;
    padding:35px;
    box-shadow:0 4px 14px rgba(0,0,0,.06);
}

.profile-header{
    display:flex;
    align-items:center;
    gap:20px;
    margin-bottom:35px;
    padding-bottom:25px;
    border-bottom:1px solid #e5e7eb;
}

.avatar{
    width:80px;
    height:80px;
    border-radius:50%;
    background:#2563eb;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:30px;
    font-weight:700;
}

.profile-info h2{
    font-size:28px;
    color:#0f172a;
    margin-bottom:5px;
}

.profile-info p{
    color:#64748b;
}

.form-group{
    margin-bottom:20px;
}

label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#374151;
}

input{
    width:100%;
    padding:12px;
    border:1px solid #d1d5db;
    border-radius:10px;
    outline:none;
    transition:.2s;
}

input:focus{
    border-color:#2563eb;
}

.readonly-input{
    background:#f3f4f6;
    cursor:not-allowed;
    color:#6b7280;
}

.button-group{
    display:flex;
    gap:10px;
    margin-top:10px;
}

.btn{
    padding:12px 22px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    text-decoration:none;
    font-weight:600;
    display:inline-flex;
    justify-content:center;
    align-items:center;
}

.btn-primary{
    background:#2563eb;
    color:white;
}

.btn-secondary{
    background:#e5e7eb;
    color:#111827;
}

.alert{
    background:#dcfce7;
    color:#166534;
    padding:14px;
    border-radius:10px;
    margin-bottom:20px;
}

small{
    color:#6b7280;
}

</style>

<div class="profile-wrapper">

@if(session('success'))

<div class="alert">

{{ session('success') }}

</div>

@endif

<div class="profile-card">

<div class="profile-header">

<div class="avatar" style="overflow:hidden;">

@if($user->profile_photo)

<img
src="{{ asset('profile/'.$user->profile_photo) }}"
style="
width:100%;
height:100%;
object-fit:cover;
">

@else

{{ strtoupper(substr($user->name,0,1)) }}

@endif

</div>

<div class="profile-info">

<h2>

{{ $user->name }}

</h2>

<p>

Employee Profile Information

</p>

</div>

</div>

<form action="{{ route('profile.update') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf

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

<input
type="text"
value="{{ $user->department }}"
class="readonly-input"
readonly>

<small>

Department can only be changed by administrator.

</small>

</div>

<div class="form-group">

<label>Profile Photo</label>

<input
type="file"
name="profile_photo">

<small>
Upload image jpg, jpeg, png
</small>

</div>

<div class="form-group">

<label>New Password</label>

<input
type="password"
name="password"
placeholder="Leave blank if not changing password">

<small>

Password is optional.

</small>

</div>

<div class="button-group">

<button type="submit"
class="btn btn-primary">

Update Profile

</button>



</div>

</form>

</div>

</div>

@endsection