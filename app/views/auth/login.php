<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Band Manager</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: #eee; 
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .bg-decor { 
            position: fixed; 
            inset: 0; 
            z-index: -1; 
            pointer-events: none; 
            background:
                radial-gradient(800px 800px at 20% 30%, rgba(255,69,0,.08), transparent 70%),
                radial-gradient(600px 600px at 80% 20%, rgba(255,215,0,.06), transparent 60%);
            animation: pulse 15s ease-in-out infinite alternate; 
        }
        .container { 
            max-width: 460px; 
            width: 100%;
            padding: 32px; 
            background: linear-gradient(145deg, #2c2c54 0%, #232347 100%);
            border: 2px solid #40407a; 
            border-radius: 16px; 
            box-shadow: 0 15px 40px rgba(0,0,0,.4), 0 5px 15px rgba(255,69,0,.1);
            animation: slideUp .6s ease;
        }
        .logo { text-align: center; margin-bottom: 24px; font-size: 48px; animation: bounce 1s ease; }
        h1 { margin: 0 0 8px; color: #ffd700; font-size: 28px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; }
        p.sub { margin: 0 0 24px; color: #b19cd9; font-size: 14px; }
        label { display: block; margin: 16px 0 8px; color: #b19cd9; font-size: 12px; text-transform: uppercase; letter-spacing: .5px; font-weight: 600; }
        input[type="email"], input[type="password"] { 
            width: 100%; 
            padding: 14px 16px; 
            border-radius: 10px; 
            border: 2px solid #40407a; 
            background: #1e1e42; 
            color: #eee; 
            font-size: 15px;
            transition: all .3s ease;
        }
        input:focus { 
            outline: none; 
            border-color: #ffd700; 
            box-shadow: 0 0 0 3px rgba(255,215,0,.2); 
            background: #232347;
        }
        .actions { margin-top: 24px; display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }
        .btn { 
            cursor: pointer; 
            border: 0; 
            padding: 14px 24px; 
            border-radius: 10px; 
            font-weight: 700; 
            text-transform: uppercase; 
            letter-spacing: .5px; 
            transition: all .2s ease;
            font-size: 13px;
        }
        .btn-primary { 
            background: linear-gradient(135deg, #ff4757, #ff3742); 
            color: #fff; 
            box-shadow: 0 4px 12px rgba(255,71,87,.3);
        }
        .btn-primary:hover { 
            transform: translateY(-2px); 
            box-shadow: 0 6px 20px rgba(255,71,87,.4); 
        }
        .link { color: #ffd700; text-decoration: none; font-size: 13px; font-weight: 600; transition: color .2s; }
        .link:hover { color: #ffed4e; text-decoration: underline; }
        .alert { 
            background: rgba(231,76,60,.15); 
            border: 1px solid #e74c3c; 
            color: #ffdada; 
            padding: 12px 16px; 
            border-radius: 10px; 
            margin: 0 0 16px; 
            font-size: 13px;
            animation: shake .5s ease;
        }
        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes bounce { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.1); } }
        @keyframes pulse { 0% { opacity: .8; } 100% { opacity: 1; } }
        @keyframes shake { 0%, 100% { transform: translateX(0); } 25% { transform: translateX(-5px); } 75% { transform: translateX(5px); } }
    </style>
</head>
<body>
    <div class="bg-decor"></div>
    <div class="container">
        <div class="logo">🎸</div>
        <h1>Welcome Back</h1>
        <p class="sub">Sign in to manage your band roster</p>
        <?php if (!empty($error)): ?>
            <div class="alert">⚠️ <?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form action="<?= site_url('login') ?>" method="POST">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required autofocus />

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required />

            <div class="actions">
                <button class="btn btn-primary" type="submit">🔐 Login</button>
                <a class="link" href="<?= site_url('register') ?>">Create an account →</a>
            </div>
        </form>
    </div>
</body>
</html>
