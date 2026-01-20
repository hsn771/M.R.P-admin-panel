<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: radial-gradient(circle at top left, #2563eb 0, #0f172a 40%, #020617 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; color: #111827; }
        .card { width: 100%; max-width: 380px; background: rgba(15,23,42,0.97); border-radius: 1rem; padding: 2rem 1.9rem 1.7rem; box-shadow: 0 20px 45px rgba(15,23,42,0.7); border: 1px solid rgba(148,163,184,0.25); backdrop-filter: blur(12px); }
        .title { font-size: 1.4rem; font-weight: 700; color: #e5e7eb; margin-bottom: 0.35rem; }
        .subtitle { font-size: 0.9rem; color: #9ca3af; margin-bottom: 1.5rem; }
        label { display: block; font-size: 0.8rem; color: #9ca3af; margin-bottom: 0.3rem; }
        input[type=email], input[type=password] { width: 100%; padding: 0.55rem 0.75rem; border-radius: 0.55rem; border: 1px solid #1f2937; background: #020617; color: #e5e7eb; font-size: 0.9rem; outline: none; }
        input[type=email]:focus, input[type=password]:focus { border-color: #2563eb; box-shadow: 0 0 0 1px rgba(37,99,235,0.6); }
        .field { margin-bottom: 0.9rem; }
        .error { color: #fca5a5; font-size: 0.8rem; margin-top: 0.25rem; }
        .btn { width: 100%; margin-top: 0.6rem; padding: 0.6rem 0.75rem; border-radius: 0.7rem; border: none; cursor: pointer; font-size: 0.9rem; font-weight: 600; letter-spacing: 0.02em; background: linear-gradient(to right, #2563eb, #4f46e5); color: #e5e7eb; box-shadow: 0 12px 25px rgba(37,99,235,0.4); }
        .btn:hover { filter: brightness(1.08); }
        .footer { margin-top: 0.9rem; font-size: 0.75rem; color: #6b7280; text-align: center; }
        .remember { display: flex; align-items: center; justify-content: space-between; margin-top: 0.5rem; font-size: 0.8rem; color: #9ca3af; }
        .remember label { display: flex; align-items: center; gap: 0.4rem; margin: 0; }
        .remember input[type=checkbox] { accent-color: #2563eb; }
    </style>
</head>
<body>
<form class="card" action="{{ route('login.attempt') }}" method="POST">
    @csrf
    <div class="title">Admin login</div>
    <div class="subtitle">Sign in to access the admin panel.</div>

    <div class="field">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', 'admin@admin.com') }}" required autofocus>
        @error('email')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="field">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" value="password" required>
        @error('password')
        <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="remember">
        <label>
            <input type="checkbox" name="remember">
            Remember me
        </label>
        <span>Demo: admin@admin.com / password</span>
    </div>

    <button class="btn" type="submit">Sign in</button>

    <div class="footer">
        Basic Laravel admin panel • Session-based authentication
    </div>
</form>
</body>
</html>


