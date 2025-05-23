<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISFOS Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @keyframes float { 0% { transform: translateY(0px); } 50% { transform: translateY(-20px); } 100% { transform: translateY(0px); } }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideIn { from { transform: translateX(-100px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.05); } 100% { transform: scale(1); } }
        .login-container { min-height: 100vh; background-color: #fff1f2; position: relative; overflow: hidden; }
        .shape { position: absolute; z-index: 0; opacity: 0.1; }
        .shape-1 { top: 10%; left: 10%; width: 50px; height: 50px; background: #000; border-radius: 50%; animation: float 6s ease-in-out infinite; }
        .shape-2 { bottom: 20%; right: 10%; width: 80px; height: 80px; background: #000; animation: float 8s ease-in-out infinite; }
        .shape-3 { top: 50%; right: 20%; width: 40px; height: 40px; background: #000; transform: rotate(45deg); animation: float 7s ease-in-out infinite; }
        .login-card { background: white; border-radius: 15px; box-shadow: 0 0 15px rgba(0,0,0,0.1); padding: 2rem; position: relative; animation: fadeIn 1s ease-out; }
        .welcome-section { background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 0 15px rgba(0,0,0,0.1); animation: slideIn 1s ease-out; }
        .logo-img { width: 150px; height: auto; margin-bottom: 1rem; animation: float 6s ease-in-out infinite; }
        .form-control { padding: 0.8rem; border-radius: 10px; border: 1px solid #ced4da; transition: all 0.3s ease; }
        .form-control:focus { box-shadow: none; border-color: #000; transform: translateY(-2px); }
        .btn-dark { width: 100%; padding: 0.8rem; border-radius: 5px; transition: transform 0.3s ease; }
        .btn-dark:hover { transform: translateY(-2px); }
        .login-link { animation: pulse 2s infinite; }
        @media (max-width: 768px) { .shape { display: none; } }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>

        <div class="container">
            <div class="row justify-content-center align-items-center min-vh-100">
                <div class="col-md-8">
                    <div class="row g-0 main-container">
                        <div class="col-md-6 d-flex flex-column align-items-center justify-content-center p-4 text-center welcome-section">
                            <h2 class="mb-3">Welcome</h2>
                            <h4 class="mb-4">Sisfos Sarsarpas</h4>

                            <img src="{{ asset('images/LogoTB.png') }}" alt="SMK TARUNA BHAKTI" class="logo-img">

                            <h5>SMK TARUNA BHAKTI</h5>
                        </div>

                        <div class="col-md-6 login-card">
                            <h3 class="text-center mb-4">Register</h3>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('actionregister') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                                </div>
                                <button type="submit" class="btn btn-dark mb-3">Register</button>
                                <p class="text-center mb-0">
                                    Already have an account?
                                    <a href="{{ route('login') }}" class="text-decoration-none login-link">Login</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
