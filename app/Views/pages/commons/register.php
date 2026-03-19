<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register — AdminPanel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Outfit', system-ui, sans-serif; min-height: 100vh; display: flex; background: #eef2f7; }
        .auth-brand {
            width: 420px; min-height: 100vh; flex-shrink: 0;
            background: linear-gradient(160deg, #050d1a 0%, #0a1628 40%, #162d58 100%);
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            padding: 3rem 2.5rem; position: relative; overflow: hidden;
        }
        .auth-brand::before { content:''; position:absolute; width:500px; height:500px; border-radius:50%; border:1px solid rgba(232,185,35,0.08); top:-150px; right:-150px; }
        .auth-brand::after  { content:''; position:absolute; width:350px; height:350px; border-radius:50%; border:1px solid rgba(232,185,35,0.06); bottom:-100px; left:-100px; }
        .brand-logo { width:80px; height:80px; background:linear-gradient(135deg,#e8b923,#b8860b); border-radius:22px; display:flex; align-items:center; justify-content:center; font-size:2.2rem; color:#0a1628; margin-bottom:1.75rem; box-shadow:0 8px 32px rgba(232,185,35,0.35); position:relative; z-index:1; }
        .auth-brand h1 { font-size:2rem; font-weight:900; color:#fff; margin-bottom:0.6rem; letter-spacing:-0.03em; position:relative; z-index:1; }
        .gold-line { width:48px; height:3px; background:linear-gradient(90deg,#e8b923,#fae08a); border-radius:2px; margin:1.25rem auto; position:relative; z-index:1; }
        .auth-brand p { color:rgba(255,255,255,0.55); font-size:0.9rem; text-align:center; line-height:1.7; max-width:280px; position:relative; z-index:1; }
        .auth-form-wrapper { flex:1; display:flex; align-items:center; justify-content:center; padding:2rem; }
        .auth-form { width:100%; max-width:460px; }
        .form-title { font-size:1.75rem; font-weight:900; color:#0a1628; margin-bottom:0.4rem; letter-spacing:-0.03em; }
        .form-subtitle { color:#4a6080; font-size:0.9rem; margin-bottom:2rem; }
        .form-label { font-size:0.82rem; font-weight:700; color:#162d58; margin-bottom:0.4rem; display:block; }
        .input-wrap { position:relative; margin-bottom:1.1rem; }
        .input-icon { position:absolute; left:1rem; top:50%; transform:translateY(-50%); color:#8aa0b8; font-size:1rem; pointer-events:none; }
        .form-control { width:100%; border:1.5px solid #d4dde8; border-radius:10px; padding:0.72rem 1rem 0.72rem 2.75rem; font-size:0.9rem; font-family:inherit; color:#0a1628; background:#fff; transition:border-color 0.15s, box-shadow 0.15s; }
        .form-control:focus { border-color:#162d58; box-shadow:0 0 0 3px rgba(22,45,88,0.1); outline:none; }
        .btn-register { width:100%; background:linear-gradient(135deg,#162d58,#0a1628); color:#fff; border:none; border-radius:10px; padding:0.85rem; font-size:1rem; font-weight:700; font-family:inherit; cursor:pointer; transition:all 0.18s ease; position:relative; overflow:hidden; margin-top:0.5rem; }
        .btn-register::after { content:''; position:absolute; bottom:0; left:0; right:0; height:3px; background:linear-gradient(90deg,#e8b923,#fae08a); }
        .btn-register:hover { background:linear-gradient(135deg,#1e3a6e,#162d58); box-shadow:0 8px 28px rgba(10,22,40,0.3); transform:translateY(-2px); }
        .divider { display:flex; align-items:center; gap:0.75rem; color:#d4dde8; font-size:0.82rem; margin:1.5rem 0; }
        .divider::before, .divider::after { content:''; flex:1; height:1px; background:#e8eef5; }
        .alert { border-radius:10px; font-size:0.875rem; padding:0.75rem 1rem; margin-bottom:1.25rem; }
        .alert-danger { background:#fef2f2; color:#b91c1c; border:none; border-left:4px solid #dc2626; }
        @media (max-width:768px) { .auth-brand { display:none; } .auth-form-wrapper { padding:2rem 1.5rem; } }
    </style>
</head>
<body>
    <div class="auth-brand">
        <div class="brand-logo"><i class="bi bi-person-plus-fill"></i></div>
        <h1>Create Account</h1>
        <div class="gold-line"></div>
        <p>Join AdminPanel and start managing your academic profile today.</p>
    </div>

    <div class="auth-form-wrapper">
        <div class="auth-form">
            <p class="form-title">Get started</p>
            <p class="form-subtitle">Fill in your details to create your account</p>

            <?php if (session()->getFlashdata('notif_error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= session()->getFlashdata('notif_error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('register') ?>" method="POST">
                <div>
                    <label class="form-label">Full Name</label>
                    <div class="input-wrap">
                        <i class="bi bi-person input-icon"></i>
                        <input type="text" name="inputFullname" class="form-control" placeholder="Juan dela Cruz" value="<?= old('inputFullname') ?>" required>
                    </div>
                </div>
                <div>
                    <label class="form-label">Username / Email</label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="text" name="inputEmail" class="form-control" placeholder="you@school.edu" value="<?= old('inputEmail') ?>" required>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-6">
                        <label class="form-label">Password</label>
                        <div class="input-wrap" style="margin-bottom:0;">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" name="inputPassword" class="form-control" placeholder="Min. 6 chars" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Confirm Password</label>
                        <div class="input-wrap" style="margin-bottom:0;">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input type="password" name="inputPassword2" class="form-control" placeholder="Repeat password" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn-register mt-3">
                    <i class="bi bi-person-check me-2"></i>Create Account
                </button>
            </form>

            <div class="divider">or</div>
            <p style="text-align:center;font-size:0.875rem;color:#4a6080;margin:0;">
                Already have an account? <a href="<?= base_url('/') ?>" style="color:#162d58;font-weight:700;text-decoration:none;">Sign in</a>
            </p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
