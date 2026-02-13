<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yönetim Paneli | Giriş Yap</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="/back/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="/back/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="/back/dist/css/adminlte.min.css">

    <style>
        body.login-page {
            background-color: #0f121a;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-box {
            width: 400px;
        }
        .card {
            background-color: #1a1e2b;
            border: 1px solid #2d3244;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
        }
        .login-card-body {
            background-color: transparent;
            color: #cbd5e0;
            padding: 2rem;
        }
        .login-logo a {
            color: #ffffff !important;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .form-control {
            background-color: #2d3244;
            border: 1px solid #3f475e;
            color: #fff;
            border-radius: 8px;
        }
        .form-control:focus {
            background-color: #2d3244;
            border-color: #6366f1;
            color: #fff;
            box-shadow: none;
        }
        .input-group-text {
            background-color: #3f475e;
            border: 1px solid #3f475e;
            color: #cbd5e0;
            border-radius: 0 8px 8px 0;
        }
        .btn-primary {
            background-color: #6366f1;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background-color: #4f46e5;
            transform: translateY(-2px);
        }
        .login-box-msg {
            color: #a0aec0;
            font-size: 0.9rem;
        }
        .invalid-feedback {
            color: #ff6b6b;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo mb-4">
        <a href="/"><b>ADMIN</b>PANEL</a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Yönetim paneline erişmek için oturum açın</p>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-posta Adresiniz" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Şifreniz" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row mt-4">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" style="color: #a0aec0; font-weight: normal;">
                                Beni Hatırla
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<script src="/back/plugins/jquery/jquery.min.js"></script>
<script src="/back/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/back/dist/js/adminlte.min.js"></script>
</body>
</html>
