<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk Plus</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI',sans-serif;
        }

        body{
            background:#f4f7fb;
        }

        .wrapper{
            display:flex;
            min-height:100vh;
        }

        /* Sidebar */
        .sidebar{
            width:250px;
            background:#2563eb;
            position:fixed;
            top:0;
            left:0;
            bottom:0;
            padding:30px 20px;
            color:white;
            display:flex;
            flex-direction:column;
        }

        .logo{
            text-align:center;
            margin-bottom:40px;
        }

        .logo h2{
            font-size:28px;
        }

        .logo p{
            font-size:13px;
            opacity:.8;
        }

        .menu{
            flex:1;
            display:flex;
            flex-direction:column;
        }

        .menu a{
            display:block;
            text-decoration:none;
            color:white;
            padding:14px 18px;
            border-radius:10px;
            margin-bottom:10px;
            transition:.3s;
            font-weight:500;
        }

        .menu a:hover{
            background:rgba(255,255,255,.15);
        }

        .menu a.active{
            background:white;
            color:#2563eb;
            font-weight:700;
            box-shadow:0 2px 8px rgba(0,0,0,.12);
        }

        /* Main */
        .main{
            margin-left:250px;
            width:calc(100% - 250px);
        }

        /* Navbar */
        .navbar{
            height:70px;
            background:white;
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:0 35px;
            box-shadow:0 2px 8px rgba(0,0,0,.05);
            position:sticky;
            top:0;
            z-index:100;
        }

        /* Badge Portal Employee ala SIMAK */
        .badge-employee{
            background:#eff6ff;
            color:#2563eb;
            padding:6px 16px;
            border-radius:999px;
            font-size:11px;
            font-weight:700;
            border:1px solid rgba(37,99,235,.1);
            text-transform:uppercase;
            letter-spacing:.5px;
        }

        /* Komponen Tanggal Sebaris di Kanan Navbar */
        .date-display {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
        }

        /* Content */
        .content{
            padding:35px;
        }

        .card{
            background:white;
            padding:30px;
            border-radius:16px;
            box-shadow:0 5px 18px rgba(0,0,0,.05);
        }

        /* Logout Button */
        .logout-form{
            margin-top:auto;
            padding-top:20px;
            border-top:1px solid rgba(255,255,255,0.15);
        }

        .logout-btn{
            width:100%;
            background:none;
            border:none;
            text-align:left;
            padding:14px 18px;
            border-radius:10px;
            color:white;
            font-size:15px;
            font-weight:500;
            cursor:pointer;
            transition:.3s;
        }

        .logout-btn:hover{
            background:rgba(255,255,255,.15);
        }
    </style>
</head>

<body>

<div class="wrapper">

    <div class="sidebar">

        <div class="logo">
            <h2>HP</h2>
            <p>Helpdesk Plus</p>
        </div>

        <div class="menu">
            <a href="{{ route('user.dashboard') }}"
               class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                🏠 Dashboard
            </a>

            <a href="{{ route('ticket.index') }}"
               class="{{ 
                    request()->routeIs('ticket.index') || 
                    request()->routeIs('ticket.show') || 
                    request()->routeIs('ticket.create')
                    ? 'active' : '' 
               }}">
                🎫 My Tickets
            </a>

            <a href="{{ route('profile.index') }}"
               class="{{ request()->routeIs('profile.index') ? 'active' : '' }}">
                👤 Profile
            </a>

            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">
                    🚪 Logout
                </button>
            </form>
        </div>

    </div>

    <div class="main">

        <div class="navbar">
            <div class="badge-employee">
                PORTAL EMPLOYEE
            </div>

            <div class="date-display">
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
            </div>
        </div>

        <div class="content">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>