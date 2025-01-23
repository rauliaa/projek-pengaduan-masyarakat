<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            min-height: 100vh;  /* Ensure the body takes at least the full height of the viewport */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        header {
            width: 100%;
            padding: 0;
            background-color: white;
            display: flex;
            align-items: center;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 10;
            max-width: 100%;
            margin-bottom: 0;
        }
        header .logo h1 {
            color: #4553E9;
            font-size: 20px;
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
        .register-box {
            width: 100%;
            max-width: 400px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            position: relative;
            overflow: hidden;
            margin-top: 100px;  /* Space between header and register box */
            padding-bottom: 60px;  /* Ensure register button is not cut off */
        }
        .register-box h3 {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            color: #4553E9;
            margin-bottom: 30px;
        }
        .register-box input {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease;
        }
        .register-box input:focus {
            border-color: #4553E9;
        }
        .register-box .btn {
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
        .register-box .btn:hover {
            background-color: #272F83;
        }
        .register-box .login {
            text-align: center;
            font-size: 16px;
            margin-top: 15px;
        }
        .register-box .login a {
            color: #4553E9;
            font-weight: bold;
            text-decoration: none;
        }
        footer {
            background-color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 40px;
            width: 100%;
            position: relative;
        }
        footer p {
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    
    @include('partials.headerauth')

    <div class="register-box">
        <h3>Register</h3>
        <form action="{{ route('user.register-post') }}" role="form" method="POST">
            @csrf
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"></span>
                        </div>
                        <input type="number" value="{{ old('nik') }}" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" placeholder="NIK">
                        @error('nik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Nama">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="text" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="number " value="{{ old('telp') }}" class="form-control @error('telp') is-invalid @enderror" name="telp" id="telp" placeholder="No Telpon">
                        @error('telp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group input-group-merge input-group-alternative">
                      <div class="input-group-prepend">
                        <span class="input-group-text"></span>
                      </div>
                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            <button type="submit" class="btn">Register</button>
        </form>
        <div class="login">
            <p>Sudah punya akun? <a href="{{ url('login') }}">Login</a></p>
        </div>
    </div>
</body>
    @include('partials.footerauth')
</html>
