<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk Plus - Register</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            /* PERBAIKAN: Izinkan scroll vertikal jika konten melebihi layar */
            overflow-y: auto; 
            overflow-x: hidden;
            position:relative;
            background:#f8fafc;
            padding:40px 20px; /* Memberi ruang space atas bawah saat di-scroll */
        }

        /* BACKGROUND */
        .gradient-bg{
            /* PERBAIKAN: Menggunakan fixed agar background mengunci di layar saat di-scroll */
            position:fixed; 
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

        @keyframes float1{
            0%{ transform:translate(0,0); }
            50%{ transform:translate(40px,30px); }
            100%{ transform:translate(0,0); }
        }

        @keyframes float2{
            0%{ transform:translate(0,0); }
            50%{ transform:translate(-30px,-40px); }
            100%{ transform:translate(0,0); }
        }

        @keyframes float3{
            0%{ transform:translate(0,0); }
            50%{ transform:translate(-20px,20px); }
            100%{ transform:translate(0,0); }
        }

        /* CARD */
        .container{
            width:100%;
            max-width:470px;
            padding:40px;
            border-radius:24px;
            background:rgba(255,255,255,.72);
            backdrop-filter:blur(14px);
            -webkit-backdrop-filter:blur(14px);
            border:1px solid rgba(255,255,255,.6);
            box-shadow: 0 10px 40px rgba(15,23,42,.08);
            position:relative;
            z-index:5;
            /* Tambahan margin otomatis agar pas di tengah saat scroll aktif */
            margin: auto; 
        }

        /* LOGO */
        .logo{
            width:78px;
            height:78px;
            margin:auto;
            border-radius:22px;
            background:linear-gradient(135deg, #2563eb, #1d4ed8);
            display:flex;
            justify-content:center;
            align-items:center;
            color:white;
            font-size:28px;
            font-weight:700;
            box-shadow: 0 10px 25px rgba(37,99,235,.25);
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
            margin-bottom:18px;
        }

        label{
            display:block;
            margin-bottom:8px;
            font-size:14px;
            font-weight:500;
            color:#334155;
        }

        input,
        select{
            width:100%;
            padding:14px 16px;
            border:1px solid #dbe2ea;
            border-radius:14px;
            outline:none;
            font-size:15px;
            background:rgba(255,255,255,.9);
            transition:.25s;
        }

        input:focus,
        select:focus{
            border-color:#2563eb;
            box-shadow: 0 0 0 4px rgba(37,99,235,.10);
            background:white;
        }

        /* BUTTON */
        button{
            width:100%;
            border:none;
            padding:14px;
            border-radius:14px;
            background:linear-gradient(135deg, #2563eb, #1d4ed8);
            color:white;
            font-size:15px;
            font-weight:600;
            cursor:pointer;
            transition:.25s;
        }

        button:hover{
            transform:translateY(-1px);
            box-shadow: 0 10px 24px rgba(37,99,235,.25);
        }

        /* FOOTER */
        .footer{
            margin-top:28px;
            text-align:center;
            color:#94a3b8;
            font-size:13px;
        }

        .bottom{
            margin-top:22px;
            text-align:center;
            color:#64748b;
            font-size:14px;
        }

        .bottom a{
            color:#2563eb;
            text-decoration:none;
            font-weight:600;
        }

        @media(max-width:500px){
            .container{
                padding:32px 24px;
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

    <h2>Create Account</h2>
    <p class="subtitle">Register employee account</p>

    <form action="{{ route('register.process') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" placeholder="Enter your name" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" placeholder="Enter your phone">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" required>
        </div>

        <div class="form-group">
            <label>Department</label>
            <select name="department">
                <option value="IT">IT</option>
                <option value="Finance">Finance</option>
                <option value="HR">HR</option>
                <option value="Marketing">Marketing</option>
                <option value="Operations">Operations</option>
            </select>
        </div>

        <button type="submit">Register</button>
    </form>

    <div class="bottom">
        Already have an account? 
        <a href="{{ route('login') }}">Sign In</a>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Helpdesk Plus
    </div>
    
</div>

</body>
</html>