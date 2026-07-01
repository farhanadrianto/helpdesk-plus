<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Helpdesk Plus - Sign In</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
    position:relative;
    background:#f8fafc;
}

/* BACKGROUND */

.gradient-bg{
    position:absolute;
    inset:0;
    overflow:hidden;
    z-index:1;
    pointer-events:none;
}

.ball{
    position:absolute;
    border-radius:50%;
    filter:blur(50px);
    opacity:.55;
    animation-duration:12s;
    animation-iteration-count:infinite;
    animation-timing-function:ease-in-out;
}

/* BALLS */

.ball-1{
    width:420px;
    height:420px;
    background:#3b82f6;
    top:-80px;
    left:-80px;
    animation-name:float1;
}

.ball-2{
    width:380px;
    height:380px;
    background:#ec4899;
    bottom:-100px;
    right:-80px;
    animation-name:float2;
}

.ball-3{
    width:300px;
    height:300px;
    background:#f59e0b;
    top:40%;
    left:45%;
    animation-name:float3;
}

/* ANIMATION */

@keyframes float1{

    0%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(40px,30px);
    }

    100%{
        transform:translate(0,0);
    }

}

@keyframes float2{

    0%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(-30px,-40px);
    }

    100%{
        transform:translate(0,0);
    }

}

@keyframes float3{

    0%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(-20px,20px);
    }

    100%{
        transform:translate(0,0);
    }

}

/* LOGIN CARD */

.container{
    width:100%;
    max-width:430px;
    padding:42px;
    border-radius:24px;

    background:rgba(255,255,255,.72);

    backdrop-filter:blur(14px);
    -webkit-backdrop-filter:blur(14px);

    border:1px solid rgba(255,255,255,.6);

    box-shadow:
    0 10px 40px rgba(15,23,42,.08);

    position:relative;
    z-index:5;
}

/* LOGO */

.logo{
    width:78px;
    height:78px;
    margin:auto;

    border-radius:22px;

    background:linear-gradient(
        135deg,
        #2563eb,
        #1d4ed8
    );

    display:flex;
    justify-content:center;
    align-items:center;

    color:white;
    font-size:28px;
    font-weight:700;

    box-shadow:
    0 10px 25px rgba(37,99,235,.25);
}

h2{
    margin-top:24px;
    text-align:center;
    color:#0f172a;
    font-size:30px;
    font-weight:700;
}

.subtitle{
    margin-top:8px;
    margin-bottom:34px;

    text-align:center;
    color:#64748b;
    font-size:14px;
}

/* FORM */

.form-group{
    margin-bottom:20px;
}

label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:500;
    color:#334155;
}

input{
    width:100%;
    padding:14px 16px;

    border:1px solid #dbe2ea;
    border-radius:14px;

    outline:none;

    font-size:15px;

    background:rgba(255,255,255,.9);

    transition:.25s;
}

input:focus{

    border-color:#2563eb;

    box-shadow:
    0 0 0 4px rgba(37,99,235,.10);

    background:white;
}

/* STYLE BARU: DEMO ACCOUNT HINT WRAPPER */
.demo-accounts-box {
    background: rgba(241, 245, 249, 0.7);
    border: 1px dashed #cbd5e1;
    border-radius: 16px;
    padding: 14px;
    margin-bottom: 24px;
}

.demo-title {
    font-size: 12px;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.demo-flex {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.account-badge {
    display: flex;
    align-items: center;
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 6px 12px;
    gap: 10px;
    font-size: 12px;
}

.role-pill {
    font-size: 10px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 20px;
    color: white;
    text-transform: uppercase;
    min-width: 65px;
    text-align: center;
}

.role-admin {
    background: #475569;
}

.role-user {
    background: #0ea5e9;
}

.account-details {
    color: #334155;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.account-details strong {
    color: #1e293b;
}

/* BUTTON */

button{
    width:100%;
    border:none;
    padding:14px;

    border-radius:14px;

    background:linear-gradient(
        135deg,
        #2563eb,
        #1d4ed8
    );

    color:white;
    font-size:15px;
    font-weight:600;

    cursor:pointer;

    transition:.25s;
}

button:hover{

    transform:translateY(-1px);

    box-shadow:
    0 10px 24px rgba(37,99,235,.25);
}

/* ALERT */

.alert{
    background:#fef2f2;
    color:#dc2626;

    padding:13px;

    border-radius:12px;

    margin-bottom:18px;

    font-size:14px;

    border:1px solid rgba(220,38,38,.1);
}

.success-alert{
    background:#ecfdf5;
    color:#065f46;
    border:1px solid rgba(16,185,129,.15);
}

/* FOOTER */

.footer{
    margin-top:28px;
    text-align:center;

    color:#94a3b8;
    font-size:13px;
}

/* RESPONSIVE */

@media(max-width:500px){

    .container{
        margin:20px;
        padding:34px 28px;
    }

}

</style>

</head>

<body>

<div class="gradient-bg">

    <div class="ball ball-1"></div>

    <div class="ball ball-2"></div>

    <div class="ball ball-3"></div>

</div>

<div class="container">

    <div class="logo">

        HP

    </div>

    <h2>

        Helpdesk Plus

    </h2>

    <p class="subtitle">

        Sign in to continue

    </p>

        @if(session('success'))

        <div class="alert success-alert">

            {{ session('success') }}

        </div>

        @endif

        @if(session('error'))

        <div class="alert">

            {{ session('error') }}

        </div>

        @endif

    @if ($errors->any())

    <div class="alert">

        {{ $errors->first() }}

    </div>

    @endif

    <form action="{{ route('login.process') }}" method="POST">

        @csrf

        <div class="form-group">

            <label>Email</label>

            <input
            type="email"
            name="email"
            placeholder="Enter your email"
            required>

        </div>

        <div class="form-group">

            <label>Password</label>

            <input
            type="password"
            name="password"
            placeholder="Enter your password"
            required>

        </div>

        <div class="demo-accounts-box">
            <div class="demo-title">💡 Demo Accounts</div>
            <div class="demo-flex">
                <div class="account-badge">
                    <span class="role-pill role-admin">Admin</span>
                    <div class="account-details">
                        admin@helpdesk.com &bull; <strong>admin</strong>
                    </div>
                </div>
                <div class="account-badge">
                    <span class="role-pill role-user">Employee</span>
                    <div class="account-details">
                        laksmana@gmail.com &bull; <strong>123456</strong>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit">

            Sign In

        </button>

    </form>

        <div style="margin-top:18px;text-align:center;">

        <span style="color:#64748b;font-size:14px;">

        Don't have an account?

        </span>

        <a
        href="{{ route('register') }}"
        style="
        color:#2563eb;
        font-weight:600;
        text-decoration:none;
        ">

        Sign Up

        </a>

        </div>

        <div class="footer">

        © {{ date('Y') }} Helpdesk Plus

        </div>

</div>

</body>
</html>