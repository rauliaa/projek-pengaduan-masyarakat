<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: #f2f7ff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        header {
            width: 100%;
            padding: 0px 0;  /* Menambahkan padding agar header tidak menempel langsung ke atas */
            background-color: white;
            display: flex;
            align-items: center;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 10;
            max-width: 100%;
            margin-bottom: 20px;  /* Menambahkan jarak bawah antara header dan login box */
        }

        header .logo h1 {
            color: #4553E9;  /* Membuat tulisan PRIMA berwarna biru */
            font-size: 20px;  /* Memperkecil ukuran font */
            margin-left: 10px;
        }

        header .logo {
            display: flex;
            align-items: center;
        }
        header .logo img {
            width: 85px;
            height: auto;
        }
        .login-box {
            width: 100%;
            max-width: 400px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            position: relative;
            overflow: hidden;
            margin-top: 110px;  /* Menambahkan jarak antara login box dan header */
            margin-bottom: -10px;  /* Menambahkan jarak bawah agar tidak terlalu dekat dengan footer */
        }
        .login-box h3 {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            color: #4553E9;
            margin-bottom: 30px;
        }
        .login-box input {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease;
        }
        .login-box input:focus {
            border-color: #4553E9;
        }
        .login-box .btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #4553E9, #272F83);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .login-box .btn:hover {
            background-color: #272F83;
        }
        .login-box .register {
            text-align: center;
            font-size: 16px;
            margin-top: 15px;
        }
        .login-box .register a {
            color: #4553E9;
            font-weight: bold;
            text-decoration: none;
        }
        .separator {
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%) rotate(30deg);
            width: 100px;
            height: 2px;
            background-color: #fff;
            opacity: 0.7;
        }
        .separator-2 {
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%) rotate(-30deg);
            width: 100px;
            height: 2px;
            background-color: #fff;
            opacity: 0.7;
        }

        .custom-checkbox {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .custom-checkbox .custom-control-input {
            position: absolute;
            opacity: 0;
        }

        .custom-checkbox .custom-control-label {
            position: relative;
            padding-left: 25px;
            font-size: 14px;
            cursor: pointer;
            line-height: 1.5;
        }

        .custom-checkbox .custom-control-label::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            border: 2px solid #4553E9;
            border-radius: 4px;
            background-color: #fff;
            transition: all 0.3s ease;
        }

        .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #4553E9;
            border-color: #4553E9;
        }

        .custom-checkbox .custom-control-input:checked ~ .custom-control-label::after {
            content: '\2713';
            position: absolute;
            left: 4px;
            top: -2px;
            font-size: 12px;
            color: white;
        }

        .custom-checkbox .custom-control-label:hover::before {
            border-color: #272F83;
        }
        footer {
            background-color: white;  /* Warna putih untuk footer */
            padding: 20px 0;  /* Memberikan ruang di dalam footer */
            text-align: center;  /* Menyusun teks footer ke tengah */
            margin-top: 40px;  /* Memberikan jarak antara footer dan login box */
            width: 100%;  /* Memastikan footer memenuhi lebar layar */
            position: relative;
        }
        footer p {
            font-size: 12px;  /* Ukuran font lebih kecil */
            color: #888;  /* Memberikan warna abu-abu pada teks */
        }
    </style>
</head>
<body>
    <!-- Header -->
<header>
    <div class="logo">
        <img src="{{ asset('quick/assets/img/logo.png') }}" alt="PRIMA Logo">
        <a href="{{ url('/') }}" style="text-decoration: none;"> <!-- Menghilangkan underline pada link -->
            <h1>PRIMA</h1>  <!-- Warna biru untuk tulisan PRIMA -->
        </a>
    </div>
</header>

    <!-- Login Box -->
    <div class="login-box">
        <div class="separator"></div>
        <div class="separator-2"></div>
        <h3>Login</h3>
        <form action="{{ route('user.login') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input type="text" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Email atau Username">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" type="password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Remember Me Checkbox -->
            <div class="custom-checkbox">
                <input class="custom-control-input" id="customCheckLogin" type="checkbox">
                <label class="custom-control-label" for="customCheckLogin">
                    <span class="text-muted">Remember me</span>
                </label>
            </div>
            
            <button type="submit" class="btn">Login</button>
        </form>
        <div class="register">
            <p>Don't have an account? <a href="{{ url('register') }}">Register</a></p>
        </div>
    </div>
</body>
<footer>
    <p>&copy; 2025 PRIMA. All rights reserved.</p>
    <p>Designed by <a href="https://www.linkedin.com/in/rahma-aulia-mangundap/">Rahma Aulia Mangundap</a> </p>
</footer>
</html>
